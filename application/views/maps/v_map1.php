
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html> 
 <head> 
  <title>Google Maps</title> 
    <script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=false&amp;key=ABQIAAAAPDUET0Qt7p2VcSk6JNU1sBSM5jMcmVqUpI7aqV44cW1cEECiThQYkcZUPRJn9vy_TWxWvuLoOfSFBw" type="text/javascript"></script> 
    <script type="text/javascript"> 
    //<![CDATA[
 
    // global arrays to hold copies of the markers used by the side_bar
    var gmarkers = [];
    
    // global "map" variable
    var map;
 
    // This function picks up the click and opens the corresponding info window
    function myclick(i) {
      GEvent.trigger(gmarkers[i], "click");
    }
    
    // This function zooms in or out
    // its not necessary to check for out of range zoom numbers, because the API checks
    function myzoom(a) {
      map.setZoom(map.getZoom() + a);
    }
 
    function onLoad() {
     if (GBrowserIsCompatible()) {
      // this variable will collect the html which will eventualkly be placed in the side_bar
      var side_bar_html = "";
 
      // A function to create the marker and set up the event window
      function createMarker(point,name,html) {
        var marker = new GMarker(point);
        GEvent.addListener(marker, "click", function() {
          marker.openInfoWindowHtml(html);
        });
        // save the info we need to use later for the side_bar
        gmarkers.push(marker);
        // add a line to the side_bar html
        side_bar_html += '<a href="javascript:myclick(' + (gmarkers.length-1) + ')">' + name + '<\/a><br>';
        return marker;
      }
 
      // create the map using the global "map" variable
      map = new GMap2(document.getElementById("map"));
      map.addControl(new GLargeMapControl());
      map.addControl(new GMapTypeControl());
      map.setCenter(new GLatLng(-33.41620079432061, -70.72802782058716), 9);
 
      // add the points    
//      var point = new GLatLng( 43.65654,-79.90138);
//      var marker = createMarker(point,"This place","Some stuff to display in the<br>First Info Window")
//      map.addOverlay(marker);

 	  <?php foreach($arrResult as $arrRow){?>
 	  	
      var point = new GLatLng( <?=$arrRow['latitud'].",".$arrRow['longitud']?>);
      var marker = createMarker(point,"<?=$arrRow['nombre_ubicacion']?>",'<?=$arrRow['nombre_ubicacion']?>')
      map.addOverlay(marker);
      
      <?php }?>	
      //var point = new GLatLng(43.82589,-79.10040);
      //var marker = createMarker(point,"The other place","Some stuff to display in the<br>Third Info Window")
      //map.addOverlay(marker);
                       
                       
      // put the assembled side_bar_html contents into the side_bar div
      document.getElementById("side_bar").innerHTML = side_bar_html;
      
    }
 
    else {
      alert("Sorry, the Google Maps API is not compatible with this browser");
    }
   } // end of onLoad function
 
    // This Javascript is based on code provided by the
    // Community Church Javascript Team
    // http://www.bisphamchurch.org.uk/   
    // http://econym.org.uk/gmap/
 
   //]]>
  </script> 
 
  </head> 
  <body onload="onLoad()" onunload="GUnload()"> 
 
    <!-- you can use tables or divs for the overall layout --> 
    <table border=1> 
      <tr> 
        <td> 
           <div id="map" style="width: 550px; height: 450px"></div> 
        </td> 
        <td width = 150 valign="top" style="text-decoration: underline; color: #4444ff;"> 
           <div id="side_bar"></div> 
           <hr /> 
           <a href="javascript:myzoom(5)">Zoom +5</a><br /> 
           <a href="javascript:myzoom(1)">Zoom +1</a><br /> 
           <a href="javascript:myzoom(-1)">Zoom -1</a><br /> 
           <a href="javascript:myzoom(-5)">Zoom -5</a><br /> 
        </td> 
      </tr> 
    </table> 
    <a href="basic5.htm">Back to the tutorial page</a> 
 
 
    <noscript><b>JavaScript must be enabled in order for you to use Google Maps.</b> 
      However, it seems JavaScript is either disabled or not supported by your browser. 
      To view Google Maps, enable JavaScript by changing your browser options, and then 
      try again.
    </noscript> 
 <p>para copiar latitud logitud </p>
 <p>javascript:void(prompt('',gApplication.getMap().getCenter()));</p>
 
  </body> 
 
</html> 
 
 
 
 