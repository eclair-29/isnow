@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				@requestdetails
				@slot('data', $request)
				@slot('sapRoles', $sapRoles)
				@endrequestdetails
			</div> <!-- END: card-body -->
		</div>
	</div>
</div>
</div>
<script src="{{ asset('js/approvals.js') }}"></script>
@endsection