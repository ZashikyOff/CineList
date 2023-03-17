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
    $sql = "SELECT titre FROM film WHERE id LIKE $id";
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
    $sql = "SELECT titre FROM serie WHERE id LIKE $id";
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
    $sql = "SELECT titre FROM anime WHERE id LIKE $id";
    require "./core/config.php";

    $queryfilm = $lienDB->prepare($sql);

    // Exécution de la requête
    if ($queryfilm->execute()) {
        // traitement des résultats
        $resultanimef = $queryfilm->fetchAll();
    }
    return $resultanimef;
}
?>

<body>
    <script src="JS/main.js"></script>
    <script src="https://unpkg.com/htmx.org@1.8.5"></script>
    <header class="d-flex flex-column justify-content-center align-items-center">
        <a class="nav-link active" aria-current="page" href="logout.php">Se deconnecter</a>
        <br>
        <h1>List of <?php echo $_SESSION["pseudo"] ?></h1>
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
    <main class="d-flex flex-column align-items-center">
        <div class="film">
            <h2>Films</h2>
            <?php
            $x = 0;
            while ($x < (count($resultfilm))) {

            ?><div class="article">
                    <h5><?= $resultfilm[$x]["titre"] ?></h5>
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
                    <h5><?= $resultserie[$x]["titre"] ?></h5>
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
                    <h5><?= $resultanime[$x]["titre"] ?></h5>
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
    </main>
    <footer>
        <p>&copy; Zashiky - 2023</p>
    </footer>
</body>

</html>