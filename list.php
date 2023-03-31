<?php
session_name("cinelist");
session_start();

require "core/config.php";
require "core/header.php";

$idcompte = $_SESSION["idcompte"];

$film = "SELECT * FROM film ORDER BY id";
$serie = "SELECT * FROM serie ORDER BY id";
$anime = "SELECT * FROM anime ORDER BY id";
$fav = "SELECT id_film,id_serie,id_anime FROM favoris WHERE id_user LIKE :id";


// Préparer la requête
$queryfilm = $lienDB->prepare($film);
$queryserie = $lienDB->prepare($serie);
$queryanime = $lienDB->prepare($anime);
$queryfav = $lienDB->prepare($fav);
$queryfav->bindParam(":id", $idcompte, PDO::PARAM_STR);

// Exécution de la requête
if ($queryfilm->execute()) {
    // traitement des résultats
    $resultfilm = $queryfilm->fetchAll();
}
// Exécution de la requête
if ($queryserie->execute()) {
    // traitement des résultats
    $resultserie = $queryserie->fetchAll();
}
// Exécution de la requête
if ($queryanime->execute()) {
    // traitement des résultats
    $resultanime = $queryanime->fetchAll();
}
// Exécution de la requête
if ($queryfav->execute()) {
    // traitement des résultats
    $resultfav = $queryfav->fetchAll();
}

function FindByIdMovie(int $id): array
{
    $sql = "SELECT titre FROM film WHERE id LIKE $id ORDER by titre";
    require "./core/config.php";

    $queryfilm = $lienDB->prepare($sql);

    // Exécution de la requête
    if ($queryfilm->execute()) {
        // traitement des résultats
        $resultfilmf = $queryfilm->fetchAll();
    }
    return $resultfilmf;
}
function FindByIdSerie(int $id): array
{
    $sql = "SELECT titre FROM serie WHERE id LIKE $id ORDER BY titre";
    require "./core/config.php";

    $queryfilm = $lienDB->prepare($sql);

    // Exécution de la requête
    if ($queryfilm->execute()) {
        // traitement des résultats
        $resultserief = $queryfilm->fetchAll();
    }
    return $resultserief;
}
function FindByIdAnime(int $id): array
{
    $sql = "SELECT titre FROM anime WHERE id LIKE $id ORDER BY titre";
    require "./core/config.php";

    $queryfilm = $lienDB->prepare($sql);

    // Exécution de la requête
    if ($queryfilm->execute()) {
        // traitement des résultats
        $resultanimef = $queryfilm->fetchAll();
    }
    return $resultanimef;
}

// Ajouter Something --------------------------------
if (isset($_POST["titre"]) && isset($_POST["genre"])) {
    require "./core/config.php";

    //Valeurs du formaulaire
    //Email du compte
    $titre = htmlspecialchars($_POST["titre"]);
    //Password du compte
    $genre = htmlspecialchars($_POST["genre"]);

    $add = "INSERT INTO $genre (titre) VALUES (:titre)";
    $query = $lienDB->prepare($add);

    // Liaison des paramètres de la requête préparée
    $query->bindParam(":titre", $titre);
    // $query->bindParam(":genre", $genre);

    try {
        if ($query->execute()) {
            echo "<p>Ajoutez</p>";
            header('Location: list.php');
        }
    }
    //catch exception
    catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
    }
}
// Delete Something --------------------------------
if (isset($_POST["deletename"]) && isset($_POST["genredelete"])) {
    require "./core/config.php";

    //Valeurs du formaulaire
    //Email du compte
    $titre = htmlspecialchars($_POST["deletename"]);
    //Password du compte
    $genre = htmlspecialchars($_POST["genredelete"]);

    $add = "DELETE FROM $genre WHERE titre LIKE :titre";
    $query = $lienDB->prepare($add);

    // Liaison des paramètres de la requête préparée
    $query->bindParam(":titre", $titre);
    // $query->bindParam(":genre", $genre);

    try {
        if ($query->execute()) {
            echo "<p>Ajoutez</p>";
            header('Location: list.php');
        }
    }
    //catch exception
    catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
    }
}
?>

