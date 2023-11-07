<?php
include_once('../../auxiliary/routing/checkURI.php');

require_once('src/auxiliary/routing/redirect.php');
require_once('src/auxiliary/session_interaction/session.php');
require_once('src/auxiliary/db_interaction/db.php');
require_once('src/auxiliary/db_interaction/tickets.php');
require_once('src/auxiliary/db_interaction/users.php');
require_once('src/templates/injectable/ticket_templates.php');
require_once('src/templates/injectable/error_templates.php');
require_once('src/auxiliary/db_interaction/faqs.php');

startSession();

// fetch ticket id if set
$id = isset($_GET['id']) ? $_GET['id'] : null;

// if a parameter was passed, we try to get that ticket from the database
if (!is_null($id)) {
    //connect to db (path starts in root, since we're importing ticket.php there)
    $db_path = 'db/app.db';
    $pdo = connectToDB($db_path);

    $ticket = getTicketAndCreatorData($pdo, $id);
    $faqs = getFAQs($pdo);

    if (!$ticket) {
        redirectTo('404');
    }

    $creator_id = $ticket['creator_id'];
    $creator_username = $ticket['creator_username'];
    $creator_picture = $ticket['creator_picture'];
    $creator_create_at = $ticket['creator_created_at'];

    if ($creator_id !== getSessionUserID()) {
        $session_role = getSessionUserRole();
        if ($session_role !== 'admin' && $session_role !== 'agent') {
            redirectTo('403');
        }
    }

    $title = $ticket['title'];
    $content = $ticket['content'];
    $ticket_status = $ticket['ticket_status'];
    $created_at = $ticket['created_at'];
    $updated_at = $ticket['updated_at'];
    $countTicketUser = getTicketUserCount($pdo, $creator_id);
    $countCommentUser = getCommentUserCount($pdo, $creator_id);
    $assigned_to = getUserWithID($pdo, $ticket['assign_id']);

    if ($creator_picture == null) {
        $creator_picture = "https://static-00.iconduck.com/assets.00/person-icon-476x512-hr6biidg.png";
    }

    if ($ticket['creator_id'] != getSessionUserID()) {
        $session_role = getSessionUserRole();
        if ($session_role !== 'admin' && $session_role !== 'agent') {
            $edit = false;
        } else {
            $edit = true;
        }
    } else {
        $edit = true;
    }

    $comments = getTicketCommentsAndCreatorData($pdo, $id);
}

function getTicketStatus($ticket_status)
{
    $class = $ticket_status . '-bubble';
    $ticket_status = htmlspecialchars($ticket_status);

    return <<<HTML
        <div class="{$class} status-bubble">
            {$ticket_status}
        </div>
    HTML;
}
function canComment($ticket_status, $assign_id, $creator_id)
{
    return isUserLoggedIn() && !($ticket_status === 'closed') && ((getSessionUserID() === $assign_id) || getSessionUserID() === $creator_id || getSessionUserRole() === 'admin');
}

function canCommentWithFAQs($ticket_status, $assign_id)
{
    return isUserLoggedIn() && !($ticket_status === 'closed') && ((getSessionUserID() === $assign_id) || getSessionUserRole() === 'admin');
}

?>


<main class="main-page-container main-container-size">
    <?php if (!$ticket) : ?>
        <?php echo simpleErrorTemplate("Error accessing that ticket. Please try to access a valid ticket.") ?>
    <?php else : ?>

        <section class="ticket-section main-container-size">
            <div class="container-box">
                <div class="ticket-question">
                    <h1><?php echo htmlspecialchars($title); ?></h1>
                    <?php if ($edit) : ?>
                        <div class="ticket-control-buttons">
                            <a class="edit-button" href="/ticket/edit?id=<?php echo htmlspecialchars($id); ?>">Edit</a>
                            <form method="POST" action="/src/routes/ticket/delete.php">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                                <input class="delete-button" type="submit" value="Delete">
                            </form>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="simple-flex-row justify-between items-center p-medium">
                    <div class="simple-flex-row items-center">
                        <p><span class="light-gray-color">Status: </span></p>
                        <?php echo getTicketStatus($ticket_status); ?>
                    </div>
                    <?php if ($assigned_to) : ?>
                        <div class="simple-flex-row items-center">
                            <p><span class="light-gray-color">Assigned to: </span></p>
                            <div class="assigned-bubble status-bubble">
                                <?php echo $assigned_to['username']; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php echo messageTemplate($creator_id, $creator_username, $creator_picture, $creator_create_at, $countTicketUser, $countCommentUser, $content, $created_at) ?>
        </section>

        <section class="comment-section main-container-size">
            <?php
            $commentaries = array();
            foreach ($comments as $comment) {
                $comment_id = $comment['id'];
                $comment_content = $comment['content'];
                $comment_created_at = $comment['created_at'];

                $commenter_id = $comment['commenter_id'];
                $commenter_username = $comment['commenter_username'];
                $commenter_picture = $comment['commenter_picture'];
                $commenter_created_at = $comment['commenter_created_at'];
                $countTicketUser = getTicketUserCount($pdo, $commenter_id);
                $countCommentUser = getCommentUserCount($pdo, $commenter_id);

                // Add the comment details to the $new array
                $commentaries[] = array(
                    'id' => $comment_id,
                    'content' => $comment_content,
                    'created_at' => $comment_created_at,
                    'commenter_username' => $commenter_username,
                    'commenter_picture' => $commenter_picture
                );



                if ($commenter_picture == null) {
                    $commenter_picture = "https://static-00.iconduck.com/assets.00/person-icon-476x512-hr6biidg.png";
                }

                echo "<article>";
                echo messageTemplate($commenter_id, $commenter_username, $commenter_picture, $commenter_created_at, $countTicketUser, $countCommentUser, $comment_content, $comment_created_at);
                echo "</article>";
            }

            ?>

            <?php if (canComment($ticket_status, $assigned_to['user_id'], $creator_id)) : ?>
                <div class="ticket-comment-form container-box">
                    <form action="/src/routes/comment/create.php" method="POST">
                        <label for="comment_content">Content:</label>
                        <textarea id="comment_content" name="comment_content" placeholder="Enter your comment here"></textarea><br>
                        <?php if (canCommentWithFAQs($ticket_status, $assigned_to['user_id'])) : ?>
                            <label for="faq-select">Or select a FAQ:</label>
                            <select id="faq-select" name="faq-select">
                                <option value="">Select a FAQ</option>
                                <?php foreach ($faqs as $faq) : ?>
                                    <option value="<?php echo htmlspecialchars($faq['answer']); ?>">
                                        <?php echo htmlspecialchars($faq['question']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select><br>
                        <?php endif; ?>
                        <input type="hidden" name="ticket_id" value="<?php echo htmlspecialchars($id); ?>">
                        <input class="submit-button" type="submit" value="Submit" disabled>
                    </form>


                </div>
            <?php endif; ?>
        </section>
    <?php endif; ?>
</main>