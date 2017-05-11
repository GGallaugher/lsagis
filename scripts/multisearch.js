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


// create feature store from parcels, binding it to the vector layer (defined in Layers.js)
store = new GeoExt.data.FeatureStore({
    layer: parcels,
	 fields: [
			{name: 'apn', type: 'string'},
			{name: 'latitude', type: 'double'},
			{name: 'longitude', type: 'double'},
			{name: 'address', type: 'string'}
			],
    proxy: new GeoExt.data.ProtocolProxy({
        protocol: new OpenLayers.Protocol.WFS({
            version: "1.1.0",
			url: '/geoserver/wms?',
			featureType: "parcels",
		   srsName: "EPSG:900913",
		   filter: theFilter
        }),    
    }), 
    autoLoad: true
});

// When data store is refreshed: zoom to extent of features and enable report button 
// or disable button if 0 features in store
store.on('load', function() {
    if (store.data.length> 0) {
        Heron.App.map.zoomToExtent(parcels.getDataExtent());
        $("#featureCount").html('Feature count: ' + parcels.features.length);
        reportbutton.enable();
  
   } else {
        if (searchFlag == true) {
            $("#featureCount").html('<b style="color: red">APN NOT FOUND</b>');
            $("#featureCount").fadeOut(100).fadeIn(100).fadeOut(100).fadeIn(100);
        } else {
            $("#featureCount").html('Feature count: 0');
        }
        reportbutton.disable();
    }  
})



searchHandler = function(){
    theAPNs = Ext.getCmp('apnlist').getValue();
    theAPNs = theAPNs.replace(/\s+/g, ''); //replace spaces with nothing
    theAPNs = theAPNs.replace(/-/g, '');  //replace dashes with nothing
    apns = theAPNs.split(",");
    theFilter.filters=[];
    for (var i = 0; i < apns.length; i++ ) {
      newFilter =  new OpenLayers.Filter.Comparison({
                type: OpenLayers.Filter.Comparison.LIKE,
                property: "apn",
                value: apns[i]
        }) 
      theFilter.filters.push(newFilter);
    }
    searchFlag = true;
    store.reload(); 
}
clearHandler = function(){
    theFilter.filters=[];
    store.reload();
    Ext.getCmp('apnlist').setRawValue('');
}

searchPanel = new Ext.form.FormPanel({
	title: 'Search by APN',

    standardSubmit: false,
    frame:false,
    border: false,
    padding: 10,
    defaultType: 'textfield',
    labelWidth: 130,
    width: 325,
    height: 110,
 	bodyStyle:{"background-color":"#DFE8F6"},   
   // bodyStyle:{"background-color":"#DFE8F6"},
    items: [{
            
			fieldLabel: 'Enter an APN (format: 0123-456-789)',
			
            width: 170,
            name: 'enterapns',
            allowBlank:false,
            id: 'apnlist'
            }],
    buttons: [
    {
       text: 'Clear',
       handler: clearHandler
    },
    {
        text: 'Search',
        handler: searchHandler   
    }],
    keys: [
        { key: [Ext.EventObject.ENTER], handler: searchHandler
        }
    ]             
});

// create grid panel configured with feature store
gridPanel = new Ext.grid.GridPanel({
    store: store,
    height: 150,
    border: false,
    columns: [{
        header: "APN",
        dataIndex: "apn",
        width: 70
    }, 
	{
        header: "Address",
        dataIndex: "address",
        width: 60
    },
	],
    sm: new GeoExt.grid.FeatureSelectionModel() 
});






var box = new Ext.BoxComponent({
	html: '<p id="featureCount" style="font-size: 10px; margin-left: 5px; font-family: Trebuchet MS; margin:auto;line-height: 22px;">Feature count: 0</p>',
	columnWidth: 0.7
});

var reportButtonHandler = function () {
	var content;
	var theURL = "apn_process.php?";
	for (var i=0; i < store.data.items.length; i++){
		theURL = theURL + "apn=" + store.data.items[i].data.apn;
	}
	$.blockUI({ message: '<p style="font-family: Trebuchet MS, Helvetica, sans-serif; font-weight: bold; padding: 25px;"><img src="busy.gif" /> Running Analysis...</h1>' }); 
	//get the file
	$.ajax({
	  type: "GET",
	  url: theURL,
	  dataType: "html",
	  success : function(data) {
	  				$.unblockUI();
	                content = data;
					Ext.fly("report-content").update(content);
					reportWin.show(this);
	            }
	});
}
var reportbutton = new Ext.Button({
	text: "Generate Report",
	columnWidth: 0.3,
	handler: reportButtonHandler,
	disabled: true
});


resultsPanel = new Ext.Panel({
    region: "south",
    //height: 38,
    padding: 5,
    width: 320,
    border: false,
    layout: 'column',
    align: 'middle',
    pack: 'center',
    bodyStyle:{"background-color":"#f5f4ec", "display":"table"},
   // html: '<div style="display: table-cell;vertical-align: middle;"><p id="featureCount" style="font-size: 10px; margin-left: 5px; font-family: Trebuchet MS; ">Feature count: 0</p></div>',
  /* buttons: [{
        text: 'Search',
        handler: searchHandler, 
        border: false,  
    }],*/
    items: [box, reportbutton]
});

panelWrap = new Ext.Panel({
	border: false,
	items: [searchPanel, gridPanel, resultsPanel],
	 	bodyStyle:{"background-color":"#f5f4ec"}
});

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



