
<?php

if (isset($_GET['eventId'])) {

    $delete_id = $_GET['eventId'];

    $delete_pro = "delete from events where EventID = '$delete_id'";

    $run_delete = mysqli_query($con, $delete_pro);

    if ($run_delete) {

        echo "<script>alert('Event Has been deleted')</script>";
        echo "<script>window.location.href = 'admin2.php?view_events';</script>";
    }
}

?>