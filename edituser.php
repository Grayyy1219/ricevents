<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Account settings</title>
    <?php
    include("connect.php");
    include("query.php"); ?>
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/userinfo.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="icon" href="css/img/logo.ico">
    <?php
    echo "<style>
        body {
            background-color: $backgroundcolor;
        }
        .fade-overlay {
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0), $backgroundcolor);
    </style>";
    ?>
</head>


<body>
    <?php
    include("header.php");
    ?>
    <section>
        <div class="wrapper" id="w1">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="wedit">
                    <div class="weditimg">
                        <?php
                        echo "<img id='profileImage' src='$location' alt='Profile Picture'>";
                        ?>
                        <label class="btn-upload-img">
                            Upload Profile Picture <input type="file" id="img" name="img" accept="image/*">
                        </label>
                    </div>
                    <div class="weform">
                        <div class="inweform">
                            <div class="weitem">
                                <div class="border">
                                    <p>Full Name:</p>
                                </div>
                                <?php
                                echo "<input type='text' name='first_name' value='$FName'>";
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="inweform">
                        <div class="weitem">
                            <div class="border">
                                <p>Email:</p>
                            </div>
                            <?php
                            echo "<input type='text' name='email' id='emailInput' value='$email' style='text-transform: none;' pattern='.*\.com' title='Please enter a valid email address'>";
                            ?>

                        </div>
                        <div class="weitem" style="display: none;">
                            <div class="border">
                                <p>Username:</p>
                                <input type="text" name="username" value="">
                            </div>
                        </div>
                        <label class="btn-save">
                            <div class="btnsave">
                                Save Changes <input formaction="updateuser.php" type="submit" name="submit" style="display: none;">
                            </div>
                        </label>
                    </div>
                </div>

        </div>
        </form>
        </div>
    </section>
    <?php include("footer.php"); ?>
    <script>
        function closeSettingsPopup() {
            document.getElementById('SettingsPopup').style.display = 'none';
            var overlay = document.querySelector('.popup-overlay');
            overlay.style.opacity = 0;
            setTimeout(function() {
                overlay.style.display = 'none';
            }, 300);
        }

        function showSettingsPopup() {
            document.getElementById("SettingsPopup").style.display = "block";
            setTimeout(function() {
                document.getElementById("spopup-overlay").style.display = "block";
            }, 10);
        }

        function closeSettingsPopup() {
            document.getElementById("spopup-overlay").style.display = "none";
            document.getElementById("SettingsPopup").style.display = "none";
        }
        document.getElementById('img').addEventListener('change', function(event) {
            const fileInput = event.target;
            const profileImage = document.getElementById('profileImage');

            const file = fileInput.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    profileImage.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>

</html>