<?php
include_once('../../auxiliary/routing/checkURI.php');

require_once('src/auxiliary/routing/redirect.php');
require_once('src/auxiliary/session_interaction/session.php');
require_once('src/auxiliary/db_interaction/db.php');
require_once('src/auxiliary/db_interaction/courses.php');
require_once('src/auxiliary/db_interaction/subjects.php');
require_once('src/templates/injectable/profile_templates.php');
require_once('src/templates/injectable/list_templates.php');
require_once('src/templates/injectable/error_templates.php');

startSession();

if (!isUserLoggedIn()) {
    redirectTo('403');
}

$session_role = getSessionUserRole();
if ($session_role !== 'admin' && $session_role !== 'teacher' && $session_role !== 'student') {
    redirectTo('403');
}

switch (getSessionUserRole()) {
    case 'admin':
        break;
    case 'teacher':
        break;
    case 'student':
    default:
        $reportcard = getReportCard($pdo, getSessionUserID());
        $nsubjects = getCountSubjets($pdo, getSessionUserID());
        $lastUpdated = getLastDateUpdated($pdo, getSessionUserID());
        $

    $tickets = getUserTicketsChunk($pdo, getSessionUserID(), $limit, $offset);
        break;
}

?>

<main class="main-page-container main-container-size">
    <h1>Relatórios Anuais</h1>
    <div>
        <li><a class="table" href="#"></a></li>
        <table id="reportcards">
            <tr>
                <th>Ciclo/Curso</th>
                <th>Ano</th>
                <th>Nº Disciplinas</th>
                <th>Nº Alunos</th>
                <!-- Add more table headers as needed -->
            </tr>
            <tr>
                <td><?php echo htmlspecialchars($course['cycle']); ?></td>
                <td><?php echo htmlspecialchars($course['year']); ?></td>
                <td><?php echo htmlspecialchars($course_info['Subjects']); ?></td>
                <td><?php echo htmlspecialchars($course_info['Users']); ?></td>
                <!-- Add more table data cells as needed -->
            </tr>
        </table>
        <!-- <table id="reportcards">
            <tr>
                <th>Ciclo/Curso</th>
                <th>Ano</th>
                <th>Nº Disciplinas</th>
                <th>Escola</th>
                <th>Média</th>
                <th>Outras Info</th>
            </tr>
            <tr>
                <td>1º Ciclo</td>
                <td>1º Ano</td>
                <td>4</td>
                <td>30</td>
                <td>Picua</td>
                <td>3</td>
                <td>+</td>
            </tr>
            </table> -->
    </div>


</main>