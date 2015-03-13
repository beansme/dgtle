@extends('layouts.admin')

@section('content')
	<div class="wrapper">

		<div class="am-cf">
		  <a href="{{action('AdminAccountController@create')}}" class="am-btn am-btn-success am-fr">创建管理员</a>
		</div>

		<table class="am-table">
			<thead>
				<tr>
					<th>管理员用户名</th>
					<th>管理员操作</th>
				</tr>
			</thead>
	   		<tbody>
				@foreach($accounts as $account)
				<tr>
					<td>{{$account['username']}}</td>
					<td><a href="{{action('AdminAccountController@edit', $account['id'])}}" class="am-btn am-btn-success">编辑用户</a></td>
				</tr>
				@endforeach
			</tbody>
		</table>


	</div>
@stop