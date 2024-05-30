<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Admin Panel</title>
    <?php include("connect.php");
    include("query.php"); ?>
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/admin2.css">
    <link rel="stylesheet" href="css/table.css">
    <link rel="icon" href="Image/logo.ico">

</head>

<body>

    <header>
        <div class="sidepanel">
            <a href="admin2.php?dashboard"><img src="css/img/dashboard.png">Dashboard</a>

            <a href="#" class="toggle" data-target="#events"><img src="css/img/dataset.png">Event<img src="css/img/down.png" class="down-arrow-icon"></a>
            <div id="events" class="collapse nested-menu">
                <a href="admin2.php?insert_events">Insert Event</a>
                <a href="admin2.php?view_events">View Event</a>
            </div>

            <a href="#" class="toggle" data-target="#customers"><img src="css/img/edit.png">View User<img src="css/img/down.png" class="down-arrow-icon"></a>
            <div id="customers" class="collapse nested-menu">
                <a href="admin2.php?view_user">User List</a>
            </div>

            <a href="#" class="toggle" data-target="#Info"><img src="css/img/cash.png">Admin Info<img src="css/img/down.png" class="down-arrow-icon"></a>
            <div id="Info" class="collapse nested-menu">
                <a href="admin2.php?aedituser">Change Basic info</a>
                <a href="admin2.php?aeditpass">Change password</a>
            </div>
            <a href="logout.php">Log Out</a>
        </div>
    </header>
    <div class="dom">
        <?php
        if (isset($_GET['dashboard'])) {
            include("dashboard.php");
        }

        if (isset($_GET['view_events'])) {
            include("view_events.php");
        }
        if (isset($_GET['delete_event'])) {
            include("delete_event.php");
        }
        if (isset($_GET['edit_event'])) {
            include("edit_event.php");
        }
        if (isset($_GET['insert_events'])) {
            include("insert_events.php");
        }

        if (isset($_GET['view_user'])) {
            include("users.php");
        }
        if (isset($_GET['signup'])) {
            include("signup.php");
        }
        if (isset($_GET['edit_customer'])) {
            include("edit_customer.php");
        }

        if (isset($_GET['aedituser'])) {
            include("aedituser.php");
        }
        if (isset($_GET['aeditpass'])) {
            include("aeditpass.php");
        }
        ?>

    </div>
    <script>
        document.querySelectorAll('.toggle').forEach(function(toggle) {
            toggle.addEventListener('click', function(event) {
                event.preventDefault();
                var target = document.querySelector(this.getAttribute('data-target'));
                if (target.classList.contains('show')) {
                    target.classList.remove('show');
                } else {
                    target.classList.add('show');
                }
            });
        });
    </script>

</body>

</html>