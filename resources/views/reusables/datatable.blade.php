<table class="table table-bordered" id="{{ $tableId }}">
    <thead>
        <tr>
            <th scope="col">Ticket ID</th>
            <th scope="col">Requestor</th>
            <th scope="col">Approver</th>
            <th scope="col">Application Type</th>
            <th scope="col">Status</th>
            <th scope="col">Updated Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $request)
        <tr>
            <td>
                <a href="{{ route($route, $request->id) }}">{{ $request->ticket_id }}</a>
            </td>
            <td>{{ $request->user->name }}</td>
            <td>{{ $request->approver->user->name ?? 'N/A' }}</td>
            <td>{{ $request->applicationType->description }}</td>
            <td>{{ $request->status->description }}</td>
            <td>{{ $request->updated_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>