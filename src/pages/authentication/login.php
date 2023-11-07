<?php
include_once('../../auxiliary/routing/checkURI.php');

require_once('src/auxiliary/routing/redirect.php');
require_once('src/auxiliary/session_interaction/session.php');
require_once('src/auxiliary/db_interaction/db.php');
require_once('src/auxiliary/db_interaction/users.php');

startSession();

// Check if user is already logged in
if (isUserLoggedIn()) {
    redirectToRoot();
}

// Check if login form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Get input values
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Connect to database
    $db_path = 'db/app.db';
    $pdo = connectToDB($db_path);

    $user = getUserWithUsername($pdo, $username);

    // Check if user exists and password is correct
    if ($user && password_verify($password, $user['pw_hash'])) {
        // Set session variable
        setSessionUserData($user['user_id'], $username, $user['role_type']);
        redirectToRoot();
    } else {
        $error_message = 'Invalid username or password.';
    }
}
?>

<main class="main-page-container main-container-size">
    <h1>Login</h1>
    <div class="authentication">
        <form method="POST">
            <input type="text" id="username" name="username" placeholder="Username" required><br>
            <input type="password" id="password" name="password" placeholder="Password" required><br>
            <input type="submit" value="Login">
            <?php if (isset($error_message)) : ?>
                <div class="login-error-message"><?php echo $error_message; ?></div>
            <?php endif; ?>
            <p>Not registered yet? <a href="/sign-up">Sign up</a></p>

        </form>
    </div>
</main>