<body>
    <script src="JS/main.js"></script>
    <script src="https://unpkg.com/htmx.org@1.8.5"></script>
    <header>
        <a class="nav-link active" aria-current="page" href="logout.php">Se deconnecter</a>
        <br>
        <h1>List of <?= $_SESSION["pseudo"] ?></h1>
        <p>Vous etes connecter avec l'email suivante :

            <?php
            if (isset($_SESSION["email"])) {
            ?>
        <p>Hello buddy ! <?= $_SESSION["email"]; ?></p>
    <?php
            }
    ?>
    </p>
    </header>
    <main class="liste">
    <div class="grub">
            <div class="add">
                <h4>Add Something</h4>
                <form action="" method="post">
                    <input type="text" name="titre" placeholder="Entrez le titre *" required>
                    <select name="genre" id="" required>
                        <option value="">---- Choose ----</option>
                        <option value="serie">Serie</option>
                        <option value="film">Film</option>
                        <option value="anime">Animé</option>
                    </select>
                    <button type="submit">-- Add ---</button>
                </form>
            </div>
            <div class="remove">
                <h4>Remove Something</h4>
                <form action="" method="post">
                    <select name="deletename" required>
                        <option value="">---- Choose ----</option>
                        <option value="serie">-- Serie --</option>
                        <?php
                        $x = 0;
                        while ($x < (count($resultserie))) { ?>
                            <option value="<?= $resultserie[$x]["titre"] ?>"><?= $resultserie[$x]["titre"] ?></option><?php
                                                                                                                        $x++;
                                                                                                                    } ?>
                        <option value="film">-- Film --</option>
                        <?php
                        $x = 0;
                        while ($x < (count($resultfilm))) { ?>
                            <option value="<?= $resultserie[$x]["titre"] ?>"><?= $resultfilm[$x]["titre"] ?></option><?php
                                                                                                                        $x++;
                                                                                                                    } ?>
                        <option value="anime">-- Animé --</option>
                        <?php
                        $x = 0;
                        while ($x < (count($resultanime))) { ?>
                            <option value="<?= $resultserie[$x]["titre"] ?>"><?= $resultanime[$x]["titre"] ?></option><?php
                                                                                                                        $x++;
                                                                                                                    } ?>
                    </select>
                    <select name="genredelete" required>
                        <option value="">---- Choose ----</option>
                        <option value="serie">Serie</option>
                        <option value="film">Film</option>
                        <option value="anime">Animé</option>
                    </select>
                    <button type="submit">-- Remove --- </button>
                </form>
            </div>
        </div>
        <div class="liste">
            <div class="film">
                <h2>Films</h2>
                <?php
                $x = 0;
                while ($x < (count($resultfilm))) {

                ?><div class="article">
                        <a href="https://www.google.com/search?q=<?= $resultfilm[$x]["titre"] . " film" ?>" target="_blank"><?= $resultfilm[$x]["titre"] ?> <span></span></a>
                    </div><?php
                            $x++;
                        } ?>
            </div>
            <div class="serie">
                <h2>Serie</h2>
                <?php
                $x = 0;
                while ($x < (count($resultserie))) {

                ?><div class="article">
                        <a href="https://www.google.com/search?q=<?= $resultserie[$x]["titre"] . " serie" ?>" target="_blank"><?= $resultserie[$x]["titre"] ?> <span></span></a>
                    </div><?php
                            $x++;
                        } ?>
            </div>
            <div class="anime">
                <h2>Animé</h2>
                <?php
                $x = 0;
                while ($x < (count($resultanime))) {

                ?><div class="article">
                        <a href="https://www.google.com/search?q=<?= $resultanime[$x]["titre"] . " animé" ?>" target="_blank"><?= $resultanime[$x]["titre"] ?> <span></span></a>
                    </div><?php
                            $x++;
                        } ?>
            </div>
            <div class="favs">
                <h2>Favories</h2>
                <?php
                $x = 0;
                while ($x < (count($resultfav))) {
                ?>
                    <?php
                    if (strlen($resultfav[$x]["id_film"]) >= 1) {
                    ?><h5><?= FindByIdMovie($resultfav[$x]["id_film"])[$x]["titre"] ?? ""; ?></h5><?php
                                                                                                }
                                                                                                    ?>
                    <?php
                    if (strlen($resultfav[$x]["id_serie"]) >= 1) {
                    ?><h5><?= FindByIdSerie($resultfav[$x]["id_serie"])[$x]["titre"] ?? ""; ?></h5><?php
                                                                                                }
                                                                                                    ?>
                    <?php
                    if (strlen($resultfav[$x]["id_anime"]) >= 1) {
                    ?><h5><?= FindByIdAnime($resultfav[$x]["id_anime"])[$x]["titre"] ?? ""; ?></h5><?php
                                                                                                }
                                                                                                    ?>

                <?php
                    $x++;
                } ?>
            </div>
        </div>
    </main>
    <footer>
        <p>&copy; Zashiky - 2023</p>
    </footer>
</body>

</html>