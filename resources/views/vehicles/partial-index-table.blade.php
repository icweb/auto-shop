<table class="table mb-0 dt-table">
    <thead>
    <tr>
        <th>Customer</th>
        <th>Year</th>
        <th>Make</th>
        <th>Model</th>
        <th>Last Seen</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach($vehicles as $vehicle)
        <tr>
            <td><a href="{{ route('customers.show', $vehicle->customer) }}">{{ $vehicle->customer->first_name . ' ' . $vehicle->customer->last_name }}</a></td>
            <td>{{ $vehicle->year }}</td>
            <td>{{ $vehicle->make }}</td>
            <td>{{ $vehicle->model }}</td>
            <td>{{ $vehicle->last_seen }}</td>
            <td class="text-right">
                <a href="{{ route('vehicles.show', $vehicle) }}" class="btn btn-sm btn-info text-white"><i class="far fa-folder-open"></i> View</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
