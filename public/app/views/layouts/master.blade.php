<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
	<meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1.0">
	
	<!--build:css(app) css/main.css-->
	<link rel="stylesheet" type="text/css" href="{{asset('app/assets/css/base.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('app/assets/css/main.css')}}">
	<!--endbuild-->
	@yield('style')

</head>
<body>

		@yield('content')
		<!--build:js(app) js/scripts.js-->
		<script src="{{asset('common/bower_components/jquery/dist/jquery.min.js')}}"></script>
		<!--endbuild-->
	    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
	    <script>
	        window.rootUrl = '<?php echo url("/"); ?>';
	        var dataForWeixin = {
	            imgUrl: "",
	            title: "",
	            timelineTitle: "",
	            link: rootUrl,
	            desc: "",
	            success: function(res) {},
	            cancel: function(res){}
	        };
	    </script>

	    @yield('wechat-data')

	    @if(isset($signPackage))
	        <script>
	            wx.config({
	                appId: '<?php echo $signPackage["appid"];?>',
	                timestamp: <?php echo $signPackage["timestamp"];?>,
	                nonceStr: '<?php echo $signPackage["noncestr"];?>',
	                signature: '<?php echo $signPackage["signature"];?>',
	                jsApiList: [
	                    'onMenuShareTimeline',
	                    'hideMenuItems',
	                    'showMenuItems',
	                    'onMenuShareAppMessage',
	                    'hideOptionMenu',
	                    'showOptionMenu',
	                    'closeWindow'
	                ]
	            });

	            wx.ready(function(){
	                wx.showOptionMenu();
	                wx.onMenuShareTimeline({
	                    title: dataForWeixin.timelineTitle,
	                    link: dataForWeixin.link,
	                    imgUrl: dataForWeixin.imgUrl,
	                    success: dataForWeixin.success,
	                    cancel: dataForWeixin.cancel
	                });
	                wx.onMenuShareAppMessage({
	                    title: dataForWeixin.title,
	                    link: dataForWeixin.link,
	                    desc: dataForWeixin.desc,
	                    imgUrl: dataForWeixin.imgUrl,
	                    success: dataForWeixin.success,
	                    cancel: dataForWeixin.cancel
	                });
	            });

	        </script>

	    @endif
		@yield('script')
</body>
</html>