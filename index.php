<?php
include_once('src/auxiliary/routing/checkURI.php');
include_once('src/auxiliary/debug/debug.php');
?>

<!DOCTYPE html>
<html lang="en">
<?php
include_once('src/templates/static/head.php');
?>

<body>
    <?php
    include_once('src/templates/static/header.php');

    include_once('src/auxiliary/routing/router.php');

    include_once('src/templates/static/footer.php');
    ?>
</body>

</html>