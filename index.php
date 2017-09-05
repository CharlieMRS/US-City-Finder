<!--Charlie Meers - Code Sample - 9/5/2017-->

<script type='text/javascript' src='http://maps.googleapis.com/maps/api/js?key=AIzaSyAF6zBim5dGJmZSPEkKhfLcYnNO9v4IyeI'></script>
<!--TODO: user input for their own api key-->
<h1>U.S. City Finder</h1>
<form method="post" action="index.php" name="mapform" id="mapform">
		<div>
				<input type="text" name="City" id="City" />
				<label for="City">City?</label>
				<br /><br />
				<input type="State" name="State" id="State" />
				<label for="State">State?</label>
				<br /><br />
				<input type="submit" name="submitMap" id="submitMap" value="submit" class="button" />
		</div>
</form>	

<?php
class Map {

	public function pins(){

		$this->citycoords = array();

			//TODO: foreach loop, make citycoords[] multidimensional 
			//TODO: form validation 
		  //if(isset($_POST['City']) && isset($_POST['State'])){

			$city = str_replace(' ','+',$_POST['City']);
			//$address = $city . '+' . state_abr($_POST('State'));
			$address = $city . '+' . $_POST['State'];
			//echo $address;
			$geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$address.'&sensor=false');
			$output = json_decode($geocode);
			$lat = $output->results[0]->geometry->location->lat;
			$long = $output->results[0]->geometry->location->lng;

			$this->citycoords[] = array($city, $lat, $long);
	}
}
$map = new Map();
$map->pins();
//print_r($map->citycoords);

?>

<script type="text/javascript">   
	var locations = <?php echo json_encode($map->citycoords); ?>;
</script>

<div id="the-map" style="width: 100%; min-height: 360px;"></div>
<script type='text/javascript' src='js/map.js'></script>
