<?php
include_once('../../auxiliary/routing/checkURI.php');

require_once('src/auxiliary/db_interaction/db.php');
require_once('src/auxiliary/db_interaction/departments.php');
require_once('src/auxiliary/session_interaction/session.php');

startSession();

if (isMessageSet()) {
    echo "<script> window.addEventListener('DOMContentLoaded', () => {displayMessagePopUp('" . getSessionMessage() . "');}); </script>";
    unsetMessage();
}

$article1_contents = array(
    "Are you stumped on a subject and you just can't make any progress?",
    "Do you need help and guidance for your educational journey?",
    "Look no further! Classroom Student is your one-stop platform for all your needs."
);

$instruction_contents = array(
    "Submit Your Ticket: Simply submit a ticket detailing your query or request. Provide as much relevant information as possible to help our helperrs understand exactly what you need.",
    "Receive Assistance: We understand the importance of fast and efficient support. After reviewing your ticket, our agents will do their best to meet your needs.",
    "Collaborate and Learn: We encourage collaboration and learning. Take part in the conversation and help us help you. Ask questions, be relentless in your search for knowledge and hold us up to your highest standards!"
);
?>

<main class="main-page-container main-container-size">
    <section class="container-box main-page-container home-section">
        <h1>Welcome to <em>Classroom Student</em></h1>
        <article>
            <h2>Empowering Students with Expert Guidance!</h2>
            <?php
            foreach ($article1_contents as $paragraph) {
                echo '<p>' . $paragraph . '</p>';
            }
            ?>
        </article>
        <article class="home-instructions">
            <h2>How does it work?</h2>
            <ul>
                <?php
                foreach ($instruction_contents as $step) {
                    echo '<li>' . $step . '</li>';
                }
                ?>
            </ul>
        </article>
    </section>
</main>