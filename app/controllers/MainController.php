<?php

class MainController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /main
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /main/create
	 *
	 * @return Response
	 */
	public function create()
	{

		$html = HtmlDomParser::file_get_html('http://trade.dgtle.com');
		$tradeboxs = ($html->find('div[class=tradebox]'));
		$products = [];
		foreach ($tradeboxs as $key => $tradebox) {
			$product = [];

			$trade =  $tradebox->children(0)->children(0);
			$product['id'] = (explode('-', $trade->href)[1]);

			if(Session::get('last_send') == $product['id']) {
				break;
			}

			$product['url'] = 'http://trade.dgtle.com' . $trade->href;
			$product['title'] = $trade->children(0)->title;
			$text = $tradebox->children(1)->plaintext; 
			$product['price'] = explode("</font>", $text)[1];
			$products[$key] = $product;

		}


		if($count = count($products)) {

			for ($i = $count; $i > 0; $i--) {
						$product = $products[$i - 1];
						$data = [
							'touser' => 'o094_t0a2KTqu2OKLHgYlgoi2j_0',
							'template_id' => 'gnonzrxi-klG_a8tWrzID_7vUlNlFK1Dv6Tsz5DRjmo',
							'url' => $product['url'], 
							'topcolor' => '#FF0000', 
							'data' => [
								'first' => [
									'value' => $product['title'], 
									'color' => '#173177'
								], 
								'keyword1' => [
									'value' => $product['price'], 
									'color' => '#173177'
								], 
								'keyword2' => [
									'value' => $product['id'], 
									'color' => '#173177'
								]
							]	
						];

						Log::info($data);

				 		if( ! Wechat::sendTemplateMessage($data) ) {
				 			Log::info($product['id'] . 'send error: ' . Wechat::getErrCode() . Wechat::getErrMsg());
				 		}

			}
			Session::set('last_send', $products[0]['id']);
			unset($products);
		}



	}

	/**
	 * Store a newly created resource in storage.
	 * POST /main
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /main/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /main/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /main/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /main/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}