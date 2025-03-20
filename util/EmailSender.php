<?php

require '../vendor/autoload.php';
require_once 'Misc.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

/**
 * The EmailSender class is responsible for sending emails using the PHPMailer library.
 * It is configured to use SMTP with Gmail for sending HTML formatted emails. The class
 * provides methods to request account verification and password reset by sending
 * appropriate emails to users. It handles exceptions during the email sending process
 * and displays a custom error page in case of failures.
 *
 * Key functionalities include:
 * - Configuring SMTP settings for email delivery.
 * - Sending verification emails for user account activation.
 * - Sending password reset emails to users.
 * - Error handling for email sending failures.
 */
class EmailSender
{
    private $mail;
    private $misc;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);
        $this->mail->isHTML(true);
        $this->mail->isSMTP();
        $this->mail->SMTPAuth = true;
        $this->mail->Host = 'smtp.gmail.com';
        $this->mail->Username = 'frenchcries12@gmail.com';
        $this->mail->Password = 'ehlxzxdcksskipfe';
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $this->mail->Port = 465;
        $this->mail->setFrom($this->mail->Username, "Rural Connect Team");
        $this->misc = new Misc;
    }

    /**
     * Sends an email using the configured mailer instance.
     *
     * This function takes an email address, subject, and body content as parameters,
     * and attempts to send an email. If the email is sent successfully, the function
     * completes without returning any value. In case of an error during the sending
     * process, it catches the exception, sets the HTTP response code to 500, and
     * includes a custom error page to inform the user of the failure.
     *
     * @param mixed $email The recipient's email address.
     * @param mixed $subject The subject of the email.
     * @param mixed $body The body content of the email.
     * @return void
     */
    private function sendEmail($email, $subject, $body)
    {
        try {
            $this->mail->addAddress($email);
            $this->mail->Subject = $subject;
            $this->mail->Body = $body;
            $this->mail->send();
        } catch (Exception $e) {
            // Handle exception - Display custom error page for 500 Internal Server Error
            http_response_code(500);
            include "../shared/500.page.php";
            exit; // Stop further execution after displaying error page
        }
    }

    /**
     * Requests account verification by sending a verification email.
     *
     * This function generates a verification email for a user account. It takes the
     * user's email address, account ID, username, and a verification token as parameters.
     * The function constructs a verification link using the provided account ID and token,
     * and then includes a template to create the email body. Finally, it calls the
     * `sendEmail` method to send the verification email to the specified address.
     *
     * @param string $email The email address to send the verification to.
     * @param string $accountId The unique identifier for the user account.
     * @param string $username The username of the account holder.
     * @param string $token The verification token for the account.
     * @return void
     */
    public function requestAccountVerification($email, $accountId, $username, $token)
    {
        $subject = "Rural Connect | Account Verification";
        $link = $this->misc->url("logic/account-verification.php?accountId=$accountId&token=$token");
        ob_start();
        include "../misc/mail/request.account.verification.php";
        $body = ob_get_clean();
        $this->sendEmail($email, $subject, $body);
    }

    /**
     * Requests a password reset by sending a reset email.
     *
     * This function generates a password reset email for a user account. It takes the
     * user's email address, account ID, username, and a reset token as parameters.
     * The function constructs a reset link using the provided account ID and token,
     * and then includes a template to create the email body. Finally, it calls the
     * `sendEmail` method to send the password reset email to the specified address.
     *
     * @param string $email The email address to send the password reset link to.
     * @param string $accountId The unique identifier for the user account.
     * @param string $username The username of the account holder.
     * @param string $token The reset token for the password.
     * @return void
     */
    public function requestPasswordReset($email, $accountId, $username, $token)
    {
        $subject = "Rural Connect | Password Reset";
        $link = $this->misc->url("page/reset-password.php?accountId=$accountId&token=$token");
        ob_start();
        include "../misc/mail/request.reset.password.php";
        $body = ob_get_clean();
        $this->sendEmail($email, $subject, $body);
    }

}