/*=========================================================================================
    File Name: datatables-styling.js
    Description: Styling Datatable
    ----------------------------------------------------------------------------------------
    Item Name: Convex - Bootstrap 4 HTML Admin Dashboard Template
    Version: 1.0
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/
(function(window, document, $) {
    'use strict';
	$(document).ready(function() {

	/********************************
	*       js of Base style        *
	********************************/

	$('.base-style').DataTable({
		"dom":	"<'row'<'col-sm-12 col-md-10'l><'col-sm-12 col-md-2'f>>" +
				"<'row'<'col-sm-12'tr>>" +
				"<'row'<'col-sm-12 col-md-8'i><'col-sm-12 col-md-4 'p>>",
	});

	/******************************
	*       js of no style        *
	******************************/

	$('.no-style-no').DataTable();

	/******************************************
	*       js of Base style - compact        *
	******************************************/

	$('.compact').DataTable();

	/*********************************
	*       js of Bootstrap 3        *
	**********************************/

	$('.bootstrap-3').DataTable();


	} );
})(window, document, jQuery);