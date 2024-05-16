@extends('template')

@section('content')
<div id="app">
	<user-edit 
		end-point-url="{!! $endpointUrl !!}"
		user-id={!! $userId !!}
	/>
</div>
@endsection