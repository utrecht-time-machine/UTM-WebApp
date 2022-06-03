


//mapbox



$(document).ready(function(){



//ini



	var mapbox = L.map('map_embed',{
		attributionControl: false,
		tap: false
	}).setView([utmmap_init.lat, utmmap_init.lon], utmmap_init.zoom);
	var tile = L.tileLayer(utmmap_init.uri,{
		maxZoom: 20,
		attribution: '',
		id: 'mapbox/streets-v11',
		tileSize: 512,
		zoomOffset: -1
	}).addTo(mapbox);
	mapbox.zoomControl.setPosition('topright');



//add markers



	var cluster = L.markerClusterGroup();
	for(var i = 0; i < utmmap_data.length; i++){
		marker = new L.marker([utmmap_data[i].lat, utmmap_data[i].lon],{
			icon: L.divIcon({
				iconSize: 24,
				className: 'utm-marker',
			})
		}).bindPopup(utmmap_data[i].box);
		cluster.addLayer(marker);
	}
	mapbox.addLayer(cluster);



//scrollwheel



	if(utmmap_init.scroll === false){
		mapbox.scrollWheelZoom.disable();
	}



//user geo



	function geo_user(a){
		if(typeof marker_user !== 'undefined'){
			if(mapbox.hasLayer(marker_user)){
				mapbox.removeLayer(marker_user);
			}
		}
		marker_user = new L.marker([a.coords.latitude, a.coords.longitude],{
			icon: L.divIcon({
				iconSize: 24,
				className: 'utm-marker-user',
			})
		}).addTo(mapbox);
		mapbox.flyTo([a.coords.latitude, a.coords.longitude], 16);
	}
	function geo_fail(a){
		clearTimeout(geo_err);
		var b = $('.geo-fail');
		b.find('div').removeClass('on');
		switch(a.code){
			case a.PERMISSION_DENIED:
				b.find('div[data-id="2"]').addClass('on');
			break;
			default:
				b.find('div[data-id="1"]').addClass('on');
			break;
		}
		b.addClass('on');
		geo_err = setTimeout(function(){
			$('.geo-fail').removeClass('on');
		}, 5000);
	}
	var geo_err;
	$('a.geo-user').click(function(){
		if(navigator.geolocation){
			navigator.geolocation.getCurrentPosition(function(position){
				geo_user(position);
			}, function(errormsg){
				geo_fail(errormsg);
			});
		} else{
			geo_fail(false);
		}
	});
});