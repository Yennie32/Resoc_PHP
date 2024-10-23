<?php $pageTitle = "logout" ?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>ReSoC - Logout</title>
    <meta name="author" content="Julien Falconnet">
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <?php include './src/methods/init-db.php';
    include './src/templates/header-template.php';
    ?>
    <div id="wrapper" class='logout'>
        <main>
            <article>

                <h2>Deconnexion</h2>
                <?php
                if (isset($_POST['confirm']) && isset($_SESSION['connected_id'])) {
                    session_unset();
                    session_destroy();
                    echo "Ca marche ou merde ?!";
                    header("Location:  login.php");
                    exit();
                }
                ?>
                <form action="logout.php" method="POST">
                    <dt><label for='deconnexion'>T'es sûr.e de vouloir nous quitter ?</label></dt>
                    <input type="submit" name="confirm" id="deconnexion" value="Bye bye" />
                </form>
            </article>
        </main>
    </div>
</body>

</html>
