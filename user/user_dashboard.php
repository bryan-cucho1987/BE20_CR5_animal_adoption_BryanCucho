<?php
session_start();

if (!isset($_SESSION["adm"])) {
    header('location: ../home.php');
}
require_once '../components/db_connect.php';

$sql = "SELECT * FROM `users` WHERE `status` != 'adm'";
$result = mysqli_query($connect, $sql);
$data = "";
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data .= "<tr>
                    <th scope='row'>{$row["user_id"]}</th>
                    <td>{$row["email"]}</td>
                    <td>{$row["fname"]}</td>
                    <td>{$row["lname"]}</td>
                    <td>{$row["phone_number"]}</td>
                    <td>{$row["address"]}</td>
                    <td><img src='../assets/{$row["picture"]}' alt='User Avatar' width='25'></td>
                    <td><a href='../user/user_update.php?user_id=$row[user_id]' class='btn btn-primary'>Update</a></td>
                    <td><a href='../user/user_delete.php?id={$row['user_id']}' class='btn btn-danger'>Delete</a></td>
            </tr>";
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
    <br>
    <div class="container1">
        <br>
        <div>
            <h1 class="text-center">User Dashboard</h1>
        </div>
        <br>
        <table class="table table-light table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Email</th>
                    <th scope="col">Name</th>
                    <th scope="col">Last name</th>
                    <th scope="col">Phone number</th>
                    <th scope="col">Address</th>
                    <th scope="col">Photo</i>
                    <th scope="col"></th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?= $data; ?>
            </tbody>
        </table>
        </table>
    </div>
    <?php require_once '../components/footer.php'; ?>
</body>

</html>