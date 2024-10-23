<?php
session_start();
if (isset($_SESSION['connected_id'])) {
    $userId =  $_SESSION['connected_id']; ?>
    <header>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
        <img src=".\src\img\resoc-login.png" alt="Logo de notre réseau social" />
        <nav id="menu">

            <a href="news.php">Actualités</a>
            <a href="wall.php?user_id=<?= $userId ?>">Mur</a>
            <a href="feed.php?user_id=<?= $userId ?>">Flux</a>
            <a href="tags.php?tag_id=1">Mots-clés</a>
            <a href="create-post.php">Ecrire un post</a>
        </nav>
        <nav id="user">
            <a href="#">Profil</a>
            <ul>
                <li><a href="settings.php?user_id=<?= $userId ?>">Paramètres</a></li>
                <li><a href="followers.php?user_id=<?= $userId ?>">Mes suiveurs</a></li>
                <li><a href="subscriptions.php?user_id=<?= $userId ?>">Mes abonnements</a></li>
                <li><a href="logout.php" id="openPopup">Se deconnecter</a></li>

            </ul>
        </nav>
    </header>
<?php }
?>

