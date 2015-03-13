<?php


class WechatAuthController extends \BaseController {

	protected $type = 'snsapi_userinfo';

	public function __construct() {
		$this->type = 'snsapi_base';
	}




	/**
	 * 网页验证， URL格式为 /auth?return=需要获取openid的网址
	 *
	 * @return Redirect Wechat Auth Redirct
	 */
	public function getIndex()
	{
		try {
			$return_url = Input::get('return');
			// $return_url = URL::previous();
			//设置微信授权回调地址，使用基本授权模式
			$real_callback = URL::action('WechatAuthController@getRedirect') . '?return=' . base64_encode($return_url);
			$callback = $real_callback;
//            $callback = $this->getCallback($real_callback);

			$red_url = Wechat::getOauthRedirect($callback, 'STATE', $this->type);
			return Redirect::to($red_url);
		} catch (Exception $e) {
			Log::error($e);
		}

	}

	private function getCallback($callback)
	{
		return 'http://work.weazm.com/wechat-auth/?red_url=' . base64_encode($callback) ;
	}


	/**
	 * 微信授权回调，附带access_token、code参数, 获取openid并跳回原地址
	 *
	 * @return Redirect 附带_token并重定向至原地址
	 */
	public function getRedirect()
	{
		//获取token信息，从中获取openid
		$token = Wechat::getOauthAccessToken();
		if(!$token){
			throw new Exception("get wechat token fail", 1);
		}
		//获取该openid在数据库中的ID，并登陆用户后重定向至原地址
		$user_id = $this->getUserId($token);
		if(!$user_id){
			throw new Exception("get userinfo fail", 1);
		}

		Auth::user()->loginUsingId($user_id);

		$return_url = base64_decode(Input::get('return')) . '#/';

		// $return_url = URL::to('/');
		return Redirect::to($return_url.'?_token='.csrf_token());

	}

	/**
	 * 通过openid查询是否曾近授权，未授权则拉取用户信息并写入数据库
	 *
	 * @param  array $token 微信拉取的token信息
	 * @return Object | Boolean  用户对象，出错返回false
	 */
	public function getUserId($token)
	{
		$openid = $token['openid'];
		$user = User::find($openid);

		if($user){
			return $user->openid;
		} else {
			if($this->type == 'snsapi_base') {
				$user = User::firstOrCreate(['openid' => $openid]);
				return $openid;
			}
			//从微信获取用户信息成功后，再把用户信息写入数据库并返回ID
			$access_token = $token['access_token'];
			$user_info = Wechat::getOauthUserinfo($access_token, $openid);
			if($user_info){
				$user_info = array_except($user_info, 'privilege');
				$user_info['user_id'] = $user_info['openid'];
				$user = User::firstOrCreate($user_info);
				return $user_info['openid'];
			} else {
				Log::error([Wechat::getErrCode() . Wechat::getErrMsg()]);
				return false;
			}
		}
	}

//    public function getTcl(){
//        $params =  substr(URL::full(), strlen(Request::url()));
//        $url  = 'http://203.195.134.232/web/tclbackup/tcl/index.php';
//        $callback = $url . $params;
//        return Redirect::to($callback);
//        // return Redirect::to('http://www.baidu.com/'.$params);
//    }




}