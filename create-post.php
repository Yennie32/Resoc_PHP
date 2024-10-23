<?php
$pageTitle = 'create-post';
?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>ReSoC - Post d'usurpateur</title>
    <meta name="author" content="Julien Falconnet">
    <link rel="stylesheet" href="style.css" />

    <?php include '..//Niveau1/src/templates/header-template.php' ?>
</head>

<div id="wrapper">

    <aside>
        <h2>Présentation</h2>
        <p>T'as vraiment besoin qu'on t'explique à quoi ça sert de faire un poste ?</p>
    </aside>

    <main>
        <article style="max-width: 900px;">
            <h2>Poster un message</h2>
            <?php
            include './src/methods/init-db.php';

            $enCoursDeTraitement = isset($_POST['message']);
            if ($enCoursDeTraitement) {
                $authorId = $userId;
                $postContent = $_POST['message'];


                $authorId = intval($authorId);

                $postContent = $mysqli->real_escape_string($postContent);

                //Etape 4 : construction de la requete
                $lInstructionSql = "INSERT INTO posts "
                . "(id, user_id, content, created, parent_id) "
                . "VALUES (NULL, "
                . $authorId . ", "
                . "'" . $postContent . "', "
                . "NOW(), "
                . "NULL);";

                // Etape 5 : execution
                $ok = $mysqli->query($lInstructionSql);
                if (! $ok) {
                    echo "Impossible d'envoyer le message: " . $mysqli->error;
                } else {
                    echo "Message envoyé !";
                    //header("Refresh:3; url=news.php", true, 303);
                }

                preg_match_all('/#(\w+)/', $postContent, $matches);
                $hashtagArray = [];
                foreach ($matches[1] as $match) {
                    $hashtagArray[] = $match;
                }

                for ($i = 0; $i < count($hashtagArray); $i++) {
                    $findHashtags = $mysqli->prepare('SELECT id, label FROM tags WHERE label = ?');
                    $findHashtags->bind_param('s', $hashtagArray[$i]);
                    $findHashtags->execute();
                    $result = $findHashtags->get_result();
                    $tagToLinkToPost = $result->fetch_assoc();

                    if ($tagToLinkToPost === null) {
                        $insertHashtags = $mysqli->prepare('INSERT INTO tags (`label`) VALUES (?)');
                        $insertHashtags->bind_param('s', $hashtagArray[$i]);
                        $insertHashtags->execute();
                        $tagToLinkToPost['id'] = $mysqli->insert_id;
                    }

                    $findPostId = $mysqli->prepare('SELECT id, user_id, content FROM posts WHERE user_id = ? AND content = ?');
                    $findPostId->bind_param('ss', $authorId, $postContent);
                    $findPostId->execute();
                    $result = $findPostId->get_result();
                    $postToLinkToTag = $result->fetch_assoc();

                    $linkHashtagsToPost = $mysqli->prepare('INSERT INTO posts_tags (`post_id`, `tag_id`) VALUES (?, ?)');
                    $linkHashtagsToPost->bind_param('ii', $postToLinkToTag['id'], $tagToLinkToPost['id']);
                    $linkHashtagsToPost->execute();
                }
            }
            ?>
            <form action="create-post.php" method="post">
                <dl>
                    <dt><label for='message'>Message</label></dt>
                    <dd><textarea name='message' style=" position: relative; transform: translateX(-50%); left:47.5%; max-width: 850px; width: 850px; border-radius: 20px; border: none;" rows="5"></textarea></dd>
                </dl>
                <input type='submit' id="create-post-input">
            </form>
        </article>
    </main>
</div>
</body>

</html>
