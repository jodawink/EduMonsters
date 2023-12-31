﻿/*
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckfinder.com/license
*/

CKFinder.customConfig = function( config )
{
	// Define changes to default configuration here.
	// For the list of available options, check:
	// http://docs.cksource.com/ckfinder_2.x_api/symbols/CKFinder.config.html

	// Sample configuration options:
	// config.uiColor = '#BDE31E';
	// config.language = 'fr';
	// config.removePlugins = 'basket';
        
        config.disableHelpButton = true;
        config.defaultSortBy = 'date';
        config.defaultDisplayFilesize = true;
        config.defaultDisplayDate = false;
        config.removePlugins = 'help,basket,flashupload';
        config.skin = 'kama';
        config.language = 'en';
};
