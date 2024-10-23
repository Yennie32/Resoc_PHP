<?php
session_start();
$pageTitle = 'login';
?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>ReSoC - Connexion</title>
    <meta name="author" content="Julien Falconnet">
    <link rel="stylesheet" href="style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
</head>

<body>

    <div id="wrapper" class="wrapper-login">

        <aside id="aside-login">
            <img src=".\src\img\resoc-login.png" alt="Logo de notre réseau, une petite crotte qui brille et qui sourit"
                id="login-img">
            <div class="login-title">
                <h1 class="login-h1">Poopie</h1>
                <p class="login-p"><br />🤷🏽‍♀️ Quitte à dire de la merde... 🤷🏽‍♀️</p>
            </div>
        </aside>
        <main id="main-login">
            <article id="article-login">
                <h2>Connexion</h2>
                <?php
                /**
                 * TRAITEMENT DU FORMULAIRE
                 */
                // Etape 1 : vérifier si on est en train d'afficher ou de traiter le formulaire
                // si on recoit un champs email rempli il y a une chance que ce soit un traitement


                $enCoursDeTraitement = isset($_POST['email']);

                if ($enCoursDeTraitement) {
                    // on ne fait ce qui suit que si un formulaire a été soumis.
                    // Initialisation des variables avec les contenus de motpasse et email
                    echo "<pre>" . print_r($_POST, 1) . "</pre>";
                    $emailAVerifier = $_POST['email'];
                    $passwdAVerifier = $_POST['motpasse'];


                    //Connexion avec la base de donnée.
                    include './src/methods/init-db.php';
                    //Etape 4 : Petite sécurité
                    // pour éviter les injection sql : https://www.w3schools.com/sql/sql_injection.asp
                    $emailAVerifier = $mysqli->real_escape_string($emailAVerifier);
                    $passwdAVerifier = $mysqli->real_escape_string($passwdAVerifier);
                    // on crypte le mot de passe pour éviter d'exposer notre utilisatrice en cas d'intrusion dans nos systèmes
                    password_hash($passwdAVerifier, PASSWORD_BCRYPT);



                    //Etape 5 : construction de la requete
                    $lInstructionSql = "SELECT * "
                        . "FROM users "
                        . "WHERE "
                        . "email LIKE '" . $emailAVerifier . "' ";

                    echo "<pre>" . print_r($_POST, 1) . "</pre>";

                    // Etape 6: Vérification de l'utilisateur
                    $res = $mysqli->query($lInstructionSql);

                    $user = $res->fetch_assoc();
                    // echo "<pre>"  .  print_r($userId, 1) . "</pre>";


                    if (password_verify($passwdAVerifier, $user['password'])) {
                        echo "Votre connexion est un succès : " . $user['alias'] . ".";
                        $_SESSION['connected_id'] = $user['id'];
                        header("Location:  news.php");
                        exit();
                    } else {
                        echo "La connexion a échoué. ";
                    }

                }
                ?>
                <form action="login.php" method="post" class="login-form">
                    <input type='hidden' name='email' value='connexion' id="connexion">
                    <dl>
                        <label for='email'>E-Mail</label>
                        <input type='email' name='email' id="email" class="login-input"><br>
                        <label for='motpasse'>Mot de passe</label>
                        <input type='password' name='motpasse' id="motpasse" class="login-input"><br>
                        <input type='submit' value="Prout !" id="connexion">
                    </dl>

                </form>
            </article>
        </main>
    </div>
</body>
<footer id="footer-login">
    <p>
        Envie d'être une petite crotte en or ✨ ?
        <a href='registration.php'>Rejoins-nous !</a>
    </p>
</footer>

</html>
