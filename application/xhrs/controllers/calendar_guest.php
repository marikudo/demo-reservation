<?php
class calendar_guest extends crackerjack{
		private $labels;
		// Tests whether the given ISO8601 string has a time-of-day or not
		const ALL_DAY_REGEX = '/^\d{4}-\d\d-\d\d$/'; // matches strings like "2013-12-29"

		public $title;
		public $allDay; // a boolean
		public $start; // a DateTime
		public $end; // a DateTime, or null
		public $properties = array(); // an array of other misc properties

		public function __construct(){
			parent::__construct();
			if ($this->session->_get('xhrslogin')==false) {
				redirect('xhrs/home/auth');
			}


		}

		public function index(){
			
			$this->template->_admin('xhrs/guest_calendar',$data,$this->load);
		}

		public function reserve($id =false){
		// Short-circuit if the client did not give us a date range.	
			if (!isset($_GET['start']) || !isset($_GET['end'])) {
				die("Please provide a date range.");
			}

			 $range_start = date("Y-m-d",$_GET['start']);
			$range_end = date("Y-m-d",$_GET['end']);
			$data = array();
			while (strtotime($range_start) <= strtotime($range_end)) {

				// $data[1]['title'] = 'test';
				// $data[2]['start'] = date("Y-m-d",strtotime($range_start));
				$date = date("Y-m-d",strtotime($range_start));

				

				$range_start = date ("Y-m-d", strtotime("+1 day", strtotime($range_start)));
			}
			//print_r($data);

		// Parse the start/end parameters.
		// These are assumed to be ISO8601 strings with no time nor timezone, like "2013-12-29".
		// Since no timezone will be present, they will parsed as UTC.

			$dQueryx = "SELECT * FROM _tbookings AS tb INNER JOIN _tguest as tg ON tb.guest_id = tg.guest_id WHERE tb.booking_status='Confirmed'";
					$aResulty = $this->crud->read($dQueryx,array(':calendar_date'=>$date),"obj");
				if ($aResulty) {
					foreach ($aResulty as $key => $value) {
						//echo count($value);
						if ($value->bookings_id > 0) {
						//////////print_r($value);
							// foreach ($value as $valuey) {
							// 	print_r($valuey);
							// }
							$a["title"] = $value->last_name.", ".$value->first_name;
							$a["start"] = $value->check_in;
							$a["end"] = $value->check_out;
							$data[] = $a;
						}
					}
				}

			$range_start = $_GET['start'];
			$range_end = $_GET['end'];
			header('Content-Type: application/json');
			// echo '[{ "title": "Meeting",
			// 	    "start": "2014-12-12",
			// 	    "end": "2014-12-13"},{ "title": "Meeting3",
			// 	    "start": "2014-12-12",
			// 	    "end": "2014-12-16"}]';
			//print_r($data);
			// echo '[{"title":"de","start":"2015-01-24","end":"2015-01-26"}]';
			echo json_encode($data);
		}

		public function isWithinDayRange($rangeStart, $rangeEnd,$array,$timezone) {
			$this->initEvent($array, $timezone=null);
			// Normalize our event's dates for comparison with the all-day range.
			$eventStart = $this->start;
			$eventEnd = isset($this->end) ? $this->end : null;

			if (!$eventEnd) {
				// No end time? Only check if the start is within range.
				return $eventStart < $rangeEnd && $eventStart >= $rangeStart;
			}
			else {
				// Check if the two ranges intersect.
				return $eventStart < $rangeEnd && $eventEnd > $rangeStart;
			}
		}

		public function initEvent($array, $timezone=null){
			$this->title = $array['title'];

			if (isset($array['allDay'])) {
				// allDay has been explicitly specified
				$this->allDay = (bool)$array['allDay'];
			}
			else {
				// Guess allDay based off of ISO8601 date strings
				$this->allDay = preg_match(self::ALL_DAY_REGEX, $array['start']) &&
					(!isset($array['end']) || preg_match(self::ALL_DAY_REGEX, $array['end']));
			}

			if ($this->allDay) {
				// If dates are allDay, we want to parse them in UTC to avoid DST issues.
				$timezone = null;
			}

			// Parse dates
			$this->start = $array['start'];
			$this->end = isset($array['end']) ? $array['end'] : null;

			// Record misc properties
			foreach ($array as $name => $value) {
				if (!in_array($name, array('title', 'allDay', 'start', 'end'))) {
					$this->properties[$name] = $value;
				}
			}
		}

		public function toArray() {

		// Start with the misc properties (don't worry, PHP won't affect the original array)
		$array = $this->properties;

		$array['title'] = $this->title;

		// Figure out the date format. This essentially encodes allDay into the date string.
		if ($this->allDay) {
			$format = 'Y-m-d'; // output like "2013-12-29"
		}
		else {
			$format = 'c'; // full ISO8601 output, like "2013-12-29T09:00:00+08:00"
		}

		// Serialize dates into strings
		$array['start'] = $this->start->format($format);
		if (isset($this->end)) {
			$array['end'] = $this->end->format($format);
		}

		return $array;
	}


}

