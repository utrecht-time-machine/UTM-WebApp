


//form



$(document).ready(function(){
	var map_uri = base_path+'dev/embed/map/';



//build embed code



	function build_code(){
		var a1 = '<iframe src="';
		var a2 = '" width="800" height="500" frameborder="0"></iframe>';
		var b1 = $('select[name="var1"]').val();
		var b2 = $('select[name="var2"]').val();
		var b3 = $('select[name="zoom"]').val();
		var b4 = $('input[name="coor_lat"]').val();
		var b5 = $('input[name="coor_lon"]').val();
		var b6 = $('select[name="scroll"]').val();
		var b7 = $('select[name="banner"]').val();
		var param = [];
		if(b3 != '14'){
			param.push("zoom="+b3);
		}
		if(b4 != ''){
			b4 = b4.replace(',', '.');
			param.push("lat="+b4);
		}
		if(b5 != ''){
			b5 = b5.replace(',', '.');
			param.push("lon="+b5);
		}
		if(b6 != 'on'){
			param.push("scroll=off");
		}
		if(b7 != 'on'){
			param.push("banner=off");
		}
		var u = map_uri+b1+(b2 != 'none' ? '/'+b2 : '');
		if(param.length > 0){
			u += '?'+param.join('&');
		}
		u = a1+u+a2;
		$('#embed').val(u);
		$('#preview').html(u);
		return true;
	}



//update



	$('#embed').click(function(){
		$(this).select();
	});
	$('.form input,.form select').change(function(){
		build_code();
	});
	build_code();
});