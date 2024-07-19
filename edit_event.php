<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event Information</title>
    <link rel="stylesheet" href="css/global.css">
    <style>
        section {
            padding: 20px;
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
        }

        .wrapper {
            max-width: 600px;
            margin: 0 auto;
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

        form input[type="button"] {
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            background-color: var(--primary);
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }

        form input[type="button"]:hover {
            background-color: #555;
        }

        img#profileImage {
            aspect-ratio: 3 / 1;
            object-fit: cover;
            border-radius: 10px;
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

        form select {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .slot div {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 5px 0px;
        }
    </style>
    <script>
        function updateEvent() {
            var form = document.getElementById('editEventForm');
            var formData = new FormData(form);

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'update_event.php', true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4) {
                    if (xhr.status == 200) {
                        alert('Event updated successfully!');
                        window.location.href = 'admin2.php?view_events';
                    } else {
                        alert('Error updating event: ' + xhr.responseText);
                    }
                }
            };
            xhr.send(formData);
        }
    </script>
</head>

<body>
    <?php
    include 'connect.php';

    function getEventDetails($con, $eventId)
    {
        $sql = "SELECT * FROM events WHERE EventID = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $eventId);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $eventId = isset($_GET["eventId"]) ? $_GET["eventId"] : '';
        $eventDetails = getEventDetails($con, $eventId);
    }
    ?>
    <section>
        <div class="wrapper" id="w3">
            <h2 style="font-size: 30px;">Event Information</h2><br>
            <form id="editEventForm" enctype="multipart/form-data" method="POST" action="">
                <?php if ($eventDetails) : ?>
                    <input type="hidden" name="eventId" value="<?php echo htmlspecialchars($eventDetails['EventID']); ?>">
                    Title: <input type="text" name="title" value="<?php echo htmlspecialchars($eventDetails['EventTitle']); ?>"><br>
                    Description: <input type="text" name="description" value="<?php echo htmlspecialchars($eventDetails['Description']); ?>"><br>
                    Date: <input type="date" name="date" value="<?php echo htmlspecialchars($eventDetails['Date']); ?>" readonly><br>
                    Location:
                    <select name="location" required>
                        <?php
                        $genreQuery = "SELECT * FROM location";
                        $genreResult = mysqli_query($con, $genreQuery);

                        while ($row = mysqli_fetch_assoc($genreResult)) {
                            $LocationName = $row["LocationName"];
                            echo "<option value='$LocationName'>$LocationName</option>";
                        }
                        ?>
                    </select><br>
                    <img id='profileImage' src="<?php echo htmlspecialchars($eventDetails['EventImg']); ?>" alt='' width="100%"><br>
                    <label class="btn-upload-img">
                        Select Image<input type="file" id="img" name="imgloc" style="display: none;" required>
                    </label><br>
                    Slot:
                    <div class="slot">
                        <div>
                            <input type="radio" name="slot" value="10" onchange="updateTotal(this)" <?php echo $eventDetails['Available'] == 10 ? 'checked' : ''; ?> required>
                            <p>10 Persons</p>
                        </div>
                        <div>
                            <input type="radio" name="slot" value="20" onchange="updateTotal(this)" <?php echo $eventDetails['Available'] == 20 ? 'checked' : ''; ?> required>
                            <p>20 Persons</p>
                        </div>
                        <div>
                            <input type="radio" name="slot" value="50" onchange="updateTotal(this)" <?php echo $eventDetails['Available'] == 50 ? 'checked' : ''; ?> required>
                            <p>50 Persons</p>
                        </div>
                        <div>
                            <input type="radio" name="slot" value="100" onchange="updateTotal(this)" <?php echo $eventDetails['Available'] == 100 ? 'checked' : ''; ?> required>
                            <p>100 Persons</p>
                        </div>
                    </div><br>
                <?php endif; ?>
                <input type="button" onclick="updateEvent()" value="Update">
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