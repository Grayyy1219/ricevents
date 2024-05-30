<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book Information</title>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/editbook.css">
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
    </style>
</head>

<body>
    <?php
    include("connect.php");
    include("query.php");
    $genreQuery = "SELECT DISTINCT location FROM events";
    $genreResult = mysqli_query($con, $genreQuery);
    $genres = [];
    while ($locationRow = mysqli_fetch_assoc($genreResult)) {
        $genres[] = $locationRow['location'];
    }
    ?>

    <div class="wrapper" id="w3">
        <h2 style="font-size: 30px;">Add Event Information</h2><br>
        <form method="post" action="process_add_event.php" enctype="multipart/form-data">
            Title: <input type="text" name="title"><br>
            Description: <input type="text" name="description"><br>
            Date: <input type="date" name="date"><br>
            Location: <input type="text" name="location"><br>
            <input type="submit" value="Add">
        </form>
    </div>
</body>

</html>