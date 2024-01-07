<div class="row" {{ $data->application_type_id == 2 ?: 'hidden' }}>
    <div class="col-4">
        <span class="text-uppercase text-secondary">Account Type</span>
        <p class="text-capitalize">{{ $data->accountApplication->accountType->description ?? 'N/A' }}</p>
    </div>
    <div class="col-4">
        <span class="text-uppercase text-secondary">Charges</span>
        <p class="text-capitalize">¥{{ $data->accountApplication->charges ?? '0' }}</p>
    </div>
</div>
<div class="row py-4">
    <div class="col">
        @subtypedetails
        @if ($data->accountApplication->accountType->id == 2)
        @slot('label', 'Salesforce Profile')
        @slot('data', $salesforceProfiles)
        @endif

        @if ($data->accountApplication->accountType->id == 3)
        @slot('label', 'SAP Roles')
        @slot('data', $sapRoles)
        @endif
        @endsubtypedetails
    </div>
</div>