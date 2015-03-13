<?php 
namespace Wechat;


use Illuminate\Support\ServiceProvider;

class WechatServiceProvider extends ServiceProvider{

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind('wechat', function(){
			return new MyWechatService(array(
				'appid' => getenv('WECHAT_APPID'),
				'appsecret' => getenv('WECHAT_APPSECRET'),
				'auth_token_id' => getenv('AUTH_TOKEN_ID'),
				'auth_token' => getenv('AUTH_TOKEN'),
			));
		});
	}
	
}