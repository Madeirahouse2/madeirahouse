    <?php
    require_once 'captcha-server.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];
        $hCaptchaResponse = $_POST['h-captcha-response'];

        $hCaptchaVerification = hcaptcha_verify($hCaptchaResponse, 'ES_580deba12fd347a298009762f75a59da');

        if ($hCaptchaVerification['success']) {
            $to = 'laura@madeira.house';
            $subject = 'Contact form submission';
            $body = "Name: $name\nEmail: $email\nMessage: $message";
            $headers = 'From: laura@madeira.house' . "\r\n" .
                'Reply-To: ' . $email . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

            if (mail($to, $subject, $body, $headers)) {
                echo '
    <div style="text-align:center; padding:50px; font-family: \'Open Sans\', sans-serif;">
        <h1>Thank you!</h1>
        <p><a href="https://www.madeira.house">Your E-Mail has been sent successfully. <br><br>I will get back to you shortly!</a></p>
    </div>
';
            } else {
                echo json_encode(array('success' => false, 'message' => 'An error occurred while sending the email. Please try again.'));
            }
        } else {
            echo json_encode(array('success' => false, 'message' => 'The hCaptcha response is invalid. Please try again.'));
        }
    }
    ?>
    ```
