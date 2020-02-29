<table class="table mb-0 dt-table">
    <thead>
    <tr>
        <th>What</th>
        @if($showVehicle)
            <th>Vehicle</th>
        @endif
        <th>When</th>
        <th>Who</th>
        <th>Cost</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach($renderedServices as $renderedService)
        <tr>
            <td>{{ $renderedService->service->name }}</td>
            @if($showVehicle)
                <td><a href="{{ route('vehicles.show', $renderedService->vehicle) }}">{{ $renderedService->vehicle->make . ' ' . $renderedService->vehicle->model }}</a></td>
            @endif
            <td>{{ $renderedService->completed_at === null ? 'Never' : $renderedService->completed_at->format('m/d/Y') }}</td>
            <td>{{ $renderedService->employee ? $renderedService->employee->name : '' }}</td>
            <td>{{ $renderedService->cost }}</td>
            <td class="text-right">
                <a href="{{ route('rendered-services.show', $renderedService) }}" class="btn btn-sm btn-info text-white"><i class="far fa-folder-open"></i> View</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
