<?php
$pageTitle = 'post';
?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>ReSoC - Commentaires</title>
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
            $postId = intval($_GET['post_id']);
            $laQuestionEnSql = "
                    SELECT posts.content, posts.created, posts.id, parent_id,
                    users.alias as author_name,
                    posts.user_id as user_id
                    FROM posts
                    JOIN users ON  users.id=posts.user_id
                    WHERE posts.id='$postId'
                    ";
            include './src/methods/fetch.php';
            
            include './src/templates/comments.php';
            ?>
        </main>
    </div>
</body>

</html>
