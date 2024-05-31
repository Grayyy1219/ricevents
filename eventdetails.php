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
                                    <p class="count">Iterested people/s</p>
                                </div>
                                <div class="usersin">
                                    <?php
                                    $stmt = $con->prepare("SELECT users.UserID, users.Username, myevents.status FROM myevents INNER JOIN users ON myevents.customer_id = users.UserID WHERE myevents.EventID = ?");
                                    $stmt->bind_param('i', $eventid);
                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    $inthis = "0";
                                    while ($row = $result->fetch_assoc()) {
                                        if ($row['Username'] === $username) {
                                            echo "<span class='usericon' style='background-color: gray;'><p>You</p></span>";
                                            $inthis = "1";
                                            $status = $row['status'];
                                        } else {
                                            echo "<span class='usericon'><p>" . htmlspecialchars($row['Username']) . "</p></span>";
                                        }
                                    }

                                    $stmt->close();
                                    ?>
                                </div>
                            </div>
                            <style>
                                .inbtns {
                                    color: white;
                                    padding: 10px;
                                    text-align: center;
                                    border-radius: 5px;
                                    margin: 5px 0;
                                    cursor: pointer;
                                    text-decoration: none;
                                }

                                .inbtns.done {
                                    background-color: gray;
                                }

                                .inbtns.unregister {
                                    background-color: red;
                                }

                                .inbtns.approved {
                                    background-color: gray;
                                }

                                .inbtns.interested {
                                    background-color: green;
                                }
                            </style>

                            <div class="row5">
                                <div class="btns">
                                    <?php
                                    $currentDate = new DateTime();
                                    $isPassed = $date < $currentDate;
                                    $message = $isPassed ? "This event on $formattedDate has already passed." : "This event on $formattedDate is upcoming.";
                                    echo $message;

                                    if ($inthis == "1") {
                                        if ($isPassed) {
                                            echo '<a><div class="inbtns done"><p>Done</p></div></a>';
                                        } else {
                                            $href = $username != 0 ? "href='editinterest.php?edit=$inthis&eventid=$eventid&customerid=$UserID'" : "onclick='verify()'";
                                            if ($status == 0) {
                                                $statusText = "<p>Pending</p>";
                                                $class = "unregister";
                                            } else {
                                                $statusText = "<p>Cancel</p>";
                                                $class = "approved";
                                            }
                                            echo "<a $href><div class='inbtns $class'>$statusText</div></a>";
                                        }
                                    } else {
                                        $href = $username != 0 ? "href='editinterest.php?edit=$inthis&eventid=$eventid&customerid=$UserID'" : "onclick='verify()'";
                                        echo "<a $href><div class='inbtns interested'><p>Interested</p></div></a>";
                                    }
                                    ?>
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