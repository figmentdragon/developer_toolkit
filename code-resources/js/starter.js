// Importing JavaScript
//
// You have two choices for including Bootstrap's JS files—the whole thing,
// or just the bits that you need.


// Option 1
//
// Import Bootstrap's bundle (all of Bootstrap's JS + Popper.js dependency)

// import "../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js";


// Option 2
//
// Import just what we need

// If you're importing tooltips or popovers, be sure to include our Popper.js dependency
// import "../../node_modules/popper.js/dist/popper.min.js";

import "../../node_modules/bootstrap/js/dist/util.js";
import "../../node_modules/bootstrap/js/dist/modal.js";
import "../../node_modules/bootstrap/js/dist/carousel.js";
import "../../node_modules/bootstrap/js/dist/dropdown.js";
import "../../node_modules/bootstrap/js/dist/scrollspy.js";
import "../../node_modules/bootstrap/js/dist/tab.js";
import "../../node_modules/bootstrap/js/dist/alert.js";
import "../../node_modules/bootstrap/js/dist/base-component.js";
import "../../node_modules/bootstrap/js/dist/button.js";

import "../../node_modules/sass/sass.js";
import "../../node_modules/sass/sass.dart.js";
import "../../node_modules/scss/src/compiler.js";
import "../../node_modules/scss/src/index.js";

import "../../node_modules/serve/bin/serve.js";
