<aside>
    <?php
    if (!in_array($pageTitle, ['news', 'tags', 'logout'])) {
    ?>

        <img src="./src/img/uploads/<?= $user['profile_pic'] ?>" alt="Portrait de l'utilisatrice" />
    <?php } else { ?>
        <img src="./src/img/user.jpg" alt="Portrait de l'utilisatrice" />
    <?php } ?>
    <?php include './src/methods/follow.php' ?>
    <section>
        <h3>Présentation</h3>
        <p><?php
            echo ($pageTitle == 'feed') ? "Sur cette page vous trouverez tous les messages des utilisatrices auxquelles est abonnée {$userAlias}." : "";
            echo ($pageTitle == 'followers') ? "Sur cette page vous trouverez la liste des personnes qui suivent {$userAlias}." : "";
            echo ($pageTitle == 'news') ? "Sur cette page vous trouverez les derniers messages de tous les utilisatrices du site." : "";
            echo ($pageTitle == 'settings') ? "Sur cette page vous trouverez les informations de {$userAlias}" : "";
            echo ($pageTitle == 'subscriptions') ? "Sur cette page vous trouverez la liste des personnes que {$userAlias} suit." : "";
            echo ($pageTitle == 'tags') ? "Sur cette page vous trouverez les derniers messages comportant le mot-clé {$tag['label']}." : "";
            echo ($pageTitle == 'wall') ? "Sur cette page vous trouverez tous les messages de {$userAlias}." : "";
            echo ($pageTitle == 'logout') ? "Page de déconnexion" : "";
            echo ($pageTitle == 'post') ? "<a href = 'wall.php?user_id=" . $user['id'] . "'\">Voir tous les posts de {$userAlias}</a>" : "";

            ?>
        </p>

    </section>
</aside>
