<?php
define('API', 'https://notify-api.line.me/api/notify');
define('TOKEN', 'C3fPBRAhyd0Z7wCKkJloBTUy7q7bBogo8QB6OAfrvW2'); // เปลี่ยนเป็น Token ของเรา
$message = array(
    'message' => 'ทดสอบส่ง LINE Notify', // ข้อความที่จะส่ง
    'stickerPackageId' => 1, // ส่งสติกเกอร์ไปด้วย
    'stickerId' => 2, // ส่งสติกเกอร์ไปด้วย
    'imageThumbnail' => 'https://www.itcomputec.com/notify/thumbnail.jpg', // ลิงค์รูปภาพ ขนาดไม่เกิน 240x240
    'imageFullsize' => 'https://www.itcomputec.com/notify/fullsize.jpg', // ลิงค์รูปภาพ ขนาดไม่เกิน 1024x1024
);
line_notify(TOKEN, $message); // เรียกใช้ฟังก์ชั่น
function line_notify($token, $message){
    $header = array('Content-type: application/x-www-form-urlencoded',
                    "Authorization: Bearer {$token}",);
    $data = http_build_query($message, '', '&');
    $cURL = curl_init();
    curl_setopt( $cURL, CURLOPT_URL, API); 
    curl_setopt( $cURL, CURLOPT_SSL_VERIFYHOST, 0); 
    curl_setopt( $cURL, CURLOPT_SSL_VERIFYPEER, 0); 
    curl_setopt( $cURL, CURLOPT_POST, 1); 
    curl_setopt( $cURL, CURLOPT_POSTFIELDS, $data); 
    curl_setopt( $cURL, CURLOPT_FOLLOWLOCATION, 1); 
    curl_setopt( $cURL, CURLOPT_HTTPHEADER, $header); 
    curl_setopt( $cURL, CURLOPT_RETURNTRANSFER, 1); 
    
    $result = curl_exec( $cURL ); 
	if(curl_error($cURL)) { 
           echo 'error:' . curl_error($cURL); 
	} else { 
	$result_ = json_decode($result, true); 
	   echo "status : ".$result_['status']; echo " message : ". $result_['message'];
    } 
	curl_close( $cURL );   
}
?>
