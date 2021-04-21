<table id="dept_table" class="table table-hover table-bordered">
	<thead>
		<th>Dept Code</th>
		<th>Description</th>
	</thead>
	<tbody>
	</tbody>
</table>
<h3 class="page-header">Import</h3>
<p>Click <em>IMPORT DEPARTMENT</em> to import departments from payroll system.</p>
<button id="btn_import" class="btn btn-primary btn-sm">IMPORT DEPARTMENT</button> <span id="import_status"></span>

<script type="text/javascript">
	$(document).ready(function() {
		var table = $('#dept_table').DataTable({
			"ajax": "<?php echo site_url('main/get_departments') ?>",
			"columns": [
	            { "data": "deptcode" },
	            { "data": "name" }
	        ]
		});

		$('#btn_import').click(function(e) {
			e.preventDefault();

			$('span#import_status').html('Please wait...');
			$.ajax({
				url: '<?php echo site_url('main/import_department') ?>',
				dataType: 'json',
				method: 'GET'
			})
			.then(function(data){
				$('span#import_status').html('Successfully imported department file');
			})
			.done(function(data) {
				table.ajax.reload();
			})
			.error(function() {
				$('span#import_status').html('Error importing department file');
			})
		})
	});
</script>