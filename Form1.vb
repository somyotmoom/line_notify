Imports System.Net
Imports System.IO
Imports System.Text

Public Class Form1

    Private Sub Form1_Load(sender As Object, e As EventArgs) Handles MyBase.Load
        Dim request = DirectCast(WebRequest.Create("https://notify-api.line.me/api/notify"), HttpWebRequest)
        'ข้อความที่จะส่ง
        Dim postData = String.Format("message={0}", "ทดสอบ line notify VB.NET")
        Dim data = Encoding.UTF8.GetBytes(postData)

        request.Method = "POST"
        request.ContentType = "application/x-www-form-urlencoded"
        request.ContentLength = data.Length
        'เปลี่ยนเป็น Token ของเรา ใส่ต่อจาก Bearer"
        request.Headers.Add("Authorization", "Bearer C3fPBRAhyd0Z7wCKkJloBTUy7q7bBogo8QB6OAfrvW2")

        Using stream = request.GetRequestStream()
            stream.Write(data, 0, data.Length)
        End Using

        Dim response = DirectCast(request.GetResponse(), HttpWebResponse)
        Dim responseString = New StreamReader(response.GetResponseStream()).ReadToEnd()
    End Sub
End Class
