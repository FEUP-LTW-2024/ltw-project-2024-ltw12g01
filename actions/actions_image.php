<?php
declare(strict_types = 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $image_data = $_FILES['image']['tmp_name'];

    $target_directory = "uploads/";
    $target_file = $target_directory . basename($_FILES['image']['name']);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        echo "Image uploaded successfully.";
    } else {
        echo "Error uploading image.";
    }
} else {
    echo "Invalid request.";
}
?>
