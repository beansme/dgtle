<?php

class AdminAccountController extends \AdminBaseController {

	public function __construct()
	{
		parent::__construct();
		$this->beforeFilter('super_admin', ['only' => ['index', 'create', 'store']]);
	}

	/**
	 * Display a listing of the resource.
	 * GET /adminaccount
	 *
	 * @return Response
	 */
	public function index()
	{
		$accounts = Admin::where('role', 'normal')->get();
		return View::make('admin.account.index',compact('accounts'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /adminaccount/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('admin.account.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /adminaccount
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();


		$rules = [
			'username' => 'required|unique:admin',
			'password' => 'required|confirmed'
		];

		$validator = Validator::make(
			$input,
			$rules
		);

		if($validator->fails()){
			Input::flash();
			return Redirect::back()->with('messages', $validator->messages()->all())->withInput();
		}

		$admin = new Admin();
		$admin->username = $input['username'];
		$admin->password = Hash::make($input['password']);
		$admin->save();

		return Redirect::action('AdminAccountController@index');
	}

	/**
	 * Display the specified resource.
	 * GET /adminaccount/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 * DELETE /adminaccount/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function edit($id)
	{
		$admin = Admin::findOrFail($id);
		$type = $this->admin->role == 'super' ? 'super' : 'normal';
		return View::make('admin.account.edit', compact('admin', 'type'));
	}

	public function editAble($id)
	{
		if($this->admin->role == 'super' || $this->admin->id == $id) {
			return 1;
		}
		return 0;
	}



	public function update($id)
	{

		if( ! $this->editAble($id)) {
			return Redirect::action('AdminController@index');
		}

		$input = Input::all();
		$username = $input['username'];
		$password = $input['password'];

		$admin = Admin::findOrFail($id);

		if( $this->admin->role == 'super' || Hash::check($input['origin_password'],  $admin->password)) {
			$rules = [
				'username' => 'required|unique:admin,id,' . $id,
				'password' => 'required|confirmed',
			];

			$validator = Validator::make(
				$input,
				$rules
			);

			if($validator->fails()){
				Input::flash();
				return Redirect::back()->with('messages', $validator->messages()->all())->withInput();
			}
			$admin->username = $username;
			$admin->password = Hash::make($password);
			$admin->save();
			$messages = ['更新成功'];

			if($this->admin->id == $id) {
				return Redirect::route('admin.logout');
			}

			return Redirect::back()->with('messages', $messages);

		} else {
			$messages = ['密码错误'];
			return Redirect::back()->with('messages', $messages);
		}

	}


}