<?php echo "
            <header class='navbar'>
                <h2 class='logoNav'></a>PETS SHOP <br>
                    </i> Stinkers! <i class='fas fa-dog'></i>
                </h2>
                <ul>
                    <li class='listItem'>
                    <a role='button' href='/BE20_CR5_BryanJCuchoM/home.php'><button class='button'>HOME</button></a>
                    </li>
                    <li>
                    <a role='button' href='/BE20_CR5_BryanJCuchoM/animal/animal_senior.php'><button class='button'>OLDER PETS</button></a>
                    </li>";
if (isset($_SESSION["user"]) || isset($_SESSION["adm"])) {
    echo "<ul><li class='listItem'>
                    <a role='button' href='/BE20_CR5_BryanJCuchoM/animal/animal_create.php'><button class='button'>ADD PET</button></a>
                    </li>
                    <li class='listItem'>
                    <a role='button' href='/BE20_CR5_BryanJCuchoM/user/logout.php?logout'><button class='button'>LOGOUT</a>
                    </li>
                    <li class='listItem'>
                    <a role='button' href='/BE20_CR5_BryanJCuchoM/user/user_update.php'><button class='button'>UPDATE PROFILE</a>
                    </li>";
} else {
    echo "<ul><li class='listItem'>
                    <a role='button' href='/BE20_CR5_BryanJCuchoM/user/register.php'><button class='button'>REGISTER</button></a>
                    </li>
                    <li class='listItem1'>
                    <a role='button' href='/BE20_CR5_BryanJCuchoM/user/login.php'><button class='button1'>LOGIN</button></a>
                    </li>";
}
if (isset($_SESSION["adm"])) {
    echo "<ul><li class='listItem'>
                    <a role='button' href='/BE20_CR5_BryanJCuchoM/user/user_dashboard.php'><button class='button'>USER DASHBOARD</a>
                    </li>
                    <li class='listItem'>
                    <a role='button' href='/BE20_CR5_BryanJCuchoM/animal/animal_dashboard.php'><button class='button'>PET DASHBOARD</a>
                    </li>
                </ul>";
}
echo "</header>
";
