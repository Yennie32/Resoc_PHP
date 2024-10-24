<?php $pageTitle = "news" ?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>ReSoC - Actualités</title>
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
            //Afficher les cinq derniers posts
            // Documentation : les exemples https://www.php.net/manual/fr/mysqli.query.php
            
            // Etape 1: Ouvrir une connexion avec la base de donnée.
            //verification
            if ($mysqli->connect_errno) {
                echo "<article>";
                echo ("Échec de la connexion : " . $mysqli->connect_error);
                echo ("<p>Indice: Vérifiez les parametres de <code>new mysqli(...</code></p>");
                echo "</article>";
                exit();
            }

            // Etape 2: Poser une question à la base de donnée et récupérer ses informations
            $laQuestionEnSql = "
                    SELECT posts.content,
                    posts.id,
                    posts.created,
                    posts.parent_id,
                    posts.user_id as user_id,
                    users.alias as author_name,
                    count(likes.id) as like_number,
                    GROUP_CONCAT(DISTINCT tags.label) AS taglist
                    FROM posts
                    JOIN users ON  users.id=posts.user_id
                    LEFT JOIN posts_tags ON posts.id = posts_tags.post_id
                    LEFT JOIN tags       ON posts_tags.tag_id  = tags.id
                    LEFT JOIN likes      ON likes.post_id  = posts.id
                    WHERE parent_id IS NULL
                    GROUP BY posts.id
                    ORDER BY posts.created DESC
                    LIMIT 5
                    ";
            include "./src/methods/like.php";
            include './src/methods/fetch.php';
            include './src/templates/post-template.php';
            ?>

        </main>
    </div>
</body>

</html>