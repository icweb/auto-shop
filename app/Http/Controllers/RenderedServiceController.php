<?php

namespace App\Http\Controllers;

use App\Customer;
use App\RenderedService;
use App\Service;
use App\User;
use Illuminate\Http\Request;

class RenderedServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function create(Customer $customer)
    {
        $services = Service::orderBy('name')->get();
        $vehicles = $customer->vehicles()->orderBy('make')->get();
        $employees = User::orderBy('name')->get();

        return view('rendered-services.create', compact('customer', 'services', 'vehicles', 'employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Customer $customer
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request, Customer $customer)
    {
        $this->validate($request, [
            'source' => 'required|string',
            'service' => 'required|string',
            'vehicle' => 'required|string',
            'employee' => 'nullable|string|sometimes',
            'completed_at' => 'nullable|string|sometimes',
            'cost' => 'nullable|string|sometimes',
            'comments' => 'nullable|string|sometimes',
        ]);

        $rendered_service = new RenderedService();
        $rendered_service->author_id = auth()->id();
        $rendered_service->customer_id = $customer->id;
        $rendered_service->service_id = request()->input('service');
        $rendered_service->vehicle_id = request()->input('vehicle');
        $rendered_service->employee_id = request()->input('employee');
        $rendered_service->completed_at = request()->input('completed_at');
        $rendered_service->cost = request()->input('cost');
        $rendered_service->comments = request()->input('comments');
        $rendered_service->save();

        if(request()->input('source') === 'customer')
        {
            return redirect()->route('customers.show', $rendered_service->customer);
        }
        elseif (request()->input('source') === 'form')
        {
            return redirect()->route('rendered-services.create', [$rendered_service->customer, 'source' => request()->input('customer')]);
        }
        else
        {
            return redirect()->route('vehicles.show', $rendered_service->vehicle);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  RenderedService $renderedService
     * @return \Illuminate\Http\Response
     */
    public function show(RenderedService $renderedService)
    {
        $renderedService->load(['vehicle', 'employee', 'customer', 'service']);
        $customer = $renderedService->customer;

        return view('rendered-services.show', compact('renderedService', 'customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
