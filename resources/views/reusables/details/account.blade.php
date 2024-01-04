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
        <span class="text-uppercase text-secondary">SAP Roles</span>
        <ul class="list-group pt-2">
            @foreach ($sapRoles as $sapRole)
            <li class="list-group-item">{{ $sapRole->description }}</li>
            @endforeach
        </ul>
    </div>
</div>
