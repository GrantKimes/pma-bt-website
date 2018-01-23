<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as HttpRequest;
use Request as Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

use App\Order;
use App\Timeslot;
use App\Mail\OrderReceived;

class SVController extends Controller
{
	// Page for creating an order for a new singing valentine.
    public function create() {

        // Pass timeslots structure from database for dropdown menu.
        $timeslots = $this->getTimeslots();


    	return view('sv.create', ['timeslots' => $timeslots] );
    }

    // View existing orders.
    public function viewOrders() {
        $orders = Order::all();

        foreach ($orders as $order) { // Capitalize each day, ex. Fri instead of fri
            $order['day'] = ucfirst($order->day);
        }
        //$songCount = Order::
        $timeslots = $this->getTimeslots();
        return view('sv.viewOrders', ['orders' => $orders, 'timeslots' => $timeslots] );
    }

    // Edit
    public function editOrders() {
        $orders = Order::all();

        foreach ($orders as $order) { // Capitalize each day, ex. Fri instead of fri
            $order['day'] = ucfirst($order->day);
        }
        //$songCount = Order::
        $timeslots = $this->getTimeslots();
        return view('sv.editOrders', ['orders' => $orders, 'timeslots' => $timeslots] );
    }

    // public function storeModifiedOrder(HttpRequest $request) {
    // 	$input = Request::all();

    // 	$orderId = $input['order_id'];
    // 	$order = Order::where('order_id', $orderId);
    //  // If no order exists, create a new one 

    // 	// Set fields on order, either all fields or just modified ones 
    //  // Ignore timeslot limits on number of orders, since this is admin view

    // 	$order->save();
    // }

    // Request to store new order in database, sent as a POST from create page. 
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

        $num_slots = Timeslot::select('num_slots')
            ->where('day_of_week', $order->day)
            ->where('class_time', $order->timeslot)
            ->get()[0]['num_slots'];

        $num_slots_taken = Order::where('day', $order->day)
            ->where('timeslot', $order->timeslot)
            ->count();


        Log::debug($order->day . ' ' . $order->timeslot . " - num_slots: " . $num_slots . ", num_slots_taken: " . $num_slots_taken);
        if ($num_slots_taken >= $num_slots) { // Filled
            $response['success'] = false;
            $response['error'] = "Could not place order, that timeslot is already filled. ";
            $response['order'] = $order;
            return $response;
        }


        // Save order to database
    	$order->save();

        /*
        Log::debug("Before sending mail");
        // Send confirmation email
        try {
        Mail::to("grantkimes@gmail.com")
            ->from("SV@betataupma.org")
            //->bcc("SV_Responses@betataupma.org")
            ->send(new OrderReceived($order));
        }
        catch (Exception $e) {
            Log::error($e->getMessage());
            dd($e->getMessage());
        }

        Log::debug("After sending mail");
        */


        // TODO: make this a separate function

        // Send confirmation email. 
        $to = $order->sender_email;
        $subject = "Singing Valentines Order for " . $order->recipient_name;
        $message = "<html><body>"
            . "<p>Thank you for your order, " . $order->sender_name . ". Here are the details:</p>" 
            . "<ul>"
            . "<li>Recipient: <b>" . $order->recipient_name . "</b></li>"
            . "<li>Sender: <b>" . $order->sender_name . "</b></li>"
            //. "<li>Sender Email: <b>" . $order->sender_email . "</b></li>"
            . "<li>Day: <b>" . toReadableDay($order->day) . "</b></li>"
            . "<li>Timeslot: <b>" . $order->timeslot . "</b></li>"
            . "<li>Location: <b>" . $order->location . "</b></li>"
            . "<li>Song: <b>" . $order->song_choice . "</b></li>"
            . "<li>Comment: <b>" . $order->comment . "</b></li>"
            . "</ul>"
            . "<p>We have a Snapchat filter! Find out more on our <a href='http://betataupma.org/sv'>website</a>.</p>"
            . "<p>If you have any questions or would like to change your order, you can reply to this email (SV@BetaTauPMA.org).<p>"
            . "</body></html>";

        // $message = "Thank you for your order, " . $order->sender_name . ". Here's the details: \n\n" 
        //     . "- Recipient: " . $order->recipient_name . "\n"
        //     . "- Day: " . toReadableDay($order->day) . "\n"
        //     . "- Timeslot: " . $order->timeslot . "\n"
        //     . "- Location: " . $order->location . "\n"
        //     . "- Song: " . $order->song_choice . "\n"
        //     . "- Comment: " . $order->comment . "\n\n\n"
        //     . "If you have any questions or concerns, you can send an email to SV@BetaTauPMA.org, or message our Facebook page.";


        $additionalHeaders[] = 'From: UMiami Phi Mu Alpha <SV@BetaTauPMA.org>';
        //$additionalHeaders[] = 'To: '.$to;
        $additionalHeaders[] = 'Return-Path: <SV@BetaTauPMA.org>';
        $additionalHeaders[] = 'MIME-Version: 1.0';
        $additionalHeaders[] = 'Bcc: webmaster.betataupma@gmail.com';
        $additionalHeaders[] = 'Content-type: text/html; charset=iso-8859-1';

        try {
            $val = mail($to, $subject, $message, implode("\r\n", $additionalHeaders));

            // Send additional copy for our records, since BCC isn't working
            //$additionalHeaders[1] = 'To: webmaster.betataupma@gmail.com';
            //mail('webmaster.betataupma@gmail.com', $subject, $message, implode("\r\n", $additionalHeaders));
        }
        catch (Exception $e) {
            Log::error($e->getMessage());
        }
        Log::info('Sending email to ' . $to . ', mail() return value: ' . $val . '.');
        


        $response = [];
        $response['success'] = true;
        $response['order'] = $order;

    	return $response;
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

function toReadableDay($shortDay) {
    $days = [
        'fri' => 'Friday, February 10',
        'mon' => 'Monday, February 13',
        'tue' => 'Tuesday, February 14'
    ];
    return $days[$shortDay];
}
