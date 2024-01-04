@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row pb-4 justify-content-end">
		<div class="col d-flex justify-content-end">
			<a href="{{ route('requests.create') }}" class="btn btn-outline-primary">Make Request</a>
		</div>
	</div>
	<div class="row justify-content-center">
		<div class="col">
			<div class="card">
				<div class="card-header">Requests</div>

				<div class="card-body">
					@if (session('status'))
					<div class="alert alert-success" role="alert">
						{{ session('status') }}
					</div>
					@endif
					<!-- List of created requests -->
					@datatable
					@slot('tableId', 'requestsdatatable')
					@slot('data', $requests)
					@slot('route', 'requests.show')
					@enddatatable
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	let table = new DataTable('#requestsdatatable');
</script>
@endsection