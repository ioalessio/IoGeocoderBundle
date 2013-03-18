function init_maps(id) {
        var mapOptions = { center: new google.maps.LatLng(-34.397, 150.644), zoom: 8, mapTypeId: google.maps.MapTypeId.ROADMAP };        
        return map = new google.maps.Map(document.getElementById(id), mapOptions);    
}


$(function(){
        var el = $('.geocoder_maps_widget');
        
        var lat  = $($(el).attr('data-latitude'));
        var lon  = $($(el).attr('data-longitude'));
        var addr = $($(el).attr('data-address'));
        
        //inizialize maps
        //var el = $(this);    
        var map = init_maps(el.attr('id'));    
        
        //events
        google.maps.event.addListener(map, 'click', function(event) { 
            var location = event.latLng;
                var marker = new google.maps.Marker({
                      position: location,
                      draggable: true,
                      map: map
                  });
              lat.val(location.lat);
              lon.val(location.lon);
              map.setCenter(location);        
              
                google.maps.event.addListener(marker, 'dragend', function(event) { 
                    lat.val(marker.position.lat);
                    lon.val(marker.position.lon);
                    map.setCenter(marker.position);
                });
              
        } );
        
        
    //callback
});
 
//$(document).on('click', '.geocoder_maps_widget', function(e) { });