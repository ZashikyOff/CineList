<?php
session_name("cinelist");
session_start();

require "core/config.php";

if (isset($_POST["email"]) && isset($_POST["password"])) {
    // requête SQL
    $sql = "SELECT * FROM user WHERE email=:email";
    $pseudo = $_POST["pseudo"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $_SESSION["pseudo"] = $pseudo;


    // Préparer la requête
    $query = $lienDB->prepare($sql);

    // Liaison des paramètres de la requête préparée
    $query->bindParam(":email", $email, PDO::PARAM_STR);

    // Exécution de la requête
    if ($query->execute()) {
        // traitement des résultats
        $results = $query->fetch();

        // débogage des résultats
        if ($results) {
            if (password_verify($password, $results['hash'])) {
                // Connexion réussie
                header('Location: list.php');
                echo 'Connexion réussie <br/>';
                echo 'Votre email :  ';
                echo  $_POST["email"];

                $_SESSION["email"] = $_POST["email"];
                $_SESSION["idcompte"] = $results["id"];
            } else {
                echo 'Mot de passe incorrect';
            }
        } else {
            echo 'Email non trouvé';
        }
    }
} else {
}
require "core/header.php";
?>

<body>
    <main class="login container py-5 column">
        <!-- Formulaire de connexion -->
        <div class="row">
            <div class="col-12">
                <h1 class="h3">Connectez-vous !</h1>
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
                        <input type="password" name="password" id="password" class="form-control" placeholder="Entrez un mot de passe *" required>
                    </div>

                    <div class="row mb-2">
                        <div class="col-12 col-md-6">

                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <button class="btn btn-dark w-100">Connexion !</button>
                    </div>
                </form>
            </div>
            <a href="signin.php">Or SignIn</a>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>

</html>