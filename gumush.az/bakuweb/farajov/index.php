<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../../bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../../bootstrap/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="../../css/normalize.css" />
	<link rel="stylesheet" type="text/css" href="../../css/style.css">
	<title>Adminpanel - Giriş</title>
	<style type="text/css">
		p{
			font-size: 24px;
			margin: 25px;
			text-align: center;
			font-weight: 700;
		}
		@media(max-width: 992px){
			p{
				font-size: 20px;
			}
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="col-xs-5 col-xs-push-3 col-sm-4 col-sm-push-4">
			<p>Adminpanel - Giriş</p>
			<form action="connection.php" method="POST">
				<div class="form-group">
			    	<label for="login">Login:</label>
			    	<input type="text" class="form-control" name="login" id="login" required="">
			    </div>
			    <div class="form-group">
			    	<label for="parol">Şifrə:</label>
			    	<input type="password" class="form-control" name="password" id="parol" required="">
			    </div>
			    <button type="submit" class="btn btn-success">Daxil Ol</button>
			</form>
		</div>
	</div>
</body>
</html>