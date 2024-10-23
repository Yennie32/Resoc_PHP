<?php
if (isset($post['taglist'])) {
    $tagList = $post['taglist'];
    $tagsArray = explode(",", $tagList);
    for ($i = 0; $i < count($tagsArray); $i++) {

        $getTagId = $GLOBALS["mysqli"]->prepare('SELECT id, label FROM tags WHERE label = ?');
        $getTagId->bind_param('s', $tagsArray[$i]);
        $getTagId->execute();
        $result = $getTagId->get_result();
        $hashtag = $result->fetch_assoc();

        try {
            if (!$hashtag) {
                throw new Exception("Exception : No tag found");
            }
            $tagIdLink = $hashtag['id'];
        } catch (Exception $error) {
            echo $error->getMessage();
        }

?>
        <a href="tags.php?tag_id=<?= $tagIdLink ?>">#<?= $hashtag['label'] ?></a>
<?php
    }
}
?>