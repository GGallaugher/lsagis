
//Feature selection style
OpenLayers.Feature.Vector.style={
	"default":{
		fillColor:"#ee9900",
		fillOpacity:0.0,
		hoverFillColor:"white",
		hoverFillOpacity:0.8,
		strokeColor:"#FFFF00",
		strokeOpacity:0.8,
		strokeWidth:2,
		strokeLinecap:"round",
		strokeDashstyle:"solid",
		hoverStrokeColor:"red",
		hoverStrokeOpacity:1,
		hoverStrokeWidth:0.2,
		pointRadius:6,
		hoverPointRadius:1,
		hoverPointUnit:"%",
		pointerEvents:"visiblePainted",
		cursor:"inherit",
		fontColor:"#000000",
		labelAlign:"cm",
		labelOutlineColor:"white",
		labelOutlineWidth:3
		},

	select:{
		fillColor:"blue",
		fillOpacity:0.0,
		hoverFillColor:"white",
		hoverFillOpacity:0.8,
		strokeColor:"#FF0000",
		strokeOpacity:1,
		strokeWidth:3,
		strokeLinecap:"round",
		strokeDashstyle:"solid",
		hoverStrokeColor:"red",
		hoverStrokeOpacity:1,
		hoverStrokeWidth:0.2,
		pointRadius:6,
		hoverPointRadius:1,
		hoverPointUnit:"%",
		pointerEvents:"visiblePainted",
		cursor:"pointer",
		fontColor:"#000000",
		fontColor:"#000000",
		labelAlign:"cm",
		labelOutlineColor:"white",
		labelOutlineWidth:3},
		
	temporary:{
		fillColor:"#66cccc",
		fillOpacity:0.2,
		hoverFillColor:"white",
		hoverFillOpacity:0.8,
		strokeColor:"#66cccc",
		strokeOpacity:1,
		strokeLinecap:"round",
		strokeWidth:2,
		strokeDashstyle:"solid",
		hoverStrokeColor:"red",
		hoverStrokeOpacity:1,
		hoverStrokeWidth:0.2,
		pointRadius:6,
		hoverPointRadius:1,
		hoverPointUnit:"%",
		pointerEvents:"visiblePainted",
		cursor:"inherit",
		fontColor:"#000000",
		labelAlign:"cm",
		labelOutlineColor:"white",
		labelOutlineWidth:3},
		
	"delete":{
		display:"none"}
	};

 

controls : [
     new OpenLayers.Control.Attribution(),
     new OpenLayers.Control.ZoomBox(),
     new OpenLayers.Control.Navigation({dragPanOptions: {enableKinetic: true}}),
     new OpenLayers.Control.LoadingPanel(),
     new OpenLayers.Control.PanPanel(),
     new OpenLayers.Control.ZoomPanel(),
     new OpenLayers.Control.OverviewMap(),
     new OpenLayers.Control.ScaleLine({geodesic: true, maxWidth: 200})
     ] 

	
	
	
Heron.options.map.layers = [

    /*
     * ==================================
     *            BaseLayers
     * ==================================
     */new OpenLayers.Layer.Google(
			"Google Streets", // the default
			{type: google.maps.MapTypeId.ROADMAP, visibility: true, transparent: false},
			{singleTile: false, buffer: 0, isBaseLayer: true}
	),
	 
	 	new OpenLayers.Layer.Google(
			"Google Satellite",
			{type: google.maps.MapTypeId.HYBRID, visibility: false},
			{singleTile: false, buffer: 0, opacity: 0.75, isBaseLayer: true}
	), 
	 	gHyb = 	new OpenLayers.Layer.Google(
			"Google Terrain",
			{type: google.maps.MapTypeId.TERRAIN, visibility: false},
			{singleTile: false, buffer: 0, isBaseLayer: true}
	),	


	

	





	
		
	

	
	
	
    /*
     * ==================================
     *       All Other Layers
     * ==================================
     */



	
		
		new OpenLayers.Layer.WMS(
	"Parcels",
		'/geoserver/wms/?',
		{layers: "cultural:bre_parcels", transparent: true, format: 'image/png', tiled: true},
		{singleTile: false, opacity: 1.0, isBaseLayer: false, visibility: false, noLegend: true,  numZoomLevels: 21,  featureInfoFormat: 'application/vnd.ogc.gml'}
	),		

	

	
	
	
	
	
	
	
	
	

	
	
	new OpenLayers.Layer.WMS(
	"LSA Projects",
		'/geoserver/wms/?',
		{layers: "lsa_projects:all_projects", transparent: true, format: 'image/png', tiled: false},
{singleTile: false, opacity: 0.9, isBaseLayer: false,  visibility: true, noLegend: false, maxExtent: new OpenLayers.Bounds(-13730611.8526507, 4241378.71827572, -13265036.4612667, 4756795.86861863),  featureInfoFormat: 'application/vnd.ogc.gml', 
                metadata: {
                    wfs: {
                        protocol: 'fromWMSLayer',
                        featurePrefix: 'lsa_projects',
						srsName: 'EPSG:4326',
                        featureNS: 'http://lsagis.net/lsa',
						
                        maxQueryLength: 10000
                    }
                }}
    ),




					new OpenLayers.Layer.WMS(
	"California Counties",
		'/geoserver/wms/?',
		{layers: "lsagis:ca_counties", transparent: true, format: 'image/png', tiled: true},
		{singleTile: false, opacity: 1.0, isBaseLayer: false, maxExtent: new OpenLayers.Bounds(-13855553.2711848, 3827387.38203803, -12699255.5230021, 5169503.17454742), visibility: false, noLegend: false,    featureInfoFormat: 'application/vnd.ogc.gml'}
	),	


	
		
	parcels = new OpenLayers.Layer.Vector("Parcel Search Results", {noLegend: true, featureInfoFormat: 'application/vnd.ogc.gml'}),
	markers = new OpenLayers.Layer.Vector("Search", {metadata: {legend: {hideInLegend: true}}})
    //Heron.App.map.addLayer(markers);
 ];
 
// Layers are organized in the application using the Layer Tree below:
var newLayertree = [

	
		{
		text:'Layers', nodeType: 'hr_cascader',  expanded: true, children:
			[	
	{nodeType: 'gx_layer', layer: 'LSA Projects'},
		{nodeType: 'gx_layer', layer: 'California Counties'},
				
				
			]
	},	
	
	{
		text:'Base Layers', nodeType: "gx_baselayercontainer", expanded: true
	}	
];


Ext.namespace("Heron.options.bookmarks");
Heron.options.bookmarks =
    [{	
				id: 'IA1',
				name: 'Industrial Alternative - 1',
				desc: 'Industrial Alternative - 1',
				layers: ['Industrial Alternative - 1'],
				x: -13574002.82012530,
				y: 4622403.81868752,
				zoom: 16
	}
        
    ];
// Replace default layer browser DefaultConfig.js
// Pass our theme tree config as an option
Ext.namespace("Heron.options.layertree");
Heron.options.layertree.tree = newLayertree;

