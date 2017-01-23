<?php

//DB Variables
$host = 'itp460.usc.edu';
$database_name = 'dvd';
$username = 'student';
$password = 'ttrojan';

//PDO object for database connection
$pdo = new PDO("mysql:host=$host;dbname=$database_name", $username, $password);

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
  WHERE title LIKE ?
";

//Preparing and executing SQL
$statement = $pdo->prepare($sql);
//The Get is taking the variable we made for text entry in index.php
$like = '%' . $_GET['dvd_title'] . '%';
$statement->bindParam(1,$like);
$statement->execute();

//Changing the results into objects for ease of use
$dvds = $statement->fetchAll(PDO::FETCH_OBJ);

//End of PHP
?>

<!-- Displaying results-->
<?php foreach ($dvds as $dvd) : ?>
  <div>
    <h2><?= $dvd->title ?> </h2>
    <p> Genre: <?=$dvd->genre_name?> <p>
    <p> Format: <?=$dvd->format_name?> <p>
    <p>
      Rating:
      <a href="ratings.php?rating=<?= $dvd->rating_name?>">
        View other <?=$dvd->rating_name?> rated movies
      </a>
    <p>
  </div>
<?php endforeach; ?>
