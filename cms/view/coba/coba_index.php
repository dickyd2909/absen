<title>Admin | Presesnsi SMKN 2 CIMAHI</title>
<div id="bgtable">
	<div id="botable">
		<div id="tablebox" class="clearfix">
			<div class="tabletit">
				<h2>Admin</h2>
			</div>
			<div class="tableadd">
				<a href="#" class="btnsecondary" id="myBtn">+ ADMIN</a>
			</div>
		</div>	
		<div class="tablecont">
			<table id="example" class="display" style="width:100%">
				<thead>
					<tr>
						<th></th>
						<th>Name</th>
						<th>Position</th>
						<th>Office</th>
						<th>Salary</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th></th>
						<th>Name</th>
						<th>Position</th>
						<th>Office</th>
						<th>Salary</th>
					</tr>
				</tfoot>
			</table>
		</div>
		
	</div>
</div>

<script>
	function format ( d ) {
    // `d` is the original data object for the row
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
        '<tr>'+
            '<td>Full name:</td>'+
            '<td>'+d.name+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Extension number:</td>'+
            '<td>'+d.extn+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Extra info:</td>'+
            '<td>And any further details here (images etc)...</td>'+
        '</tr>'+
    '</table>';
}
 
	$(document).ready(function() {
		// Add event listener for opening and closing details
		$('#example').on('click', 'tbody td.dt-control', function () {
			var tr = $(this).closest('tr');
			var row = table.row( tr );
	 
			if ( row.child.isShown() ) {
				// This row is already open - close it
				row.child.hide();
			}
			else {
				// Open this row
				row.child( format(row.data()) ).show();
			}
		} );
	 
		$('#example').on('requestChild.dt', function(e, row) {
			row.child(format(row.data())).show();
		})
	 
		var table = $('#example').DataTable( {
			"ajax": "libs/getApi.json",
			"rowId": 'id',
			"columns": [
				{
					"className":      'dt-control',
					"orderable":      false,
					"data":           null,
					"defaultContent": ''
				},
				{ "data": "name" },
				{ "data": "position" },
				{ "data": "office" },
				{ "data": "salary" }
			],
			"order": [[1, 'asc']],
			dom: 'Blfrtip',
			buttons:['createState', 'savedStates']
		} );
	 
		table.on('stateLoaded', (e, settings, data) => {
			for(var i = 0; i < data.childRows.length; i++) {
				var row = table.row(data.childRows[i]);
				row.child(format(row.data())).show();
			}
		})
	} );
</script>

