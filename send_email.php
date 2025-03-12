<?php
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $fullName = $_POST['full_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';  // Gmail SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'sathish@gmail.com';
        $mail->Password = 'demo';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Sender's email and name
        $mail->setFrom('sathish.com', 'Yercaud Bison Taxi');  // Sender's email and name
        $mail->addReplyTo($email, $fullName);  // The email to reply to

        // Receiver's email
        $mail->addAddress('sathish@gmail.com', 'Recipient Name');  // The recipient's email address

        // Email subject and body
        $mail->isHTML(true);
        $mail->Subject = 'New Message from Yercaud Bison Taxi Contact Form';
        $mail->Body = "
            <html>
        <head>
            <title>New Message from Contact Form</title>
            <style>
                body {
                    font-family: 'Arial', sans-serif;
                    background-color: #f3f3f3;
                    margin: 0;
                    padding: 0;
                }
                .container {
                    width: 100%;
                    max-width: 650px;
                    background-color: #ffffff;
                    margin: 30px auto;
                    padding: 30px;
                    border-radius: 8px;
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                    border-top: 5px solid #3498db;
                }
                h1 {
                    font-size: 24px;
                    color: #333;
                    text-align: center;
                    margin-bottom: 20px;
                }
                p {
                    font-size: 16px;
                    color: #555;
                    line-height: 1.6;
                }
                .label {
                    font-weight: bold;
                    color: #3498db;
                }
                .content {
                    color: #555;
                    padding-left: 10px;
                }
                .footer {
                    margin-top: 30px;
                    text-align: center;
                    font-size: 14px;
                    color: #888;
                }
                .footer a {
                    color: #3498db;
                    text-decoration: none;
                }
                .footer a:hover {
                    text-decoration: underline;
                }
                .button {
                    background-color: #3498db;
                    color: white;
                    padding: 10px 20px;
                    border-radius: 4px;
                    text-align: center;
                    text-decoration: none;
                    display: inline-block;
                    font-weight: bold;
                    margin-top: 20px;
                }
                .button:hover {
                    background-color: #2980b9;
                }
            </style>
        </head>
        <body>
            <div class='container'>
                <h1>New Message from Contact Form</h1>
                <p><span class='label'>Name:</span> <span class='content'>$fullName</span></p>
                <p><span class='label'>Phone:</span> <span class='content'>$phone</span></p>
                <p><span class='label'>Email:</span> <span class='content'>$email</span></p>
                <p><span class='label'>Message:</span><br><span class='content'>$message</span></p>
                <a href='mailto:$email' class='button'>Reply to $fullName</a>
            </div>
            <div class='footer'>
                <p>If you have any questions, feel free to <a href='mailto:$email'>contact us</a>!</p>
            </div>
        </body>
    </html>
        ";

        $mail->send();

        // If email sent successfully
        echo "success"; // Send success response back to JavaScript
    } catch (Exception $e) {
        // If email failed to send
        echo "failure"; // Send failure response back to JavaScript
    }
}
?>
