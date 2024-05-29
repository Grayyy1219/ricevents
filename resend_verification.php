<?php
// Assuming you have a function to send verification emails
function sendVerificationEmail($email) {
    // Implement your email sending logic here
    // For example:
    // mail($email, "Verification Email", "Your verification link: https://example.com/verify.php?email=$email&code=$verificationCode");
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) {
    $userEmail = $_POST['email'];
    // Call your function to send the verification email
    sendVerificationEmail($userEmail);
    // Return a success message
    echo "success";
} else {
    // Handle invalid request
    echo "error";
}
?>
