<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as HttpRequest;
use Request as Request;

use App\Order;
use App\Timeslot;

class SVController extends Controller
{
	// Page for creating an order for a new singing valentine
    public function create() {

    	//return view('sv.order', ['data' => SVOrder::all() ] );

    	/*
    	$fri = Timeslots::where('day', '=', 'Friday');
    	$mon = Timeslots::where('day', '=', 'Monday');
    	$tue = Timeslots::where('day', '=', 'Tuesday');
    	$timeslots = [
    		'fri' => $fri,
    		'mon' => $mon,
    		'tue' => $tue
    	];*/
    	// data to pass to order form: day/timeslots, whether they are full

        $timeslots = [
            'fri'   => Timeslot::select('day_of_week', 'class_time', 'num_slots')->where('day_of_week', 'fri')->get(),
            'mon'   => Timeslot::select('day_of_week', 'class_time', 'num_slots')->where('day_of_week', 'mon')->get(),
            'tue'   => Timeslot::select('day_of_week', 'class_time', 'num_slots')->where('day_of_week', 'tue')->get()
        ];

    	return view('sv.create', ['timeslots' => $timeslots] );
    }

    // view
    public function viewOrders() {

        $orders = Order::all();
        return view('sv.viewOrders', ['orders' => $orders] );
    }

    // edit

    // Request to store new order in database
    public function store(HttpRequest $request) {
    	$input = Request::all();

    	$order = new Order;
    	$order->recipient_name = $input['recipient_name'];
    	$order->sender_name = $input['sender_name'];
    	$order->sender_email = $input['sender_email'];
    	$order->day = $input['day'];
    	$order->timeslot = $input['timeslot'];
    	$order->song_choice = $input['song_choice'];
    	$order->comment = isset($input['comments']) ? $input['comments']  : '';

        // Check if that timeslot is filled up or not
        // totalAvailable = Timeslot::where(day_of_week ...).where(class_time ...).first().num_slots
        // ordersMade = Order::where(day_of_week...).where(class_time ...).count()
        // if ordersMade >= totalAvailable, already full
        // Should respond here to tell that slot is full


        // Save order to database
    	$order->save();


        // Send confirmation email


        $response = [];
        $response['success'] = true;
        $response['order'] = $order;

    	return $response;
    	// Upon valid creation, return redirect to /sv/order with success message
    }

    // Needs validate method

}
