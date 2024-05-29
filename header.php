<div class="promsale"><a name="home"></a>
    <p style="color: white;">Endless Events, Exclusive Access, and More! <span><b>Starting at just ₱299</b></span> Nationwide!</p>
</div>
<nav>
    <div class="header">
        <div class="logo">
            <a href="Landingpage.php#"><img src="css/img/logo.png" height="55px"><?= $companyname ?></a>
            <div class="headerlink">
                <a href="Landingpage.php#myevent">My Events</a>
                <a href="Landingpage.php#events">Discoveries</a>
                <a href="Landingpage.php#3">Browse</a>
            </div>
        </div>

        <div class="searchbar">
            <input type="text" class="searchinp searchbar" id="searchbar" placeholder=" Search">
            <button class="searchbtn"><img src="css/img/searchicon.png" width="25" style="filter: invert(1);"></button>
        </div>
        <?php
        if ($username == "0") { ?>
            <div class='login'>
                <div class='pointer' id='popup-signin'>
                    <p class='loginb'>Sign in</p>
                </div>
                <div>|</div>
                <div class='pointer' id='popup-create'>
                    <p class='signupb'>Create Account</p>
                </div>
            </div>
        <?php
        } else { ?>
            <div class='profile'>
                <img src='<?php echo $location; ?>' width='40' height='40' id='currentuser'>
                <div id='inout'>
                    <p class='name'><b><?= $FName ?></b></p>
                    <p class='email'><?= $email; ?></p>
                </div>
                <div class='carts'>
                    <a href='cart.php'>
                        <img src='css/img/form.png' width='25' id='currentuser'>
                    </a>
                    <a onclick='showSettingsPopup()'>
                        <img src='css/img/setting.png' width='25' id='profile'>
                    </a>
                </div>
            </div>
        <?php }
        ?>
    </div>
</nav>
<div id="LoginPopup" class="popup">
    <div class="popup-content">
        <span class="close" onclick="closePopup('LoginPopup')"><b>&times;</b></span>
        <div class="form-box">
            <form action="checkuser.php" class="form" method="post" enctype="multipart/form-data">
                <span class="title">Log In</span>
                <span class="subtitle">Welcome back! Please sign in to your account.</span>
                <div class="form-container">
                    <input type="text" class="input2" id="user" name="user" placeholder="Username" required>
                    <input type="password" class="input2" name="pass" placeholder="Password" required>
                </div>
                <input type="submit" class="submit" name="submit" value="Login">
            </form>
            <div class="form-section">
                <p>Don't have an account? <a href="#" class="ssignupb">Sign up</a></p>
            </div>
            <div class="form-section">
                <p><a href="forgetpage.php" class="aforgot">Forgot password?</a></p>
            </div>
        </div>
    </div>
</div>

<div id="SignupPopup" class="popup">
    <div class="popup-content">
        <span class="close" onclick="closePopup('SignupPopup')"><b>&times;</b></span>
        <div class="form-box">
            <form action="createuser.php" class="form" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                <span class="title">Sign Up</span>
                <span class="subtitle">Create a free account with your details.</span>
                <div class="form-container">
                    <div class="input-row">
                        <input type="text" class="input2" placeholder="First Name" name="txtfname" required>
                        <input type="text" class="input2" placeholder="Last Name" name="txtlname" required>
                    </div>
                    <input type="text" class="input2" placeholder="Username" name="txtusername" required>
                    <input type="password" class="input2" placeholder="Password" name="txtpassword" id="password" required>
                    <input type="password" class="input2" placeholder="Confirm Password" name="txtcpassword" id="confirmPassword" required>
                    <input type="email" class="input2" placeholder="Email" name="txtemail" required>
                </div>
                <input type="submit" class="submit" name="submit" value="Sign Up">
                <div class="form-section">
                    <p>Already have an account? <a href="#" class="sloginb">Log In</a></p>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="popup-overlay"></div>
<div id="spopup-overlay" style="display: none;"></div>
<div id="SettingsPopup" class="spopup">
    <div class="popup-content">
        <span class="close" onclick="closeSettingsPopup()"><b>&times;</b></span>
        <div class="sdiv">
            <?php
            echo "<div class='profileimg'><p><img  src='$location' width='200' height='200' style='object-fit: cover;'></p><br><br>";
            echo "<p class='name'><b>" . $FName . "</b></p>";
            echo "<p class='emaillink'>" . $email . "</p></div>";
            ?>
            <div class="ssbuttons">
                <div class="settingbtn">
                    <a href="edituser.php">
                        <div class="inbtn">
                            <p style="color: white;">Edit Basic Information</p>
                        </div>
                    </a>
                    <a href="editpass.php">
                        <div class="inbtn">
                            <p style="color: white;">Change Password</p>
                        </div>
                    </a>
                    <a href="history.php">
                        <div class="inbtn">
                            <p style="color: white;">Purchase History</p>
                        </div>
                    </a>
                </div>

                <a href="logout.php">
                    <div class="LogOut">
                        <p>Log Out</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
<script>
    function validateForm() {
        var password = document.getElementById("password").value;
        var confirmPassword = document.getElementById("confirmPassword").value;

        if (password !== confirmPassword) {
            alert("Passwords do not match. Please make sure both passwords are the same.");
            return false;
        }
        if (password.length < 8) {
            alert("Password must be at least 8 characters long.");
            return false;
        }
        return true;
    }

    function openPopup(popupId) {
        var openElements = document.querySelectorAll('.popup, .popup-overlay');
        openElements.forEach(function(element) {
            element.style.opacity = 0;
            setTimeout(function() {
                element.style.display = 'none';
            }, 150);
        });

        var overlay = document.querySelector('.popup-overlay');
        var popup = document.getElementById(popupId);
        setTimeout(function() {
            overlay.style.display = 'block';
            popup.style.display = 'block';
            setTimeout(function() {
                overlay.style.opacity = 1;
                popup.style.opacity = 1;
            }, 10);
        }, 150);
    }

    function closePopup(popupId) {
        var elementsToClose = document.querySelectorAll('.popup, .popup-overlay');
        elementsToClose.forEach(function(element) {
            element.style.opacity = 0;
            setTimeout(function() {
                element.style.display = 'none';
            }, 300);
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.loginb, .signupb, .sloginb, .ssignupb').forEach(function(btn) {
            btn.addEventListener('click', function() {
                var popupId = btn.classList.contains('loginb') || btn.classList.contains('sloginb') ? 'LoginPopup' : 'SignupPopup';
                openPopup(popupId);
            });
        });
    });

    function toverify() {
        alert("Please Log in into a Verified account first!");
    }

    function showSettingsPopup() {
        var popup = document.getElementById("SettingsPopup");
        var overlay = document.querySelector(".popup-overlay");
        popup.style.display = "block";
        overlay.style.display = "block";
        setTimeout(function() {
            popup.style.opacity = 1;
            overlay.style.opacity = 1;
        }, 10);
    }

    function closeSettingsPopup() {
        var popup = document.getElementById("SettingsPopup");
        var overlay = document.querySelector(".popup-overlay");
        popup.style.opacity = 0;
        overlay.style.opacity = 0;
        setTimeout(function() {
            popup.style.display = "none";
            overlay.style.display = "none";
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
</script>