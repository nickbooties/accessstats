/**
 * ownCloud - accessstats
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later. See the COPYING file.
 *
 * @author Nick Booth <nicbooth@gmail.com>
 * @copyright Nick Booth 2014
 */
$(document).ready(function() {
	
	var d = new Date();
	var n = new Date();
	
	n.setMonth(d.getMonth()-1);
	
	var dfrm = n.getFullYear()+'-'+(n.getMonth()+1)+'-'+n.getDate();
	var dto = d.getFullYear()+'-'+(d.getMonth()+1)+'-'+(d.getDate());
	
	$('#accessstats').attr("action",OC.generateUrl('/apps/accessstats/getstats'));
	$('#accessstats').submit(function(event){downloadStats(event);});
	$('.accessstats_datepicker').datepicker({minDate: new Date(2014, 1 - 1, 1), dateFormat: "yy-mm-dd"});
	$('#accessstats_fromdate').datepicker("setDate",dfrm);
	$('#accessstats_todate').datepicker("setDate",dto);
});

function downloadStats(event) {
	//event.preventDefault();
	//url = $('#add_url').val();
	
	var from_date = $('#accessstats_fromdate').datepicker( "getDate" );
	var to_date = $('#accessstats_todate').datepicker( "getDate" );
	
	var accessstats = {from_date: from_date, to_date: to_date};
	
	$("#accessstatstoken").attr('value',oc_requesttoken);
	$("#accessstatsdata").attr('value',JSON.stringify(accessstats));
	
	return true;
}
