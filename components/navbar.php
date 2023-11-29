<?php
require "db_connect.php";

$ProfileID = "";
$profPic = "";

if (isset($_SESSION["user"])) {
    $sql = "SELECT * FROM `users` WHERE `user_id` = $_SESSION[user]";
    $result = mysqli_query($connect, $sql);
    if ($row = mysqli_fetch_assoc($result)) {
        $ProfileID .= " <p>Welcome :{$row['fname']}</p>";
        $profPic .= " <img src='/BE20_CR5_BryanJCuchoM/assets/{$row['picture']} class='rounded-circle border border-warning' style='width:32px;height:32px;margin-top:4px;'>";
    }
} else if (isset($_SESSION["adm"])) {
    $sql = "SELECT * FROM `users` WHERE `user_id` = $_SESSION[adm]";
    $result = mysqli_query($connect, $sql);
    if ($row = mysqli_fetch_assoc($result)) {
        $ProfileID .= " <p>Welcome : {$row['fname']}</p>";
        $profPic .= " <img src='/BE20_CR5_BryanJCuchoM/assets/{$row['picture']} class='rounded-circle border border-warning' style='width:32px;height:32px;margin-top:4px;'>";
    }
}

echo "
            <header class='navbar'>
                <h3 class='logoNav'></a>PETSHOP <br>
                    </i> Stinkers! <i class='fas fa-dog'></i>
                </h3>
                <ul>
                    <li class='listItem'>
                    <a role='button' href='/BE20_CR5_BryanJCuchoM/home.php'><button class='button'>HOME</button></a>
                    </li>
                    <li>
                    <a role='button' href='/BE20_CR5_BryanJCuchoM/animal/animal_senior.php'><button class='button'>OLDER PETS</button></a>
                    </li>";
if (isset($_SESSION["user"]) || isset($_SESSION["adm"])) {
    echo "<ul>
                    <li class='listItem'>
                    <a role='button' href='/BE20_CR5_BryanJCuchoM/user/user_update.php'><button class='button'>USER PROFILE</a>
                    </li>                
                    <li class='listItem'>
                    <a role='button' href='/BE20_CR5_BryanJCuchoM/user/logout.php?logout'><button class='button'>LOGOUT</a>
                    </li>
                    <li class='listItem d-flex align-items-center'>
                    $profPic $ProfileID 
                    </li> ";
} else {
    echo "<ul>      <li class='listItem'>
                    <a role='button' href='/BE20_CR5_BryanJCuchoM/user/register.php'><button class='button'>REGISTER</button></a>
                    </li>
                    <li class='listItem1'>
                    <a role='button' href='/BE20_CR5_BryanJCuchoM/user/login.php'><button class='button1'>LOGIN</button></a>
                    </li>";
}
if (isset($_SESSION["adm"])) {
    echo "<ul>      <li class='listItem'>
                    <a role='button' href='/BE20_CR5_BryanJCuchoM/animal/animal_create.php'><button class='button'>CREATE PET</button></a>
                    </li>
                    <li class='listItem'>
                    <a role='button' href='/BE20_CR5_BryanJCuchoM/user/user_dashboard.php'><button class='button'>USER DASHBOARD</a>
                    </li>
                    <li class='listItem'>
                    <a role='button' href='/BE20_CR5_BryanJCuchoM/animal/animal_dashboard.php'><button class='button'>PET DASHBOARD</a>
                    </li>
                </ul>";
}
echo "</header>
";
mysqli_close($connect);
