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

if (!isUserLoggedIn()) {
    redirectTo('403');
}

$session_role = getSessionUserRole();
if ($session_role !== 'admin' && $session_role !== 'teacher' && $session_role !== 'student') {
    redirectTo('403');
}

$db_path = 'db/app.db';
$pdo = connectToDB($db_path);


switch ($session_role) {
    case 'admin':
        break;
    case 'teacher':
        break;
    case 'student':
    default:
        $reportIds = getReportsId($pdo, getSessionUserID());
        // $reportData($reportsId,$reportCycle,$reportYear,$reportSchoolName,$reportCountSubjects,$reportAverage,$reportLastUpdated,$reportDescription);
        break;
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
                    $reportCycle = getReportCycleName($pdo, $reportId);
                    $reportCycle = ($reportCycle != null) ? htmlspecialchars($reportCycle) : "-";
                    
                    $reportYear = getReportYear($pdo, $reportId);
                    $reportYear = ($reportYear != null) ? htmlspecialchars($reportYear) : "-";
                    
                    $reportSchoolName = getSchoolName($pdo, $reportId);
                    $reportSchoolName = ($reportSchoolName != null) ? htmlspecialchars($reportSchoolName) : "-";

                    $reportCountSubjects = getReportCountSubjects($pdo, $reportId);
                    $reportCountSubjects = ($reportCountSubjects != null) ? htmlspecialchars($reportCountSubjects) : "-";

                    $reportAverage = getReportAverage($pdo, $reportId);
                    $reportAverage = ($reportAverage != null) ? htmlspecialchars($reportAverage) : "-";

                    $reportLastUpdated = getReportLastUpdated($pdo, $reportId);
                    $reportLastUpdated = ($reportLastUpdated != null) ? htmlspecialchars($reportLastUpdated) : "-";

                    echo "<tr>";
                    echo "<td>" . $reportCycle . "</td>";
                    echo "<td>" . $reportYear . "</td>";
                    echo "<td>" . $reportSchoolName . "</td>";
                    echo "<td>" . $reportCountSubjects . "</td>";
                    echo "<td>" . $reportAverage . "</td>";
                    echo "<td>" . $reportLastUpdated . "</td>";
                    echo "<td> <button type='button'>+</button> </td>";
                    echo "</tr>";
                }
            ?>
        </table>
    </div>
</main>
