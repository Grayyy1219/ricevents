<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Account settings</title>
    <?php
    include("connect.php"); ?>
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/userinfo.css">
    <link rel="icon" href="css/img/logo.ico">
</head>


<body>
    <?php
    $userid = $_GET['UserID'];
    $query = "SELECT UserID, FName, Username, Email, Profile FROM users where UserID = $userid";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $userId = $row['UserID'];
    $FName = $row['FName'];
    $email = $row['Email'];
    $location = $row['Profile'];

    ?>
    <section>
        <div class="wrapper" id="w1">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="wedit">
                    <input type="hidden" name="UserID" value="<?= $userId ?>">
                    <div class="weditimg">
                        <?php
                        echo "<img id='profileImage' src='$location' alt='Profile Picture'>";
                        ?>
                        <label class="btn-upload-img">
                            Upload Profile Picture <input type="file" id="img" name="img" accept="image/*" style="display: none;">
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
                        <div class="weitem">
                            <div class="border">
                                <p>Role:</p>
                                <select name="role">
                                    <option value="0">User</option>
                                    <option value="1">Admin</option>
                                </select>
                            </div>
                        </div>
                        <div class="weitem" style="display: none;">
                            <div class="border">
                                <p>Username:</p>
                                <input type="text" name="username" value="">
                            </div>
                        </div>
                        <label class="btn-save">
                            <div class="btnsave">
                                Save Changes <input formaction="aupdateuser2.php" type="submit" name="submit" style="display: none;">
                            </div>
                        </label>
                    </div>
                </div>

        </div>
        </form>
        </div>
    </section>
    <script>
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