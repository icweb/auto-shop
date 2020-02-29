<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\AppointmentService;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appointments = Appointment::all();

        return view('appointments.index', compact('appointments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = AppointmentService::all();

        return view('appointments.create', compact('services'));
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
            'customer' => 'required',
            'comments' => 'string|nullable|sometimes',
            'starts_at' => 'required|timestamp',
            'ends_at' => 'required|timestamp',
        ]);

        $appointment = Appointment::create([
            'author_id' => auth()->id(),
            'customer_id' => request()->input('customer'),
            'comments' => request()->input('comments'),
            'starts_at' => request()->input('starts_at'),
            'ends_at' => request()->input('ends_at'),
        ]);

        foreach(request()->input('services') as $service)
        {
            $appointment->service()->create([
                'author_id' => auth()->id(),
                'service_id' => $service['service'],
                'vehicle_id' => $service['vehicle'],
                'cost' => $service['cost'],
                'comments' => $service['comments'],
            ]);
        }

        return view('appointments.show', compact('appointment'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        return view('appointments.show', compact('appointment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {
        return view('appointments.edit', compact('appointment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment $appointment)
    {
        $this->validate($request, [
            'customer' => 'required',
            'comments' => 'string|nullable|sometimes',
            'starts_at' => 'required|timestamp',
            'ends_at' => 'required|timestamp',
        ]);

        $appointment->update([
            'customer_id' => request()->input('customer'),
            'comments' => request()->input('comments'),
            'starts_at' => request()->input('starts_at'),
            'ends_at' => request()->input('ends_at'),
        ]);

        return view('appointments.show', compact('appointment'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()->route('appointments.index');
    }
}
