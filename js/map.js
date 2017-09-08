var Mappy = (function(){ 
	
	
	var map = new google.maps.Map(document.getElementById('the-map'), {
			center : new google.maps.LatLng(39.7392358, -104.990251),
			zoom : 4,
			mapTypeId : google.maps.MapTypeId.ROADMAP,
			disableDefaultUI: true,
			scrollwheel: false
	});
	
	var form = document.getElementById("mapform");
	form.onsubmit = function() {
		return false;
	}	

	
	function pinBuilder(resp){

		var infowindow = new google.maps.InfoWindow;
		var marker, i;

		marker = new google.maps.Marker({
			position: new google.maps.LatLng(resp[1], resp[2]),
			map: map,
			animation: google.maps.Animation.DROP,
		});

		google.maps.event.addListener(marker, 'click', (function(marker, i) {
			return function() {
				 infowindow.setContent(resp[0]);
				 infowindow.open(map, marker);
			}
		})(marker, i));

	}

	
	return {

    getPin: function() {  
			
			xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {

				if (this.readyState == 4 && this.status == 200) {
					pinBuilder(JSON.parse(xhttp.responseText));
				}

			};
			
			xhttp.open("GET", "pin_builder.php?CITY="+form.City.value+"&STATE="+form.State.value, true);
			xhttp.send();   
			
		}

	}
	
})();






