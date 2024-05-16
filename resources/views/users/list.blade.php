@extends('template')

@section('content')
<div id="app">
	<user-list 
	end-point-url="{!! $endpointUrl !!}" 
	edit-user-route={{ route('users.edit', '') }}
	/>
</div>
@endsection
