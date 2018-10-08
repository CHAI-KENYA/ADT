<style type="text/css">
.dataTable {
	letter-spacing:0px;
}
.table-bordered input {
	width:9em;
}
table {
	table-layout: fixed;
	width: 100px;
}

td {
	white-space: nowrap;
	overflow: hidden;         /* <- this does seem to be required */
	text-overflow: ellipsis;
}
</style>

<script type="text/javascript">
	
	// defaulter_table
	$(document).ready(function() {
		$('.defaulter_table').dataTable({
			"bJQueryUI": true,
			"sPaginationType": "full_numbers",
			"sDom": '<"H"Tfr>t<"F"ip>',
			"oTableTools": {
				"sSwfPath": "../assets/scripts/datatable/copy_csv_xls_pdf.swf",
				"aButtons": [ "copy", "print","xls","pdf" ]
			},
			"bProcessing": true,
			"bServerSide": false,
		});
	});
</script>
<?php  echo $followup_patients; ?>
