<?php
    session_name("mylist");
    session_start();


    if (isset($_POST["email"]) && isset($_POST["password"])){
        // requête SQL
        $sql = "SELECT * FROM users WHERE email=:email";
        $password = $_POST["password"];
        $email = $_POST["email"];
    }
    // Connexion à la base de données
    $dsn = "mysql:host=localhost;port=3306;dbname=animlist;charset=utf8";
    $dbUser = "root";
    $dbPassword = "";
    $lienDB = new PDO($dsn, $dbUser, $dbPassword);

    $sql2 = "SELECT * FROM listvu ORDER BY nom ASC";
    $result = $lienDB->query($sql2);

    try{
        if($result === false){
         die("Erreur");
        }
        
       }catch (PDOException $e){
         echo $e->getMessage();
       }

?>

<!-- Zone recherche -->
<?php
  
 $articles = $lienDB->query('SELECT nom FROM listvu ORDER BY id DESC');
 if(isset($_POST['nanim']) AND !empty($_POST['nanim'])) {
    $animtosearch = htmlspecialchars($_POST['nanim']);
    $articles = $lienDB->query('SELECT nom FROM listvu WHERE nom LIKE "%'.$animtosearch.'%" ORDER BY nom ASC');
    if($articles->rowCount() == 0) {
       $articles = $lienDB->query('SELECT nom FROM listvu WHERE nom LIKE "%'.$animtosearch.'%" ORDER BY nom ASC');
    }
 }
?>
<?php 
            if(isset($_GET['addnom']) AND !empty($_GET['addnom'])){
                $addnom = $_GET["addnom"];
                $addsaison = $_GET["addsaison"];
                // Requête SQL
                $sql2 = "INSERT INTO listvu (nom, saison) VALUES ('$addnom', '$addsaison');";
                // devient, notez la disparition des guillemets simples
                $sql2 = "INSERT INTO listvu (nom, saison) VALUES (:addnom, :addsaison);";
                
                // Préparer la requête
                $query = $lienDB-> prepare($sql2);
    
                // Liaison des paramètres de la requête préparée
                $query-> bindParam(":addnom", $addnom, PDO::PARAM_STR);
                $query-> bindParam(":addsaison", $addsaison, PDO::PARAM_STR);
    
                // Exécution de la requête
                if ($query-> execute()) {
                    echo "<p>Le compte a bien été créé</p>";
                    header("Location: list.php");

                } else {
                    echo "<p>Une erreur s'est produite</p>";
                }
            }
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="Css/main.css">
        <title>My Anime List</title>
    </head>
    <body>
        <script src="JS/main.js"></script>
        <script src="https://unpkg.com/htmx.org@1.8.5"></script>
        <header>
            <a class="nav-link active" aria-current="page" href="logout.php">Se deconnecter</a>
            <br>
            <h1>List of <?php echo $_SESSION["pseudo"] ?></h1>
            <p>Vous etes connecter avec l'email suivante :

                    <?php
                        if (isset($_SESSION["email"])) {
                        ?>
                            <p>Hello buddy ! <?php echo $_SESSION["email"]; ?></p>
                        <?php
                        }
                    ?>
                    </p>
        </header>
        <main>
            <div class="leftarea">
                <form action="" method="get" name="formleftarea">
                    <h3>Ajoutez Animé Vu</h3>
                    <input type="text" placeholder="Nom de l'animé" id="addnom" name="addnom" require>
                    <input type="text" placeholder="Nombre de saison" id="addsaison" name="addsaison" require>
                    <input type="submit" value="Ajoutez" id="addonlist">
                </form>
                <div class="searchbox">
                    <input id="search" type="search" name="q" hx-post="search.php" h hx-trigger="keyup changed delay:400ms, search" hx-target=".searchresults" autocomplete="off">
                    <div class="searchresults"></div>
                </div>
            </div>
            <div class="rightarea">
                <div id="listanim">
                    <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Saison</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while($row = $result->fetch(PDO::FETCH_ASSOC)) : ?>
                            <tr>
                                <td id="<?php echo htmlspecialchars($row['id']); ?>" class="nom"><?php echo htmlspecialchars($row['nom']); ?></td>
                                <td class="saison"><?php echo htmlspecialchars($row['saison']); ?></td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
        <footer>
            <p>&copy; Zashiky - 2023</p>
        </footer>
    </body>
</html>