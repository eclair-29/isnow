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
          <table class="table table-bordered" id="requestsdatatable">
            <thead>
              <tr>
                <th scope="col">Ticket ID</th>
                <th scope="col">Requestor</th>
                <th scope="col">Approver</th>
                <th scope="col">Application Type</th>
                <th scope="col">Status</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  let table = new DataTable('#requestsdatatable');
</script>
@endsection