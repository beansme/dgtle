<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class GetNew extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'dgtle:new';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Command description.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$html = HtmlDomParser::file_get_html('http://trade.dgtle.com');
		$tradeboxs = ($html->find('div[class=tradebox]'));
		$products = [];
		foreach ($tradeboxs as $key => $tradebox) {
			$product = [];

			$trade =  $tradebox->children(0)->children(0);
			$product['id'] = (explode('-', $trade->href)[1]);

			if(Cache::get('last_send') == $product['id']) {
				break;
			}

			$product['url'] = 'http://trade.dgtle.com' . $trade->href;
			$product['title'] = $trade->children(0)->title;
			$text = $tradebox->children(1)->plaintext; 
			$product['price'] = explode("</font>", $text)[1];
			$products[$key] = $product;

		}

		Log::info('start_at', date('Y-m-d h:i:s'));


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

						Log::info($product['id']);

				 		if( ! Wechat::sendTemplateMessage($data) ) {
				 			Log::info($product['id'] . 'send error: ' . Wechat::getErrCode() . Wechat::getErrMsg());
				 		}

			}
			Cache::put('last_send', $products[0]['id'], 60);
			unset($products);
		}
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			// array('example', InputArgument::REQUIRED, 'An example argument.'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			// array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
		);
	}

}
