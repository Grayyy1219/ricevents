<?php
$sql = "SELECT COUNT(*) as totalevents FROM events";
$row = mysqli_query($con, $sql);
$totalevents = mysqli_fetch_assoc($row)['totalevents'];

$sql = "SELECT COUNT(*) as totaluser FROM users";
$row = mysqli_query($con, $sql);
$totaluser = mysqli_fetch_assoc($row)['totaluser'];
?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Dashboard</h3>
            </div>
            <div class="table-responsive">
                <div class="alldash">
                    <div class="dashitem bg-primary">
                        <div class="img"></div>
                        <div class="infodash">
                            <div class="huge"> <?= $totalevents ?> </div>
                            <div>Events</div>
                        </div>
                        <div class="view">
                            <p>View more</p>
                        </div>
                    </div>
                    <div class="dashitem">
                        <div class="img"></div>
                        <div class="infodash">
                            <div class="huge"> <?= $totaluser ?> </div>
                            <div>Users</div>
                        </div>
                        <div class="view">
                            <p>View more</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="css/eventstable.css">
<section id="myevent" style="padding-top: 50px;">
    <?php
    if (isset($UserID)) {
        $getEventQuery = "SELECT myevents.MyEventID , myevents.customer_id , myevents.status, events.EventID ,events.EventTitle, events.Description, events.Date, events.Location
                      FROM myevents
                      INNER JOIN events ON myevents.eventid  = events.EventID 
                       ORDER BY events.EventID ASC";
        $result = mysqli_query($con, $getEventQuery);
    ?>
        <div class="your-events">
            <div class="headertitle">
                <img src="css/img/time.png" style="width: 30px;">
                <p class="count"><?= $eventcount ?></p>
                <p class="HeaderName">Pending Request</p>
            </div>
            <div class="iventdom">
                <?php while ($row = mysqli_fetch_assoc($result)) {
                    $dateFromDb = $row['Date'];
                    $date = new DateTime($dateFromDb);
                    $formattedDate = $date->format('F j, Y');
                    $status = $row['status'];
                ?>
                    <div class="perevent">
                        <div class="eventdate">
                            <img src="css/img/time.png" style="width: 25px;">
                            <p><?= $formattedDate ?></p>
                            <?php
                            if ($row['status'] == 0) { ?>
                                <a href="updat_status.php?status=1&eventid=<?= $row['MyEventID']; ?>" class="Approve">Approve</a>
                            <?php } else { ?>
                                <a href="updat_status.php?status=0&eventid=<?= $row['MyEventID']; ?>" class="Approve" style=" background-color: gray; ">Approved</a>
                            <?php }
                            ?>
                            <a href="updat_status.php?status=2&eventid=<?= $row['MyEventID']; ?>" class="Cancel">Cancel</a>
                        </div>
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
                                <p class="count">Request by:
                                    <?php
                                    $requestid = $row['customer_id'];
                                    $sql2 = "SELECT * FROM users WHERE UserID = $requestid";
                                    $row2 = mysqli_query($con, $sql2);
                                    $requestusernames = mysqli_fetch_assoc($row2)['Username'];


                                    echo " <span class='usericon'>$requestusernames</span>";

                                    ?>
                                </p>
                            </div>
                        </div>
                    </div>
            <?php }
            } ?>
            </div>
        </div>
</section>
<style>
    .alldash {
        display: flex;
        flex-wrap: wrap;
    }

    .dashitem {
        margin: 10px;
        padding: 10px;
        border: 1px solid #ddd;
        position: relative;
        overflow: hidden;
    }

    .dashitem .img {
        background-color: var(--primary);
        width: 344px;
        height: 91px;
    }

    .huge {
        font-size: 40px;
        line-height: normal;
    }

    .infodash {
        position: absolute;
        top: 7px;
        right: 6px;
        padding: 10px;
        color: white;
        text-align: right;
    }

    .view {
        text-align: right;
        padding: 5px;
    }

    .view p {
        color: #337ab7;
    }
</style>