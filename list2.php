<?php
session_name("cinelist");
session_start();

require "core/config.php";

$idcompte = $_SESSION["idcompte"];

// Delete Something --------------------------------
if (isset($_POST["deletename"])) {
    require "./core/config.php";

    //Valeurs du formaulaire
    $titre = htmlspecialchars($_POST["deletename"]);

    $delete = "DELETE FROM film WHERE titre LIKE :titre";
    $query = $lienDB->prepare($delete);

    // Liaison des paramètres de la requête préparée
    $query->bindParam(":titre", $titre);

    try {
        if ($query->execute()) {
            echo "<p>Ajoutez</p>";
            header('Location: list2.php');
        }
    }
    //catch exception
    catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
    }
}

// Ajouter Something --------------------------------
if (isset($_POST["titre"]) && isset($_POST["genre"])) {
    require "./core/config.php";

    //Valeurs du formaulaire
    //Email du compte
    $titre = htmlspecialchars($_POST["titre"]);
    //Password du compte
    $genre = htmlspecialchars($_POST["genre"]);

    $add = "INSERT INTO film (titre, genre) VALUES (:titre, :genre)";
    $query = $lienDB->prepare($add);

    // Liaison des paramètres de la requête préparée
    $query->bindParam(":titre", $titre);
    $query->bindParam(":genre", $genre);
    // $query->bindParam(":genre", $genre);

    try {
        if ($query->execute()) {
            echo "<p>Ajoutez</p>";
            header('Location: list2.php');
        }
    }
    //catch exception
    catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
    }
}

function Allmovie()
{
    require "core/config.php";

    $sql = "SELECT titre FROM film ORDER BY genre";

    $queryfilm = $lienDB->prepare($sql);

    // Exécution de la requête
    if ($queryfilm->execute()) {
        // traitement des résultats
        $resultall = $queryfilm->fetchAll();
    }
    return $resultall;
}

function FindMovieByGenre(string $genre)
{
    require "core/config.php";

    $sql = "SELECT titre FROM film WHERE genre LIKE :genre ORDER BY titre";

    $queryfilm = $lienDB->prepare($sql);

    $queryfilm->bindParam(":genre", $genre);

    // Exécution de la requête
    if ($queryfilm->execute()) {
        // traitement des résultats
        $resultbygenre = $queryfilm->fetchAll();
    }
    return $resultbygenre;
}

// var_dump(Allmovie());

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/main2.css">
    <title>Document</title>
</head>

