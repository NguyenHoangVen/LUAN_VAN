<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Send mail</title>
</head>
<body>
	<h1>{{$details['title']}}</h1>

	<p>{{$details['body']}}!</p>
	<p>Đây là email gửi từ hệ thống Phuot để xác nhận lấy lại mật khẩu của bạn.</p>
	<p><strong>Mã xác nhận: {{$details['active_token']}}</strong></p>
	
	<p>Thank you!!!!!</p>
</body>
</html>