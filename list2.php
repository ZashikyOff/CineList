<?php
session_name("cinelist");
session_start();

require "core/config.php";

$idcompte = $_SESSION["idcompte"];


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

// var_dump(FindMovieByGenre('aventure'));

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
                <ul class="genre">Aventure
                    <?php
                    $x = 0;
                    while ($x < (count(FindMovieByGenre('aventure')))) { ?>
                        <li value="<?= FindMovieByGenre('aventure')[$x]["titre"] ?>"><?= FindMovieByGenre('aventure')[$x]["titre"] ?></li><?php
                                                                                                                    $x++;
                                                                                                                } ?>
                </ul>
                <ul class="genre">Comédie
                <?php
                    $x = 0;
                    while ($x < (count(FindMovieByGenre('aventure')))) { ?>
                        <li value="<?= FindMovieByGenre('aventure')[$x]["titre"] ?>"><?= FindMovieByGenre('aventure')[$x]["titre"] ?></li><?php
                                                                                                                    $x++;
                                                                                                                } ?>
                </ul>
                <ul class="genre">Drame
                <?php
                    $x = 0;
                    while ($x < (count(FindMovieByGenre('aventure')))) { ?>
                        <li value="<?= FindMovieByGenre('aventure')[$x]["titre"] ?>"><?= FindMovieByGenre('aventure')[$x]["titre"] ?></li><?php
                                                                                                                    $x++;
                                                                                                                } ?>
                </ul>
                <ul class="genre">Fiction jeunesse
                <?php
                    $x = 0;
                    while ($x < (count(FindMovieByGenre('aventure')))) { ?>
                        <li value="<?= FindMovieByGenre('aventure')[$x]["titre"] ?>"><?= FindMovieByGenre('aventure')[$x]["titre"] ?></li><?php
                                                                                                                    $x++;
                                                                                                                } ?>
                </ul>
                <ul class="genre">Film musical
                <?php
                    $x = 0;
                    while ($x < (count(FindMovieByGenre('aventure')))) { ?>
                        <li value="<?= FindMovieByGenre('aventure')[$x]["titre"] ?>"><?= FindMovieByGenre('aventure')[$x]["titre"] ?></li><?php
                                                                                                                    $x++;
                                                                                                                } ?>
                </ul>
                <ul class="genre">Policier
                <?php
                    $x = 0;
                    while ($x < (count(FindMovieByGenre('aventure')))) { ?>
                        <li value="<?= FindMovieByGenre('aventure')[$x]["titre"] ?>"><?= FindMovieByGenre('aventure')[$x]["titre"] ?></li><?php
                                                                                                                    $x++;
                                                                                                                } ?>
                </ul>
                <ul class="genre">Fantastique
                <?php
                    $x = 0;
                    while ($x < (count(FindMovieByGenre('aventure')))) { ?>
                        <li value="<?= FindMovieByGenre('aventure')[$x]["titre"] ?>"><?= FindMovieByGenre('aventure')[$x]["titre"] ?></li><?php
                                                                                                                    $x++;
                                                                                                                } ?>
                </ul>
                <ul class="genre">Science fiction
                <?php
                    $x = 0;
                    while ($x < (count(FindMovieByGenre('aventure')))) { ?>
                        <li value="<?= FindMovieByGenre('aventure')[$x]["titre"] ?>"><?= FindMovieByGenre('aventure')[$x]["titre"] ?></li><?php
                                                                                                                    $x++;
                                                                                                                } ?>
                </ul>
                <ul class="genre">Horreur
                <?php
                    $x = 0;
                    while ($x < (count(FindMovieByGenre('aventure')))) { ?>
                        <li value="<?= FindMovieByGenre('aventure')[$x]["titre"] ?>"><?= FindMovieByGenre('aventure')[$x]["titre"] ?></li><?php
                                                                                                                    $x++;
                                                                                                                } ?>
                </ul>
                <ul class="genre">Western
                <?php
                    $x = 0;
                    while ($x < (count(FindMovieByGenre('aventure')))) { ?>
                        <li value="<?= FindMovieByGenre('aventure')[$x]["titre"] ?>"><?= FindMovieByGenre('aventure')[$x]["titre"] ?></li><?php
                                                                                                                    $x++;
                                                                                                                } ?>
                </ul>
                <ul class="genre">Histoire
                <?php
                    $x = 0;
                    while ($x < (count(FindMovieByGenre('aventure')))) { ?>
                        <li value="<?= FindMovieByGenre('aventure')[$x]["titre"] ?>"><?= FindMovieByGenre('aventure')[$x]["titre"] ?></li><?php
                                                                                                                    $x++;
                                                                                                                } ?>
                </ul>
            </li>
        </ul>
        <ul class="type">Serie
            <li>
                <ul class="genre">Aventure
                <?php
                    $x = 0;
                    while ($x < (count(FindMovieByGenre('aventure')))) { ?>
                        <li value="<?= FindMovieByGenre('aventure')[$x]["titre"] ?>"><?= FindMovieByGenre('aventure')[$x]["titre"] ?></li><?php
                                                                                                                    $x++;
                                                                                                                } ?>
                </ul>
                <ul class="genre">Comédie
                <?php
                    $x = 0;
                    while ($x < (count(FindMovieByGenre('aventure')))) { ?>
                        <li value="<?= FindMovieByGenre('aventure')[$x]["titre"] ?>"><?= FindMovieByGenre('aventure')[$x]["titre"] ?></li><?php
                                                                                                                    $x++;
                                                                                                                } ?>
                </ul>
                <ul class="genre">Drame
                <?php
                    $x = 0;
                    while ($x < (count(FindMovieByGenre('aventure')))) { ?>
                        <li value="<?= FindMovieByGenre('aventure')[$x]["titre"] ?>"><?= FindMovieByGenre('aventure')[$x]["titre"] ?></li><?php
                                                                                                                    $x++;
                                                                                                                } ?>
                </ul>
                <ul class="genre">Fiction jeunesse
                <?php
                    $x = 0;
                    while ($x < (count(FindMovieByGenre('aventure')))) { ?>
                        <li value="<?= FindMovieByGenre('aventure')[$x]["titre"] ?>"><?= FindMovieByGenre('aventure')[$x]["titre"] ?></li><?php
                                                                                                                    $x++;
                                                                                                                } ?>
                </ul>
                <ul class="genre">Film musical
                <?php
                    $x = 0;
                    while ($x < (count(FindMovieByGenre('aventure')))) { ?>
                        <li value="<?= FindMovieByGenre('aventure')[$x]["titre"] ?>"><?= FindMovieByGenre('aventure')[$x]["titre"] ?></li><?php
                                                                                                                    $x++;
                                                                                                                } ?>
                </ul>
                <ul class="genre">Policier
                <?php
                    $x = 0;
                    while ($x < (count(FindMovieByGenre('aventure')))) { ?>
                        <li value="<?= FindMovieByGenre('aventure')[$x]["titre"] ?>"><?= FindMovieByGenre('aventure')[$x]["titre"] ?></li><?php
                                                                                                                    $x++;
                                                                                                                } ?>
                </ul>
                <ul class="genre">Fantastique
                <?php
                    $x = 0;
                    while ($x < (count(FindMovieByGenre('aventure')))) { ?>
                        <li value="<?= FindMovieByGenre('aventure')[$x]["titre"] ?>"><?= FindMovieByGenre('aventure')[$x]["titre"] ?></li><?php
                                                                                                                    $x++;
                                                                                                                } ?>
                </ul>
                <ul class="genre">Science fiction
                <?php
                    $x = 0;
                    while ($x < (count(FindMovieByGenre('aventure')))) { ?>
                        <li value="<?= FindMovieByGenre('aventure')[$x]["titre"] ?>"><?= FindMovieByGenre('aventure')[$x]["titre"] ?></li><?php
                                                                                                                    $x++;
                                                                                                                } ?>
                </ul>
                <ul class="genre">Horreur
                <?php
                    $x = 0;
                    while ($x < (count(FindMovieByGenre('aventure')))) { ?>
                        <li value="<?= FindMovieByGenre('aventure')[$x]["titre"] ?>"><?= FindMovieByGenre('aventure')[$x]["titre"] ?></li><?php
                                                                                                                    $x++;
                                                                                                                } ?>
                </ul>
                <ul class="genre">Western
                <?php
                    $x = 0;
                    while ($x < (count(FindMovieByGenre('aventure')))) { ?>
                        <li value="<?= FindMovieByGenre('aventure')[$x]["titre"] ?>"><?= FindMovieByGenre('aventure')[$x]["titre"] ?></li><?php
                                                                                                                    $x++;
                                                                                                                } ?>
                </ul>
                <ul class="genre">Histoire
                <?php
                    $x = 0;
                    while ($x < (count(FindMovieByGenre('aventure')))) { ?>
                        <li value="<?= FindMovieByGenre('aventure')[$x]["titre"] ?>"><?= FindMovieByGenre('aventure')[$x]["titre"] ?></li><?php
                                                                                                                    $x++;
                                                                                                                } ?>
                </ul>
            </li>
        </ul>
    </nav>
</body>

</html>