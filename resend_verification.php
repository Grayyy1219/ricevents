<?php
function sendVerificationEmail($email)
{
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) {
    $userEmail = $_POST['email'];
    sendVerificationEmail($userEmail);
    echo "success";
} else {
    echo "error";
}
