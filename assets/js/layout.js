'use strict';

import $ from 'jquery';
import 'bootstrap';
import 'bootstrap/scss/bootstrap.scss';
import 'font-awesome/scss/font-awesome.scss';
import '../css/main.scss';


$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
});

$('.dropdown-toggle').dropdown();