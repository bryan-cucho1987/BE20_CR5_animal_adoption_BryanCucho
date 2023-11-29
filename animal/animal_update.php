<?php
session_start();

if ((!isset($_SESSION["user"]) && !isset($_SESSION["adm"])) || isset($_SESSION["user"])) {
    header("location: /home.php");
}

require_once '../components/db_connect.php';
require_once '../components/file_upload.php';

if (isset($_GET["id"]) && !empty($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "SELECT * FROM `animals` WHERE `animal_id` = $id";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);
}

if (isset($_POST["create"])) {
    $animal_name = $_POST["animal_name"];
    $price = $_POST["price"];
    $photo = file_upload($_FILES["photo"], "default");
    $location = $_POST["location"];
    $description = $_POST["description"];
    $size = $_POST["size"];
    $age = $_POST["age"];
    $vaccinated = $_POST["vaccinated"];
    $breed = $_POST["breed"];
    $status = $_POST["status"];


    if ($_FILES["photo"]["error"] == 0) {
        if ($row["photo"] !== "default.jpg") {
            unlink("../assets/$row[photo]");
        }
        $sql = "UPDATE `animals` SET `animal_name`='$animal_name',`price`= $price,`photo` = '$photo[0]',`location` ='$location', `description` = '$description',`size` = '$size',`age`='$age',`vaccinated` = '$vaccinated',`breed` = '$breed',`status`='$status' WHERE `animal_id` = {$id}";
    } else {
        $sql =  "UPDATE `animals` SET `animal_name` = '$animal_name',`price` = $price,`location` = '$location', `description` = '$description',`size`='$size', `age` = '$size', `vaccinated` = '$vaccinated',`breed` = '$breed',`status` = '$status' WHERE `animal_id` = {$id}";
    }


    if (mysqli_query($connect, $sql)) {
        echo "
            <div class='alert alert-success' role='alert'>
                Pet entry has been succesfully updated!
            </div>";
    } else {
        echo "
            <div class='alert alert-danger' role='alert'>
                Something went wrong!
            </div>";
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
    <script src="https://kit.fontawesome.com/fd5dec3618.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/footer.css">
</head>

<body>
    <?php require_once '../components/navbar.php' ?>

    <div class="container1 mt-5">
        <h2>UPDATE PET PROFILE</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3 mt-3">
                <label for="title" class="form-label">Name</label>
                <input type="text" class="form-control" id="animal_name" aria-describedby="animal_name" name="animal_name" value="<?= $row["animal_name"] ?>">
            </div>
            <div class="mb-3 mt-3">
                <label for="price" class="form-label">€ Price</label>
                <input type="number" class="form-control" id="price" aria-describedby="price" name="price" value="<?= $row["price"] ?>">
            </div>
            <div class="mb-3 mt-3">
                <label for="author_lastname" class="form-label">Photo</label>
                <input type="file" class="form-control" id="photo" aria-describedby="photo" name="photo" value="<?= $row["photo"] ?>">
            </div>
            <div class="mb-3 mt-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" class="form-control" id="location" aria-describedby="location" name="location" value="<?= $row["location"] ?>">
            </div>
            <div class="mb-3 mt-3">
                <label for="description" class="form-label">Description</label>
                <input type="text" class="form-control" id="description" aria-describedby="description" name="description" value="<?= $row["description"] ?>">
            </div>
            <div class="mb-3 mt-3">
                <label for="size" class="form-label">Size</label>
                <input type="text" class="form-control" id="size" aria-describedby="size" name="size" value="<?= $row["size"] ?>">
            </div>
            <div class="mb-3 mt-3">
                <label for="age" class="form-label">Age</label>
                <input type="text" class="form-control" id="age" aria-describedby="age" name="age" value="<?= $row["age"] ?>">
            </div>
            <div class="mb-3 mt-3">
                <label for="vaccinated" class="form-label">Vaccinated</label>
                <input type="text" class="form-control" id="vaccinated" aria-describedby="vaccinated" name="vaccinated" value="<?= $row["vaccinated"] ?>">
            </div>
            <div class="mb-3">
                <label for="breed" class="form-label">Breed / Race </label>
                <input type="text" step="0.01" class="form-control" id="breed" aria-describedby="breed" name="breed" value="<?= $row["breed"] ?>">
            </div>
            <div class="mb-3">
                <select name="status" class="form-control">
                    <option value="0"> Status</option>
                    <?= $options ?>
                </select>
            </div>
            <button name="create" type="submit" class="btn btn-primary">Confirm updates</button>
            <a href="../home.php" class="btn btn-warning">Back to home page</a>
        </form>
    </div>
    <?php require_once '../components/footer.php'; ?>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>