<?php

class AdminBaseController extends \ApiController {

	protected $admin;
	protected $appointmentPreQuery;

	public function __construct()
	{
		$this->admin = Auth::admin()->get();
		View::share('admin', $this->admin);
	}

	public function downExcel($e_data, $title)
	{
    Excel::create($title, function($excel) use ($e_data) {

        $excel->sheet('user', function($sheet) use ($e_data) {
            $sheet->fromArray( $e_data );
        });
    })->export('xls');
	}


	public function transformDataToExcel($data)
	{
	  $data = [];

	  foreach($data as $key => $value) {

	      $e_data['时间'] = date('Y-m-d H:i:s', strtotime($value->created_at));

	      $data[$key] = $e_data;
	  }

		return $data;
	}


}