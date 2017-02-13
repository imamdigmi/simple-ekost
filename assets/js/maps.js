function initialize() {
	var map = new google.maps.Map(document.getElementById('map'), {
		center: new google.maps.LatLng(-7.792611, 110.408021),
		zoom: 16
	});
	var infoWindow = new google.maps.InfoWindow({map: map});

	var pos = {
		lat: -7.792611,
		lng: 110.408021
	};
	infoWindow.setPosition(pos);
	infoWindow.setContent("Your location!.");
	map.setCenter(pos);
	marker = new google.maps.Marker({
		map: map,
		icon: myCurrentLocationMarker,
		animation: google.maps.Animation.DROP,
		position: pos
	});
	marker.addListener('click', toggleBounce);
	marker.addListener('click', function() {
		infoWindow.setContent("Your location!.");
		infoWindow.open(map, marker);
	});

	// Try HTML5 geolocation.
	// if (navigator.geolocation) {
	// 	navigator.geolocation.getCurrentPosition(function(position) {
	// 		var pos = {
	// 			lat: position.coords.latitude,
	// 			lng: position.coords.longitude
	// 		};
	// 		infoWindow.setPosition(pos);
	// 		infoWindow.setContent("Your location!.");
	// 		map.setCenter(pos);
	// 		marker = new google.maps.Marker({
	// 	    map: map,
	// 			icon: myCurrentLocationMarker,
	// 	    animation: google.maps.Animation.DROP,
	// 	    position: pos
	// 	  });
	// 	  marker.addListener('click', toggleBounce);
	// 		marker.addListener('click', function() {
	// 			infoWindow.setContent("Your location!.");
	// 			infoWindow.open(map, marker);
	// 		});
	// 	}, function() {
	// 		handleLocationError(true, infoWindow, map.getCenter());
	// 	});
	// } else {
		// Browser doesn't support Geolocation
	// 	handleLocationError(false, infoWindow, map.getCenter());
	// }

	if (getUrlVars()["searched"] == "true") {
		var nama = getUrlVars()["nama"];
		var status = getUrlVars()["status"];
		var min = getUrlVars()["min"];
		var max = getUrlVars()["max"];
		var url = "xml.php?searched=true&nama="+nama+"&status="+status+"&min="+min+"&max="+max;
	} else if (getUrlVars()["searched"] == "click") {
		var url = "xml.php?searched=click&key="+getUrlVars()["key"];
	} else {
		var url = "xml.php?searched=false";
	}
	downloadUrl(url, function(data) {
		var xml = data.responseXML;
		var markers = xml.getElementsByTagName('marker');
		Array.prototype.forEach.call(markers, function(markerElem) {
		  var id = markerElem.getAttribute("id");
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

			// Info Nama Kost
			strong.textContent = nama
			infowincontent.appendChild(strong);
			infowincontent.appendChild(document.createElement('br'));

			// Info Kamar tersedia
			var text = document.createElement('text');
			text.textContent = "Kamar tersedia : "+tersedia;
			infowincontent.appendChild(text);
			infowincontent.appendChild(document.createElement('br'));

			// Info harga 3 bulan
			var harga3bulan = document.createElement('text');
			harga3bulan.textContent = "Harga 3 Bulan : Rp."+harga_3bulan+",-";
			infowincontent.appendChild(harga3bulan);
			infowincontent.appendChild(document.createElement('br'));

			// Info harga 6 bulan
			var harga6bulan = document.createElement('text');
			harga6bulan.textContent = "Harga 6 Bulan : Rp."+harga_6bulan+",-";
			infowincontent.appendChild(harga6bulan);
			infowincontent.appendChild(document.createElement('br'));

			// Info harga pertahun
			var hargapertahun = document.createElement('text');
			hargapertahun.textContent = "Harga pertahun : Rp."+harga_pertahun+",-";
			infowincontent.appendChild(hargapertahun);
			infowincontent.appendChild(document.createElement('br'));
			infowincontent.appendChild(document.createElement('br'));


			var a = document.createElement('a');
			a.appendChild(document.createTextNode("Lihat Detail"));
			a.title = nama;
			a.class = "btn btn-info btn-xs";
			a.href = "?page=detail&key="+id;
			infowincontent.appendChild(a);

			var marker = new google.maps.Marker({
				map: map,
				icon: markerImage,
				position: point,
		    animation: google.maps.Animation.DROP,
				draggable : IsDraggable
			});

			// set coordinate to textfield
			google.maps.event.addListener(marker, "dragend", function(event) {
				document.getElementById("latitude1").value = this.getPosition().lat();
				document.getElementById("longitude1").value = this.getPosition().lng();
				document.getElementById("latitude2").value = this.getPosition().lat();
				document.getElementById("longitude2").value = this.getPosition().lng();
			});

			google.maps.event.addListener(marker, 'click', function(event) {
				$.post("ajax.php", {"id": id});
      });

			marker.addListener('click', function() {
				infoWindow.setContent(infowincontent);
				infoWindow.open(map, marker);
			});

  		marker.addListener('click', toggleBounce);
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
function getUrlVars() {
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

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
	infoWindow.setPosition(pos);
	infoWindow.setContent(browserHasGeolocation ?
												'Error: The Geolocation service failed.' :
												'Error: Your browser doesn\'t support geolocation.');
}

function toggleBounce() {
  if (marker.getAnimation() !== null) {
    marker.setAnimation(null);
  } else {
    marker.setAnimation(google.maps.Animation.BOUNCE);
  }
}
