<?php
class Map {

	public function __construct(){

		$this->citycoords = array();

			$city = str_replace(' ','+',$_GET['CITY']);
			$address = $city . '+' . $_GET['STATE'];
		
			$geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$address.'&sensor=false');
			$output = json_decode($geocode);
			
			$lat = $output->results[0]->geometry->location->lat;
			$long = $output->results[0]->geometry->location->lng;
			$this->citycoords = array($city, $lat, $long);

			print_r(json_encode($this->citycoords));
	}
	
}
$map = new Map();

?>