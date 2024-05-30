<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book Information</title>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/editbook.css">
    <script>
        function updateBook() {
            var form = document.getElementById('editBookForm');
            var formData = new FormData(form);

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'update_item.php', true); // Update the PHP file name
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    alert('Book updated successfully!');
                    window.location.href = 'admin2.php?view_products';
                }
            };
            xhr.send(formData);
        }
    </script>
</head>

<body>
    <?php
    include 'connect.php';

    function getBookDetails($con, $bookId)
    {
        $sql = "SELECT * FROM events WHERE EventID = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $bookId);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $bookId = isset($_GET["bookId"]) ? $_GET["bookId"] : '';
        $bookDetails = getBookDetails($con, $bookId);
    }
    ?>
    <section>
        <div class="wrapper" id="w3">
            <h2 style="font-size: 30px;">Item Information</h2><br>
            <form id="editBookForm" enctype="multipart/form-data" method="POST" action="">
                <?php if ($bookDetails) : ?>
                    <input type="hidden" name="bookId" value="<?php echo htmlspecialchars($bookDetails['EventID']); ?>">
                    Name: <input type="text" name="title" value="<?php echo htmlspecialchars($bookDetails['EventTitle']); ?>"><br>
                    Description: <input type="text" name="publisher" value="<?php echo htmlspecialchars($bookDetails['Description']); ?>"><br>
                    Date: <input type="date" name="publisher" value="<?php echo htmlspecialchars($bookDetails['Date']); ?>"><br>
                    Price: <input type="text" name="price" value="<?php echo htmlspecialchars($bookDetails['Location']); ?>"><br>
                <?php endif; ?>
                <input type="submit" onclick="updateBook()" value=" Update">
            </form>
        </div>
    </section>
    <script>
        document.getElementById('img').addEventListener('change', function(event) {
            const fileInput = event.target;
            const profileImage = document.getElementById('profileImage');

            const file = fileInput.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    profileImage.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>

</html>