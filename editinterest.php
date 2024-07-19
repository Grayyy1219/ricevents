<?php
include("connect.php");
include("query.php");

if (isset($_GET['edit'])) {
    $edit = $_GET['edit'];
    $edeventidit = $_GET['eventid'];
    $available = $_GET['available'];
    $peoplecount = $_GET['peoplecount'];

    if ($peoplecount >= $available) {
        if ($edit == 1) {
            $sql = "DELETE FROM myevents WHERE eventid = $edeventidit and customer_id = $UserID";
            if ($con->query($sql) === TRUE) {
                $successMessage = "Successfully Unregistered from the event.";
                echo "<script>
                alert('$successMessage');
                window.location.href = 'Landingpage.php#';
                </script>";
                exit();
            }
        } else {
            $alertMessage = "No available slots left for this event. Please select a different event.";
            echo "<script>
                alert('$alertMessage');
                window.history.back();
                </script>";
            exit();
        }
    } else {
        if ($edit == 1) {
            $sql = "DELETE FROM myevents WHERE eventid = $edeventidit and customer_id = $UserID";
            if ($con->query($sql) === TRUE) {
                $successMessage = "Successfully Unregistered from the event.";
                echo "<script>
                alert('$successMessage');
                window.location.href = 'Landingpage.php#';
                </script>";
                exit();
            } else {
                echo "Error: " . $con->error;
            }
        } else {
            $sql = "INSERT INTO `myevents` (`MyEventID`, `customer_id`, `eventid`) VALUES (NULL, '$UserID', '$edeventidit');";
            if ($con->query($sql) === TRUE) {
                $successMessage = "Successfully Registered for the event.";
                echo "<script>
                alert('$successMessage');
                window.location.href = 'Landingpage.php#';
                </script>";
                exit();
            } else {
                echo "Error: " . $con->error;
            }
        }
    }
}
