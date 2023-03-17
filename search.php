<?php
    session_name("cinelist");
    session_start();

// Search Index
// Connexion à la base de données
$dsn = "mysql:host=localhost;port=3306;dbname=animlist;charset=utf8";
$dbUser = "root";
$dbPassword = "";
$lienDB = new PDO($dsn, $dbUser, $dbPassword);

$search = $_POST["q"];
$sql2 = "SELECT * FROM listvu WHERE nom LIKE :search ORDER BY nom ASC";
$result = $lienDB->prepare($sql2);
$result->bindValue(':search', "$search%");
$result->execute();

while ($row = $result->fetch()) : ?>
  <a href="https://www.google.fr/search?q=<?=htmlspecialchars($row['nom']); ?>" target="_blank"><?=htmlspecialchars($row['nom']); ?></a>
  <br>
<?php endwhile;