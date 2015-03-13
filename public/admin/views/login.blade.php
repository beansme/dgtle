<!doctype html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title> </title>
		<meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1.0">

		<link rel="stylesheet" href="http://cdn.amazeui.org/amazeui/2.2.1/css/amazeui.min.css"/>

		<style>
			.header {
				text-align: center;
			}
			.header h1 {
				font-size: 200%;
				color: #333;
				margin-top: 30px;
			}
			.header p {
				font-size: 14px;
			}
		</style>

		<script>window.global = {rootUrl: "{{ url('/') }}"};</script>




	</head>
	<body>

	<div class="header">
		<div class="am-g">
			<h1>活</h1>
			<p>USER LOGIN<br/>用户后台登录界面</p>
		</div>
		<hr />
	</div>
	<div class="am-g">
		<div class="am-u-lg-6 am-u-md-8 am-u-sm-centered">

			<br>
			<br>

			@if(Session::has('message'))
				<p class="alert alert-danger">
					{{Session::get('message')}}
				</p>
			@endif

			<form class="form-signin am-form" role="form" action="{{URL::action('AdminSessionController@store')}}" method="post">
				<label for="username">账号:</label>
				<input type="text" class="form-control" placeholder="账号" name="username" required autofocus id="username">
				<br>
				<label for="password">密码:</label>
				<input type="password" class="form-control" placeholder="密码" name="password" id="password" required>

				<br />
				<div class="am-cf">
					<input type="submit" name="" value="登 录" class="am-btn am-btn-primary am-btn-sm am-fr">
				</div>
			</form>

			<hr>
		</div>
	</div>

	<script src="http://cdn.staticfile.org/jquery/2.1.1-rc1/jquery.min.js"></script>
	<script src="http://cdn.amazeui.org/amazeui/2.2.1/js/amazeui.min.js"></script>


	</body>
</html>



