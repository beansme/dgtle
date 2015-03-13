@extends('layouts.admin')


@section('content')
	<div class="wrapper">

		@include('partial.show-errors')

		<form action="{{route('admin.account.update', [$admin['id']])}}" method="POST" class="am-form">
				<input type="hidden" name="_method" value="PUT">
				<div class="am-form-group">
					<label>用户名：</label>
					<input type="text" name="username" value="{{$admin['username']}}">
				</div>

				<div class="am-form-group">
					<label>原密码: </label>
					<input type="password" name="origin_password">
				</div>

				<div class="am-form-group">
					<label>修改密码：</label>
					<input type="password" name="password">
				</div>
				<div class="am-form-group">
					<label>确认密码：</label>
					<input type="password" name="password_confirmation">
				</div>
				<p><button type="submit" class="am-btn am-btn-default">提交</button></p>
		</form>
		
	
			<a href="{{route('admin.dashboard')}}">返回主页</a>

	</div>
@stop