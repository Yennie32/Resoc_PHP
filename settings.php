<?php $pageTitle = "settings" ?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>ReSoC - Paramètres</title>
    <meta name="author" content="Julien Falconnet">
    <link rel="stylesheet" href="style.css" />
</head>

<body>
<?php include './src/templates/header-template.php'; ?>

    <div id="wrapper" class='profile'>

    <?php
        include './src/methods/init-db.php';
        include './src/templates/aside-template.php';
        ?>

        <main>
            <?php
            $laQuestionEnSql = "
                    SELECT users.*,
                    count(DISTINCT posts.id) as totalpost,
                    count(DISTINCT given.post_id) as totalgiven,
                    count(DISTINCT received.user_id) as totalreceived
                    FROM users
                    LEFT JOIN posts ON posts.user_id=users.id
                    LEFT JOIN likes as given ON given.user_id=users.id
                    LEFT JOIN likes as received ON received.post_id=posts.id
                    WHERE users.id = '$userId'
                    GROUP BY users.id
                    ";
                    include './src/methods/fetch.php';
                    include './src/templates/settings-template.php';
            ?>
        </main>
    </div>
</body>

</html>
