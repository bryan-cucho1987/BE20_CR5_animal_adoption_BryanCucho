<?php
session_start();
require_once '../components/db_connect.php';
$sql = " SELECT *
FROM `animals`
LEFT JOIN `pet_adoption` ON `animals`.`fk_pet_id` = `pet_adoption`.`pet_id`";
$result = mysqli_query($connect, $sql);
$animalData = "";

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $animalData .= "<tr>
                    <th scope='row'>{$row["animal_id"]}</th>
                    <td>{$row["animal_name"]}</td>
                    <td>{$row["breed"]}</td>
                    <td>{$row["age"]}</td>
                    <td>{$row["vaccinated"]}</td>
                    <td>{$row["location"]}</td>
                    <td>{$row["size"]}</td>
                    <td>{$row["status"]}</td>
                    <td><img src='../assets/{$row["photo"]}' alt='In progress..' width='25'></td>
            </tr>";
    }
} else {
    $animalData = "<p>No results found</p>";
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Pet Dashboard</title>
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
    <br>
    <div class="container1">
        <br>
        <div>
            <h1 class="text-center">Pet dashboard</h1>
        </div>
        <br>
        <table class="table table-light table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Animal name</th>
                    <th scope="col">Breed</th>
                    <th scope="col">Age</th>
                    <th scope="col">Vaccinated</th>
                    <th scope="col">Location</th>
                    <th scope="col">Size</i>
                    <th scope="col">Status</th>
                    <th scope="col">Photo</th>
                </tr>
            </thead>
            <tbody>
                <?= $animalData; ?>
            </tbody>
        </table>
        </table>
    </div>
    <?php require_once '../components/footer.php'; ?>
</body>

</html>