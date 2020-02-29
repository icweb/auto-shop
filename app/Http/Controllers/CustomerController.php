<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
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
     * Search for resources.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getSearch(Request $request)
    {
        return view('customers.search');
    }

    /**
     * Search for resources.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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
        if(request()->exists('first_name') && !empty(request()->input('first_name'))) $customers = $customers->where('first_name', 'LIKE', '%' . request()->input('first_name') . '%');
        if(request()->exists('last_name') && !empty(request()->input('last_name'))) $customers = $customers->where('last_name', 'LIKE', '%' . request()->input('last_name') . '%');
        if(request()->exists('home_phone') && !empty(request()->input('home_phone'))) $customers = $customers->where('home_phone', 'LIKE', '%' . request()->input('home_phone') . '%');
        if(request()->exists('mobile_phone') && !empty(request()->input('mobile_phone'))) $customers = $customers->where('mobile_phone', 'LIKE', '%' . request()->input('mobile_phone') . '%');
        if(request()->exists('email') && !empty(request()->input('email'))) $customers = $customers->where('email', 'LIKE', '%' . request()->input('email') . '%');
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
