<?php

function clean($data)
{
    $data = Trim($data);
    $data = htmlspecialchars($data);
    $data = strip_tags($data);
    return $data;
};
