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

    <link rel="icon" href="css/img/logo.ico">
    <style>
        /* Basic reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        /* Container */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        /* Header styles */
        header {
            background: #333;
            padding: 10px 0;
            color: #fff;
        }

        .logo img {
            max-height: 50px;
        }

        nav ul {
            list-style: none;
            display: flex;
        }

        nav ul li {
            margin-left: 20px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            padding: 5px 10px;
            transition: background 0.3s;
        }

        nav ul li a:hover {
            background: #555;
            border-radius: 5px;
        }
    </style>
</head>

<body onload="loadevents()">
    <?php include("header.php"); ?>
    <div class="body">
        <section>
            <div class="" id="w1">
                <!-- <?php
                        echo " <div id='bg' class='image-container'>
                    <img src='$backgroundimg'>
                    <div class='fade-overlay'></div>
                </div>";
                        ?> -->
                <div class=" slideshow-container">
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
        <section>
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
                <div class="sort">
                    Sort by Location:
                    <select id="locationbar" onchange="loadevents()">
                        <option value="none">All</option>
                        <?php
                        $sql = "SELECT DISTINCT Location FROM events";
                        $result = $con->query($sql);

                        $options = "";

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $options .= "<option value='" . $row["Location"] . "'>" . $row["Location"] . "</option>";
                            }
                        } else {
                            $options .= "<option value=''>No locations found</option>";
                        }
                        echo $options;
                        $con->close();
                        ?>
                    </select>
                </div>

            </div>
            <div class="output" id="eventsList">
            </div>
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
            </script>
        </section>
    </div>
    <?php include("footer.php"); ?>
</body>
<script src="js/slide.js"></script>

</html>