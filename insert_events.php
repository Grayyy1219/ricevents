<style>
    section {
        padding: 20px;
        background-color: #f5f5f5;
        font-family: Arial, sans-serif;
    }

    .wrapper {
        max-width: 600px;
        margin: 20px auto;
        background-color: #fff;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
        color: var(--primary);
        text-align: center;
    }

    form {
        display: flex;
        flex-direction: column;
    }

    form input[type="text"],
    form input[type="date"] {
        margin-bottom: 10px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    form input[type="submit"],
    form input[type="button"] {
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        background-color: var(--primary);
        color: #fff;
        font-size: 16px;
        cursor: pointer;
    }

    form input[type="submit"]:hover,
    form input[type="button"]:hover {
        background-color: #555;
    }

    form select {
        margin-bottom: 10px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .btn-upload-img {
        display: block;
        width: 200px;
        margin: 0 auto;
        text-align: center;
        padding: 10px;
        background-color: var(--primary);
        color: #fff;
        border-radius: 5px;
        cursor: pointer;
    }

    img#profileImage {
        aspect-ratio: 3 / 1;
        object-fit: cover;
        border-radius: 10px;
    }

    .slot div {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 5px 0px;
    }

    .slot {
        margin: 10px 0;
    }
</style>

<body>
    <?php
    include("connect.php");
    include("query.php");
    ?>

    <div class="wrapper" id="w3">
        <h2 style="font-size: 30px;">Add Event Information</h2><br>
        <form method="post" action="process_add_event.php" enctype="multipart/form-data">
            <input type="hidden" name="" value="<?= $UserID ?>">
            Title: <input type="text" name="title"><br>
            Description: <input type="text" name="description"><br>
            Date: <?php
                    if (isset($_GET["date"])) {
                        $date = $_GET["date"];
                        echo '<input type="date" name="date" value="' . $date . '" readonly>';
                    } else {
                        echo '<input type="date" name="date">';
                    }
                    ?><br>
            Location:
            <select name="location">
                <?php
                $genreQuery = "SELECT * FROM location";
                $genreResult = mysqli_query($con, $genreQuery);

                while ($row = mysqli_fetch_assoc($genreResult)) {
                    $LocationName = $row["LocationName"];
                    echo "<option value='$LocationName'>$LocationName</option>";
                }
                ?>
            </select><br>
            <img id='profileImage' alt='' width="100%"><br>
            <label class="btn-upload-img">
                Select Image<input type="file" id="img" name="imgloc" style="display: none;">
            </label><br>
            <div class="slot">
                <div>
                    <input type="radio" name="slot" value="10">
                    <p>10 Persons</p>
                </div>
                <div>
                    <input type="radio" name="slot" value="20">
                    <p>20 Persons</p>
                </div>
                <div>
                    <input type="radio" name="slot" value="50">
                    <p>50 Persons</p>
                </div>
            </div>

            <input type="submit" value="Add">
        </form>
    </div>
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