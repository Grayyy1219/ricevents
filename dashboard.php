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