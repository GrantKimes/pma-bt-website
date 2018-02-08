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
    		'timeslots' => Timeslot::orderBy('start_time', 'ASC')->get(),
    		'songs' => Song::all(),
    		'days' => Timeslot::select('day')->distinct()->orderBy('day', 'ASC')->get(),
    	];
    }

    public function show(Order $order) {
    	return $order;
    }

    public function store(Request $request) {
    	Log::info("------------------------ New order request");
    	$orderJson = $this->getJsonFromRequest($request);
    	Log::info($orderJson);

    	$timeslot = Timeslot::find($orderJson['timeslot_id']);
    	$timeslotIsFull = $timeslot->orders()->count() >= $timeslot->num_available_slots;
    	$shouldOverrideTimeslotFull = $orderJson['should_override_timeslot_full'];
    	if ($timeslotIsFull && !$shouldOverrideTimeslotFull) {
    		Log::warning("Timeslot ".$timeslot->id." is full, rejecting order");
    		$response['error'] = "timeslot full";
    		return response()->json($response, 200);
    	}
    	else {
	    	$order = Order::create($orderJson);
	    	$this->sendEmailConfirmation($order);
	    	return response()->json($order, 201);
    	}

    }

    public function update(Request $request, Order $order) {
    	Log::info("------------- Update order request");
    	$orderJson = $this->getJsonFromRequest($request);
    	Log::info($orderJson);
    	Log::info($order);
    	$order->update($orderJson);
    	return response()->json($order, 200);
    }

    private function getJsonFromRequest(Request $request) {
    	$orderJson = $request->json()->all();
    	if ($orderJson['comment'] == null) {
    		$orderJson['comment'] = "";
    	}
    	return $orderJson;
    }

    public function delete(Order $order) {
    	$order->delete();
    	return response()->json(null, 204);
    }

    private function sendEmailConfirmation($order) {
    	Log::info($order);
    	$day = new \DateTime($order->timeslot->day);
    	$readableDay = $day->format('l, F j');
    	$startTime = new \DateTime($order->timeslot->start_time);
    	$endTime = new \DateTime($order->timeslot->end_time);
    	$readableTimeslot = $startTime->format('g:ia') . " - " . $endTime->format('g:ia');

        $to = $order->sender_email;
        $subject = "Singing Valentines Order for " . $order->recipient_name;
        $message = "<html><body>"
            . "<p>Thank you for your order, " . $order->sender_name . ". Here are the details:</p>" 
            . "<ul>"
            . "<li>Recipient: <b>" . $order->recipient_name . "</b></li>"
            . "<li>Sender: <b>" . $order->sender_name . "</b></li>"
            . "<li>Day: <b>" . $readableDay . "</b></li>"
            . "<li>Timeslot: <b>" . $readableTimeslot . "</b></li>"
            . "<li>Location: <b>" . $order->location . "</b></li>"
            . "<li>Song: <b>" . $order->song->title . "</b></li>"
            . "<li>Comment: <b>" . $order->comment . "</b></li>"
            . "</ul>"
            // . "<p>We have a Snapchat filter! Find out more on our <a href='http://betataupma.org/sv'>website</a>.</p>"
            . "<p>If you have any questions or would like to change your order, you can reply to this email.<p>"
            . "<p>You can also message us on Facebook at <a href='https://www.facebook.com/betatau1937/'>Phi Mu Alpha - University of Miami</a>.</p>"
            . "</body></html>";



        $additionalHeaders[] = 'From: UMiami Phi Mu Alpha <UMiami.PMA@gmail.com>';
        //$additionalHeaders[] = 'To: '.$to;
        $additionalHeaders[] = 'Return-Path: <UMiami.PMA@gmail.com>';
        $additionalHeaders[] = 'MIME-Version: 1.0';
        $additionalHeaders[] = 'Bcc: webmaster.betataupma@gmail.com';
        $additionalHeaders[] = 'Content-type: text/html; charset=iso-8859-1';

        try {
            $val = mail($to, $subject, $message, implode("\r\n", $additionalHeaders));
        }
        catch (Exception $e) {
            Log::error($e->getMessage());
        }
        Log::info('Sending email to ' . $to . ', mail() return value: ' . $val . '.');
    }
}
