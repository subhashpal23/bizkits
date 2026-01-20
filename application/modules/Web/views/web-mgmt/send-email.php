<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $telephone = htmlspecialchars($_POST['telephone']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // Validate required fields
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        echo json_encode(['success' => false, 'message' => 'All fields are required.']);
        exit;
    }

    // Email settings
    $to = 'maurya11187@gmail.com'; // Replace with your email address
    $emailSubject = "Contact Form Submission: $subject";
    $emailBody = "Name: $name\nEmail: $email\nPhone: $telephone\n\nMessage:\n$message";
    $headers = "From: $email\r\nReply-To: $email";

    // Send the email
    if (mail($to, $emailSubject, $emailBody, $headers)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to send email.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>
