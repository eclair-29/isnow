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
          <form method="POST" action="{{ route('requests.store') }}">
            @csrf

            <!-- User details -->
            <div class="form-row">
              <div class="col form-group">
                <label for="staffid">Requestor ID</label>
                <input readonly name="staffid" id="staffid" class="form-control" value="{{ $user->staff_id }}" />
              </div>

              <div class="col form-group">
                <label for="requestor">Requestor</label>
                <input readonly name="requestor" id="requestor" class="form-control" value="{{ $user->name }}" />
              </div>
            </div>

            <div class="form-row">
              <div class="col form-group">
                <label for="site">Site</label>
                <input readonly name="site" id="site" class="form-control" value="{{ $user->site->site_code }}" />
              </div>

              <div class="col form-group">
                <label for="division">Division</label>
                <input readonly name="division" id="division" class="form-control"
                  value="{{ $user->division->description }}" />
              </div>

              <div class="col form-group">
                <label for="status">Employment Status</label>
                <input readonly name="status" id="status" class="form-control"
                  value="{{ $user->status->description }}" />
              </div>
            </div>

            <!-- Application Type dropdown -->
            <div class="form-group">
              <label for="applicationtypes">Select Application Type<span class="required">*</span></label>
              <select name="applicationtypes" id="applicationtypes" class="form-control">
                <option selected disabled>Select Application Type</option>
                @foreach ($applicationTypes as $applicationType)
                <option value="{{ $applicationType->id }}">{{ $applicationType->description }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-row">
              <!-- Ticket ID -->
              <div class="col form-group" hidden>
                <label for="ticketid">Ticket ID</label>
                <input readonly name="ticketid" id="ticketid" class="form-control" placeholder="Ticket ID" />
                <small id="ticketinputinfo" class="form-text text-muted">ticket id is auto generated</small>
              </div>

              <!-- Requet Type dropdown -->
              <div class="col form-group" hidden>
                <label for="requesttypes">Request Type<span class="required">*</span></label>
                <select name="requesttypes" id="requesttypes" class="form-control"></select>
              </div>
            </div>

            <!-- Fields depending on the selected application type -->
            <!-- HRIS fields -->

            <!-- Purpose field -->
            <div class="form-group" hidden>
              <label for="purpose">Purpose<span class="required">*</span></label>
              <textarea class="form-control" name="purpose" id="purpose" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-outline-primary mt-2">Post Request</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).on('change', '#applicationtypes', function () {
    const value = $(this).val();
    const requesttypes = $('#requesttypes');
    const ticketid = $('#ticketid');
    const purpose = $('#purpose');
    
    // Get request types options depending on selected application type
    $.ajax({
      type: 'get',
      url: '{{ route('requests.getrequesttypes') }}?application_type_id=' + value,
      success: function (response) {
        // Show ticket id and request types fields
        ticketid.parent().attr("hidden", false);
        requesttypes.parent().attr("hidden", false);
        purpose.parent().attr("hidden", false);

        requesttypes.html('<option selected disabled>Select Request Type</option>');

        $.each(response, function (key, value) {
          requesttypes
            .append('<option value="' + value.id + '">' + value.description + '</option>');
        })
      }
    })
})
</script>
@endsection