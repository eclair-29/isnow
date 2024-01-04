<div class="card-header">Ticket No. {{ $data->ticket_id }}</div>

<div class="card-body">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif
    @include('reusables.details.user')
    @include('reusables.details.request')
    <!-- application type: account  -->
    @include('reusables.details.account')
    <div class="row">
        <div class="col-12">
            <span class="text-uppercase text-secondary">Purpose</span>
            <p class="text-capitalize">{{ $data->purpose }}</p>
        </div>
    </div>