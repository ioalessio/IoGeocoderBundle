//i should pass map options by a global configuration
function init_maps(id) {
    
        var mapOptions = {
            zoom: 12,
            disableDefaultUI: true,
            center: new google.maps.LatLng(40.616667, 14.366667),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };        
        return map = new google.maps.Map(document.getElementById(id), mapOptions);    
}

//i should manage this script as event for ajax pages
$(function(){
        var el = $('.geocoder_maps_widget');
        
        var addr = $($(el).attr('data-address'));
        
        //inizialize maps
        //var el = $(this);    
        var map = init_maps(el.attr('id'));    
        
        //events
        var oldmarker;        
        google.maps.event.addListener(map, 'click', function(event) { 
            //remove old markers
            if(oldmarker)
                oldmarker.setMap(null);
            //create marker
            var marker = new google.maps.Marker({
                      position: event.latLng,
                      draggable: true,
                      map: map
                });
             oldmarker = marker;
             //update form
              $("#"+$(el).attr('data-latitude')).val(marker.position.lat());
              $("#"+$(el).attr('data-longitude')).val(marker.position.lng());
              //center map
              map.setCenter(marker.position);        
              //update form on drag
              google.maps.event.addListener(marker, 'dragend', function(event) { 
                    $("#"+$(el).attr('data-latitude')).val(marker.position.lat());
                    $("#"+$(el).attr('data-longitude')).val(marker.position.lng());
                    map.setCenter(marker.position);
              });
        });
        //implementing suggest 
        $("#" + $(el).attr('data-suggest') ).on('change', function(event){
            //create a dropdown
            var suggest = $(this);
            suggest.parent().addClass('dropdown');
            suggest.addClass('dropdown-toggle');
            suggest.parent().attr('data-toggle', 'dropdown')
            //geocoder api request
            $.getJSON( $(el).attr('data-link'), {'address': $(this).val(), 'sensor' : false }, function(data) {                   
                    var suggests = $("<ul>");
                    suggests.attr('class', 'dropdown-menu');
                    suggest.parent().addClass('open');
                    //for each result -> render dropdown
                    $.each(data.results, function(key, val) {
                        var item  = $("<li>");
                        item.attr('data-address', val.formatted_address);
                        item.attr('data-latitude', val.geometry.location.lat);
                        item.attr('data-longitude', val.geometry.location.lng);
                        item.html("<a>"+val.formatted_address+"</a>");
                        suggests.append(item);
                        //on click of a item -> update form and map
                        item.on('click', function(){
                            if(oldmarker)
                                oldmarker.setMap(null);                           
                            var marker = new google.maps.Marker({
                                      position: new google.maps.LatLng(item.attr('data-latitude'), item.attr('data-longitude')),
                                      draggable: true,
                                      map: map
                            });
                            map.setCenter(marker.position); 
                            oldmarker = marker;
                            google.maps.event.addListener(marker, 'dragend', function(event) { 
                                  $("#"+$(el).attr('data-latitude')).val(marker.position.lat());
                                  $("#"+$(el).attr('data-longitude')).val(marker.position.lng());
                                  map.setCenter(marker.position);
                            });                            
                            $("#"+$(el).attr('data-address')).val(item.attr('data-address'));                            
                            $("#"+$(el).attr('data-latitude')).val(marker.position.lat());
                            $("#"+$(el).attr('data-longitude')).val(marker.position.lng());
                            suggest.parent().removeClass('open');
                        });
                      });

                    suggest.parent().append(suggests) ;
                    suggest.on('focus', function() { $(this).parent().addClass('open') });
              });
        });
        
    //callback
});
 
//$(document).on('click', '.geocoder_maps_widget', function(e) { });