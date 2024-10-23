<?php $pageTitle = "wall" ?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>ReSoC - Mur</title>
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

        <main>
            <?php
            $laQuestionEnSql = "
                    SELECT posts.content, posts.created,
                    posts.id,
                    posts.parent_id,
                    users.alias as author_name,
                    posts.user_id as user_id,
                    COUNT(likes.id) as like_number, GROUP_CONCAT(DISTINCT tags.label) AS taglist
                    FROM posts
                    JOIN users ON  users.id=posts.user_id
                    LEFT JOIN posts_tags ON posts.id = posts_tags.post_id
                    LEFT JOIN tags       ON posts_tags.tag_id  = tags.id
                    LEFT JOIN likes      ON likes.post_id  = posts.id
                    WHERE posts.user_id='$userId'
                    AND parent_id IS NULL
                    GROUP BY posts.id
                    ORDER BY posts.created DESC
                    ";
            include './src/methods/fetch.php';
            include "./src/methods/like.php";
            include './src/templates/post-template.php';
            ?>
        </main>
    </div>
</body>

</html>