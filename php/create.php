<?php
session_start(); // Start session for handling messages (optional)

// Connect to database (replace with your credentials)
$conn = mysqli_connect("localhost", "root", "", "profile");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = mysqli_real_escape_string($conn, $_POST["title"]);
    $description = mysqli_real_escape_string($conn, $_POST["description"]);

    // Image upload logic (implement validation and secure path generation)
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $target_dir = "uploads/"; // Replace with secure upload directory with proper permissions

        // Generate a unique filename to prevent overwriting
        $filename = uniqid() . '.' . pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
        $target_file = $target_dir . $filename;

        $uploadOk = true;

        // Check if image file is actually an image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = true;
        } else {
            echo "File is not an image.";
            $uploadOk = false;
        }

        // Check if file already exists (unlikely due to unique filename)
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = false;
        }

        // Check file size
        if ($_FILES["image"]["size"] > 500000) { // Adjust size limit as needed
            echo "Sorry, your file is too large.";
            $uploadOk = false;
        }

        // Allow certain file formats
        $allowed_extensions = array("jpg", "jpeg", "png", "gif");
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if (!in_array($imageFileType, $allowed_extensions)) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed";
        }


    }
}
