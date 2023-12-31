<?php
include_once('../../auxiliary/routing/checkURI.php');

require_once('src/auxiliary/routing/redirect.php');
require_once('src/auxiliary/db_interaction/db.php');
require_once('src/auxiliary/db_interaction/users.php');
require_once('src/auxiliary/session_interaction/session.php');

startSession();

// Check if user is already logged in
if (isUserLoggedIn()) {
    redirectToRoot();
}

// Check if login form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get input values
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    $db_path = 'db/app.db';
    $pdo = connectToDB($db_path);

    // Check if user exists
    $user = getUserWithUsername($pdo, $username);
    $user2 = getUserWithEmail($pdo, $email);

    if ($user || $user2) {
        $error_message = 'Username or email already exists.';
    } elseif ($password != $confirm_password) {
        $error_message = 'Passwords do not match.';
    } else {
        $role = 'student';
        // Hash password
        $password = password_hash($password, PASSWORD_DEFAULT);

        insertNewUser($pdo, $username, $email, $role, $password);

        // Set session variable
        setSessionUserData($pdo->lastInsertId(), $username, $role);
        redirectToRoot();
    }
}
?>

<main class="main-page-container main-container-size">
    <h1>Register</h1>
    <div class="authentication">

        <form method="POST">
            <input type="text" id="username" name="username" placeholder="Username" required><br>
            <input type="text" id="firstname" name="firstname" placeholder="Primeiro Nome" required><br>
            <input type="text" id="lastname" name="lastname" placeholder="Último Nome" required><br>

            <input type="email" id="email" name="email" placeholder="Email" required><br>

            <!-- <select id="role" name="role">
                <option>Estudante</option>
                <option>Professor</option>
                <!-- <option>Progenitor</option> 
            </select>    -->

            <!-- <input type="text" id="yearenrolled" name="yearenrolled" placeholder="Ano Atual" required><br>
            <input type="text" id="trimesterenrolled" name="trimesterenrolled" placeholder="Período Atual" required><br> -->
            
            <input type="password" id="password" name="password" placeholder="Enter Password" required><br>
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required><br>

            <label class="customCheckBox"> Concordo com os Termos e Condições
                <input type="checkbox" id="checkboxtermos"required>
            </label>
            <label class="customCheckBox"> Concordo com a Política de Privacidade
                <input type="checkbox" id="checkboxpolitica"required>
            </label>

            <input type="submit" value="Register">
            <?php if (isset($error_message)) : ?>
                <div class="login-error-message"><?php echo $error_message; ?></div>
            <?php endif; ?>
            <p>Já tens uma conta?<a href="/sign-in">Entrar</a></p>
        </form>
    </div>
</main>