<body>
    <nav>
        <ul class="type">Film
            <li>
                <ul class="genre"><span>Aventure</span>
                    <ol>
                        <?php
                        $x = 0;
                        while ($x < (count(FindMovieByGenre('aventure')))) { ?>
                            <li value="<?= FindMovieByGenre('aventure')[$x]["titre"] ?>"><a href="https://www.google.com/search?q=<?= FindMovieByGenre('aventure')[$x]["titre"] . " film" ?>" target="_blank"><?= FindMovieByGenre('aventure')[$x]["titre"] ?> <span></span></a></li><?php
                                                                                                                                                                                                                                                        $x++;
                                                                                                                                                                                                                                                    } ?>
                    </ol>
                </ul>
                <ul class="genre"><span>Comédie</span>
                    <ol>
                        <?php
                        $x = 0;
                        while ($x < (count(FindMovieByGenre('Comédie')))) { ?>
                            <li value="<?= FindMovieByGenre('Comédie')[$x]["titre"] ?>"><a href="https://www.google.com/search?q=<?= FindMovieByGenre('Comédie')[$x]["titre"] . " film" ?>" target="_blank"><?= FindMovieByGenre('Comédie')[$x]["titre"] ?> <span></span></a></li><?php
                                                                                                                                                                                                                                                        $x++;
                                                                                                                                                                                                                                                    } ?>
                    </ol>
                </ul>
                <ul class="genre"><span>Drame</span>
                    <ol>
                        <?php
                        $x = 0;
                        while ($x < (count(FindMovieByGenre('Drame')))) { ?>
                            <li value="<?= FindMovieByGenre('Drame')[$x]["titre"] ?>"><a href="https://www.google.com/search?q=<?= FindMovieByGenre('Drame')[$x]["titre"] . " film" ?>" target="_blank"><?= FindMovieByGenre('Drame')[$x]["titre"] ?> <span></span></a></li><?php
                                                                                                                                                                                                                                                    $x++;
                                                                                                                                                                                                                                                } ?>
                    </ol>
                </ul>
                <ul class="genre"><span>Fiction jeunesse</span>
                    <ol>
                        <?php
                        $x = 0;
                        while ($x < (count(FindMovieByGenre('Fiction jeunesse')))) { ?>
                            <li value="<?= FindMovieByGenre('Fiction jeunesse')[$x]["titre"] ?>"><a href="https://www.google.com/search?q=<?= FindMovieByGenre('Fiction jeunesse')[$x]["titre"] . " film" ?>" target="_blank"><?= FindMovieByGenre('Fiction jeunesse')[$x]["titre"] ?> <span></span></a></li><?php
                                                                                                                                                                                                                                                                $x++;
                                                                                                                                                                                                                                                            } ?>
                    </ol>
                </ul>
                <ul class="genre"><span>Film musical</span>
                    <ol>
                        <?php
                        $x = 0;
                        while ($x < (count(FindMovieByGenre('Film musical')))) { ?>
                            <li value="<?= FindMovieByGenre('Film musical')[$x]["titre"] ?>"><a href="https://www.google.com/search?q=<?= FindMovieByGenre('Film musical')[$x]["titre"] . " film" ?>" target="_blank"><?= FindMovieByGenre('Film musical')[$x]["titre"] ?> <span></span></a></li><?php
                                                                                                                                                                                                                                                            $x++;
                                                                                                                                                                                                                                                        } ?>
                    </ol>
                </ul>
                <ul class="genre"><span>Policier</span>
                    <ol>
                        <?php
                        $x = 0;
                        while ($x < (count(FindMovieByGenre('Policier')))) { ?>
                            <li value="<?= FindMovieByGenre('Policier')[$x]["titre"] ?>"><a href="https://www.google.com/search?q=<?= FindMovieByGenre('Policier')[$x]["titre"] . " film" ?>" target="_blank"><?= FindMovieByGenre('Policier')[$x]["titre"] ?> <span></span></a></li><?php
                                                                                                                                                                                                                                                        $x++;
                                                                                                                                                                                                                                                    } ?>
                    </ol>
                </ul>
                <ul class="genre"><span>Fantastique</span>
                    <ol>
                        <?php
                        $x = 0;
                        while ($x < (count(FindMovieByGenre('Fantastique')))) { ?>
                            <li value="<?= FindMovieByGenre('Fantastique')[$x]["titre"] ?>"><a href="https://www.google.com/search?q=<?= FindMovieByGenre('Fantastique')[$x]["titre"] . " film" ?>" target="_blank"><?= FindMovieByGenre('Fantastique')[$x]["titre"] ?> <span></span></a></li><?php
                                                                                                                                                                                                                                                            $x++;
                                                                                                                                                                                                                                                        } ?>
                    </ol>
                </ul>
                <ul class="genre"><span>Science fiction</span>
                    <ol>
                        <?php
                        $x = 0;
                        while ($x < (count(FindMovieByGenre('Science fiction')))) { ?>
                            <li value="<?= FindMovieByGenre('Science fiction')[$x]["titre"] ?>"><a href="https://www.google.com/search?q=<?= FindMovieByGenre('Science fiction')[$x]["titre"] . " film" ?>" target="_blank"><?= FindMovieByGenre('Science fiction')[$x]["titre"] ?> <span></span></a></li><?php
                                                                                                                                                                                                                                                                $x++;
                                                                                                                                                                                                                                                            } ?>
                    </ol>
                </ul>
                <ul class="genre"><span>Horreur</span>
                    <ol>
                        <?php
                        $x = 0;
                        while ($x < (count(FindMovieByGenre('Horreur')))) { ?>
                            <li value="<?= FindMovieByGenre('Horreur')[$x]["titre"] ?>"><a href="https://www.google.com/search?q=<?= FindMovieByGenre('Horreur')[$x]["titre"] . " film" ?>" target="_blank"><?= FindMovieByGenre('Horreur')[$x]["titre"] ?> <span></span></a></li><?php
                                                                                                                                                                                                                                                        $x++;
                                                                                                                                                                                                                                                    } ?>
                    </ol>
                </ul>
                <ul class="genre"><span>Western</span>
                    <ol>
                        <?php
                        $x = 0;
                        while ($x < (count(FindMovieByGenre('Western')))) { ?>
                            <li value="<?= FindMovieByGenre('Western')[$x]["titre"] ?>"><a href="https://www.google.com/search?q=<?= FindMovieByGenre('Western')[$x]["titre"] . " film" ?>" target="_blank"><?= FindMovieByGenre('Western')[$x]["titre"] ?> <span></span></a></li><?php
                                                                                                                                                                                                                                                        $x++;
                                                                                                                                                                                                                                                    } ?>
                    </ol>
                </ul>
                <ul class="genre"><span>Histoire</span>
                    <ol>
                        <?php
                        $x = 0;
                        while ($x < (count(FindMovieByGenre('Histoire')))) { ?>
                            <li value="<?= FindMovieByGenre('Histoire')[$x]["titre"] ?>"><a href="https://www.google.com/search?q=<?= FindMovieByGenre('Histoire')[$x]["titre"] . " film" ?>" target="_blank"><?= FindMovieByGenre('Histoire')[$x]["titre"] ?> <span></span></a></li><?php
                                                                                                                                                                                                                                                        $x++;
                                                                                                                                                                                                                                                    } ?>
                    </ol>
                </ul>
            </li>
        </ul>

    </nav>
    <div class="grub">
            <div class="add">
                <h4>Add Something</h4>
                <form action="" method="post">
                    <input type="text" name="titre" placeholder="Entrez le titre *" required>
                    <select name="genre" id="" required>
                        <option value="">---- Choose ----</option>
                        <option value="Aventure">Aventure</option>
                        <option value="Comédie">Comédie</option>
                        <option value="Drame">Drame</option>
                        <option value="Fiction jeunesse">Fiction jeunesse</option>
                        <option value="Film musical">Film musical</option>
                        <option value="Policier">Policier</option>
                        <option value="Fantastique">Fantastique</option>
                        <option value="Science fiction">Science fiction</option>
                        <option value="Horreur">Horreur</option>
                        <option value="Western">Western</option>
                        <option value="Histoire">Histoire</option>
                    </select>
                    <button type="submit">-- Add --</button>
                </form>
            </div>
            <div class="remove">
                <h4>Remove Something</h4>
                <form action="" method="post">
                    <select name="deletename" required>
                        <option value="">---- Choose ----</option>
                        <option value="serie">-- Films --</option>
                        <?php
                        $x = 0;
                        while ($x < (count(Allmovie()))) { ?>
                            <option value="<?= Allmovie()[$x]["titre"] ?>"><?= Allmovie()[$x]["titre"] ?></option><?php
                                                                                                                        $x++;
                                                                                                                    } ?>
                    </select>
                    <button type="submit">-- Remove --- </button>
                </form>
            </div>
        </div>
</body>

</html>