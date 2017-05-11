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
Ext.namespace("Heron");
Ext.namespace("Heron.options");
Ext.namespace("Heron.options.layertree");
/** REST Services specific to Heron. */
Heron.globals.serviceUrl = '/cgi-bin/heron.cgi';


// Describe layout of application
Heron.layout = {
	xtype: 'panel',

	/* Optional ExtJS Panel properties here, like "border", see ExtJS API docs. */
	id: 'hr-container-main',
	layout: 'border',
    /** Any classes in "items" and nested items are automatically instantiated (via "xtype") and added by ExtJS. */

    items: [
		{
			xtype: 'panel',
			id: 'hr-map-and-info-container',
			layout:'border',
			region:'center',
			width:'100%',
			items: [
				{
					xtype: 'hr_mappanel',
					id: 'hr-map',
					region: 'center',
					collapsible : false,
					border: true,
					hropts: Heron.options.map
				},
				{
					xtype: 'panel',
					id: 'left-side',
					region: 'west',
					layout: 'border',
					title:'Search&nbsp;and&nbsp;Layers',
					width: 325,
					border: true,
					collapsible: true,
					defaults: {
						collapsible: true,
						split: false,
						border: false
					},
					items: [
									
						{
							xtype: 'panel',
							region: 'center',
							id: 'center',
							collapsible: false,
							layout: 'fit',

							items: [{
							xtype: 'hr_layertreepanel', 
								                    xtype: 'hr_layertreepanel',
	
													 
                    border: false,
					
					autoScroll: true,
								layout: 'auto',
								flex: 1,
                    // The LayerTree tree nodes appearance: default is ugly ExtJS document icons										flex: 1,

                    // The LayerTree tree nodes appearance: default is ugly ExtJS document icons
                    // Other values are 'none' (no icons). May be overridden in specific 'gx_layer' type config.
                    layerIcons : 'bylayertype',

                    // Allow moving layers
                    enableDD: false,

                    // Right-mouse popoup menu
                    contextMenu: [

                        {
                            xtype: 'hr_layernodemenuzoomextent'
                        },
                        {
                            xtype: 'hr_layernodemenuopacityslider'
                        }
                    ],
                    // Optional, use internal default if not set
                    hropts: Heron.options.layertree
                },

                {
                    xtype: 'hr_htmlpanel',
                    id: 'hr-info-west',
                    border: true,
                    preventBodyReset: true,
					title: 'Info'},

						                						
				
            ]

            
            
        },

						{
							xtype: 'panel',
							region: 'north',
							id: 'north',
							title: 'Search',
							collapsible: true,
							height: '',
							items: [		{
                    xtype: 'hr_bookmarkspanel',
					region: 'south',
					
                    id: 'hr-bookmarks',
					height: '',
					collapsed: false,
					collapsible: true,
	
  /** The map contexts to show links for in the BookmarksPanel. */
             //       hropts: Heron.options.bookmarks =
	//	[


	//				{
	//	id: 'Arch2',
	//			name: 'Built Environment Demo',
	//			desc: 'Built Environment Demo',
		//		layers: ['Built Environment Demo', 'Parcels with Photos', 'Google Streets'],
			//	x: -13682535.42746650,
				//y: 4724250.81931041,
		//		zoom: 15.5
		//	},
			
		





	//	],

		

			},	googleSearchPanel]
						},				
								
		
								


						]
				},
				{
					xtype: 'panel',
					id: 'hr-menu-right-container',
					layout: 'fit',			
					region : 'east',
					width: 250,
					collapsible: true,
					split	: false,
					border: true,
					title: 'Legend (shows the layers that are checked in layer panel)',
					items: [
						{
							xtype: 'hr_layerlegendpanel',
							id: 'hr-layerlegend-panel',
							border: false,
							title: '',
							defaults: {
								useScaleParameter : true,
								baseParams: {
									FORMAT: 'image/png',
									LEGEND_OPTIONS: 'fontSize:9'
								}
							},
							hropts: {
								// Preload Legends on initial startup
								// Will fire WMS GetLegendGraphic's for WMS Legends
								// Otherwise Legends will be loaded only when Layer
								// becomes visible. Default: false
								prefetchLegends: false
							}
						}
					]
				}				
			]
		},
		{
			xtype: 'panel',
			id: 'banner',
			region : "north",
			html: '<div id=\'banner_container\'><div id=\'banner_main\'><img src=\'./final_banner.jpg\'/ style="vertical-align: middle;"></div></div>',
			height: 80,
			collapsible: false,
			border: false,
			items: [
			]
		}


    ]

};

//Set title for collapsed 'Search' panel -- overrides default behavior
Ext.layout.BorderLayout.Region.prototype.getCollapsedEl = Ext.layout.BorderLayout.Region.prototype.getCollapsedEl.createSequence(function() 
{
if ( ( this.position == 'north' ) && !this.collapsedEl.titleEl ) 
{
this.collapsedEl.titleEl = this.collapsedEl.createChild({cls: 'x-collapsed-title', cn: this.panel.title});
};
if ( ( this.position == 'east' || this.position == 'west') && !this.collapsedEl.titleEl ) 
{
this.collapsedEl.titleEl = this.collapsedEl.createChild({cls: 'x-collapsed-title-90', cn: this.panel.title});
}
}); 
