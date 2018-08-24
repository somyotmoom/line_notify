Imports System.Net
Imports System.IO

Partial Class _Default
    Inherits System.Web.UI.Page

    Protected Sub form1_Load(sender As Object, e As EventArgs) Handles form1.Load
        Dim request = DirectCast(WebRequest.Create("https://notify-api.line.me/api/notify"), HttpWebRequest)
        Dim postData = String.Format("message={0}", "ทดสอบ line notify asp.net")
        Dim data = Encoding.UTF8.GetBytes(postData)

        request.Method = "POST"
        request.ContentType = "application/x-www-form-urlencoded"
        request.ContentLength = data.Length
        'request.Headers.Add("Authorization", "Bearer token สร้างแล้ว Copy code มาใส่ครับ")
        request.Headers.Add("Authorization", "Bearer C3fPBRAhyd0Z7wCKkJloBTUy7q7bBogo8QB6OAfrvW2")

        Using stream = request.GetRequestStream()
            stream.Write(data, 0, data.Length)
        End Using

        Dim response = DirectCast(request.GetResponse(), HttpWebResponse)
        Dim responseString = New StreamReader(response.GetResponseStream()).ReadToEnd()
    End Sub
End Class
