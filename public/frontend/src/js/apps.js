'use strict'

window.Popper = require('popper.js').default;
window.$ = window.jQuery = require('jquery');
require('bootstrap');
require('jquery-match-height');
require('slick-carousel');
require('select2');
require('./vendors/fancybox.js');
require('./vendors/masked.js');
require('./vendors/jquery.steps');
require('./vendors/jquery.validate');

// Functions
require('./functions/banner.js');
require('./functions/header.js');
require('./functions/init.js');
require('./functions/slider.js');

