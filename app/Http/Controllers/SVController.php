<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as HttpRequest;
use Request as Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use App\Order;
use App\Timeslot;
use App\Mail\OrderReceived;

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

        // Pass timeslots structure from database for dropdown menu.
        $timeslots = $this->getTimeslots();
        /*$timeslots = [
            'fri'   => Timeslot::select('day_of_week', 'class_time', 'num_slots')->where('day_of_week', 'fri')->get(),
            'mon'   => Timeslot::select('day_of_week', 'class_time', 'num_slots')->where('day_of_week', 'mon')->get(),
            'tue'   => Timeslot::select('day_of_week', 'class_time', 'num_slots')->where('day_of_week', 'tue')->get()
        ];

        // Determine for each timeslot if there are already the max amount of orders.
        foreach ($timeslots as $day) { // through fri, mon, tue
            foreach ($day as $slot) { // through fri order 1, fri order 2, etc
                $num_slots_taken = Order::where('day', $slot['day_of_week'])->where('timeslot', $slot['class_time'])->count();
                if ($num_slots_taken >= $slot['num_slots']) { 
                    $slot['filled'] = 'true';
                }  
                else {
                    $slot['filled'] = 'false';
                }
            }
        }*/



    	return view('sv.create', ['timeslots' => $timeslots] );
    }

    // view
    public function viewOrders() {
        $orders = Order::all();
        foreach ($orders as $order) {
            $order['day'] = ucfirst($order->day);
        }
        //$songCount = Order::
        $timeslots = $this->getTimeslots();
        return view('sv.viewOrders', ['orders' => $orders, 'timeslots' => $timeslots] );
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
        $order->location = $input['location'];
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
        //Mail::to("grantkimes@gmail.com")
            //->bcc("SV_Responses@betataupma.org")
        //    ->send(new OrderReceived($order));

        $to = "g.kimes@umiami.edu";
        $subject = "Singing Valentines Confirmation";
        $message = "Thank you for your order, ".$order->sender_name.". Here's info about it: ".$order->recipient_name."\n";
        $additionalHeaders;
        //mail($to, $subject, $message);


        $response = [];
        $response['success'] = true;
        $response['order'] = $order;

    	return $response;
    	// Upon valid creation, return redirect to /sv/order with success message
    }


    // Return timeslots variable that contains all necessary info for frontend display. 
    protected function getTimeslots() {
        // Pass timeslots structure from database for dropdown menu.
        $timeslots = [
            'fri'   => Timeslot::select('day_of_week', 'class_time', 'num_slots')->where('day_of_week', 'fri')->get(),
            'mon'   => Timeslot::select('day_of_week', 'class_time', 'num_slots')->where('day_of_week', 'mon')->get(),
            'tue'   => Timeslot::select('day_of_week', 'class_time', 'num_slots')->where('day_of_week', 'tue')->get()
        ];

        // Determine for each timeslot if there are already the max amount of orders.
        foreach ($timeslots as $day) { // through fri, mon, tue
            foreach ($day as $slot) { // through fri order 1, fri order 2, etc
                $num_slots_taken = Order::where('day', $slot['day_of_week'])->where('timeslot', $slot['class_time'])->count();
                if ($num_slots_taken >= $slot['num_slots']) { 
                    $slot['filled'] = 'true';
                }  
                else {
                    $slot['filled'] = 'false';
                }
                $slot['num_slots_taken'] = $num_slots_taken;
            }
        }

        return $timeslots;
    }

    public function login(HttpRequest $request) {

        if (Auth::check()) {
            return redirect('/sv/order');
        }

        return view('sv.login');
    }

}
