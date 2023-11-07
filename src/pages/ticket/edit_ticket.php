<?php
include_once('../../auxiliary/routing/checkURI.php');

require_once('src/auxiliary/routing/redirect.php');
require_once('src/auxiliary/db_interaction/db.php');
require_once('src/auxiliary/db_interaction/departments.php');
require_once('src/auxiliary/db_interaction/tickets.php');
require_once('src/auxiliary/db_interaction/users.php');
require_once('src/auxiliary/session_interaction/session.php');

$id = $_GET['id'];

if (!isUserLoggedIn()) {
    redirectTo('sign-in');
}

if (!is_null($id)) {

    $db_path = 'db/app.db';
    $pdo = connectToDB($db_path);

    $ticket = getTicketByID($pdo, $id);

    $departments = getAllDepartments($pdo);
    $users = getAllAgents($pdo);


    // hashtags from ticket
    $hashtags = getTicketHashtags($pdo, $id);

    if (!$ticket) {
        redirectTo('404');
    } else {
        $department_id = $ticket['department_id'];
    }


    if ($ticket['creator_id'] !== getSessionUserID()) {
        if (getSessionUserRole() !== 'admin' && getSessionUserRole() !== 'agent') {
            redirectTo('403');
        }
    }
}

$title = $ticket['title'];
$content = $ticket['content'];
$status = $ticket['ticket_status'];
$department = $ticket['department_id'];
?>
<main class="main-page-container main-container-size edit_form">
    <h1>Edit Ticket</h1>
    <form method="POST" action="/src/routes/ticket/update.php">
        <?php echo '<input type="hidden" name="id" value="' . $id . '">'; ?>
        <?php if (getSessionUserRole() == 'client' || getSessionUserID() == $ticket['creator_id']) : ?>
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($title) ?>"><br>

            <label for="content">Content:</label>
            <textarea id="content" name="content"><?php echo htmlspecialchars($content) ?></textarea><br>
        <?php endif; ?>
        <?php
        if (getSessionUserRole() === 'admin' || getSessionUserRole() === 'agent') : ?>
            <label for="status-select">Status:</label>
            <select id="status-select" name="status">
                <option value="open" <?php if ($status === 'open') echo 'selected'; ?>>Open</option>
                <option value="closed" <?php if ($status === 'closed') echo 'selected'; ?>>Closed</option>
                <option value="assigned" <?php if ($status === 'assigned') echo 'selected'; ?>>Assigned</option>
            </select><br>

            <label for="agent-select">Assign:</label>
            <select id="agent-select" name="agent" <?php echo ($status === 'assigned') ? "" : "disabled"; ?>>
                <?php foreach ($users as $user) { ?>
                    <option value="<?php echo $user['user_id']; ?>" <?php if ($user['user_id'] === $ticket['assign_id']) echo 'selected'; ?>>
                        <?php echo $user['username']; ?>
                    </option>
                <?php } ?>
            </select><br>


            <label for="department">Department:</label>
            <select id="department" name="department">
                <?php foreach ($departments as $department) { ?>
                    <option value="<?php echo $department['department_id']; ?>" <?php if ($department_id === $department['department_id']) echo 'selected'; ?>>
                        <?php echo $department['department_name']; ?>
                    </option>
                <?php } ?>
            </select><br>
        <?php endif; ?>

        <label for="hashtags">Hashtags: (press space to add hashtag)</label>
        <div class="tags-input">
            <?php foreach ($hashtags as $hashtag) { ?>
                <div class="tag">
                    <span><?php echo htmlspecialchars($hashtag); ?></span>
                    <i class="remove-tag">x</i>
                </div>
            <?php } ?>
            <input type="text" id="hashtags" name="hashtags" placeholder="#">
        </div><br>
        <input type="hidden" name="hashtags" id="hashtags-input">

        <input class="submit-button" type="submit" value="Submit">
    </form>
</main>