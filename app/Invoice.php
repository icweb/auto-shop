<?php

namespace App;

use App\Services\CurrencyService;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\Party;

class Invoice extends BaseModel
{
    protected $fillable = [
        'author_id',
        'customer_id',
        'appointment_id',
        'status',
        'payment_type',
        'pay_until_days',
        'total_sub',
        'total_tax',
        'total_discount',
        'total_grand',
        'amount_due',
        'amount_paid',
        'converted_from_quote',
        'comments',
        'due_at',
        'paid_at',
    ];

    protected $casts = [
        'deleted_at' => 'datetime',
        'due_at' => 'datetime',
        'paid_at' => 'datetime',
    ];

    public $statuses = [
        'Quote',
        'Unpaid',
        'Paid',
        'Outstanding',
        'Refund',
    ];

    public $paymentTypes = [
        'Cash',
        'Credit Card',
        'Check',
        'No Payment Required',
    ];

//    public static function boot()
//    {
//        parent::boot();
//
//        self::creating(function($model){
//            // ... code here
//        });
//
//        self::created(function($model){
//            // ... code here
//        });
//
//        self::updating(function($model){
//            // ... code here
//        });
//
//        self::updated(function($model){
//            // ... code here
//        });
//
//        self::deleting(function($model){
//            // ... code here
//        });
//
//        self::deleted(function($model){
//            // ... code here
//        });
//    }

    public function assemble()
    {
        $business = new Party([
            'name' => Setting::check('invoice_business_name'),
            'address' => Setting::check('invoice_address'),
            'phone' => Setting::check('invoice_phone')
        ]);

        $customer = new Buyer([
            'name' => $this->customer->name,
            'custom_fields' => [
                'home_phone' => $this->customer->home_phone,
                'cell_phone' => $this->customer->cell_phone,
                'email' => $this->customer->email,
            ],
        ]);

        $items = [];

        foreach($this->invoiceItems as $invoiceItem)
        {
            $newItem = (new \LaravelDaily\Invoices\Classes\InvoiceItem())
                ->title($invoiceItem->description)
                ->pricePerUnit(intval(CurrencyService::toDollars($invoiceItem->unit_price)))
                ->quantity($invoiceItem->quantity);

            array_push($items, $newItem);
        }

        $invoice = \LaravelDaily\Invoices\Invoice::make($this->status)
            ->sequence($this->id)
            ->serialNumberFormat('{SEQUENCE}/{SERIES}')
            ->seller($business)
            ->buyer($customer)
            ->date(now()->subWeeks(3))
            ->dateFormat('m/d/Y')
            ->currencySymbol('$')
            ->currencyCode('USD')
            ->currencyFormat('{SYMBOL}{VALUE}')
            ->currencyThousandsSeparator('.')
            ->currencyDecimalPoint(',')
            ->filename('Invoice No ' . $this->id . ' - ' . $this->customer->last_name . ', ' . $this->customer->first_name)
            ->addItems($items)
            ->notes($this->comments)
            ->logo(public_path('logo.jpg'));


        if(is_null($this->due_at))
        {
            $invoice = $invoice->payUntilDays(14);
        }
        else
        {

        }

        // You can additionally save generated invoice to configured disk
        $invoice->save('public');

        return $invoice;
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function invoiceItems()
    {
        return $this->hasMany(InvoiceItem::class);
    }
}
