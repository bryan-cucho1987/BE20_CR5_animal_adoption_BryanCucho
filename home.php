<?php
session_start();
require_once './components/db_connect.php';
if (isset($_SESSION["user"]) && isset($_POST["buy"])) {
  $date = date('Y-m-d');
  $sql = "INSERT INTO `pet_adoption`(`pet_adoption_date`, `fk_user_id`, `fk_animal_id`) VALUES ('$date',($_SESSION[user]),'$_POST[animal]')";
  if (mysqli_query($connect, $sql)) {
    echo "
    <div class='alert alert-success' role='alert'>
    A Pet has been bought succesfully!
    </div>";
  } else {
    echo "
    <div class='alert alert-danger' role='alert'>
    Sorry! Your purchase has not gone through!
    </div>";
  }
}


$sql = " SELECT *
FROM `animals`
LEFT JOIN `pet_adoption` ON `animals`.`fk_animal_id` = `pet_adoption`.pet_id";
$result = mysqli_query($connect, $sql);
$cards = "";


if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $cards .= "<div class.='card'>
        <img src='assets/{$row['photo']}' class='card-img-top'>
        <div class='card-body'>
          <h2 class='card-title'><strong> {$row['animal_name']}</strong></h2>
        </div>
        <ul class='list-group list-group-flush'>
          <li class='list-group-item'>{$row['breed']}</li>
          <li class='list-group-item'>{$row['description']}</li>
        </ul>
        <div class='card-body'>
          <a href='./animal/animal_details.php?id={$row['animal_id']}' class='btn btn-outline-primary'>Read more</a>";
    if (isset($_SESSION["user"])) {
      $cards .= "
      <form action = '' method='post'>
          <input type ='hidden' name='animal' value'$row[animal_id]'>
          <input class='btn btn-outline-warning' type='submit' value='Take me home!' name= 'buy'>
      </form>";
    }
    $cards .= "</div>
        <br/>
      </div>";
  }
} else {
  $cards = "<p> No results found </p>";
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
  <link rel="stylesheet" href="css/navbar.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/footer.css">

</head>

<body>
  <?php require_once './components/navbar.php'; ?>
  <div class="container">
    <div class="section-title">
      <h1 class="greeting">Meet our dear friends!<br>
        &
      </h1>
      <h2 class="greeting">Sign up to purchase a pet</h>
    </div>
    <div class='row row-cols-lg-3 row-cols-md-2 row-cols-sm-1 row row-cols-xs-1'>
      <?= $cards ?>
    </div>
  </div>
  <?php require_once './components/footer.php'; ?>
  <script src="https://kit.fontawesome.com/fd5dec3618.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>