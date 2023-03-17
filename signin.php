<?php

require "core/config.php";
session_name("cinelist");
session_start();

if (isset($_POST["email"]) && isset($_POST["password"])) {

    //Valeurs du formaulaire
    //Email du compte
    $email = htmlspecialchars($_POST["email"]);
    //Password du compte
    $password = htmlspecialchars($_POST["password"]);
    //Password de confimation
    $passwordConfirm = htmlspecialchars($_POST["confirmpassword"]);
    // Pseudo du compte
    $pseudo = htmlspecialchars($_POST["pseudo"]);

    //A Condition que les deux password soit pareil
    if ($_POST["password"] == $_POST["confirmpassword"]) {
        $options = [
            'cost' => 12,
        ];
        $hashPass = password_hash($_POST["password"], PASSWORD_BCRYPT, $options);

        $sql = "INSERT INTO user (email, hash, pseudo) VALUES (:email, :hashPass, :pseudo)";
        $query = $lienDB->prepare($sql);

        // Liaison des paramètres de la requête préparée
        $query->bindParam(":email", $email);
        $query->bindParam(":hashPass", $hashPass);
        $query->bindParam(":pseudo", $pseudo);

        // Exécution de la requête
        if ($query->execute()) {
            header('Location: index.php');
        } else {
            echo "<p>Une erreur s'est produite</p>";
        }
    }
}
require "core/header.php";
?>

<body>
    <main class="container py-5">
        <!-- Formulaire de connexion -->
        <div class="row">
            <div class="col-12">
                <h1 class="h3">Inscrivez-Vous !</h1>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-6">
                <form action="" method="post">
                    <div class="form-group mb-3">
                        <input type="text" name="pseudo" id="pseudo" class="form-control" placeholder="Entrez votre Pseudo *" required>
                    </div>

                    <div class="form-group mb-3">
                        <input type="email" name="email" id="email" class="form-control" placeholder="Votre adresse email *" required>
                    </div>
                    <div class="form-group mb-3">
                        <input type="file" name="photo" id="photo_profil" class="form-control" placeholder="Votre Photo de profil" required>
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Entrez un mot de passe *" required>
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" name="confirmpassword" id="confirmpassword" class="form-control" placeholder="Confimer le mot de passe *" required>
                    </div>
                    <div class="row mb-2">
                        <div class="col-12 col-md-6">

                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <button class="btn btn-dark w-100">Inscription !</button>
                    </div>
                </form>
            </div>
            <a href="index.php">Or Login</a>
        </div>
    </main>
    <footer>

    </footer>
</body>

</html>