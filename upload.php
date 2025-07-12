<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

  if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['image']['tmp_name'];
    $fileName = $_FILES['image']['name'];
    $fileSize = $_FILES['image']['size'];
    $fileType = $_FILES['image']['type'];
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    if (in_array($fileExt, $allowedExtensions)) {
      // Create folder for extension if it doesn't exist
      $uploadDir = 'uploads/' . $fileExt;
      if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
      }

      // Make a safe unique file name
      $newFileName = uniqid('img_', true) . '.' . $fileExt;

      // Move the uploaded file
      $destPath = $uploadDir . '/' . $newFileName;
      if (move_uploaded_file($fileTmpPath, $destPath)) {
        echo "Image uploaded successfully to <strong>$destPath</strong>";
      } else {
        echo "Error moving uploaded file.";
      }
    } else {
      echo "Invalid image type. Only JPG, PNG, GIF, and WEBP allowed.";
    }
  } else {
    echo "No file uploaded or upload error.";
  }
}
?>