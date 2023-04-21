<?php

defined('BASEPATH') or exit('No direct script access allowed');

use League\OAuth2\Client\Provider\Google;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

use BarcodeBakery\Common\BCGFontFile;
use BarcodeBakery\Common\BCGColor;
use BarcodeBakery\Common\BCGDrawing;
use BarcodeBakery\Barcode\BCGcode39;

class Test extends MX_Controller
{



    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

        $this->output->set_header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
    }

    public function sendWa()
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://whatsva.id/api/sendMessageText');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, '{"instance_key": "9fmerDs7ZoFm", "jid": "081217088807", "message": "hello"}');

        $headers = array();
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }

        curl_close($ch);

        echo $result;
    }

    public function sendEmail()
    {
        $provider = new Google([
            'clientId'     => $_ENV['GOOGLE_CLIENTID'],
            'clientSecret' => $_ENV['GOOGLE_CLIENTSECRET'],
            'redirectUri'  => 'https://example.com/callback-url',
        ]);

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';  //gmail SMTP server
        $mail->SMTPAuth = true;
        //to view proper logging details for success and error messages
        // $mail->SMTPDebug = 1;
        $mail->Host = 'smtp.gmail.com';  //gmail SMTP server
        $mail->Username = $_ENV['GMAIL_USER'];   //email
        $mail->Password = $_ENV['GMAIL_APP_PASSWORD'];   //16 character obtained from app password created
        $mail->Port = 465;                    //SMTP port
        $mail->SMTPSecure = "ssl";

        //sender information
        $mail->setFrom('cs.kodeaplikasi@gmail.com', 'Admin');

        //receiver email address and name
        $mail->addAddress('triasfahrudin@gmail.com', 'triasfahrudin');

        // Add cc or bcc   
        // $mail->addCC('email@mail.com');  
        // $mail->addBCC('user@mail.com');  


        $mail->isHTML(true);

        $mail->Subject = 'PHPMailer SMTP test';
        $mail->Body    = "<h4> PHPMailer the awesome Package </h4>
            <b>PHPMailer is working fine for sending mail</b>
            <p> This is a tutorial to guide you on PHPMailer integration</p>";

        // Send mail   
        if (!$mail->send()) {
            echo 'Email not sent an error was encountered: ' . $mail->ErrorInfo;
        } else {
            echo 'Message has been sent.';
        }

        $mail->smtpClose();
    }

    public function testnidn()
    {
        $url = 'https://api-frontend.kemdikbud.go.id/hit/1016038802';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // tambahkan opsi ini

        $headers = array(
            'User-Agent: PostmanRuntime/7.31.3',
            'Accept: */*',
            'Postman-Token: ac8e840f-9e26-40de-8590-00182e726c9d',
            'Host: api-frontend.kemdikbud.go.id',
            'Accept-Encoding: gzip, deflate, br'
        );
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);

        curl_close($ch);

        // Tampilkan hasil
        var_dump($result);
    }


    function generate_barcode($scale = 2, $fontsize = 18, $thickness = 30)
    {
        $font = new BCGFontFile(APPPATH . 'libraries/font/Arial.ttf', $fontsize);
        $colorBlack = new BCGColor(0, 0, 0);
        $colorWhite = new BCGColor(255, 255, 255);

        // Barcode Part
        $code = new BCGcode39();
        $code->setScale($scale);
        $code->setThickness($thickness);
        $code->setForegroundColor($colorBlack);
        $code->setBackgroundColor($colorWhite);
        $code->setFont($font);
        $code->setChecksum(false);
        $code->parse("P 0001 ");

        // Drawing Part
        $drawing = new BCGDrawing($code, $colorWhite);

        //header('Content-Type: image/png');

        $imageData = $drawing->finish(BCGDrawing::IMG_FORMAT_PNG,FCPATH . 'uploads/test.png');

        //$filename = FCPATH . 'uploads/test.png';
        //file_put_contents($filename, $imageData);

        // var_dump($drawing);


    }
}
