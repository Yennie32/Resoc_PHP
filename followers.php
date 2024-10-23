<?php $pageTitle = 'followers' ?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>ReSoC - Mes abonnés </title>
    <meta name="author" content="Julien Falconnet">
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <?php include './src/templates/header-template.php'; ?>

    <div id="wrapper">
        <?php
        include './src/methods/init-db.php';
        include './src/templates/aside-template.php';
        ?>
        <main class='contacts'>
            <?php
            $laQuestionEnSql = "
                    SELECT users.*
                    FROM followers
                    LEFT JOIN users ON users.id=followers.following_user_id
                    WHERE followers.followed_user_id='$userId'
                    GROUP BY users.id
                    ";
                    include './src/methods/fetch.php';
                    include './src/templates/follow-template.php';
            ?>
        </main>
    </div>
</body>

</html>
