<?php
include("connect.php");
include("query.php");

if (isset($_GET['status'])) {
    $status = $_GET['status'];
    $eventid = $_GET['eventid'];


    if ($status == 0) {
        $sql = "UPDATE myevents SET status = $status WHERE MyEventID = $eventid";

        if ($con->query($sql) === TRUE) {
            $successMessage = "Approve Cancel.";
            echo "<script>
                alert('$successMessage');
                window.location.href = 'admin2.php?dashboard';
              </script>";
            exit();
        } else {
            $errorMessage = "Error unblocking user: " . $con->error;
            echo "<script>
                alert('Error: $errorMessage');
                window.location.href = 'admin2.php?dashboard';
              </script>";
            exit();
        }
    }

    if ($status == 1) {
        $sql = "UPDATE myevents SET status = $status WHERE MyEventID = $eventid";

        if ($con->query($sql) === TRUE) {
            $successMessage = "Request Approved.";
            echo "<script>
                alert('$successMessage');
                window.location.href = 'admin2.php?dashboard';
              </script>";
            exit();
        } else {
            $errorMessage = "Error unblocking user: " . $con->error;
            echo "<script>
                alert('Error: $errorMessage');
                window.location.href = 'admin2.php?dashboard';
              </script>";
            exit();
        }
    } else if ($status == 2) {
        $sql = "DELETE FROM myevents WHERE MyEventID = $eventid";

        if ($con->query($sql) === TRUE) {
            $successMessage = "Request Canceled.";
            echo "<script>
                alert('$successMessage');
                window.location.href = 'admin2.php?dashboard';
              </script>";
            exit();
        } else {
            $errorMessage = "Error unblocking user: " . $con->error;
            echo "<script>
                alert('Error: $errorMessage');
                window.location.href = 'admin2.php?dashboard';
              </script>";
            exit();
        }
    }
} else {
    $noUserIdMessage = "User ID not provided.";
    echo "<script>
            alert('$noUserIdMessage');
            window.location.href = 'admin2.php?dashboard';
          </script>";
    exit();
}
