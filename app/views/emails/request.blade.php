<!DOCTYPE html>
<html lang="en">
<head>
	<title>
		<meta charset="utf-8" />
	</title>
</head>
<body>
<h1> Password Reset </h1>
To reset your password, complete this form:
{{ URL::route("user/reset", compact("token")) }}

</body>
</html>