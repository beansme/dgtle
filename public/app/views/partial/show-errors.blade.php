@if($messages = Session::has('message'))
		<p class="alert alert-danger">
		@foreach($messages as $message)
			<li>
				{{Session::get('message')}}
			</li>
		@endforeach
		</p>
@endif