<aside>
    <h2>Mots-clés</h2>
    <?php
    while ($tag = $lesInformations->fetch_assoc()) {
        ?>
        <article>
            <h3>#<?php echo $tag['label'] ?></h3>
            <p>id:<?php echo $tag['id'] ?></p>
            <nav>
                <a href="tags.php?tag_id=<?php echo $tag['id'] ?>">Messages</a>
            </nav>
        </article>
    <?php } ?>
</aside>
