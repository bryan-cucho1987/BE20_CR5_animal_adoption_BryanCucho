<?php
session_start();

if ((!isset($_SESSION["user"]) && !isset($_SESSION["adm"])) || isset($_SESSION["user"])) {
    header("location: ../home.php");
}

require_once "../components/db_connect.php";

$id = $_GET["id"]; // to take the value from the parameter "id" in the url 
$sql = "SELECT * FROM animals WHERE animal_id = $id"; // finding the product 
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($result);  // fetching the data 
if ($row["image"] != "default.jpg") { // if the picture is not product.png (the detault picture) we will delete the picture
    unlink("../assets/$row[image]");
}

$delete = "DELETE FROM animals WHERE animal_id = $id"; // query to delete a record from the database

if (mysqli_query($connect, $delete)) {
    echo "<div class='alert alert-success' role='alert'>
    Pet entry has been succesfully deleted.
  </div>";
    header("Location: ../home.php");
} else {
    echo "Error";
}

mysqli_close($connect);
