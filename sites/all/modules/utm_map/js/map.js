


//utm map



(function($){
	$(document).ready(function(){



//fetch map data



		var maps = {};
		var maps_init = Drupal.settings.utm_map_init;
		var maps_data = Drupal.settings.utm_map_data;
		Object.keys(maps_init).forEach(k => {
			var map = k;
			var map_setup = JSON.parse(maps_init[k]);



//init each map



			var maps_tiles;
			maps[map] = L.map(map, {attributionControl: false, tap: false}).setView([map_setup.lat, map_setup.lon], map_setup.dep);
			maps_tiles = L.tileLayer(map_setup.api,{
				maxZoom: 20,
				attribution: '',
				id: 'mapbox/streets-v11',
				tileSize: 512,
				zoomOffset: -1
			}).addTo(maps[map]);
			maps[map].zoomControl.setPosition('topright');



//add markers



			var map_data_cluster = L.markerClusterGroup();
			var map_data = JSON.parse(maps_data[k]);
			for(var i = 0; i < map_data.length; i++){
				marker = new L.marker([map_data[i].lat, map_data[i].lon],{
					icon: L.divIcon({
						iconSize: 24,
						className: 'utm-marker',
					})
				}).bindPopup(map_data[i].box);
				if(map_setup.nid == map_data[i].nid){
					marker.addTo(maps[map]).openPopup();
				} else{
					map_data_cluster.addLayer(marker);
				}
			}
			maps[map].addLayer(map_data_cluster);
		});



//block map index flyto



		$('.block-map .index a[data-lat][data-lon]').click(function(){
			var m = $(this).parents('.block-map').attr('data-map');
			maps[m].flyTo([$(this).attr('data-lat'), $(this).attr('data-lon')], 19);
		});



//user geo location



		function geo_show(position, geo_map){
			if(typeof marker_user !== 'undefined'){
				if(maps[geo_map].hasLayer(marker_user)){
					maps[geo_map].removeLayer(marker_user);
				}
			}
			marker_user = new L.marker([position.coords.latitude, position.coords.longitude],{
				icon: L.divIcon({
					iconSize: 24,
					className: 'utm-marker-user',
				})
			}).addTo(maps[geo_map]);
			maps[geo_map].flyTo([position.coords.latitude, position.coords.longitude], 16);
		}
		function geo_fail(error, div){
			clearTimeout(geo_err);
			var des = $('.geo-fail[data-map="'+div+'"]');
			des.find('div').removeClass('on');
			switch(error.code){
				case error.PERMISSION_DENIED:
					des.find('div[data-id="2"]').addClass('on');
				break;
				case error.POSITION_UNAVAILABLE:
					des.find('div[data-id="3"]').addClass('on');
				break;
				case error.TIMEOUT:
					des.find('div[data-id="4"]').addClass('on');
				break;
				case error.UNKNOWN_ERROR:
					des.find('div[data-id="5"]').addClass('on');
				break;
				default:
					des.find('div[data-id="1"]').addClass('on');
				break;
			}
			des.addClass('on');
			geo_err = setTimeout(function(){
				$('.geo-fail').removeClass('on');
			}, 5000);
		}
		var geo_err;
		$('a.geo-user-btn').click(function(){
			var geo_map = $(this).attr('data-map');
			if(navigator.geolocation){
				navigator.geolocation.getCurrentPosition(function(position){
					geo_show(position, geo_map);
				}, function(error){
					geo_fail(error, geo_map);
				});
			} else{
				geo_fail(false, geo_map);
			}
		});
	});
})(jQuery);