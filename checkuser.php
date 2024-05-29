<link rel="stylesheet" href="css/global.css">
<link rel="stylesheet" href="css/mail.css">
<?php
include("connect.php");

if (isset($_POST['submit'])) {
    $enteredUsername = $_POST['user'];
    $enteredPassword = $_POST['pass'];

    // Prepared statement to protect against SQL injection
    if ($stmt = mysqli_prepare($con, "SELECT * FROM users WHERE username = ?")) {
        mysqli_stmt_bind_param($stmt, "s", $enteredUsername);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && $row = mysqli_fetch_assoc($result)) {
            $hashedPassword = $row['Password'];

            if (password_verify($enteredPassword, $hashedPassword)) {
                // Update user information
                $updateStmt = mysqli_prepare($con, "UPDATE currentuser SET FName = ?, username = ?, Email = ?, address = ?, phone = ?, profile = ? WHERE UserId = 1");
                mysqli_stmt_bind_param($updateStmt, "ssssss", $row['FName'], $row['Username'], $row['Email'], $row['address'], $row['phone'], $row['profile']);
                mysqli_stmt_execute($updateStmt);
                if (mysqli_stmt_affected_rows($updateStmt) > 0) {
                    if ($row['verified'] == 0) { ?>
                        <div id="verificationModal" class="modal">
                            <div class="modal-content">
                                <form action="" class="modal-content" method="post" enctype="multipart/form-data">
                                    <button class="close" formaction="logout.php">&times;</button>
                                    <h2>Email Verification Required</h2>
                                    <p>Your account is not verified yet. Please check your email for the verification link.</p>
                                    <p>If you did not receive the email, click the button below to resend the verification email.</p>
                                    <p>Enter the verification code:</p>
                                    <input type="hidden" name="email" value="<?= $row['Email'] ?>">
                                    <input type="text" name="code" id="verificationCodeInput" placeholder="Enter code">
                                    <button id="submitVerificationCode" formaction="process.php">Submit</button>
                                    <button id="resendVerification" formaction="mail.php">Resend Verification Email</button>
                                </form>
                            </div>
                        </div>
<?php } else {
                        // Redirect based on user type
                        if ($row['admin'] == 1) {
                            echo '<script>alert("Successfully logged in as admin");</script>';
                            echo '<script>window.location.href = "admin2.php?dashboard";</script>';
                        } else {
                            echo '<script>alert("Successfully logged in");</script>';
                            echo '<script>window.location.href = "Landingpage.php";</script>';
                        }
                        exit();
                    }
                } else {
                    echo '<script>alert("Error updating user information, please try again later");</script>';
                    echo '<script>window.location.href = "logout.php";</script>';
                }
            } else {
                echo '<script>alert("Incorrect Password");</script>';
                echo '<script>window.history.back();</script>';
            }
        } else {
            echo '<script>alert("User not found or invalid credentials");</script>';
            echo '<script>window.history.back();</script>';
        }
        exit();
    } else {
        echo '<script>alert("Database error: Unable to prepare statement.");</script>';
    }
}
?>