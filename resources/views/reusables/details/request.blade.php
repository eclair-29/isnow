<div class="row">
    <div class="col-12 pb-2 pt-4">
        <h6 class="text-dark">Request Details</h6>
    </div>
    <div class="col-4">
        <span class="text-uppercase text-secondary">Application Type</span>
        <p class="text-capitalize">{{ $data->applicationType->description }}</p>
    </div>
    <div class="col-4">
        <span class="text-uppercase text-secondary">Request Type</span>
        <p class="text-capitalize">{{ $data->requestType->description }}</p>
    </div>
    <div class="col-4">
        <span class="text-uppercase text-secondary">Request Status</span>
        <p class="text-capitalize">{{ $data->status->description }}</p>
    </div>
</div>