<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">



    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/navbar.css">

    <!-- Custom JavaScript -->
    
    <script src="https://unpkg.com/axios/dist/axios.js"></script>
    <script src="js/attraction.js"></script>
    <script src="https://kit.fontawesome.com/fbf5c5a506.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/vue@next"></script>

</head>
<body>
    <!-- Navigation -->
    <div id="navdiv">
        <include-navbar></include-navbar>
    </div>

    <div class="searchbar">
        <div class="row g-2 my-2">
            <div class="col-md-6 col-sm-6">
                <div class="form-floating ">
                  <select class="form-select" id="floatingSelectGrid" aria-label="Floating label select example" >
                    <option selected></option>
                    <option value="1">Adventure</option>
                    <option value="2">Arts</option>
                    <option value="3">History & Culture</option>
                    <option value="4">Leisure & Recreation</option>
                    <option value="5">Nature & Wildlife</option>
                    <option value="6">Others</option>
                  </select>
                  <label for="floatingSelectGrid">Search by category</label>
                </div>
              </div>

            <div class="col-md-6 col-sm-6">
              <div class="form-floating ">
                <select class="form-select" id="floatingSelectGrid" aria-label="Floating label select example" >
                  <option selected></option>
                  <option value="1">North</option>
                  <option value="2">South</option>
                  <option value="3">East</option>
                  <option value="4">West</option>
                </select>
                <label for="floatingSelectGrid">Search by area</label>
              </div>
            </div>

           
        <div class="input-group mb-3 my-3">
            
                <input id="keyword" type="form" class="form-control me-2" placeholder="Search attraction by any keword!" aria-label="Search">
                <button onclick="initMap()" class="btn btn-danger" type="submit">Search</button>
            
        </div>


        
        </div>

        <div id="map" class="map-responsive">
        </div>
        

    <!--Load the API from the specified URL
    * The async attribute allows the browser to render the page while the API loads
    * The key parameter will contain your own API key 
    * The callback parameter executes the initMap() function
    -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDT6sTbyN3xQA9bTHQYcyFVXsqAXT54zfE&callback=initMap"
        async defer></script>

    
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <script>

            
var myStyle = [
       {
         featureType: "administrative",
         elementType: "labels",
         stylers: [
           { visibility: "off" }
         ]
       },{
         featureType: "poi",
         elementType: "labels",
         stylers: [
           { visibility: "off" }
         ]
       },{
         featureType: "water",
         elementType: "labels",
         stylers: [
           { visibility: "off" }
         ]
       },{
         featureType: "road",
         elementType: "labels",
         stylers: [
           { visibility: "off" }
         ]
       }
     ]; 
   



function initMap() {
        const map = new google.maps.Map(document.getElementById("map"), {
        
                zoom: 11.7,
                center: { lat: 1.3649170000000002, lng: 103.82287200000002 },
                styles: [    
        {
            featureType: "poi",
            elementType: "labels",
            stylers: [{ visibility: "off" }]
        }
    ]
            });

            setMarkers(map);
            }

            // Data for the markers consisting of a name, a LatLng and a zIndex for the
            // order in which these markers should display on top of each other.
    

    //const location_list=[[1.360261, 103.9892345],[1.360261, 103.9892345]];
    // [{lantitie:1.3,longitute:103}]
    
    //console.log(location_list);
    

  //  const hardcode_locations=[{latitude:1.360261,longitude:103.9892345},[1.2890235,103.8484538],[1.3016419,103.838816],[1.395499,103.924187],[1.256148,103.821552]
