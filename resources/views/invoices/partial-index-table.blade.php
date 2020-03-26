<table class="table mb-0 dt-table">
    <thead>
    <tr>
        <th>ID</th>
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
            <td>{{ $invoice->due_at !== null ? $invoice->due_at->format('m/d/Y') : '' }}</td>
            <td>${{ \App\Services\CurrencyService::toDollars($invoice->amount_due) }}</td>
            <td>${{ \App\Services\CurrencyService::toDollars($invoice->amount_paid) }}</td>
            <td>{{ $invoice->status }}</td>
            <td class="text-right">
                <a href="{{ route('invoices.pdf', $invoice) }}" class="btn btn-sm btn-info text-white"><i class="far fa-download"></i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
