<form id="accessstats" class="section" target="_blank" method="post">
	<h2><?php p($_['title']); ?></h2>
	<br/>

	<p>Date From: <input type="text" class="accessstats_datepicker" id="accessstats_fromdate"></p>
	<p>Date To: <input type="text" class="accessstats_datepicker" id="accessstats_todate"></p>
	<input type="submit" value="Download" />
	<input id='accessstatsdata' type='hidden' name='accessstats' value=''>
	<input id='accessstatstoken' type='hidden' name='requesttoken' value=''>
</form>