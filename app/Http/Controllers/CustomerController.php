<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Exports\CustomersExport;
use Illuminate\Http\Request;

class CustomerController extends BaseController
{
    public $export_class = CustomersExport::class;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();

        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for searching for a resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getSearch(Request $request)
    {
        return view('customers.search');
    }

    /**
     * Search for a resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * @throws \Illuminate\Validation\ValidationException
     */
    public function postSearch(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'nullable|string|sometimes',
            'last_name' => 'nullable|string|sometimes',
            'home_phone' => 'nullable|string|sometimes',
            'mobile_phone' => 'nullable|string|sometimes',
            'email' => 'nullable|string|sometimes',
        ]);

        $criteria = [
            'first_name' => request()->input('first_name'),
            'last_name' => request()->input('last_name'),
            'home_phone' => request()->input('home_phone'),
            'mobile_phone' => request()->input('mobile_phone'),
            'email' => request()->input('email'),
        ];

        $customers = Customer::select('*');
        foreach($criteria as $key => $val)
        {
            if(request()->exists($key) && !empty(request()->input($key))) $customers = $customers->where($key, 'LIKE', '%' . request()->input($key) . '%');
        }
        $customers = $customers->get();

        if($customers->count() === 1)
        {
            return redirect()->route('customers.show', $customers[0]);
        }

        return view('customers.search', compact('customers', 'criteria'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'home_phone' => 'nullable|string|sometimes',
            'mobile_phone' => 'nullable|string|sometimes',
            'email' => 'nullable|string|sometimes',
            'comments' => 'nullable|string|sometimes',
            'email_reminders' => 'required|in:0,1',
            'sms_reminders' => 'required|in:0,1',
        ]);

        $customer = Customer::create([
            'author_id' => auth()->id(),
            'first_name' => request()->input('first_name'),
            'last_name' => request()->input('last_name'),
            'home_phone' => request()->input('home_phone'),
            'mobile_phone' => request()->input('mobile_phone'),
            'email' => request()->input('email'),
            'comments' => request()->input('comments'),
            'email_reminders' => request()->input('email_reminders'),
            'sms_reminders' => request()->input('sms_reminders'),
        ]);

        return view('customers.show', compact('customer'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        $customer->load(['vehicles', 'renderedServices']);

        return view('customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $this->validate($request, [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'home_phone' => 'nullable|string|sometimes',
            'mobile_phone' => 'nullable|string|sometimes',
            'email' => 'nullable|string|sometimes',
            'comments' => 'nullable|string|sometimes',
            'email_reminders' => 'required|in:0,1',
            'sms_reminders' => 'required|in:0,1',
        ]);

        $customer->update([
            'first_name' => request()->input('first_name'),
            'last_name' => request()->input('last_name'),
            'home_phone' => request()->input('home_phone'),
            'mobile_phone' => request()->input('mobile_phone'),
            'email' => request()->input('email'),
            'comments' => request()->input('comments'),
            'email_reminders' => request()->input('email_reminders'),
            'sms_reminders' => request()->input('sms_reminders'),
        ]);

        return view('customers.show', compact('customer'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->route('customers.index');
    }
}