//,[1.2540421,103.8238084],[1.3600727,103.9897102],[1.360208,103.989759],[1.255179,103.8218107],[1.28218,103.84415],[1.2711456,103.8195228]];

    
    var keyword = document.getElementById("keyword");

    function setMarkers(map){
            var options = {
            method: 'GET',
            url: 'https://tih-api.stb.gov.sg/content/v1/attractions/search?keyword='+document.getElementById('keyword').value+'&language=en&apikey=UnWhZ0GbjpzxKlcM9GssA3xbSio89mM2'
            };
            var locations_list=[];
            axios.request(options)
            .then(response=>{
                var attractionData=response.data.data;
                
            
                for (i=0; i<response.data.data.length; i++){
                    // console.log(locations_list)
                    var lat=attractionData[i].location.latitude
                    var lng=attractionData[i].location.longitude
                    var desc = attractionData[i].description;

                    var name = attractionData[i].name; 
              // console.log(attractionData)

                    var type = attractionData[i].type; 
                    // console.log(lat, lng)
                    // var each_location={lat:location.latitude,lng:location.longitude}
                    locations_list.push({attractionName:name,category:type, desc:desc,latitude:lat,longitude:lng})
                    
                }
                const image_adventure = {
                    url: "https://img.icons8.com/fluency/48/000000/adventure.png",
                    // This marker is 20 pixels wide by 32 pixels high.
                    size: new google.maps.Size(30, 48),
                    scaledSize: new google.maps.Size(30, 48),
                    // The origin for this image is (0, 0).
                    origin: new google.maps.Point(0, 0),
                    // The anchor for this image is the base of the flagpole at (0, 32).
                    anchor: new google.maps.Point(0, 32),
                };
                const image_arts = {
                    url:"https://img.icons8.com/external-konkapp-outline-color-konkapp/64/000000/external-art-back-to-school-konkapp-outline-color-konkapp.png",
                    // This marker is 20 pixels wide by 32 pixels high.
                    size: new google.maps.Size(30, 48),
                    scaledSize: new google.maps.Size(30, 48),
                    // The origin for this image is (0, 0).
                    origin: new google.maps.Point(0, 0),
                    // The anchor for this image is the base of the flagpole at (0, 32).
                    anchor: new google.maps.Point(0, 32),
                };
                const image_history_culture = {
                    url: "https://img.icons8.com/external-becris-lineal-color-becris/64/000000/external-history-literary-genres-becris-lineal-color-becris.png",
                    // This marker is 20 pixels wide by 32 pixels high.
                    size: new google.maps.Size(30, 48),
                    scaledSize: new google.maps.Size(30, 48),
                    // The origin for this image is (0, 0).
                    origin: new google.maps.Point(0, 0),
                    // The anchor for this image is the base of the flagpole at (0, 32).
                    anchor: new google.maps.Point(0, 32),
                };
                const image_nature_wildlife = {
                    url: "https://img.icons8.com/fluency/48/000000/wildlife.png",
                    // This marker is 20 pixels wide by 32 pixels high.
                    size: new google.maps.Size(30, 48),
                    scaledSize: new google.maps.Size(30, 48),
                    // The origin for this image is (0, 0).
                    origin: new google.maps.Point(0, 0),
                    // The anchor for this image is the base of the flagpole at (0, 32).
                    anchor: new google.maps.Point(0, 32),
                };
                const image_leisure_recreation = {
                    url: "https://img.icons8.com/fluency/48/000000/nintendo-switch-pro-controller.png",
                    // This marker is 20 pixels wide by 32 pixels high.
                    size: new google.maps.Size(30, 48),
                    scaledSize: new google.maps.Size(30, 48),
                    // The origin for this image is (0, 0).
                    origin: new google.maps.Point(0, 0),
                    // The anchor for this image is the base of the flagpole at (0, 32).
                    anchor: new google.maps.Point(0, 32),
                };
                
                const image_others = {
                    url: "https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png",
                    // This marker is 20 pixels wide by 32 pixels high.
                    size: new google.maps.Size(30, 48),
                    scaledSize: new google.maps.Size(30, 48),
                    // The origin for this image is (0, 0).
                    origin: new google.maps.Point(0, 0),
                    // The anchor for this image is the base of the flagpole at (0, 32).
                    anchor: new google.maps.Point(0, 32),
                };
                // Shapes define the clickable region of the icon. The type defines an HTML
                // <area> element 'poly' which traces out a polygon as a series of X,Y points.
                // The final coordinate closes the poly by connecting to the first coordinate.
                const shape = {
                    coords: [1, 1, 1, 20, 18, 20, 18, 1],
                    type: "poly",
                };
                console.log(locations_list)
                
                for (let i = 0; i < locations_list.length; i++) {
                    var image;
                    
                    
                    var attraction_location = locations_list[i];
                    if (attraction_location.category=="Adventure"){
                        image=image_adventure;
                    } else if (attraction_location.category=="Arts"){
                        image=image_arts;
                    } else if (attraction_location.category=="Leisure & Recreation"){
                        image=image_leisure_recreation;
                    } else if (attraction_location.category=="History & Culture"){
                        image=image_history_culture;
                    } else if (attraction_location.category=="Nature & Wildlife"){
                        image=image_nature_wildlife;
                    } else if (attraction_location.category=="Others"){
                        image=image_others;
                    }
                    var marker=new google.maps.Marker({
                        
                    position: { lat: attraction_location.latitude, lng: attraction_location.longitude },
                    map,
                    icon: image,
                    shape: shape,
                    title: attraction_location.attractionName
                    
        
                    });
                    var content='<h3 style="color:Tomato">'+ attraction_location.attractionName + '</h3>' +'<div style="font-weight:bold">Attraction type: '+ attraction_location.category+'</div>'+'<br><div>' + attraction_location.desc+'<br></br>' +'</div>' +'<div><button type="button" style="color:black">I arrived here now!</button></div>'

                    var infowindow=new google.maps.InfoWindow()
                    google.maps.event.addListener(marker,'click', (function(marker,content,infowindow){ 
                    return function() {
                        infowindow.setContent(content);
                        infowindow.open(map,marker);
                        };
                    })(marker,content,infowindow)); 

                    
                }

            }).catch(function (error) {
            console.error(error);
            });
            
            
    }

   
           
       
        

        // console.log(locations_list[0])
        // console.log(typeof location_list[0]);
        // console.log(typeof locations_list[0].lat);
        
    
    
   
        
                        
            
    </script>
        
            
        

        <!-- Footer -->
    <!-- <script src="js/attraction.js"></script> -->
    <script src="js/attractions_donghyun.js"></script>
    <script src="js/navbar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

        
</body>
</html>