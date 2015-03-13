<?php

class AdminSessionController extends \AdminBaseController {


    public function create()
    {
        if(Auth::admin()->check()){
            return Redirect::route('admin.dashboard');
        }
        return View::make('admin/login');
    }

    /**
     * Show the form for creating a new resource.
     * GET /admin/create
     *
     * @return Response
     */
    public function store()
    {
        $username = Input::get('username');
        $password = Input::get('password');


        if (Auth::admin()->attempt(array('username' => $username, 'password' => $password)))
        {
            return Redirect::route('admin.dashboard');
        }

        return Redirect::route('admin.login')->with('message', '账号或密码错误');
    }

    /**
     * Display the specified resource.
     * GET /admin/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy()
    {
        Auth::admin()->logout();
        return Redirect::route('admin.login');
    }



}