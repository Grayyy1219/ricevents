<?php
include("connect.php");

$filter = $_GET['filter'];
$location = $_GET['location'];
$search = $_GET['search'];

$sql = "SELECT * FROM events WHERE 1";
$conditions = array();
$params = array();

if ($filter !== 'all') {
    $conditions[] = "Available = ?";
    $params[] = $filter;
}
if ($location !== 'none') {
    $conditions[] = "Location = ?";
    $params[] = $location;
}
if (!empty($search)) {
    $conditions[] = "EventTitle LIKE ?";
    $params[] = "%$search%";
}

if (!empty($conditions)) {
    $sql .= " AND " . implode(" AND ", $conditions);
}

$stmt = $con->prepare($sql);

if (!empty($params)) {
    $types = str_repeat('s', count($params));
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $dateFromDb = $row['Date'];
        $date = new DateTime($dateFromDb);
        $formattedDate = $date->format('F j, Y');
        echo " <a href='eventdetails.php?eventid=" . $row['EventID'] . "'>";
        echo "<div class='event-card' onclick='preview(" . $row["EventID"] . ")'>";
        echo "<h3>" . htmlspecialchars($row["EventTitle"]) . "</h3>";
        // echo "<p><strong>Description:</strong> " . htmlspecialchars($row["Description"]) . "</p>"; 
        echo "<p><strong>Date:</strong> " . $formattedDate . "</p>";
        echo "<p><strong>Location:<br></strong> " . htmlspecialchars($row["Location"]) . "</p>";
        echo "</div>";
    }
} else {
    echo "0 results";
}

$stmt->close();
$con->close();
