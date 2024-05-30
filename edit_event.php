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
                    Date: <input type="date" name="date" value="<?php echo htmlspecialchars($eventDetails['Date']); ?>"><br>
                    Location: <input type="text" name="location" value="<?php echo htmlspecialchars($eventDetails['Location']); ?>"><br>
                <?php endif; ?>
                <input type="button" onclick="updateEvent()" value="Update">
            </form>
        </div>
    </section>
</body>

</html>