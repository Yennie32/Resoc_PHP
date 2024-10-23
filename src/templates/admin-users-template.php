<main>
    <h2>Utilisatrices</h2>
    <?php
    $laQuestionEnSql = "SELECT * FROM `users` LIMIT 50";
    $lesInformations = $mysqli->query($laQuestionEnSql);
    if (!$lesInformations) {
        echo ("Échec de la requete : " . $mysqli->error);
        exit();
    }

    while ($users = $lesInformations->fetch_assoc()) {
        ?>
        <article>
            <h3><?php echo $users['alias'] ?></h3>
            <p>id:<?php echo $users['id'] ?></p>
            <nav>
                <a href="wall.php?user_id=<?php echo $users['id'] ?>">Mur</a>
                | <a href="feed.php?user_id=<?php echo $users['id'] ?>">Flux</a>
                | <a href="settings.php?user_id=<?php echo $users['id'] ?>">Paramètres</a>
                | <a href="followers.php?user_id=<?php echo $users['id'] ?>">Suiveurs</a>
                | <a href="subscriptions.php?user_id=<?php echo $users['id'] ?>">Abonnements</a>
            </nav>
        </article>
    <?php } ?>
</main>
