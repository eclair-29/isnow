@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col">
			<div class="card">
				<div class="card-header">For Approvals</div>

				<div class="card-body">
					@if (session('status'))
					<div class="alert alert-success" role="alert">
						{{ session('status') }}
					</div>
					@endif
					<!-- List of request for approvals -->
					@datatable
					@slot('tableId', 'approvalsdatatable')
					@slot('data', $approver->approver_type_id == 5 ? $approvalsForProcessing : $approvals)
					@slot('route', 'approvals.show')
					@enddatatable
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	let table = new DataTable('#approvalsdatatable');
</script>
@endsection