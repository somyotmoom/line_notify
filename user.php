<!doctype html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  </head>
  <body>
    <div class="container"><br/>
    <form action="send.php" method="post">
    <h1>ส่งข้อความแจ้งเตือนหาผู้ใช้งานที่ลงทะเบียน</h1>
    <table class="table">
    <thead class="thead-dark">
        <tr>
        <th scope="col">Token ผู้ใช้งานที่ลงทะเบียน</th>
        <th scope="col"></th>
        </tr>
    </thead>

<?php
//เชื่อมต่อฐานข้อมูล
$conn = mysqli_connect('127.0.0.1', 'root', '', 'notify');
mysqli_set_charset($conn,"utf8");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} 
$sql = "SELECT * FROM user";
$result = mysqli_query($conn,$sql);

while($row = mysqli_fetch_assoc($result)){
    $token = $row["token"];
    echo '<tbody>
    <tr>
    <td>'.$token.'</td>
    <td align="right">
    <button type="submit" name="token" class="btn btn-primary" value='.$token.'>ส่งข้อความ</button>
    </td>
    </tr>
    </tbody>';
}
echo "</table>";
?>
</form>
</div>
</body>
</html>