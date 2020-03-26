<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\AppointmentService;
use App\Holiday;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Holiday $holiday)
    {
        $appointments = Appointment::all();

        return view('appointments.index', compact('appointments'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function feed()
    {
        $raw_appointments = Appointment::select('*');

        if($_GET['start']) {
            $raw_appointments = $raw_appointments->where('ends_at', '>', $_GET['start']);
        }
        if($_GET['end']) {
            $raw_appointments = $raw_appointments->where('starts_at', '<', $_GET['end']);
        }

        $raw_appointments = $raw_appointments->get();

        $appointments = [];
        foreach($raw_appointments as $appointment) {
            $appointments[] = [
                'id' => 'a' . $appointment->id,
                'title' =>  preg_replace("/[^a-zA-Z]/", "", $appointment->customer->name),
                'start' => $appointment->starts_at->format('Y-m-d H:i:s'),
                'end' => $appointment->ends_at->format('Y-m-d H:i:s'),
                'rendering' => $appointment->link === '#holiday' ? 'background' : '',
                'backgroundColor' => $appointment->color,
                'borderColor' => $appointment->color,
                'textColor' => $appointment->fg_color,
                'overlap' =>  true,
                'className' => 'full-cal-event',
                'editable' => true,
                'startEditable' => true,
                'durationEditable' => true,
                'meta' => (object)[
                    'id' => $appointment->id,
                    'href' => $appointment->link,
                    'customer' => (object)[
                        'id' => 'c' . $appointment->customer->id,
                        'name' => preg_replace("/[^a-zA-Z]/", "", $appointment->customer->name)
                    ]
                ]
            ];
        }

        return response()->json($appointments);
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
            'starts_at' => 'string|date',
            'ends_at' => 'string|date',
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
        $appointment->load(['customer', 'services', 'invoices']);
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
            'customer' => 'string|nullable|sometimes',
            'comments' => 'string|nullable|sometimes',
            'starts_at' => 'string|nullable|sometimes',
            'ends_at' => 'string|nullable|sometimes',
        ]);

        $data = [
            'customer_id' => request()->input('customer'),
            'comments' => request()->input('comments'),
            'starts_at' => date('Y-m-d H:i:s', strtotime(request()->input('starts_at'))),
            'ends_at' => date('Y-m-d H:i:s', strtotime(request()->input('ends_at'))),
        ];

        if(!request()->exists('customer')) unset($data['customer_id']);
        if(!request()->exists('comments')) unset($data['comments']);
        if(!request()->exists('starts_at')) unset($data['starts_at']);
        if(!request()->exists('ends_at')) unset($data['ends_at']);

        $appointment->update($data);

        if(request()->ajax())
        {
            return response()->json([]);
        }
        else
        {
            return view('appointments.show', compact('appointment'));
        }

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
