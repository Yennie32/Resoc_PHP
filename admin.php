<?php $pageTitle = 'admin'
    ?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>ReSoC - Administration</title>
    <meta name="author" content="Julien Falconnet">
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <?php include './src/templates/header-template.php';
    include './src/methods/init-db.php';
    ?>

    <div id="wrapper" class='admin'>
        <?php include './src/templates/admin-tags-template.php';
        include './src/templates/admin-users-template.php' ?>
    </div>
</body>

</html>
