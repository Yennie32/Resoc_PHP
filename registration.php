<?php $pageTitle = 'registration' ?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>ReSoC - Inscription</title>
    <meta name="author" content="Julien Falconnet">
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <?php include './src/templates/header-template.php'; ?>

    <div id="wrapper">

        <aside>
            <h2>Présentation</h2>
            <p>Bienvenue sur notre réseau social.</p>
        </aside>
        <main>
            <article>
                <h2>Inscription</h2>
                <?php
                // Etape 1 : vérifier si on est en train d'afficher ou de traiter le formulaire
                $enCoursDeTraitement = isset($_POST['email']);
                if ($enCoursDeTraitement) {
                    include './src/methods/init-db.php';

                    ini_set('display_errors', 1);

                    $msg = "";

                    if (!empty($_FILES['uploadfile']['name'])) {
                        $filename = $_FILES['uploadfile']['name'];
                        $tempname = $_FILES['uploadfile']['tmp_name'];
                        $folder = './src/img/uploads/' . $filename;
                    }

                    //Récupération de ce qu'il y a dans le formulaire
                    $dataToInsert = [
                        'email' => $_POST['email'],
                        'alias' => $_POST['pseudo'],
                        'password' => password_hash($_POST['motpasse'], PASSWORD_BCRYPT),
                        'profile_pic' => $filename
                    ];

                    //Préparation de la requête
                    $requeteSql = 'INSERT INTO `users` (`email`, `password`, `alias`, `profile_pic`) VALUES (?, ?, ?, ?)';

                    $stmt = $mysqli->prepare($requeteSql);

                    if (move_uploaded_file($tempname, $folder)) {
                        // Etape 6: exécution de la requete
                        if ($stmt) {
                            //En arguments : sss veut dire trois strings
                            $stmt->bind_param("ssss", $dataToInsert['email'], $dataToInsert['password'], $dataToInsert['alias'], $dataToInsert['profile_pic']);

                            //@todo : convertir ce bloc en try ... catch pour un code plus secure et plus propre
                            if ($stmt->execute()) {
                                echo "Votre inscription est un succès : " . $dataToInsert['alias'];
                                echo " <a href='login.php'>Connectez-vous.</a>";
                            } else {
                                echo "L'inscription a échoué : " . $mysqli->error;
                            }
                        }
                    } else {
                        echo 'Failed to upload image';
                    }
                }
                ?>
                <form action="registration.php" method="post" enctype="multipart/form-data">
                    <input type='hidden' name='registerForm' value='achanger'>
                    <dl>
                        <dt><label for='pseudo'>Pseudo</label></dt>
                        <dd><input type='text' name='pseudo'></dd>
                        <dt><label for='email'>E-Mail</label></dt>
                        <dd><input type='email' name='email'></dd>
                        <dt><label for='motpasse'>Mot de passe</label></dt>
                        <dd><input type='password' name='motpasse'></dd>
                        <dd><label for="uploadfile">Choississez votre photo de profil</label></dd>
                        <dd><input type="file" name="uploadfile" required></dd>
                    </dl>
                    <input type='submit' name='submit'>
                </form>
            </article>
        </main>
    </div>
</body>

</html>
