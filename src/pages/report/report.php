<?php
include_once('../../auxiliary/routing/checkURI.php');

require_once('src/auxiliary/routing/redirect.php');
require_once('src/auxiliary/session_interaction/session.php');
require_once('src/auxiliary/db_interaction/db.php');
require_once('src/auxiliary/db_interaction/courses.php');
require_once('src/auxiliary/db_interaction/subjects.php');
require_once('src/auxiliary/db_interaction/report.php');
require_once('src/auxiliary/db_interaction/users.php');
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

switch ($session_role) {
    case 'admin':
        break;
    case 'teacher':
        break;
    case 'student':
    default:
    $reportIds = getReportsId($pdo, getSessionUserID());

    foreach ($reportIds as $reportId) {
        $reportCycle = getReportCycle($pdo, $reportId);
        $reportYear = getReportYear($pdo, $reportId);
        $reportSchoolName = getSchoolName($pdo, $reportId);
        $reportCountSubjects = getReportCountSubjects($pdo, $reportId);
        $reportAverage = getReportAverage($pdo, $reportId);
        $reportLastUpdated = getReportLastUpdated($pdo, $reportId);
        $reportDescription = getReportDescription($pdo, $reportId);
        // $reportData($reportsId,$reportCycle,$reportYear,$reportSchoolName,$reportCountSubjects,$reportAverage,$reportLastUpdated,$reportDescription);
        break;
    }
}

?>

<main class="main-page-container main-container-size">
    <h1>Relatório Anual</h1>
    <div>
        <li><a class="table"></a></li>
        <table id="reportcards">
            <tr>
                <th>Ciclo/Curso</th>
                <th>Ano</th>
                <th>Escola</th>
                <th>Nº Disciplinas</th>
                <th>Média</th>
                <th>Última Atualização</th>
                <th>Outras Info</th>
                <!-- Add more table headers as needed -->
            </tr>
            <?php
                // Loop through the fetched data and populate table rows dynamically
                foreach ($reportIds as $reportId) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($reportCycle) . "</td>";
                    echo "<td>" . htmlspecialchars($reportYear) . "</td>";
                    echo "<td>" . htmlspecialchars($reportSchoolName) . "</td>";
                    echo "<td>" . htmlspecialchars($reportCountSubjects) . "</td>";
                    echo "<td>" . htmlspecialchars($reportAverage) . "</td>";
                    echo "<td>" . htmlspecialchars($reportLastUpdated) . "</td>";
                    echo "<td>" . htmlspecialchars($reportDescription) . "</td>";
                    echo "</tr>";
                }
            ?>
        </table>
    </div>
</main>