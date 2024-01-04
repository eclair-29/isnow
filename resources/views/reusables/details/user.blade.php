<div class="row">
    <div class="col">
        @include('reusables.approvers')
    </div>
    <div class="col-12 py-2">
        <h6 class="text-dark">User Details</h6>
    </div>
    <div class="col-4">
        <span class="text-uppercase text-secondary">Staff ID</span>
        <p>{{ $data->user->staff_id }}</p>
    </div>
    <div class="col-4">
        <span class="text-uppercase text-secondary">Name</span>
        <p>{{ $data->user->name }}</p>
    </div>
    <div class="col-4">
        <span class="text-uppercase text-secondary">Site</span>
        <p>{{ $data->user->site->site_code }}</p>
    </div>
    <div class="col-4">
        <span class="text-uppercase text-secondary">Division</span>
        <p>{{ $data->user->division->description }}</p>
    </div>
    <div class="col-4">
        <span class="text-uppercase text-secondary">Dept.</span>
        <p>{{ $data->user->dept->description }}</p>
    </div>
    <div class="col-4">
        <span class="text-uppercase text-secondary">Employment Status</span>
        <p class="text-capitalize">{{ $data->user->status->description }}</p>
    </div>
    <div class="col-12">
        <span class="text-uppercase text-secondary">Email Address</span>
        <p class="text-capitalize">{{ $data->user->email ?? 'N/A' }}</p>
    </div>
</div>