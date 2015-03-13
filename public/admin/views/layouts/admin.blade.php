<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title> </title>
	<meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1.0">

	<link rel="stylesheet" href="{{asset('common/bower_components/amazeui/dist/css/amazeui.min.js')}}"/>

	@yield('style')
	<style>
		.container{
			width: 100%;
		}
		.wrapper{
			width: 960px;
			margin: 0 auto;
		}
	</style>


	<script>window.global = {rootUrl: "{{ url('/') }}"};</script>


</head>
<body>

	@yield('content')
	
	<!--build:js(app) js/scripts.js-->
 	<script src="{{asset('common/bower_components/jquery/dist/jquery.min.js')}}"></script>
	<script src="{{asset('common/bower_components/amazeui/dist/js/amazeui.min.js')}}"></script>
	<!--endbuild-->

	@yield('script')
	
</body>
</html>