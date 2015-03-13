@extends('layouts.admin')


@section('content')
	<div class="wrapper">

		@include('partial.show-errors')

		<form action="{{action('AdminAccountController@store')}}" method="POST" class="am-form">
				<div class="am-form-group">
					<label>用户名：</label>
					<input type="text" name="username" value="{{Input::old('username')}}">
				</div>
				<div class="am-form-group">
					<label>填写密码：</label>
					<input type="password" name="password" value="">
				</div>
				<div class="am-form-group">
					<label>确认密码：</label>
					<input type="password" name="password_confirmation">
				</div>
				<p><button type="submit" class="am-btn am-btn-default">提交</button></p>
		</form>
	</div>
	

@stop