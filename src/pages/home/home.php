<?php
include_once('../../auxiliary/routing/checkURI.php');

require_once('src/auxiliary/db_interaction/db.php');
require_once('src/auxiliary/session_interaction/session.php');

startSession();

if (isMessageSet()) {
    echo "<script> window.addEventListener('DOMContentLoaded', () => {displayMessagePopUp('" . getSessionMessage() . "');}); </script>";
    unsetMessage();
}

$article1_contents = array(
    "Classroom Student é uma plataforma educacional inovadora que visa ajudar os estudantes a atingir o seu máximo potencial académico.",
    "Com um design intuitivo e funcionalidades abrangentes, esta aplicação permite aos estudantes organizar as suas disciplinas, notas e metas de forma eficaz."
);

$instruction_contents = array(
    "Cria o Teu Perfil: Começa por criar um perfil personalizado. Insere as tuas disciplinas, notas e conquistas para acompanhares o teu progresso de forma fácil e rápida.",
    "Acompanha o Teu Progresso: Regista as tuas notas e disciplinas na nossa interface intuitiva. Observa o teu desempenho académico e vê o teu crescimento ao longo do tempo.",
    "Estabelece Metas: Define metas alcançáveis e monitoriza as tuas realizações. Visualiza o teu progresso académico e mantém-te motivado durante toda a tua jornada de aprendizagem.",
    "Set Goals: Set achievable goals and monitor your achievements. Visualize your academic growth and stay motivated throughout your learning journey.",
    "Colabora com Educadores: Professores e administradores têm acesso aos teus registos académicos. Podem oferecer orientação personalizada e fornecer insights valiosos para enriquecer a tua experiência de aprendizagem."
);
?>

<main class="main-page-container main-container-size">
    <section class="container-box main-page-container home-section">
        <h1>Bem vindo à <em>Classroom Student</em></h1>
        <article>
            <h2>Sobre a aplicação</h2>
            <?php
            foreach ($article1_contents as $paragraph) {
                echo '<p>' . $paragraph . '</p>';
            }
            ?>
        </article>
        <article class="home-instructions">
            <h2>Como Funciona?</h2>
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