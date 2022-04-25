'use strict';

const pkg = require( '../../../package.json' );
const year = new Date().getFullYear();

function getBanner( pluginFilename ) {
	return `/*!
  * creativity${ pluginFilename ? ` ${ pluginFilename }` : '' } v${
		pkg.version
	} (${ pkg.homepage })
  * Copyright 2022-${ year } ${ pkg.author }
  * Licensed under GPL (http://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html)
  */`;
}

module.exports = getBanner;
