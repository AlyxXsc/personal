<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = strip_tags(trim($_POST["message"]));

    // Set the recipient email address. Replace with your actual email.
    $to = "your_email@example.com";

    // Set the email subject.
    $subject = "New Contact Form Submission from " . $name;

    // Build the email message.
    $email_content = "Name: " . $name . "\n";
    $email_content .= "Email: " . $email . "\n\n";
    $email_content .= "Message:\n" . $message . "\n";

    // Build the email headers.
    $email_headers = "From: " . $name . " <" . $email . ">\r\n";
    $email_headers .= "Reply-To: " . $email . "\r\n";

    // Send the email.
    if (mail($to, $subject, $email_content, $email_headers)) {
        // Redirect to the contact form with a success status.
        header("Location: contact.html?status=success");
    } else {
        // Redirect to the contact form with an error status.
        header("Location: contact.html?status=error");
    }

} else {
    // If someone tries to access send_email.php directly, redirect them to the contact form.
    header("Location: contact.html");
    exit;
}
?>
