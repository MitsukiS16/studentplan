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
    "Are you striving for academic excellence and looking for a platform to organize your grades and subjects effectively?",
    "Look no further! Classroom Student is your dedicated space to stay organized, responsible, and on top of your educational journey."
);

$instruction_contents = array(
    "Create Your Profile: Get started by creating your personalized profile. Input your subjects, grades, and achievements to keep track of your academic progress.",
    "Track Your Progress: Easily input your grades and subjects into our user-friendly interface. Stay on top of your academic performance and see your progress over time.",
    "Stay Organized: Manage your subjects, assignments, and exam dates all in one place. Say goodbye to confusion and hello to clarity in your studies",
    "Set Goals: Set achievable goals and monitor your achievements. Visualize your academic growth and stay motivated throughout your learning journey.",
    "Collaborate with Educators: Teachers and administrators can access your academic records, offer personalized guidance, and provide valuable insights to enhance your learning experience."
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