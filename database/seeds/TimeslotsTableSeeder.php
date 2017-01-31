<?php

use Illuminate\Database\Seeder;

use App\Timeslot;

class TimeslotsTableSeeder extends Seeder
{


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	$MWF_schedule = [
    		'8:00am - 8:50am' 	=> 5, 
    		'9:05am - 9:55am' 	=> 5,
    		'10:10am - 11:00am' => 5, 
    		'11:15am - 12:05pm' => 5, 
    		'12:20pm - 1:10pm' 	=> 5, 
    		'1:25pm - 2:15pm'	=> 5, 
    		'2:30pm - 3:20pm'	=> 5,
    		'3:35pm - 4:50pm'	=> 8,
    		'5:00pm - 6:15pm' 	=> 8,
    		'6:25pm - 7:40pm' 	=> 8,
    		'7:50pm - 9:05pm'	=> 8,
    	];

    	$TR_schedule = [
    		'8:00am - 9:15am'	=> 8,
    		'9:30am - 10:45am'	=> 8,
    		'11:00am - 12:15pm'	=> 8,
    		'12:30pm - 1:45pm'	=> 8,
    		'2:00pm - 3:15pm'	=> 8,
    		'3:30pm - 4:45pm'	=> 8, 
    		'5:00pm - 6:15pm' 	=> 8,
    		'6:25pm - 7:40pm' 	=> 8,
    		'7:50pm - 9:05pm'	=> 8,
    	];

    	$daysOfWeek = ['fri', 'mon', 'tue'];

    	foreach ($daysOfWeek as $day) {
    		if ($day == 'mon' || $day == 'wed' || $day == 'fri') {
    			$schedule = $MWF_schedule;
    		}
    		else {
    			$schedule = $TR_schedule;
    		}

    		foreach ($schedule as $time => $numSlots) {
    			Timeslot::create([
    				'day_of_week'	=> $day,
    				'class_time'	=> $time,
    				'num_slots'		=> $numSlots
    			]);
    		}
    	}

    	/*
    	$file = file_get_contents(storage_path('SV_Timeslots.json'));
    	$json_arr = json_decode($file, true);
    	//echo "array: \n" ;
    	//echo typeof($file);
    	print_r($json_arr);

    	$timeslot = new Timeslot;


    	$day = $json_arr['fri'][0]['start'];

    	//foreach ($file as $day) {
    		//$timeslot->day_of_week = $day;
    		echo "Printing: ";
    		print_r($day);
    	//}


    	//$this->logger->debug("Test");
    	//$this->console->line($file);
    	//echo "hi";


        $timeslot = new Timeslot;
        $timeslot->day_of_week = 'fri';
        $timeslot->start_time = "8:00am";
        $timeslot->end_time = "8:50am";
        $timeslot->num_slots = 5;
        //$timeslot->save();

        $daysOfWeek = ['fri', 'mon', 'tue'];
		*/
        /*for ($daysOfWeek as $day) {
        	$timeslot->day_of_week = $day;

        	$timeslot
        }*/

    }
}
