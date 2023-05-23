<!DOCTYPE html>
<html>
<head>
	<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="admin/img/apple-icon.png">
  <link rel="icon" type="image/png" href="admin/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Login
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('admin/css/paper-dashboard.css?v=2.0.1') }}" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="{{ ('admin/demo/demo.css') }}" rel="stylesheet" />
</head>
</head>
<style type="text/css">
	body{
		background: #f8f9fa;
	}
	.container{
		margin: 40px 35% !important;
	}
	.btn-primary{
		margin-left: 20% !important;
	}
</style>
<body>
<div class="container" style="margin-top:40px;">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			@if(Request::get("notify") == "invalid")
			<div class="alert alert-danger">Sai email hoặc mật khẩu!</div>
			@endif
			<div class="panel panel-primary">
				<div style="text-align: center;" class="panel-heading"><h3>Đăng nhập</h3></div>
				<div class="panel-body">
					<form style="align-items: center !important;" method="post" action="{{ url('backend/login-post') }}">
						<!-- Muốn submid được form laravel thì phải có thẻ sau -->
						@csrf
					<div class="row" style="margin-top:5px;">
						<div class="col-md-2">Email</div>
						<div class="col-md-9"><input type="email" name="email" required class="form-control"></div>
					</div>
					<div class="row" style="margin-top:5px;">
						<div class="col-md-2">Password</div>
						<div class="col-md-9"><input type="password" name="password" required class="form-control"></div>
					</div>
					<div class="row" style="margin-top:5px;">
						<div class="col-md-2"></div>
						<div class="col-md-9"><input type="submit" value="Đăng nhập" class="btn btn-primary"> <input type="reset" value="Reset" class="btn btn-danger"></div>
					</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>