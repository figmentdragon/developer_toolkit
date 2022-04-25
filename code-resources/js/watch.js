'use strict';

const _ = require('lodash');
const chokidar = require('chokidar');
const upath = require('upath');
const renderAssets = require('./render-assets');
const renderScripts = require('./render-scripts');
const renderSCSS = require('./render-scss');
const renderPages = require('./render-pages');

const watcher = chokidar.watch('src', {
    persistent: true,
});

let READY = false;

process.title = 'pug-watch';
process.stdout.write('Loading');
let allPugFiles = {};

watcher.on('add', filePath => _processFile(upath.normalize(filePath), 'add'));
watcher.on('change', filePath => _processFile(upath.normalize(filePath), 'change'));
watcher.on('ready', () => {
    READY = true;
    console.log(' READY TO ROLL!');
});

_handleSCSS();

function _handleSCSS() {
    renderSCSS();
}
function _processFile(filePath, watchEvent) {

    if (!READY) {

    if (filePath.match(/\.scss$/)) {
        if (watchEvent === 'change') {
            return _handleSCSS(filePath, watchEvent);
        }
        return;
    }

    if (filePath.match(/src\/js\//)) {
        return renderScripts();
    }

    if (filePath.match(/src\/assets\//)) {
        return renderAssets();
    }

    if (filePath.match(/src\/pages\//)) {
        return renderPages();
      }
    }
}
