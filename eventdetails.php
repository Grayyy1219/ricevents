<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Ric events</title>
    <?php include("connect.php"); ?>
    <?php include("query.php"); ?>
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/landing.css">
    <link rel="stylesheet" href="css/eventdetails.css">
    <link rel="icon" href="css/img/logo.ico">
</head>

<body>
    <?php include("header.php"); ?>
    <div class="body">
        <section id="myevent" style=" padding-top: 50px;">
            <?php
            $eventid = $_GET['eventid'];

            $getEventQuery = "SELECT * FROM events where EventID = $eventid";

            $result = mysqli_query($con, $getEventQuery);
            $row = mysqli_fetch_assoc($result);
            $dateFromDb = $row['Date'];
            $date = new DateTime($dateFromDb);
            $formattedDate = $date->format('F j, Y');

            ?>
            <div class="your-events">
                <div class="headertitle">
                    <img src="css/img/time.png" style="width: 30px;">
                    <p class="count"><?= $formattedDate ?></p>
                </div>
                <div class="iventdom">
                    <div class="perevent">
                        <div class="rows">
                            <div class="row">
                                <h1 class="eventh1"><?= $row['EventTitle'] ?></h1>
                            </div>
                            <div class="row2">
                                <img src="css/img/pin.png" style="width: 15px;">
                                <p class=" location"><?= $row['Location'] ?></p>
                            </div>
                            <div class="row3">
                                <p class="description"><?= $row['Description'] ?></p>
                            </div>
                            <div class="row4">
                                <div class="headertitle">
                                    <img src="css/img/time.png" style="width: 30px;">
                                    <p class="count">Iterested Users</p>
                                </div>
                                <div class="usersin">
                                    <?php
                                    $stmt = $con->prepare("SELECT users.UserID, users.Username FROM myevents INNER JOIN users ON myevents.customer_id = users.UserID WHERE myevents.EventID = ?");
                                    $stmt->bind_param('i', $eventid);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    $inthis = "0";
                                    while ($row = $result->fetch_assoc()) {
                                        if ($row['Username'] === $username) {
                                            echo "<span class='usericon' style='background-color: gray;'><p>You</p></span>";
                                            $inthis = "1";
                                        } else {
                                            echo "<span class='usericon'><p>" . htmlspecialchars($row['Username']) . "</p></span>";
                                        }
                                    }

                                    $stmt->close();
                                    ?>
                                </div>
                            </div>
                            <div class="row5">
                                <div class="btns">
                                    <?php if ($inthis == "1") { ?>
                                        <a <?php if ($username != 0) {
                                                echo "href='editinterest.php?edit=$inthis&eventid=$eventid&customerid=$UserID'";
                                            } else {
                                                echo "onclick='verify()'";
                                            } ?>>
                                            <div class="inbtns" style="color: white; background-color: red;">
                                                <p>Unregister</p>
                                            </div>
                                        </a>
                                    <?php } else { ?>
                                        <a <?php if ($username != 0) {
                                                echo "href='editinterest.php?edit=$inthis&eventid=$eventid&customerid=$UserID'";
                                            } else {
                                                echo "onclick='verify()'";
                                            } ?>>
                                        <div class="inbtns" style="color: white; background-color: green;">
                                            <p>Interested</p>
                                        </div>
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <?php include("footer.php"); ?>
</body>

</html>