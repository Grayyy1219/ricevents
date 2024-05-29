<?php
include("connect.php");

$filter = $_GET['filter'];
$location = $_GET['location'];
$search = $_GET['search'];

$sql = "SELECT * FROM events WHERE 1";

if ($filter !== 'all') {
    $sql .= " AND Available = '$filter'";
}
if ($location !== 'none') {
    $sql .= " AND Location = '$location'";
}
if (!empty($search)) {
    $sql .= " AND EventTitle LIKE '%$search%'";
}

$result = $con->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='event-card'>";
        echo "<h3>" . $row["EventTitle"] . "</h3>";
        echo "<p><strong>Description:</strong> " . $row["Description"] . "</p>";
        echo "<p><strong>Date:</strong> " . $row["Date"] . "</p>";
        echo "<p><strong>Location:</strong> " . $row["Location"] . "</p>";
        echo "</div>";
    }
} else {
    echo "0 results";
}
$con->close();
