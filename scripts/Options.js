/*
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

OpenLayers.Util.onImageLoadErrorColor = "transparent";
Ext.BLANK_IMAGE_URL = 'http://extjs.cachefly.net/ext-3.4.0/resources/images/default/s.gif';

// Settings for main map
Ext.namespace("Heron.options.map");
OpenLayers.ProxyHost = "/cgi-bin/proxy.cgi?url=";
Heron.globals.serviceUrl = '/cgi-bin/heron.cgi';
Heron.options.map.settings = {
						projection: 'EPSG:900913',
						displayProjection: new OpenLayers.Projection("EPSG:4326"),
						units: 'm',
						resolutions: [156543.03390625, 78271.516953125, 39135.7584765625, 19567.87923828125, 
						9783.939619140625, 4891.9698095703125, 2445.9849047851562, 1222.9924523925781, 611.4962261962891, 
						305.74811309814453, 152.87405654907226, 76.43702827453613, 38.218514137268066, 19.109257068634033, 
						9.554628534317017, 4.777314267158508, 2.388657133579254, 1.194328566789627, 0.5971642833948135, 
						0.29858214169740677, 0.14929107084870338, 0.07464553542435169, 0.037322767712175846, 0.018661383856087923, 
						0.009330691928043961, 0.004665345964021981, 0.0023326729820109904, 0.0011663364910054952, 5.831682455027476E-4, 
						2.915841227513738E-4, 1.457920613756869E-4],							
						center:(-13526793.7936846, 4516209.18994983),
			
						xy_precision: 7,
						zoom: 7,

						theme: null,
						ZoomLevels: 17,
						zoomOnRowDoubleClick: true
		
,

};

//Define elements of toolbar
Heron.options.map.toolbar = [
//    {type: "scale", options: {width: 110}},

    {type: "-"} ,
	{
		// Instead of an internal "type", or using the "any" type
		// provide a create factory function.
		// MapPanel and options (see below) are always passed
		create: function (mapPanel, options) {

			// A trivial handler
			options.handler = function () {
					win.show(this);
			};

			// Provide an ExtJS Action object
			// If you use an OpenLayers control, you need to provide a GeoExt Action object.
			return new Ext.Action(options);
		},

		/* Options to be passed to your create function. */
	
	},
	
    {type: "pan"},
    {type: "zoomin"},
    {type: "zoomout"},
    {type: "coordinatesearch", options: {iconCls: "icon-coordinatesearch", projEpsg: 'EPSG:4326', onSearchCompleteZoom: 5, fieldLabelX: 'lon (X)', fieldLabelY: 'lat (Y)', fieldEmptyTextX: 'Enter'}},
    {type: "-"} ,
    {type: "zoomprevious"},
    {type: "zoomnext"},
    {type: "-"},
    {type: "measurelength", options: {geodesic: true,
            control: new OpenLayers.Control.Measure(OpenLayers.Handler.Path, {
                persist: true,
                immediate: true,
                displayClass: "olControlMeasureDistance", // css-Cursor
                displaySystem: 'english',
                handlerOptions: {
                    layerOptions: {styleMap: new OpenLayers.StyleMap({
                        "default": new OpenLayers.Style(null, {
                            rules: [new OpenLayers.Rule({
                                symbolizer: {
                                    "Point": {
                                        pointRadius: 10,
                                        graphicName: "square",
                                        fillColor: "white",
                                        fillOpacity: 0.25,
                                        strokeWidth: 1,
                                        strokeOpacity: 1,
                                        strokeColor: "#333333"
                                    },
                                    "Line": {
                                        strokeWidth: 1,
                                        strokeOpacity: 1,
                                        strokeColor: "#FF0000",
                                        strokeDashstyle: "solid"
                                    }
                                }
                            })]
                        })
                    })}
                }
            })
    }},
    {type: "measurearea", options: {geodesic: true,
			control: new OpenLayers.Control.Measure(OpenLayers.Handler.Polygon, {
				persist: true,
				immediate: true,
				displayClass: "olControlMeasureArea", // css-Cursor
                displaySystem: 'english',
				handlerOptions: {
					layerOptions: {styleMap: new OpenLayers.StyleMap({
						"default": new OpenLayers.Style(null, {
							rules: [new OpenLayers.Rule({
								symbolizer: {
									"Point": {
										pointRadius: 10,
										graphicName: "square",
										fillColor: "white",
										fillOpacity: 0.25,
										strokeWidth: 1,
										strokeOpacity: 1,
										strokeColor: "#333333"
									},
									"Polygon": {
										strokeWidth: 1,
										strokeOpacity: 1,
										strokeColor: "#FF0000",
										strokeDashstyle: "solid",
										fillColor: "#FFFFFF",
										fillOpacity: 0.5
                                    }
                                }
                            })]
                        })
                    })}
                }
            })
    }},
	// Old Drawing Editor
	{type: "-"},
		{type: "oleditor", options: {
			pressed: true,

					// Options for OLEditor
			olEditorOptions: {
				activeControls: ['DownloadFeature','UploadFeature','Separator', 'SnappingSettings', 'Separator', 'DeleteAllFeatures', 'DeleteFeature', 'DragFeature', 'SelectFeature', 'Separator', 'ModifyFeature', 'Separator'],
					featureTypes: ['text', 'regular', 'polygon', 'path', 'point'],
					language: 'en',
					DownloadFeature: {
							url: Heron.globals.serviceUrl,
							formats: [
							{name: 'Well-Known-Text (WKT)', fileExt: '.wkt', mimeType: 'text/plain', formatter: 'OpenLayers.Format.WKT'},
								{name: 'Geographic Markup Language - v2 (GML2)', fileExt: '.gml', mimeType: 'text/xml', formatter: new OpenLayers.Format.GML.v2({featureType: 'oledit', featureNS: 'http://geops.de'})},
								{name: 'GeoJSON', fileExt: '.json', mimeType: 'text/plain', formatter: 'OpenLayers.Format.GeoJSON'},
                                {name: 'GPS Exchange Format (GPX)', fileExt: '.gpx', mimeType: 'text/xml', formatter: 'OpenLayers.Format.GPX', fileProjection: new OpenLayers.Projection('EPSG:4326')},
                                {name: 'Keyhole Markup Language (KML)', fileExt: '.kml', mimeType: 'text/xml', formatter: 'OpenLayers.Format.KML', fileProjection: new OpenLayers.Projection('EPSG:4326')}
                               
				],
							// For custom projections use Proj4.js
		//					fileProjection: new OpenLayers.Projection('EPSG:4326')
						},
						UploadFeature: {
						url: Heron.globals.serviceUrl,
						formats: [
								{name: 'Well-Known-Text (WKT)', fileExt: '.wkt', mimeType: 'text/plain', formatter: 'OpenLayers.Format.WKT'},
							{name: 'Geographic Markup Language - v2 (GML2)', fileExt: '.gml', mimeType: 'text/xml', formatter: 'OpenLayers.Format.GML'},
							{name: 'GeoJSON', fileExt: '.json', mimeType: 'text/plain', formatter: 'OpenLayers.Format.GeoJSON'},
                              {name: 'GPS Exchange Format (GPX)', fileExt: '.gpx', mimeType: 'text/xml', formatter: 'OpenLayers.Format.GPX', fileProjection: new OpenLayers.Projection('EPSG:4326')},
                              {name: 'Keyhole Markup Language (KML)', fileExt: '.kml', mimeType: 'text/xml', formatter: 'OpenLayers.Format.KML', fileProjection: new OpenLayers.Projection('EPSG:4326')},
                          {name: 'CSV (with X,Y in WGS84)', fileExt: '.csv', mimeType: 'text/plain', formatter: 'OpenLayers.Format.GeoJSON', fileProjection: new OpenLayers.Projection('EPSG:4326')}
                       

                      ],
							// For custom projections use Proj4.js
	//						fileProjection: new OpenLayers.Projection('EPSG:4326')
				}
			}
			}
		},

    {type: "-"} ,
	 {type: "scale", options: {width: 75}},
	
 {type: "addbookmark"},
    {type: "featureinfo", options: {
        popupWindow: {
			title: 'Feature Information',
            width: 600,
            height: 200,
           zoomOnRowDoubleClick: true,
		   featureInfoPanel: {
				layout: 'fit',
                exportFormats: ['CSV', 'XLS'],
                maxFeatures: 75
            }
        }
    }}, 
	    {type: "printdirect", options: {url: 'http://kademo.nl/print/pdf28992', mapTitle: 'My Title - Direct Print'
        , mapTitleYAML: "mapTitle"		// MapFish - field name in config.yaml - default is: 'mapTitle'
         , mapComment: 'My Comment - Direct Print'
        , mapCommentYAML: "mapComment"	// MapFish - field name in config.yaml - default is: 'mapComment'
         , mapFooter: 'My Footer - Direct Print'
       , mapFooterYAML: "mapFooter"	    // MapFish - field name in config.yaml - default is: 'mapFooter'
		 , printAttribution: true         // Flag for printing the attribution
		 , mapAttribution: null           // Attribution text or null = visible layer attributions
		 , mapAttributionYAML: "mapAttribution" // MapFish - field name in config.yaml - default is: 'mapAttribution'
         , mapPrintLayout: "A4"			// MapFish - 'name' entry of the 'layouts' array or Null (=> MapFish default)
        , mapPrintDPI: "75"				// MapFish - 'value' entry of the 'dpis' array or Null (=> MapFish default)
       , mapPrintLegend: true
       , legendDefaults: {
             useScaleParameter : false,
            baseParams: {FORMAT: "image/png"}
          }
    }},
    {type: "printdialog", options: {url: 'http://kademo.nl/print/pdf28992', windowWidth: 360
        , showTitle: true
       , mapTitle: 'My Header - Print Dialog'
         , mapTitleYAML: "mapTitle"		// MapFish - field name in config.yaml - default is: 'mapTitle'
         , showComment: true
        , mapComment: 'My Comment - Print Dialog'
       , mapCommentYAML: "mapComment"	// MapFish - field name in config.yaml - default is: 'mapComment'
        , showFooter: true
         , mapFooter: 'My Footer - Print Dialog'
         , mapFooterYAML: "mapFooter"	    // MapFish - field name in config.yaml - default is: 'mapFooter'
	, printAttribution: false        // Flag for printing the attribution
		 , mapAttribution: null           // Attribution text or null = visible layer attributions
 		// , mapAttributionYAML: "mapAttribution" // MapFish - field name in config.yaml - default is: 'mapAttribution'
     , showOutputFormats: true
       , showRotation: true
 , showLegend: true
    , showLegendChecked: true
      , mapLimitScales: false
    , mapPreviewAutoHeight: true // Adapt height of preview map automatically, if false mapPreviewHeight is used.
       , mapPreviewHeight: 400
 }},

	
 



    {
        type: "searchcenter",
        // Options for SearchPanel window
        options: {
            pressed: true,

            searchWindow: {
                title: __('Query Builder'),
     
                layout: 'fit',
                width: 850,
                height: 400,
                items: [
                    {
                        xtype: 'hr_searchcenterpanel',
                        id: 'hr-searchcenterpanel',
                        hropts: {
                            searchPanel: {
                                xtype: 'hr_gxpquerypanel',
                                header: false,
                                border: false,
                                spatialQuery: false,
                                attributeQuery: true,
                                caseInsensitiveMatch: true,
                                autoWildCardAttach: true
                            },
                            resultPanel: {
                                xtype: 'hr_featuregridpanel',
                                id: 'hr-featuregridpanel',
                                header: false,
                                border: false,
                                autoConfig: true,
                                exportFormats: ['CSV', 'XLS', 'GMLv2', 'GeoJSON', 'WellKnownText', 'GeoPackage', 'Shapefile'],
                                hropts: {
									xy_precision: 3,
                                    zoomOnRowDoubleClick: true,
                                    zoomOnFeatureSelect: true,
                                    zoomLevelPointSelect: 17,
                                    zoomToDataExtent: false,
									  // Optional: make these layers visible when search completes
layerOpts: {
								layerOn: 'LSA Projects', layerOpacity: 0.9, srsName: "EPSG:4326",
                          
								}
                                }
                            }
                        }
                    }
                ]
            }
        }
    },
	
