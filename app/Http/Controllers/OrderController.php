<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Timeslot;
use App\Song;

use Illuminate\Support\Facades\Log;


class OrderController extends Controller
{
    public function index() {
    	return [
    		'orders' => Order::with('timeslot')->with('song')->get(),
    		'timeslots' => Timeslot::all(),
    		'songs' => Song::all(),
    		'days' => Timeslot::select('day')->distinct()->get()
    	];
    }

    public function show(Order $order) {
    	return $order;
    }

    public function store(Request $request) {
    	Log::info("------------------------ Request");
    	Log::info($request);
    	$json = $request->json()->all();
    	Log::info($json);
    	$order = Order::create($json);
    	return response()->json($order, 201);

    	// TODO: send confirmation email here
    	// TODO: return failure if timeslot is full. Needs way to override that if coming from edit page 
    }

    public function update(Request $request, Order $order) {
    	$order->update($request->all());
    	return response()->json($order, 200);
    }

    public function delete(Order $order) {
    	$order->delete();
    	return response()->json(null, 204);
    }
}
