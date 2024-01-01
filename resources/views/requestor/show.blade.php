@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">Ticket No. {{ $request->ticket_id }}</div>

				<div class="card-body">
					@if (session('status'))
					<div class="alert alert-success" role="alert">
						{{ session('status') }}
					</div>
					@endif
					<div class="row">
						<div class="col">
							@include('reusables.approvers')
						</div>
						<div class="col-12 py-2">
							<h6 class="text-dark">User Details</h6>
						</div>
						<div class="col-4">
							<span class="text-uppercase text-secondary">Staff ID</span>
							<p>{{ $request->user->staff_id }}</p>
						</div>
						<div class="col-4">
							<span class="text-uppercase text-secondary">Name</span>
							<p>{{ $request->user->name }}</p>
						</div>
						<div class="col-4">
							<span class="text-uppercase text-secondary">Site</span>
							<p>{{ $request->user->site->site_code }}</p>
						</div>
						<div class="col-4">
							<span class="text-uppercase text-secondary">Division</span>
							<p>{{ $request->user->division->description }}</p>
						</div>
						<div class="col-4">
							<span class="text-uppercase text-secondary">Dept.</span>
							<p>{{ $request->user->dept->description }}</p>
						</div>
						<div class="col-4">
							<span class="text-uppercase text-secondary">Employment Status</span>
							<p class="text-capitalize">{{ $request->user->status->description }}</p>
						</div>
						<div class="col-12">
							<span class="text-uppercase text-secondary">Email Address</span>
							<p class="text-capitalize">{{ $request->user->email ?? 'N/A' }}</p>
						</div>
					</div>
					<div class="row">
						<div class="col-12 pb-2 pt-4">
							<h6 class="text-dark">Request Details</h6>
						</div>
						<div class="col-4">
							<span class="text-uppercase text-secondary">Application Type</span>
							<p class="text-capitalize">{{ $request->applicationType->description }}</p>
						</div>
						<div class="col-4">
							<span class="text-uppercase text-secondary">Request Type</span>
							<p class="text-capitalize">{{ $request->requestType->description }}</p>
						</div>
						<div class="col-4">
							<span class="text-uppercase text-secondary">Request Type</span>
							<p class="text-capitalize">{{ $request->status->description }}</p>
						</div>
						<div class="col-12">
							<span class="text-uppercase text-secondary">Purpose</span>
							<p class="text-capitalize">{{ $request->purpose }}</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="{{ asset('js/approvals.js') }}"></script>
@endsection