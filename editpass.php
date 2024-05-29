<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Change Password</title>
    <?php
    include("connect.php");
    include("query.php"); ?>
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/editpass.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="icon" href="css/img/logo.ico">



</head>

<body>
    <?php
    include("header.php");
    ?>
    <section class="body"></a>
        <div class="center">
            <div class="wrapper" id="w1">
                <form action="changepass.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                    <div class="wedit">
                        <div class="weform">
                            <div class="inweform">
                                <div>
                                    <p>Current Password:</p>
                                    <div class="weitem">
                                        <input type='password' name='currentpass' value='' required>
                                    </div>
                                </div>
                                <div>
                                    <p>New Password:</p>
                                    <div class="weitem">
                                        <input type='password' id='newpass' name='newpass' class="password-input" value='' required>
                                    </div>
                                </div>
                                <div>
                                    <p>Confirm Password:</p>
                                    <div class="weitem">
                                        <input type='password' id='confirmpass' name='confirmpass' class="password-input" value='' required>
                                    </div>
                                </div>
                                <label class="btn-save">
                                    <div class="btnsave">
                                        Save Changes <input type="submit" name="submit">
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <?php include("footer.php"); ?>
    <script>
        function validateForm() {
            var newPassword = document.getElementById('newpass').value;
            var confirmPassword = document.getElementById('confirmpass').value;
            var passwordInputs = document.querySelectorAll('.password-input');

            if (newPassword !== confirmPassword) {
                alert("New Password and Confirm Password must match!");
                passwordInputs.forEach(function(element) {
                    element.classList.add('password-mismatch');
                });
                return false;
            } else {
                passwordInputs.forEach(function(element) {
                    element.classList.remove('password-mismatch');
                });
            }

            return true;
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