<?php
    echo $_POST["schedule"];
?>
    <br/>
<?php
        try {

            $pdo = new PDO('mysql:host=localhost;dbname=test;charset=utf8','root','1235',
        array(PDO::ATTR_EMULATE_PREPARES => false));

            } catch (PDOException $e) {
                             exit('データベース接続失敗。'.$e->getMessage());
        }       

    $sche = $_POST["schedule"];
    $sche_time = $_POST["sche_time"];
    
?>
         <br/>
    <?php
    echo "<a href='app1.php'>戻る</a>";



require __DIR__.'/vendor/autoload.php';
use Twilio\Rest\Client;

// Your Account SID and Auth Token from twilio.com/console
$account_sid = '';
$auth_token = '	';
// In production, these should be environment variables. E.g.:
// $auth_token = $_ENV["TWILIO_ACCOUNT_SID"]

// A Twilio number you own with Voice capabilities
$twilio_number = "";
// Where to make a voice call (your cell phone?)
$to_number = "";
$twiml = urlencode("<Response>
                        <Say voice='woman' language='ja-JP'>
                            $sche_time"."の予定は".$sche."です。"."
                        </Say>
                    </Response>");
$client = new Client($account_sid, $auth_token);
$client->account->calls->create(  
    $to_number,
    $twilio_number,
    array(
        "url"=>"http://twimlets.com/echo?Twiml=$twiml"
    ) 
);
    header('Location: app1.php');
?>