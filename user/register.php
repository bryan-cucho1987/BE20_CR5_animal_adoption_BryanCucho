<?php

session_start();

if (isset($_SESSION["USER"])) { // if a session "user" exists and have a value
    header("Location: ../home.php"); // redirect the user to the home page
}

if (isset($_SESSION["ADM"])) { // if a session "adm" exists and have a value
    header("Location: ../user/dashboard.php"); // redirect the admin to the dashboard page
}

require_once '../components/db_connect.php';
require_once '../components/clean.php';
require_once '../components/file_upload.php';

$error = false;  // by default, a varialbe $error is false, means there is no error in our form



$fname = $lname = $email = $password = $phone_number = $date_of_birth = $address = $image = ""; // define variables and set them to empty string
$fnameError = $lnameError = $emailError = $dateError = $passError = ""; // define variables that will hold error messages later, for now empty string 

if (isset($_POST["register"])) {
    $fname = clean($_POST["fname"]);
    $lname = clean($_POST["lname"]);
    $email = clean($_POST["email"]);
    $password = clean($_POST["password"]);
    $phone_number = clean($_POST["phone_number"]);
    $date_of_birth = clean($_POST["date_of_birth"]);
    $address = clean($_POST["address"]);
    $image = file_upload($_FILES["picture"]);
    $error = false;

    // simple validation for the "first name"
    if (empty($fname)) {
        $error = true;
        $fnameError = "Please, enter your first name";
    } elseif (strlen($fname) < 3) {
        $error = true;
        $fnameError = "Name must have at least 3 characters.";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $fname)) {
        $error = true;
        $fnameError = "Name must contain only letters and spaces.";
    }


    // simple validation for the "last name"
    if (empty($lname)) {
        $error = true;
        $lnameError = "Please, enter your last name";
    } elseif (strlen($lname) < 3) {
        $error = true;
        $lnameError = "Last name must have at least 3 characters.";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $lname)) {
        $error = true;
        $lnameError = "Last name must contain only letters and spaces.";
    }


    // simple validation for the "date of birth"
    if (empty($date_of_birth)) {
        $error = true;
        $dateError = "date of birth can't be empty!";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { // if the provided text is not a format of an email, error will be true
        $error = true;
        $emailError = "Please enter a valid email address";
    } else {
        // if email is already exists in the database, error will be true
        $query = "SELECT email FROM users WHERE email='$email'";
        $result = mysqli_query($connect, $query);
        if (mysqli_num_rows($result) !== 0) {
            $error = true;
            $emailError = "Provided Email is already in use";
        }
    }

    // simple validation for the "password"
    if (empty($password)) {
        $error = true;
        $passError = "Password can't be empty!";
    } elseif (strlen($password) < 3) {
        $error = true;
        $passError = "Password must have at least 6 characters.";
    }

    if (!$error) { // if there is no error with any input, data will be inserted to the database
        // hashing the password before inserting it to the database
        $password = hash("sha256", $password);

        $sql = "INSERT INTO users (`fname`, `lname`, `email`, `password`, `phone_number`,`date_of_birth`, `address`, `picture`) VALUES ('$fname','$lname', '$email','$password','$phone_number', '$date_of_birth', '$address', '$image[0]')";

        $result = mysqli_query($connect, $sql);

        if ($result) {
            header("Location: ../user/login.php");
            echo "<div class='alert alert-success'>
            <p>New account has been created, $image[1]</p>
        </div>";

            ///// :(
        } else {
            echo "<div class='alert alert-danger'>
            <p>Something went wrong, please try again later ...</p>
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

    <body>
        <div class="container1">
            <h1 class="text-center">Registration</h1>
            <form method="post" autocomplete="off" enctype="multipart/form-data">
                <div class="mb-3 mt-3">
                    <label for="fname" class="form-label">First name</label>
                    <input type="text" class="form-control" id="fname" name="fname" placeholder="First name" value="<?= $fname ?>">
                    <span class="text-danger"><?= $fnameError ?></span>
                </div>
                <div class="mb-3">
                    <label for="lname" class="form-label">Last name</label>
                    <input type="text" class="form-control" id="lname" name="lname" placeholder="Last name" value="<?= $lname ?>">
                    <span class="text-danger"><?= $lnameError ?></span>
                </div>
                <div class="mb-3">
                    <label for="date" class="form-label">Date of birth</label>
                    <input type="date" class="form-control" id="date" name="date_of_birth" value="<?= $date_of_birth ?>">
                    <span class="text-danger"><?= $dateError ?></span>
                </div>
                <div class="mb-3">
                    <label for="phone_number" class="form-label">Phone number</label>
                    <input type="tel" class="form-control" id="phone_number" name="phone number">
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address">
                </div>

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
                <div class="mb-3">
                    <label for="picture" class="form-label">Profile picture</label>
                    <input type="file" class="form-control" id="picture" name="picture">
                </div>

                <button name="register" type="submit" class="btn btn-primary">Create account</button>
                <span>you have an account already? <a href="login.php">login in here</a></span>
            </form>
        </div>
        <br>

        <?php require_once '../components/footer.php'; ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    </body>

</html>