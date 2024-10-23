<?php
// $userId = intval($_GET['user_id']);
include "./src/methods/like.php";

$post = $lesInformations->fetch_assoc();

$sessionId = $_SESSION['connected_id'];

$check_like = $GLOBALS["mysqli"]->prepare('SELECT COUNT(id) AS count FROM likes WHERE post_id = ? AND user_id = ?');
$check_like->bind_param('ii', $post['id'], $sessionId);
$check_like->execute();
$like_result = $check_like->get_result();
$like_row = $like_result->fetch_assoc();

$check_dislike = $GLOBALS["mysqli"]->prepare('SELECT COUNT(id) AS count FROM dislikes WHERE post_id = ? AND user_id = ?');
$check_dislike->bind_param('ii', $post['id'], $sessionId);
$check_dislike->execute();
$dislike_result = $check_dislike->get_result();
$dislike_row = $dislike_result->fetch_assoc();
    ?>

<article style="width: 900px">
    <h3>
        <time datetime='2020-02-01 11:12:13'><?= $post['created'] ?></time>
    </h3>
    <address>par <a href="./wall.php?user_id=<?= $post['user_id'] ?>"> <?= $post['author_name'] ?></a></address>
    <div>
        <p><?= $post['content'] ?></p>
    </div>

    <footer>
        <small>💩 <?= getVotes($post['id']) ?></small>

        <form method="post" action="">
            <input type="hidden" name="id" value="<?= $post['id'] ?>">

            <button type="submit" name="action" value="upVote" class="likeButton" style="<?php if($like_row['count']) {echo 'background-color:#FFDBB5; color: #603F26;';} ?>;">UpVote</button>
            <button type="submit" name="action" value="downVote" class="likeButton" style="<?php if($dislike_row['count']) {echo 'background-color:#FFDBB5; color: #603F26;';} ?>;">DownVote</button>
        </form>
    </footer>
</article>
<article style="max-width: 900px;">
    <?php
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
            . "NOW(),"
            . $post['id'] . ");";

        // Etape 5 : execution
        $ok = $mysqli->query($lInstructionSql);
        if (!$ok) {
            echo "Impossible d'envoyer le commentaire: " . $mysqli->error;
        } else {
            echo "Commentaire envoyé !";
        }
    }
    ?>
    <form method="post">
        <dl>
            <dt><label for='message'>Message</label></dt>
            <dd><textarea name='message' style=" position: relative; transform: translateX(-50%); left:47.5%; max-width: 850px; width: 850px; border-radius: 10px; border: none;" rows="5"></textarea></dd>
        </dl>
        <input type='submit'>
    </form>
</article>

<?php
$laQuestionEnSql = "SELECT posts.content, posts.created, posts.id, posts.user_id, users.alias as author_name
                    FROM posts
                    JOIN users ON users.id = posts.user_id
                    WHERE posts.parent_id = " . $post['id'] . "; 
                    ";

include './src/methods/fetch.php';
include './src/templates/post-template.php';
?>