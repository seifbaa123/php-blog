<?php

function uploadImage()
{
    if (!isset($_FILES["image"]) || $_FILES["image"]["error"] != 0) {
        return null;
    }

    $uploadDir = "../static/images/";

    $fileName = uniqid();
    $targetPath = $uploadDir . $fileName;

    if (!move_uploaded_file($_FILES["image"]["tmp_name"], $targetPath)) {
        return null;
    }

    return $fileName;
}