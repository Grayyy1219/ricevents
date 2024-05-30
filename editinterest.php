<?php
include("connect.php");
include("query.php");

if (isset($_GET['edit'])) {
    $edit = $_GET['edit'];
    $edeventidit = $_GET['eventid'];
    if ($edit == 1) {
        $sql = "DELETE FROM myevents WHERE eventid = $edeventidit and customer_id = $UserID";
        if ($con->query($sql) === TRUE) {
            $successMessage = "Successfully Unregister to the event.";
            echo "<script>
                alert('$successMessage');
                window.location.href = 'Landingpage.php#';
              </script>";
            exit();
        }
    } else {
        $sql = "INSERT INTO `myevents` (`MyEventID`, `customer_id`, `eventid`) VALUES (NULL, '$UserID', '$edeventidit');";
        if ($con->query($sql) === TRUE) {
            $successMessage = "Successfully Register to the event.";
            echo "<script>
                alert('$successMessage');
                window.location.href = 'Landingpage.php#';
              </script>";
            exit();
        }
    }
}
