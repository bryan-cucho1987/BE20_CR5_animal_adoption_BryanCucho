<?php
function file_upload($photo, $source = "user")
{

    if ($photo["error"] == 4) {
        $photoName = "avatar.jpeg";
        if ($source == "default") {
            $photoName = "default.jpg";
        }
        $message = "No photo has been chosen, but you can upload an image later :)";
    } else {
        $checkIfImage = getimagesize($photo["tmp_name"]);
        $message = $checkIfImage ? "Ok" : "Not an image";
    }

    if ($message == "Ok") {
        $ext = strtolower(pathinfo($photo["name"], PATHINFO_EXTENSION));
        $photoName = uniqid("") . "." . $ext;
        $destination = "../assets/{$photoName}";
        move_uploaded_file($photo["tmp_name"], $destination);
    }

    return [$photoName, $message];
}
