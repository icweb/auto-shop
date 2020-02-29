<table class="table mb-0 dt-table">
    <thead>
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach($customers as $customer)
        <tr>
            <td>{{ $customer->first_name }}</td>
            <td>{{ $customer->last_name }}</td>
            <td class="text-right">
                <a href="{{ route('customers.show', $customer) }}" class="btn btn-sm btn-info text-white"><i class="far fa-folder-open"></i> View</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
