<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body dir="rtl">
		<h2>
			تغيير كلمة المرور
		</h2>

		<div>
		<h3>
				لتغيير كلمة المرور الخاصة بك إضغط على الرابط التالى :
			</h3>
			<br/>
			{{ URL::to('password/reset', array($token)) }}.<br/>
هذا الرابط صالح لمدة
			{{ Config::get('auth.reminder.expire', 60) }}
			دقيقة .
		</div>
	</body>
</html>
