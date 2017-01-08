function initialize() {
	var map = new google.maps.Map(document.getElementById('map'), {
		center: new google.maps.LatLng(-7.792611, 110.408021),
		zoom: 16
	});
	var infoWindow = new google.maps.InfoWindow;
	// Center area with geolocation detection
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(function (position) {
			initialLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
			map.setCenter(initialLocation);
		});
	}

	// Change this depending on the name of your PHP or XML file
	var searched = (getUrlVars()["searched"] == "true") ? "true" : "false";
	var nama = getUrlVars()["nama"];
	var status = getUrlVars()["status"];
	var min = getUrlVars()["min"];
	var max = getUrlVars()["max"];
	var url = "xml.php?searched="+searched+"&nama="+nama+"&status="+status+"&min="+min+"&max="+max;
	downloadUrl(url, function(data) {
		var xml = data.responseXML;
		var markers = xml.documentElement.getElementsByTagName('marker');
		Array.prototype.forEach.call(markers, function(markerElem) {
		  var nama = markerElem.getAttribute("nama");
		  var alamat = markerElem.getAttribute("alamat");
		  var latitude = markerElem.getAttribute("latitude");
		  var longitude = markerElem.getAttribute("longitude");
		  var tersedia = markerElem.getAttribute("tersedia");
		  var status = markerElem.getAttribute("status");
		  var harga_3bulan = markerElem.getAttribute("harga_3bulan");
		  var harga_6bulan = markerElem.getAttribute("harga_6bulan");
		  var harga_pertahun = markerElem.getAttribute("harga_pertahun");

			var infowincontent = document.createElement('div');
			var strong = document.createElement('strong');

			var point = new google.maps.LatLng(
				parseFloat(markerElem.getAttribute('latitude')),
				parseFloat(markerElem.getAttribute('longitude'))
			);

			strong.textContent = nama
			infowincontent.appendChild(strong);
			infowincontent.appendChild(document.createElement('br'));

			var text = document.createElement('text');
			text.textContent = alamat+", "+tersedia+" kamar tersedia, Rp."+harga_3bulan+",-/3bln Rp."+harga_6bulan+",-/6bln Rp."+harga_pertahun+",-/pertahun"
			infowincontent.appendChild(text);
			var marker = new google.maps.Marker({
				map: map,
				icon: markerImage,
				position: point,
				draggable : IsDraggable
			});

			// set coordinate to textfield
			google.maps.event.addListener(marker, "dragend", function(event) {
				document.getElementById("latitude1").value = this.getPosition().lat();
				document.getElementById("longitude1").value = this.getPosition().lng();
				document.getElementById("latitude2").value = this.getPosition().lat();
				document.getElementById("longitude2").value = this.getPosition().lng();
			});

			marker.addListener('click', function() {
				infoWindow.setContent(infowincontent);
				infoWindow.open(map, marker);
			});
		});
	});
}

function downloadUrl(url, callback) {
	var request = window.ActiveXObject ?
		new ActiveXObject('Microsoft.XMLHTTP') :
		new XMLHttpRequest;

	request.onreadystatechange = function() {
		if (request.readyState == 4) {
			request.onreadystatechange = doNothing;
			callback(request, request.status);
		}
	};

	request.open('GET', url, true);
	request.send(null);
}

function doNothing() {}

// Read a page's GET URL variables and return them as an associative array.
function getUrlVars()
{
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}
