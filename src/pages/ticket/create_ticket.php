<?php
include_once('../../auxiliary/routing/checkURI.php');

require_once('src/auxiliary/db_interaction/db.php');
require_once('src/auxiliary/db_interaction/departments.php');

$db_path = 'db/app.db';
$pdo = connectToDB($db_path);
$departments = getAllDepartments($pdo);

?>

<main class="edit_form">
    <h1>Create a New Ticket</h1>
    <form action="/src/routes/ticket/create.php" method="POST">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required><br>

        <label for="content">Content:</label>
        <textarea id="content" name="content" required></textarea><br>

        <label for="department">Department:</label>
        <select id="department" name="department" required>
            <option value="">-- Select Department --</option>
            <?php foreach ($departments as $department) { ?>
                <option value="<?php echo $department['department_id']; ?>"><?php echo $department['department_name']; ?></option>
            <?php } ?>
        </select><br>

        <label for="hashtags">Hashtags: (press space to add hashtag)</label>
        <div class="tags-input">
            <input type="text" id="hashtags" name="hashtags" placeholder="#">
        </div><br>
        <input type="hidden" name="hashtags" id="hashtags-input">

        <input class="submit-button" type="submit" value="Submit">
    </form>
</main>