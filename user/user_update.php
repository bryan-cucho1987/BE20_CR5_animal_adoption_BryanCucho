<?php
session_start();

if (!isset($_SESSION["user"]) && !isset($_SESSION["adm"])) {
    header('location: htdocs\BE20_CR5_BryanJCuchoM\home.php');
    exit();
}

if (isset($_SESSION["adm"])) {
    $id = $_GET["user_id"] ?? $_SESSION["adm"];
} else {
    $id = $_SESSION["user"];
}

require_once '../components/db_connect.php';
require_once '../components/clean.php';
require_once '../components/file_upload.php';


$emailError = "";
$passError = "";

$sql = "SELECT * FROM `users` WHERE user_id = '$id'";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($result);

if (isset($_POST["update"])) {
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $phone_number = $_POST["phone_number"];
    $date_of_birth = $_POST["date_of_birth"];
    $address = $_POST["address"];
    $picture = file_upload($_FILES["picture"]);



    /* checking if a picture has been selected in the input for the image */
    if ($_FILES["picture"]["error"] == 0) {
        /* checking if the picture name of the product is not avatar.png to remove it from pictures folder */
        if ($row["picture"] !== 'avatar.jpg') {
            // unlink("..assets/$row[picture]");
        }
        $sql = "UPDATE `users` SET `fname` = '$fname', `lname` = '$lname', `email` = '$email',`password` = '$password', phone_number = '$phone_number', date_of_birth = '$date_of_birth', `address` = '$address', picture = '$picture[0]' WHERE user_id = {$id}";
    } else {
        $sql = "UPDATE `users` SET `fname` = '$fname', `lname` = '$lname', `email` = '$email',`password` = '$password', phone_number = '$phone_number', date_of_birth = '$date_of_birth', `address` = '$address' WHERE user_id = {$id}";
    }
    $result = mysqli_query($connect, $sql);
    $error = false;

    if (empty($email)) {
        $error = true;
        $emailError = "Please type your email adress here.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $emailError = "Email address with an invalid format";
    }

    if (empty($password)) {
        $error = True;
        $passError = "Password cannot be empty.";
    } elseif (strlen($password) < 3) {
        $error = true;
        $passError = "Password must be at least 8 character long.";
    }

    if ($error === false) {
        $password = hash("sha256", $password);





        if ($result) {
            echo "<div class='alert alert-success' role='alert'>
            User updated.
          </div>";
        } else {
            echo "<div class='alert alert-danger' role='alert'>
            something went wrong!.
          </div>";
        }
    }
}
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
    <script src="https://kit.fontawesome.com/fd5dec3618.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/footer.css">
</head>

<body>
    <?php require_once '../components/navbar.php' ?>


    <div class="container1">
        <h1 class="text-center">Profile Update</h1>
        <form method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="mb-3 mt-3">
                <label for="fname" class="form-label">First name</label>
                <input type="text" class="form-control" id="fname" name="fname" placeholder="First name" value="<?= $row["fname"] ?>">
            </div>
            <div class="mb-3">
                <label for="lname" class="form-label">Last name</label>
                <input type="text" class="form-control" id="lname" name="lname" placeholder="Last name" value="<?= $row["lname"] ?>">
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">Date of birth</label>
                <input type="date" class="form-control" id="date" name="date_of_birth" value="<?= $row["date_of_birth"] ?>">
            </div>
            <div class="mb-3">
                <label for="phone number" class="form-label">Phone number</label>
                <input type="tel" class="form-control" id="phone_number" name="phone_number" value="<?= $row["phone_number"] ?>">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" value="<?= $row["address"] ?>">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email address" value="<?= $row["email"] ?>">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="<?= $row["password"] ?>">
            </div>

            <div class="mb-3">
                <label for="picture" class="form-label">Profile picture</label>
                <input type="file" class="form-control" id="picture" name="picture">
            </div>

            <button name="update" type="submit" class="btn btn-warning">Update profile</button>
            <a href='../home.php' class='btn btn-warning'>Take me home!</a>
        </form>
    </div>

    <?php require_once '../components/footer.php'; ?>

    <script src="https://kit.fontawesome.com/fd5dec3618.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>