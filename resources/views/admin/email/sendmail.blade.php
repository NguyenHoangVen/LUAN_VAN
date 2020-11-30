<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Sen email</title>
</head>
<body>
	<h1>{{$details['title']}}</h1>

	<p>{{$details['body']}}!</p>
	<p>Đây là email gửi từ hệ thống Phuot để xác nhận tài khoản đăng kí của bạn.Để kích hoạt tài khoản bạn vui lòng click vào link sau:</p>
	<p><strong>Mã xác nhận: {{$details['active_token']}}</strong></p>
	<p>Email này có hiệu lực trong 24h, sau 24h nếu bạn chưa kích hoạt thì hệ thống sẽ vô hiệu hóa Email này, và bạn vui lòng phải đăng kí lại</p>
	<p>Thank you!!!!!</p>
</body>
</html>