<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Ric events</title>
    <?php include("connect.php"); ?>
    <?php include("query.php"); ?>
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/landing.css">
    <link rel="stylesheet" href="css/slideshow.css">
    <link rel="stylesheet" href="css/eventstable.css">
    <link rel="icon" href="css/img/logo.ico">
</head>

<body>
    <?php include("header.php"); ?>
    <div class="body">
        <section>
            <div class="" id="w1">
                <div class="slideshow-container">
                    <button class="prev-button">&#10094;</button>
                    <div class="slides-container">
                        <?php
                        $query = mysqli_query($con, "select * from slideshow");
                        while ($row = mysqli_fetch_assoc($query)) {
                            $location = $row["imagelocation"];
                            echo "<div class='slide'><img class='slideimg' src='$location'></div>";
                        }
                        ?>
                    </div>
                    <button class="next-button">&#10095;</button>
                    <div class="dot-container"></div>
                </div>
            </div>
        </section>
        <section id="myevent" style="padding-top: 50px;">
            <?php
            if (isset($UserID)) {
                $getEventQuery = "SELECT myevents.MyEventID, events.EventID, events.EventTitle, events.Description, events.Date, events.Location
                                  FROM myevents
                                  INNER JOIN events ON myevents.eventid = events.EventID 
                                  WHERE myevents.customer_id = $UserID ORDER BY events.EventID ASC";
                $result = mysqli_query($con, $getEventQuery);
                $totalCartValue = 0;
            ?>
                <div class="your-events">
                    <div class="headertitle">
                        <img src="css/img/time.png" style="width: 30px;">
                        <p class="count"><?= $eventcount ?></p>
                        <p class="HeaderName">Events you are in</p>
                    </div>
                    <div class="iventdom">
                        <?php while ($row = mysqli_fetch_assoc($result)) {
                            $dateFromDb = $row['Date'];
                            $date = new DateTime($dateFromDb);
                            $formattedDate = $date->format('F j, Y');
                        ?>
                            <a href="eventdetails.php?eventid=<?= $row['EventID'] ?>">
                                <div class="perevent">
                                    <div class="eventdate">
                                        <img src="css/img/time.png" style="width: 25px;">
                                        <p><?= $formattedDate ?></p>
                                    </div>
                                    <div class="rows">
                                        <div class="row">
                                            <h1 class="eventh1"><?= $row['EventTitle'] ?></h1>
                                        </div>
                                        <div class="row2">
                                            <img src="css/img/pin.png" style="width: 15px;">
                                            <p class="location"><?= $row['Location'] ?></p>
                                        </div>
                                        <div class="row3">
                                            <p class="description"><?= $row['Description'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </section>
        <section id="events">
            <h1 style="text-align: center; font-size: xxx-large;">Event Calendar</h1>
            <div class="update">
                <div class="search">
                    Search by Title:
                    <input type="text" id="searchInput" onkeyup="searchEvents()" placeholder="Enter event title...">
                </div>
                <div class="filter">
                    Filter:
                    <select id="filterbar" onchange="loadevents()">
                        <option value="all">All</option>
                        <option value="0">Available</option>
                        <option value="1">Unavailable</option>
                    </select>
                </div>
                <div class="filter">
                    Sort by Location:
                    <select id="locationbar" onchange="loadevents()">
                        <option value="none">All</option>
                        <?php
                        $sql = "SELECT DISTINCT Location FROM events";
                        $result = $con->query($sql);

                        $options = "";

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $location = htmlspecialchars($row["Location"], ENT_QUOTES, 'UTF-8');
                                $options .= "<option value='" .  $location . "'>" .  $location . "</option>";
                            }
                        } else {
                            $options .= "<option value=''>No locations found</option>";
                        }
                        echo $options;
                        ?>
                    </select>
                </div>
            </div>
            <div class="output" id="eventsList">
                <?php
                $currentDate = isset($_GET['date']) ? new DateTime($_GET['date']) : new DateTime();
                $startDate = (clone $currentDate)->modify('first day of this month');
                $endDate = (clone $currentDate)->modify('last day of this month');
                $approved = 0;

                $query = "SELECT * FROM events WHERE Date BETWEEN ? AND ? AND status != ?";
                $stmt = $con->prepare($query);
                $startDateString = $startDate->format('Y-m-d');
                $endDateString = $endDate->format('Y-m-d');
                $stmt->bind_param('sss', $startDateString, $endDateString, $approved);
                $stmt->execute();
                $result = $stmt->get_result();

                $events = [];
                while ($row = mysqli_fetch_assoc($result)) {
                    $events[$row['Date']][] = $row;
                }
                ?>

                <div class="calendar">
                    <?php
                    $interval = new DateInterval('P1D');
                    $datePeriod = new DatePeriod($startDate, $interval, $endDate->add($interval));
                    foreach ($datePeriod as $date) {
                        $formattedDate = $date->format('F j, Y');
                        $dateString = $date->format('Y-m-d');
                    ?>
                        <div class="day">
                            <div class="eventdate">
                                <img src="css/img/time.png" style="width: 25px;">
                                <p><?= $formattedDate ?></p>
                            </div>
                            <?php
                            if (isset($events[$dateString])) {
                                foreach ($events[$dateString] as $event) {
                            ?>
                                    <a href="eventdetails.php?eventid=<?= $event['EventID'] ?>" style="height: -webkit-fill-available;">
                                        <div class="rows">
                                            <div class="row">
                                                <h1 class="eventh1"><?= $event['EventTitle'] ?></h1>
                                            </div>
                                            <div class="row2">
                                                <p class="location"><?= $event['Location'] ?></p>
                                            </div>
                                        </div>
                                    </a>
                                <?php
                                }
                            } else {
                                ?>
                                <div class="no-event" style="height: -webkit-fill-available;">
                                    <p>No Events</p>
                                    <div><a href="user_insert_events.php?date=<?= $dateString ?>"><input type="button" class="addevent" value="+"></a></div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <div class="pagination">
                    <?php
                    $previousMonth = (clone $currentDate)->modify('-1 month')->format('Y-m-d');
                    $nextMonth = (clone $currentDate)->modify('+1 month')->format('Y-m-d');
                    ?>
                    <a href="?date=<?= $previousMonth ?>">Previous Month</a>
                    <a href="?date=<?= $nextMonth ?>">Next Month</a>
                </div>
            </div>
        </section>
    </div>
    <?php include("footer.php"); ?>
</body>
<script>
    function loadevents() {
        var filterValue = document.getElementById("filterbar").value;
        var locationValue = document.getElementById("locationbar").value;
        var searchValue = document.getElementById("searchInput").value;

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                updateEventsList(this.responseText);
            }
        };
        xhttp.open("GET", "get_items.php?filter=" + filterValue + "&location=" + locationValue + "&search=" + searchValue, true);
        xhttp.send();
    }

    function searchEvents() {
        loadevents();
    }

    function updateEventsList(response) {
        var eventsList = document.getElementById("eventsList");
        eventsList.innerHTML = response;
    }

    function preview($eventid) {

    }
</script>
<script src="js/slide.js"></script>

</html>