<?php
define('CLIENT_ID', '1I1N7bkspfIjo2PLoyrytK'); // เปลี่ยนเป็น Client ID ของเรา
define('CLIENT_SECRET', 'skS8ZGYW4nw8OsTX4WySYsdCOE6r0ojVc6eWu0y3d4v'); // เปลี่ยนเป็น Client Secret ของเรา
define('LINE_API_URI', 'https://notify-bot.line.me/oauth/token');
define('CALLBACK_URI', 'http://localhost/callback.php');
parse_str($_SERVER['QUERY_STRING'], $queries);
$fields = [
    'grant_type' => 'authorization_code',
    'code' => $queries['code'],
    'redirect_uri' => CALLBACK_URI,
    'client_id' => CLIENT_ID,
    'client_secret' => CLIENT_SECRET
];
try {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, LINE_API_URI);
    curl_setopt($ch, CURLOPT_POST, count($fields));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $res = curl_exec($ch);
    curl_close($ch);
    $json = json_decode($res, true);
    $access_token = $json['access_token'];

    //เชื่อมต่อฐานข้อมูล
    $conn = mysqli_connect('127.0.0.1', 'root', '', 'notify');
    mysqli_set_charset($conn,"utf8");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    } 
    $sql = "INSERT INTO user (token) VALUES ('$access_token')"; //บันทึก Token ลงฐานข้อมูล
    $query = mysqli_query($conn, $sql);

    if( $query === false ) {
        die( print_r( sqlsrv_errors(), true));
    }
    
    mysqli_close($conn);

} catch(Exception $e) {
    var_dump($e);
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  </head>
  <body>
    <div class="container"><br/>
    <div class="alert alert-success" role="alert">
    <h4 class="alert-heading">ลงทะเบียนสำเร็จ!</h4>
    <p>คุณจะได้รับข้อความการแจ้งเตือนการอนุมัติใบตัดยอดทาง LINE จากเรา</p><hr>
    <a class="btn btn-secondary" href="#" role="button">กลับหน้าแรก</a>
    </div>
    </div>
  </body>
</html>