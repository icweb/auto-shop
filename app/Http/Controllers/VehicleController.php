<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Exports\VehiclesExport;
use App\Vehicle;
use App\VehicleMileage;
use Illuminate\Http\Request;

class VehicleController extends BaseController
{
    public $export_class = VehiclesExport::class;

    private function _getBodyTypes()
    {
        return Vehicle::select('body_type')->groupBy('body_type')->groupBy('body_type')->pluck('body_type')->toArray();
    }

    private function _getMakes()
    {
        return Vehicle::select('make')->groupBy('make')->groupBy('make')->pluck('make')->toArray();
    }

    private function _getModels()
    {
        return Vehicle::select('model')->groupBy('model')->groupBy('model')->pluck('model')->toArray();
    }

    private function _getColors()
    {
        return Vehicle::select('color')->groupBy('color')->groupBy('color')->pluck('color')->toArray();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicles = Vehicle::with('customer')->get();

        return view('vehicles.index', compact('vehicles'));
    }

    /**
     * Show the form for searching for a resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getSearch(Request $request)
    {
        $makes = $this->_getMakes();
        $models = $this->_getModels();
        $colors = $this->_getColors();
        $body_types = $this->_getBodyTypes();

        $criteria = [
            'make' => '',
            'model' => '',
            'year' => '',
            'color' => '',
            'body_type' => '',
            'license_plate' => '',
            'vin' => '',
        ];

        return view('vehicles.search', compact('body_types', 'makes', 'models', 'colors', 'criteria'));
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
            'make' => 'nullable|string|sometimes',
            'model' => 'nullable|string|sometimes',
            'year' => 'nullable|string|sometimes',
            'color' => 'nullable|string|sometimes',
            'body_type' => 'nullable|string|sometimes',
            'license_plate' => 'nullable|string|sometimes',
            'vin' => 'nullable|string|sometimes',
        ]);

        $makes = $this->_getMakes();
        $models = $this->_getModels();
        $colors = $this->_getColors();
        $body_types = $this->_getBodyTypes();

        $criteria = [
            'make' => request()->input('make'),
            'model' => request()->input('model'),
            'year' => request()->input('year'),
            'color' => request()->input('color'),
            'body_type' => request()->input('body_type'),
            'license_plate' => request()->input('license_plate'),
            'vin' => request()->input('vin'),
        ];

        $vehicles = Vehicle::select('*');
        foreach($criteria as $key => $val)
        {
            if(request()->exists($key) && !empty(request()->input($key))) $vehicles = $vehicles->where($key, 'LIKE', '%' . request()->input($key) . '%');
        }
        $vehicles = $vehicles->get();

        if($vehicles->count() === 1)
        {
            return redirect()->route('vehicles.show', $vehicles[0]);
        }

        return view('vehicles.search', compact('vehicles', 'criteria', 'body_types', 'makes', 'models', 'colors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function create(Customer $customer)
    {
        return view('vehicles.create', compact('customer'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Customer $customer
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request, Customer $customer)
    {
        $this->validate($request, [
            'make' => 'required|string',
            'model' => 'required|string',
            'year' => 'nullable|string|sometimes',
            'color' => 'nullable|string|sometimes',
            'body_type' => 'nullable|string|sometimes',
            'license_plate' => 'nullable|string|sometimes',
            'vin' => 'nullable|string|sometimes',
            'mileage' => 'nullable|string|sometimes',
            'comments' => 'nullable|string|sometimes',
        ]);

        $vehicle = new Vehicle();
        $vehicle->author_id = auth()->id();
        $vehicle->customer_id = $customer->id;
        $vehicle->make = request()->input('make');
        $vehicle->model = request()->input('model');
        $vehicle->year = request()->input('year');
        $vehicle->color = request()->input('color');
        $vehicle->body_type = request()->input('body_type');
        $vehicle->license_plate = request()->input('license_plate');
        $vehicle->vin = request()->input('vin');
        $vehicle->comments = request()->input('comments');
        $vehicle->save();

        if(!empty(request()->input('mileage')))
        {
            $current_mileage = request()->input('mileage');
        }
        else
        {
            $current_mileage = 0;
        }

        $mileage = new VehicleMileage();
        $mileage->author_id = auth()->id();
        $mileage->vehicle_id = $vehicle->id;
        $mileage->mileage = $current_mileage;
        $mileage->save();

        return redirect()->route('vehicles.show', $vehicle);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle)
    {
        $vehicle->load(['mileage', 'renderedServices']);

        return view('vehicles.show', compact('vehicle'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Customer $customer
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer, Vehicle $vehicle)
    {
        return view('vehicles.edit', compact('vehicle', 'customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Customer $customer
     * @param Vehicle $vehicle
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Customer $customer, Vehicle $vehicle)
    {
        $this->validate($request, [
            'make' => 'required|string',
            'model' => 'required|string',
            'year' => 'nullable|string|sometimes',
            'color' => 'nullable|string|sometimes',
            'body_type' => 'nullable|string|sometimes',
            'license_plate' => 'nullable|string|sometimes',
            'vin' => 'nullable|string|sometimes',
            'mileage' => 'nullable|string|sometimes',
            'comments' => 'nullable|string|sometimes',
        ]);

        $vehicle->make = request()->input('make');
        $vehicle->model = request()->input('model');
        $vehicle->year = request()->input('year');
        $vehicle->color = request()->input('color');
        $vehicle->body_type = request()->input('body_type');
        $vehicle->license_plate = request()->input('license_plate');
        $vehicle->vin = request()->input('vin');
        $vehicle->comments = request()->input('comments');
        $vehicle->save();

        if(!empty(request()->input('mileage')) && request()->input('mileage') != $vehicle->last_mileage)
        {
            $mileage = new VehicleMileage();
            $mileage->author_id = auth()->id();
            $mileage->vehicle_id = $vehicle->id;
            $mileage->mileage = request()->input('mileage');
            $mileage->save();
        }

        return redirect()->route('vehicles.show', $vehicle);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $vehicle)
    {
        //
    }
}
