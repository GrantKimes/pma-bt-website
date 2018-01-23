<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Timeslot;

class TimeslotController extends Controller
{
    public function index() {
    	return Timeslot::all();
    }

    public function show(Timeslot $timeslot) {
    	return $timeslot;
    }

    public function store(Request $request) {
    	$timeslot = Timeslot::create($request->all());
    	return response()->json($timeslot, 201);
    }

    public function update(Request $request, Timeslot $timeslot) {
    	$timeslot->update($request->all());
    	return response()->json($timeslot, 200);
    }

    public function delete(Timeslot $timeslot) {
    	$timeslot->delete();
    	return response()->json(null, 204);
    }

}
