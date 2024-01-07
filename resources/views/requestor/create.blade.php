@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">Create Request</div>

				<div class="card-body">
					@if (session('status'))
					<div class="alert alert-success" role="alert">
						{{ session('status') }}
					</div>
					@endif
					<form method="post" action="{{ route('requests.store') }}">
						@csrf

						<!-- User details -->
						@include('requestor.fields.user')

						<!-- Application Type dropdown -->
						<div class="form-group">
							<label for="application_type">Application Type<span class="required">*</span></label>
							<select name="application_type" id="application_type" class="form-control custom-select">
								<option selected disabled>Select Application Type</option>
								@foreach ($applicationTypes as $applicationType)
								<option value="{{ $applicationType->id }}" {{
									old('application_type')==$applicationType->id ?
									'selected' : '' }}>{{ $applicationType->description }}</option>
								@endforeach
							</select>
							@error('application_type')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>

						<div class="form-row">
							<!-- Ticket ID -->
							<div class="col form-group">
								<label for="ticket_id">Ticket No.</label>
								<input readonly name="ticket_id" id="ticket_id" class="form-control"
									placeholder="Ticket No." value="{{ old('ticket_id') }}" />
								<small id="ticketinputinfo" class="form-text text-muted">auto generated based on
									selected
									application type</small>
							</div>

							<!-- Request Type dropdown -->
							<div class="col form-group">
								<label for="request_type">Request Type<span class="required">*</span></label>
								<select name="request_type" id="request_type"
									class="form-control custom-select"></select>
								<small id="reqtypeselectinfo" class="form-text text-muted">request types will depend on
									selected application type</small>
								@error('request_type')
								<small class="form-text text-danger">{{ $message }}</small>
								@enderror
							</div>
						</div>

						<!-- Fields depending on the selected application type -->
						<!-- Hris fields -->
						@include('requestor.fields.hris')

						<!-- Account fields -->
						@include('requestor.fields.account')

						<!-- Purpose field -->
						<div class="form-group">
							<label for="purpose">Purpose<span class="required">*</span></label>
							<textarea class="form-control" name="purpose" id="purpose"
								rows="5">{{ old('purpose') }}</textarea>
							@error('purpose')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>

						<button type="submit" class="btn btn-outline-primary mt-2">Post Request</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="{{ asset('js/apptypefields.js') }}"></script>
<script src="{{ asset('js/approvals.js') }}"></script>
<script src="{{ asset('js/setcharges.js') }}"></script>
<script src="{{ asset('js/accounttypefields.js') }}"></script>
<script>
	feather.replace();
</script>
@endsection