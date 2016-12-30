var maps;
var markerImage = 'assets/img/marker.png';

function baseMap(){
	// default position
	var location = new google.maps.LatLng(-6.912889,107.609787);
	maps = new google.maps.Map(document.getElementById("map_canvas"), {
		zoom: 13,
		center: location,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	});
	// generate coordinate by draggable
	tanda = new google.maps.Marker({
		position: location,
		map: maps,
		icon: markerImage,
		draggable : true
	});
	// set coordinate to textfield
	google.maps.event.addListener(tanda, "dragend", function(event) {
		document.getElementById("#latitude").value = this.getPosition().lat();
		document.getElementById("#longitude").value = this.getPosition().lng();
	});
}
