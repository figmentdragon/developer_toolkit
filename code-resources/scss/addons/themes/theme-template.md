/*!
 * Bootstrap Docs (https://getbootstrap.com/)
 * Copyright 2011-2022 The Bootstrap Authors
 * Copyright 2011-2022 Twitter, Inc.
 * Licensed under the Creative Commons Attribution 3.0 Unported License.
 * For details, see https://creativecommons.org/licenses/by/3.0/.
 */

// Dev notes
//
// Background information on nomenclature and architecture decisions here.
//
// - Bootstrap functions, variables, and mixins are included for easy reuse.
//   Doing so gives us access to the same core utilities provided by Bootstrap.
//   For example, consistent media queries through those mixins.
//
// - Bootstrap's **docs variables** are prefixed with `$`.
//   These custom colors avoid collision with the components Bootstrap provides.
//
// - Classes are prefixed with `.`.
//   These classes indicate custom-built or modified components for the design
//   and layout of the Bootstrap docs. They are not included in our builds.
//
// Happy Bootstrapping!

// Load Bootstrap variables and mixins
@import 'function';
@import 'default';
@import 'mixins';

// fusv-disable
$enable-grid-classes: false; // stylelint-disable-line scss/dollar-variable-default
$enable-cssgrid: true; // stylelint-disable-line scss/dollar-variable-default
// fusv-enable
@import 'grid';

// Load docs components
@import 'branding/variables';
@import 'branding/nav/nav';
@import 'branding/nav/navbar';
@import 'branding/nav/subnav';
@import 'branding/layout/masthead';
@import 'branding/vendors/ads';
@import 'branding/layout/content';
@import 'branding/skippy';
@import 'branding/layout/sidebar';
@import 'branding/layout/layout';
@import 'branding/toc';
@import 'branding/layout/footer';
@import 'branding/components/component-examples';
@import 'branding/components/buttons';
@import 'branding/components/callouts';
@import 'branding/browser-bugs';
@import 'branding/brand';
@import 'branding/color/colors';
@import 'branding/clipboard-js';
@import 'branding/components/placeholder-img';

// Load docs dependencies
@import 'branding/syntax';
@import 'branding/nav/anchor';
@import 'branding/vendors/algolia';
