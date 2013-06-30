<body onload="initialize()">
<div class="map_operate"><a href="javascript:calcRoute();">查看路线</a></div>

<div class="google_maps">
 
 <div id="google_maps_cav">
   
 </div>
</div>
</body>



<script type="text/javascript">

var directionDisplay;
var directionsService = new google.maps.DirectionsService();
var map;
var geocoder;
var json_trave_area_datas=<?= $json_trave_area_datas; ?>;
function initialize() {

	var center="<?= $trave_region ?>";
  directionsDisplay = new google.maps.DirectionsRenderer();
  var myOptions = {
    zoom:8,
    mapTypeControl: true,
    mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
    navigationControl: true,
    navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL},
    scaleControl: true,
    scaleControlOptions: {
        position: google.maps.ControlPosition.TOP_LEFT
    },  
   // center:latlng,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    streetViewControl: true
  }
  
  map = new google.maps.Map(document.getElementById("google_maps_cav"), myOptions);
  //var marker = new google.maps.Marker({
     //  map: map, 
  //});
 // marker.setPosition(latlng);
  codeAddress(center);
  directionsDisplay.setMap(map);
} 



//codeAddress("shanghai");
  function codeAddress(address) {

  	geocoder = new google.maps.Geocoder();
    if (geocoder) {
      geocoder.geocode( { 'address': address}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
         var marker = new google.maps.Marker({
             map: map, 
             position: results[0].geometry.location
         });
          map.setCenter(results[0].geometry.location);
        }
      });
    }
  }

function calcRoute(){
  var start = "<?= $trave_sregion ?>";
  var end = "<?= $trave_region ?>";
  var s_latlng="";
  var e_latlng="";
  if (geocoder) {
      geocoder.geocode( { 'address': start}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
        	s_latlng=results[0].geometry.location;
        } 
      });
      geocoder.geocode( { 'address': end}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
        	e_latlng=results[0].geometry.location;
        	var request = {
    				origin:s_latlng, 
    				destination:e_latlng,
   				  travelMode: google.maps.DirectionsTravelMode.DRIVING
  				};
 				 directionsService.route(request, function(result, status) {
   			 	if (status == google.maps.DirectionsStatus.OK) {
      				directionsDisplay.setDirections(result);
    				}
  				});
        } 
      });
    }  
}

function set_trave_area(){
	  geocoder = new google.maps.Geocoder();
    if (geocoder) {
    	  var area_len=json_trave_area_datas.length;
    	  for(var ii=0;ii<area_len;ii++){
    	  	
        geocoder.geocode( { 'address':json_trave_area_datas[ii].name}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
         var len=results.length;
         
         for(var ii=0;ii<len;ii++){
         	//map.setCenter(results[ii].geometry.location);
          var marker = new google.maps.Marker({
             map: map, 
             icon:'/css/images/io.png',
             position: results[ii].geometry.location
          });
        }

        }
      });
     }
    }
}
</script>

   
   
   

