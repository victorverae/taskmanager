
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html> 
  <head> 
    <title>Google Maps</title> 
    <script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=false&amp;key=ABQIAAAAPDUET0Qt7p2VcSk6JNU1sBSM5jMcmVqUpI7aqV44cW1cEECiThQYkcZUPRJn9vy_TWxWvuLoOfSFBw" type="text/javascript"></script> 
  </head> 
  <body onunload="GUnload()"> 
 
 
    <!-- you can use tables or divs for the overall layout --> 
    <table border=1> 
      <tr> 
        <td> 
           <div id="map" style="width: 550px; height: 450px"></div> 
        </td> 
        <td width = 150 valign="top" style="text-decoration: underline; color: #4444ff;"> 
           <div id="side_bar"></div> 
        </td> 
      </tr> 
    </table> 
    <form action="#"> 
      <input type="button" value="A" onclick='readMap("a")' /> 
      <input type="button" value="B" onclick='readMap("b")' /> 
      <input type="button" value="C" onclick='readMap("c")' /> 
    </form> 
 
    <a href="basic11.htm">Back to the tutorial page</a> 
 
 
    <noscript><b>JavaScript must be enabled in order for you to use Google Maps.</b> 
      However, it seems JavaScript is either disabled or not supported by your browser. 
      To view Google Maps, enable JavaScript by changing your browser options, and then 
      try again.
    </noscript> 
 
 
    <script type="text/javascript"> 
    //<![CDATA[
 
    if (GBrowserIsCompatible()) {
      var side_bar_html = "";
      var gmarkers = [];
      var htmls = [];
      var i = 0;
 
      // A function to create the marker and set up the event window
      function createMarker(point,name,html) {
        var marker = new GMarker(point);
        GEvent.addListener(marker, "click", function() {
          marker.openInfoWindowHtml(html);
        });
        gmarkers[i] = marker;
        htmls[i] = html;
        side_bar_html += '<a href="javascript:myclick(' + i + ')">' + name + '<\/a><br>';
        i++;
        return marker;
      }
 
 
      // This function picks up the click and opens the corresponding info window
      function myclick(i) {
        gmarkers[i].openInfoWindowHtml(htmls[i]);
      }
 
 
      // create the map
      var map = new GMap2(document.getElementById("map"));
      map.addControl(new GLargeMapControl());
      map.addControl(new GMapTypeControl());
      map.setCenter(new GLatLng( 43.907787,-79.359741), 9);
 
 
      // A function to read the data
      function readMap(url) {
        var url="map11.php?q="+url;
        var request = GXmlHttp.create();
        request.open("GET", url, true);
        request.onreadystatechange = function() {
          if (request.readyState == 4) {
            var xmlDoc = request.responseXML;
            // obtain the array of markers and loop through it
            var markers = xmlDoc.documentElement.getElementsByTagName("marker");
            
            // hide the info window, otherwise it still stays open where the removed marker used to be
            map.getInfoWindow().hide();
            
            map.clearOverlays();
            
            // empty the array
            gmarkers = [];
 
            // reset the side_bar
            side_bar_html="";
          
            for (var i = 0; i < markers.length; i++) {
              // obtain the attribues of each marker
              var lat = parseFloat(markers[i].getAttribute("lat"));
              var lng = parseFloat(markers[i].getAttribute("lng"));
              var point = new GLatLng(lat,lng);
              var html = markers[i].getAttribute("html");
              var label = markers[i].getAttribute("label");
              // create the marker
              var marker = createMarker(point,label,html);
              map.addOverlay(marker);
            }
            // put the assembled side_bar_html contents into the side_bar div
            document.getElementById("side_bar").innerHTML = side_bar_html;
          }
        }
        request.send(null);
      }
      
      // When initially loaded, use the data from "map11.php?q=a"
      readMap("a");
      
    }
 
    else {
      alert("Sorry, the Google Maps API is not compatible with this browser");
    }
 
    // This Javascript is based on code provided by the
    // Community Church Javascript Team
    // http://www.bisphamchurch.org.uk/   
    // http://econym.org.uk/gmap/
 
    //]]>
    </script> 
  </body> 
 
</html> 
 
 
 
 