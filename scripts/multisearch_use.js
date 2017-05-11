/*
 * Multi Parcel Search and Report
 * multisearch.js
 * December 31, 2014
 * Steve Borgstrom
 *
 * Ext components to provide multiple apn
 * search and reporting functionality within Geobrowser
 *
 */
searchFlag = false;
theFilter = new OpenLayers.Filter.Logical({
    type: OpenLayers.Filter.Logical.OR,
    filters: []
})


//Add in Google address search functionality
googleSearchHandler = function(){
    searchAddress = Ext.getCmp('addressID').getValue(); 
    codeAddress(searchAddress);
    markers.removeAllFeatures();
};

googleClearHandler = function(){
    Ext.getCmp('addressID').setRawValue('');
    markers.removeAllFeatures();
};


codeAddress = function(addressSubmit) {
  var address = addressSubmit;
  geocoder.geocode( { 'address': address}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      gc = results[0];

      lon = gc.geometry.location.lng();
      lat = gc.geometry.location.lat();
      var proj = new OpenLayers.Projection("EPSG:4326");
      point = new OpenLayers.LonLat(lon,lat);
      point.transform(proj, Heron.App.map.getProjectionObject());
      //var mapPoint = new OpenLayers.Feature.Vector(new OpenLayers.Geometry.Point(point.lon, point.lat), {externalGraphic: 'marker.png', graphicHeight: 25, graphicWidth: 21, graphicXOffset:-12, graphicYOffset:-25});
      var feature = new OpenLayers.Feature.Vector(
        new OpenLayers.Geometry.Point(point.lon, point.lat),
        {} ,
        {externalGraphic: 'marker.png', graphicHeight: 25, graphicWidth: 21, graphicXOffset:-12, graphicYOffset:-25  }
        );
      markers.addFeatures(feature);
      if (gc.geometry.location_type == "ROOFTOP") {
        Heron.App.map.setCenter(point, 18);
      } else {
        Heron.App.map.setCenter(point, 13);
      }

    } else {
      alert('Not able to geocode your entry successfully.');
    }
  });
}

googleSearchPanel = new Ext.form.FormPanel({
    title: 'Find Location',
    standardSubmit: false,
    frame:false,
    border: false,
    padding: 10,
    defaultType: 'textfield',
    width: 325,
    height: 125,
    labelAlign: "top",
    buttonAlign: "center",
    bodyStyle:{"background-color":"#f5f4ec", "display":"table"},
    footerStyle:{"background-color":"#f5f4ec"},
   // bodyStyle:{"background-color":"#f5f4ec"},
    items: [{
            fieldLabel: 'Enter address, placename, or latitude and longitude in decimal degrees (i.e. 38.417, -121.881)',
            width: 300,
            name: 'address',
            allowBlank:false,
            id: 'addressID'
            }],
    buttons: [
    {
       text: 'Clear',
       handler: googleClearHandler
    },
    {
        text: 'Search',
        handler: googleSearchHandler   
    }],
    keys: [
        { key: [Ext.EventObject.ENTER], handler: googleSearchHandler
        }
    ]             
});
