<?php
session_start();

if (isset($_SESSION['user']) || isset($_SESSION['adm'])) {
    header("location: ../home.php");
}

require_once '../components/db_connect.php';
require_once '../components/clean.php';
$password = "";
$email = "";
$emailError = "";
$passError = "";
$error = "";


if (isset($_POST["login"])) {
    $email = isset($_POST["email"]) ? clean($_POST["email"]) : "";
    $password = isset($_POST["password"]) ? clean($_POST["password"]) : "";


    if (empty($email)) {
        $error = true;
        $emailError = "Email cannot be empty.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $emailError = "Email has the wrong format.";
    }

    if (empty($password)) {
        $error = true;
        $passError = "Password cannot be empty.";
    }
    if (!$error) {
        $password = hash("sha256", $password);

        $sql = "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'";
        $result = mysqli_query($connect, $sql);
        var_dump($result);
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['status'] == 'user') {
                $_SESSION['user'] = $row['user_id'];
                header("Location: ../home.php");
            } elseif ($row["status"] == "adm") {
                $_SESSION['adm'] = $row['user_id'];
                header("Location: /BE20_CR5_BryanJCuchoM/user/user_dashboard.php");
            }
        } else {
            echo "
            <div class='alert alert-danger' role='alert'>
                Either Username or Password is wrong!
            </div>";
        }
    }
}
var_dump('status');
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
    <script src="https://kit.fontawesome.com/fd5dec3618.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/footer.css">
</head>

<body>
    <?php require_once '../components/navbar.php' ?>
    <div class="container1">
        <h2 class="text-center">Login page</h2>
        <form method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email address" value="<?= $email ?>">
                <span class="text-danger"><?= $emailError ?></span>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
                <span class="text-danger"><?= $passError ?></span>
            </div>
            <button name="login" type="submit" class="btn btn-primary">Login</button>

            <span>You don't have an account? <a href="register.php"><strong>register here</strong></a></span>
        </form>
        <br>
        <p> user login: bryancucho@gmail.com / 123456</p>
        <p> adm login: peterpane@gmail.com / 123456</p>
    </div>
    <br>
</body>
<?php require_once '../components/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</html>