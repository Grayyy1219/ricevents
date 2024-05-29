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

<body>
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
                <div class="filter">
                    Filter:
                    <select id="filterbar" onchange="loadXMLDoc('filter')" value="">
                        <option value="None">All</option>
                        <option value="Men's Road Running Shoes">Men's Road Running Shoes</option>
                        <option value="Basketball Shoes">Basketball Shoes</option>
                    </select>
                </div>
                <div class="sort">
                    Sort Price:
                    <select id="sortbar" onchange="loadXMLDoc('sort')" value="">
                        <option value="None">None</option>
                        <option value="ascending">Low to High</option>
                        <option value="descending">High to Low</option>
                    </select>
                </div>
            </div>
            <div class="output">
                <div id="demo">
                </div>
            </div>
        </section>
    </div>
    <?php include("footer.php"); ?>
</body>
<script src="js/slide.js"></script>

</html>