{type: "-"},
	{type: "tooltips", options: {
        // Pressed cannot be true when anchored is true!
        pressed: false,
		getfeatureControl: {
			hover: true,
			drillDown: false
		},
		popupWindow: {
			title: "Information",
			hideonmove: false,
            anchored: true,
			//layer: "World Cities (FAO)",
			featureInfoPanel: {
				// Bare grid.
                showTopToolbar: false,
                displayPanels: ['Table']
			}
		}
	}}	
	,	
			 

	 {type: "-"},

    {type: "mapsave", options : {
        mime: 'text/xml',
        fileName: 'heron_map',
        fileExt: '.cml'
    }}
		
	
];
var treeTheme = [
	{

		text:'Layers', nodeType: 'hr_cascader',  expanded: true, children:
			[	
	{nodeType: 'gx_layer', layer: 'LSA Projects'},
		{nodeType: 'gx_layer', layer: 'California Counties'},
				
				
			]
	},	
	
];

Ext.namespace("Heron.options.map.settings");

/** api: example[streetview]
 *  StreetView
 *  ----------
 *  Show Google StreetView for clicked point in map.
 */
Heron.options.map.toolbar.push({type: "-"});

// See more options in ToolbarBuilder.js for "streetview" entry.
Heron.options.map.toolbar.push({ type: "streetview", options: {
            pressed: false
        }});

