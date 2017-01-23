<?php

//DB Variables
$host = 'itp460.usc.edu';
$database_name = 'dvd';
$username = 'student';
$password = 'ttrojan';

//PDO object for database connection
$pdo = new PDO("mysql:host=$host;dbname=$database_name", $username, $password);

$rating = $_GET['rating'];

//SQL Query
$sql = "
  SELECT title, genre_name, format_name, rating_name
  FROM dvds
  INNER JOIN genres
  ON dvds.genre_id = genres.id
  INNER JOIN formats
  ON dvds.format_id = formats.id
  INNER JOIN ratings
  ON dvds.rating_id = ratings.id
  WHERE rating_name = ?
";

//prepares statement
$statement = $pdo->prepare($sql);
$statement->bindParam(1, $rating);
$statement->execute();
$dvds = $statement->fetchAll(PDO::FETCH_OBJ);

//End of PHP
?>

<!-- Displaying results-->
<ul>
  <?php foreach ($dvds as $dvd) : ?>
    <li>
      <h2><?= $dvd->title ?> </h2>
      <p> Genre: <?=$dvd->genre_name?> <p>
      <p> Format: <?=$dvd->format_name?> <p>
      <p> Rating: <?=$dvd->rating_name?> <p>
    </li>
  <?php endforeach; ?>
</ul>
