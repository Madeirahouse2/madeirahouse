    <?php
    function hcaptcha_verify($response, $secret) {
        $url = "https://hcaptcha.com/siteverify";
        $data = array(
            'secret' => $secret,
            'response' => $response
        );

        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data),
            ),
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);

        if ($result === FALSE) {
            return array('success' => false, 'error-codes' => array('failed to connect to hCaptcha API'));
        }

        return json_decode($result, true);
    }
    ?>
