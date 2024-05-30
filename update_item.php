<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['bookId']) && isset($_POST['title']) && isset($_POST['publisher']) && isset($_POST['genre']) && isset($_POST['price']) && isset($_POST['Quantity'])) {
        // Sanitize input data
        $bookId = mysqli_real_escape_string($con, $_POST['bookId']);
        $title = mysqli_real_escape_string($con, $_POST['title']);
        $publisher = mysqli_real_escape_string($con, $_POST['publisher']);
        $genre = mysqli_real_escape_string($con, $_POST['genre']);
        $price = mysqli_real_escape_string($con, $_POST['price']);
        $Quantity = mysqli_real_escape_string($con, $_POST['Quantity']);

        if (isset($_FILES['bookImage']['name']) && !empty($_FILES['bookImage']['name'])) {
            $targetDir = "upload/";
            $fileName = basename($_FILES["bookImage"]["name"]);
            $targetFilePath = $targetDir . time() . '_' . $fileName;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

            $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
            if (in_array($fileType, $allowTypes)) {
                if (move_uploaded_file($_FILES["bookImage"]["tmp_name"], $targetFilePath)) {
                    $sql = "UPDATE books SET Title = '$title', Publisher = '$publisher', Genre = '$genre', Price = '$price', Quantity='$Quantity', BookImage = '$targetFilePath' WHERE BookID = $bookId";
                    if (mysqli_query($con, $sql)) {
                        echo $targetFilePath;
                    } else {
                        echo "Error updating book information: " . mysqli_error($con);
                    }
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            } else {
                echo "Sorry, only JPG, JPEG, PNG, & GIF files are allowed.";
            }
        } else {
            $sql = "UPDATE books SET Title = '$title', Publisher = '$publisher', Genre = '$genre', Price = '$price', Quantity='$Quantity' WHERE BookID = $bookId";
            if (mysqli_query($con, $sql)) {
                $result = mysqli_query($con, "SELECT BookImage FROM books WHERE BookID = $bookId");
                $row = mysqli_fetch_assoc($result);
                echo $row['BookImage'];
            } else {
                echo "Error updating book information: " . mysqli_error($con);
            }
        }
    } else {
        echo "Incomplete form data.";
    }
} else {
    echo "Invalid request method.";
}
