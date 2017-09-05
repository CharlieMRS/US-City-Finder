 
(function(){ 
	var map = new google.maps.Map(document.getElementById('the-map'), {
			center : new google.maps.LatLng(39.7392358, -104.990251),
			zoom : 4,
			mapTypeId : google.maps.MapTypeId.ROADMAP,
			disableDefaultUI: true,
			scrollwheel: false
	});

	var infowindow = new google.maps.InfoWindow;
	var marker, i;

	for (i = 0; i < locations.length; i++) {  
			marker = new google.maps.Marker({
					 position: new google.maps.LatLng(locations[i][1], locations[i][2]),
					 map: map,
			 animation: google.maps.Animation.DROP,
			});


			google.maps.event.addListener(marker, 'click', (function(marker, i) {
					 return function() {
							 infowindow.setContent(locations[i][0]);
							 infowindow.open(map, marker);
					 }
			})(marker, i));

	}
})();





