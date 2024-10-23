<?php
while ($follow = $lesInformations->fetch_assoc()) {
    ?>
    <article>
    <!-- <?php //echo "<pre>" . print_r($follow, 1) . "</pre>"?> -->

        <img src="./src/img/user.jpg" alt="blason" />
        <a href="./wall.php?user_id=<?php echo $follow['id'] ?>"> <h3><?php echo $follow['alias'] ?></h3> </a>
        <p>id:<?php echo $follow['id'] ?></p>
    </article>
<?php } ?>

