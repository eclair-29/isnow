<table class="table table-bordered table-striped subtype-table">
    <thead>
        <tr>
            <th colspan="3" class="text-center">{{ $label }}</th>
        </tr>
        <tr>
            <th class="text-center">ID</th>
            <th class="text-center">Requested {{ $label }}</th>
            <th class="text-center">Requested Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $value)
        <tr>
            <td>{{ $value->id }}</td>
            <td>{{ $value->description }}</td>
            <td>Add</td>
        </tr>
        @endforeach
    </tbody>
</table>