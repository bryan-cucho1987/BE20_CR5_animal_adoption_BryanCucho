<?php
$hostname = "127.0.0.1"; // this is the hostname that you can find in the PhpMyAdmin and you can write "localhost" too
$username = "root"; // be default the userName for the databases is root
$password = ""; // by default there is no password in the databases
$dbname = "BE20_cr5_animal_adoption_BryanCuchoM"; // here we need to write the Database name

// create connection, you need to be aware of the order of the parameters
$connect = mysqli_connect($hostname, $username, $password, $dbname);

// check connection
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}
