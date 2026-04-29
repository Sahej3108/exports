<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name    = htmlspecialchars(strip_tags(trim($_POST["name"])));
    $email   = htmlspecialchars(strip_tags(trim($_POST["email"])));
    $comment = htmlspecialchars(strip_tags(trim($_POST["comment"])));

    if (empty($name) || empty($email) || empty($comment)) {
        die("All fields are required.");
    }

    $to      = "sales@takkarpolychem.com";
    $subject = "New Blog Comment from " . $name;
    $body    = "You received a new blog comment.\n\n" .
               "Name:    " . $name    . "\n" .
               "Email:   " . $email   . "\n\n" .
               "Comment:\n" . $comment;

    $headers  = "From: noreply@takkarpolychem.com\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    if (mail($to, $subject, $body, $headers)) {
        header("Location: " . $_SERVER['HTTP_REFERER'] . "?comment=success");
        exit;
    } else {
        die("Mail failed. Please contact your hosting provider to confirm mail() is enabled.");
    }

} else {
    header("Location: index.php");
    exit;
}
?>