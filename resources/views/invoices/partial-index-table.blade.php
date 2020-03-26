<table class="table mb-0 dt-table">
    <thead>
    <tr>
        <th>ID</th>
        @if($showCustomer)
            <th>Customer</th>
        @endif
        <th>Due At</th>
        <th>Due</th>
        <th>Paid</th>
        <th>Status</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach($invoices as $invoice)
        <tr>
            <td>{{ $invoice->id }}</td>
            @if($showCustomer)
                <td><a href="{{ route('customers.show', $invoice->customer) }}"><i class="far fa-user"></i> {{ $invoice->customer->name }}</a></td>
            @endif
            <td>{{ $invoice->due_at !== null ? $invoice->due_at->format('m/d/Y') : '' }}</td>
            <td>${{ \App\Services\CurrencyService::toDollars($invoice->amount_due) }}</td>
            <td>${{ \App\Services\CurrencyService::toDollars($invoice->amount_paid) }}</td>
            <td>{{ $invoice->status }}</td>
            <td class="text-right">
                @if($invoice->status === 'Quote')
                    <a href="#" class="btn btn-sm btn-success btn-sm text-white" data-toggle="tooltip" data-placement="top" title="Convert to an invoice"><i class="far fa-sync fa-fw"></i></a>
                @endif
                @if($invoice->status === 'Paid')
                    <a href="#" class="btn btn-sm btn-danger btn-sm text-white" data-toggle="tooltip" data-placement="top" title="Refund"><i class="far fa-times fa-fw"></i></a>
                @endif
                <a href="{{ route('invoices.pdf', $invoice) }}" class="btn btn-sm btn-info text-white" data-toggle="tooltip" data-placement="top" title="Download PDF"><i class="far fa-download fa-fw"></i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
