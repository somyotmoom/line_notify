<?php
define('CLIENT_ID', '1I1N7bkspfIjo2PLoyrytK'); // เปลี่ยนเป็น Client ID ของเรา
define('LINE_API_URI', 'https://notify-bot.line.me/oauth/authorize?');
define('CALLBACK_URI', 'http://localhost/callback.php'); // เปลี่ยนให้ตรงกับ Callback URL ของเรา
$queryStrings = [
    'response_type' => 'code',
    'client_id' => CLIENT_ID,
    'redirect_uri' => CALLBACK_URI,
    'scope' => 'notify',
    'state' => 'abcdef123456'
];
$queryString = LINE_API_URI . http_build_query($queryStrings);
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  </head>
  <body>
    <div class="container"><br/>
    <div class="jumbotron">
    <h1 class="display-5">รับการแจ้งเตือนทาง LINE Notify</h1>
    <p class="lead">หลังเสร็จสิ้นการเชื่อมต่อกับเว็บเซอร์วิสแล้ว คุณจะได้รับการแจ้งเตือนจากบัญชีทางการ "LINE Notify"</p>
    <hr class="my-4">
    <p>ลงทะเบียนรับข้อความการแจ้งเตือนทาง LINE Notify</p>
    <a class="btn btn-primary btn-lg" href="<?php echo $queryString; ?>" role="button">ลงทะเบียน</a>
    </div>
    </div>
  </body>
</html>