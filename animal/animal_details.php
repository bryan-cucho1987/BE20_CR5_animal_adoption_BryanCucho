<?php
session_start();
require_once '../components/db_connect.php';
if (isset($_GET["id"]) && !empty($_GET["id"])) {
    $sql = "SELECT * FROM `animals` WHERE `animal_id` = $_GET[id]";

    $result = mysqli_query($connect, $sql);

    $cards = "";


    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $cards .= "<div class.='card'>
        <img src='../assets/{$row['photo']}' class='card-img-top'>
        <div class='card-body'>
          <h3 class='card-title'>Name:{$row['animal_name']}</h3>
        </div>
        <ul class='list-group list-group-flush'>
            <li class='list-group-item'>Name:{$row['animal_name']}</li>
          <li class='list-group-item'>Breed / Race: {$row['breed']}</li>
          <li class='list-group-item'>Age: {$row['age']}</li>
          <li class='list-group-item'>Vaccinated: {$row['vaccinated']}</li>
          <li class='list-group-item'>Address: {$row['location']}</li>
          <li class='list-group-item'>Size: {$row['size']}</li>
          <li class='list-group-item'>Status: {$row['status']}</li>
          <li class='list-group-item'>Description: {$row['description']}</li>
        </ul>
        <div class='card-body'>
          <a href='../animal/animal_details.php?id={$row['animal_id']}' class='btn btn-outline-primary'>Take me home!</a>";
            if (isset($_SESSION["adm"])) {
                $cards .= "
          <a href='../animal/animal_update.php?id={$row['animal_id']}' class='btn btn-outline-warning'>Update</a>
          <a href='../animal/animal_delete.php?id={$row['animal_id']}' class='btn btn-outline-danger'>Delete</a>";
            }
            $cards .= "</div>
        <br/>
      </div>";
        }
    } else {
        $cards = "<p>No results found</p>";
    }
}
mysqli_close($connect);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> HOME </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://kit-free.fontawesome.com/releases/latest/css/free.min.css" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://kit-free.fontawesome.com/releases/latest/css/free.min.css" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/footer.css">
</head>

<body>
    <?php require_once '../components/Navbar.php'; ?>
    <div class="container">
        <div class="section-title">
            <h1>Read about me</h1>
        </div>
        <?= $cards ?>
    </div>
    <?php require_once '../components/footer.php'; ?>
</body>

</html>