<table id="emp_table" class="table table-hover">
	<thead>
		<th>Empployee ID</th>
		<th>Last Name</th>
		<th>First Name</th>
		<th>Middle Name</th>
	</thead>
	<tbody>
	</tbody>
</table>
<h3 class="page-header">Import</h3>
<p>Click <em>IMPORT EMPLOYEE</em> to import departments from payroll system.</p>
<button id="btn_import" class="btn btn-primary btn-sm">IMPORT EMPLOYEE</button> <span id="import_status"></span>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Employee Information</h4>
      </div>
      <div class="modal-body">
      	<span id="emp_code"></span>

      	<?php echo form_open('main/employee_update', ['id' => 'frm-employee']); ?>
      	<input type="hidden" name="empcode" id="empcode">
      	<strong>Employee ID</strong>
      	<p><span id="empcode"></span></p>

		<strong>Name</strong>
		<p><span id="name"></span></p>
		
		<strong>Department</strong>
		<p><span id="department"></span></p>
		
		<strong>Approver</strong>
		<!-- <div class="checkbox">
			<label>
				<input type="checkbox" id="supervisor" name="supervisor"> Supervisor
			</label>
		</div> -->

		<div class="radio">
			<label><input type="radio" name="optradio" id="supervisor" value="supervisor">Supervisor</label>
		</div>

		<!-- <div class="checkbox">
			<label>
				<input type="checkbox" id="depthead" name="depthead"> Department Head
			</label>
		</div> -->

		<div class="radio">
			<label><input type="radio" name="optradio" id="depthead" value="depthead">Department Head</label>
		</div>

		  <!-- <div class="checkbox">
		    <label>
		      <input type="checkbox" id="secthead" name="secthead"> Section Head
		    </label>
		  </div> -->

		<div class="radio">
			<label><input type="radio" name="optradio" id="secthead" value="secthead">Section Head</label>
		</div>

		<!-- <div class="checkbox">
			<label>
				<input type="checkbox" id="divhead" name="divhead"> Division Head
			</label>
		</div> -->

		<div class="radio">
			<label><input type="radio" name="optradio" id="divhead" value="divhead">Division Head</label>
		</div>

		<strong>Employee Control</strong>
		<div class="checkbox">
			<label>
				<input type="checkbox" id="is_hr" name="is_hr"> Human Resource
			</label>
		</div>

		<div class="checkbox">
			<label>
				<input type="checkbox" id="is_payroll" name="is_payroll"> Payroll
			</label>
		</div>

		<div class="checkbox">
			<label>
				<input type="checkbox" id="is_audit" name="is_audit"> Audit
			</label>
		</div>
      	<?php echo form_close(); ?>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btn-save">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		var table = $('#emp_table').DataTable({
			"ajax": "<?php echo site_url('main/get_employees') ?>",
			"columns": [
	            { "data": "empcode" },
	            { "data": "lname" },
	            { "data": "fname" },
	            { "data": "mname" },
	        ]
		});

		$('#btn_import').click(function(e) {
			e.preventDefault();

			$('span#import_status').html('Please wait...');
			$.ajax({
				url: '<?php echo site_url('main/import_employee') ?>',
				dataType: 'json',
				method: 'GET'
			})
			.done(function(data){
				$('span#import_status').html('Successfully imported employee file');
			})
			.then(function(data) {
				table.ajax.reload();
			})
			.fail(function() {
				$('span#import_status').empty();
				toastr.error('Error importing employee file from the server. Please try to import deparments first.');
			})
		});

		$.noConflict();
		$('#emp_table tbody').on('click', 'tr', function() {
			var empcode = $(this).find('td').html();

			$.get('<?php echo site_url('get_employee') ?>/'+empcode, null, null, 'json')
			.done(function(data) {
				$('input#empcode').val(data.empcode);
				$('span#empcode').text(empcode);
				$('span#name').text(data.lname+', '+data.fname+' '+data.mname);
				$('span#department').text(data.deptcode+' '+data.name);

				if (data.supervisor == '1') {
					$('input#supervisor').prop('checked', data.supervisor);
					console.log('supervisor');
				} else if (data.depthead == '1') {
					$('input#depthead' == '1').prop('checked', data.depthead);
					console.log('depthead');
				} else if (data.secthead == '1') {
					$('input#secthead' == '1').prop('checked', data.secthead);
					console.log('secthead');
				} else {
					$('input#divhead').prop('checked', data.divhead);
					console.log('sedivheadcthead');
				}

				// $('input#supervisor').prop('checked', data.supervisor);
				// $('input#depthead').prop('checked', data.depthead);
				// $('input#secthead').prop('checked', data.secthead);
				// $('input#divhead').prop('checked', data.divhead);

				$('input#is_hr').prop('checked', data.is_hr);
				$('input#is_payroll').prop('checked', data.is_payroll);
				$('input#is_audit').prop('checked', data.is_audit);

				$('#myModal').modal('show');
			})
			.fail(function() {
				toastr.error('Error fetching employee information from the server.');
			});
		});

		$('#myModal button#btn-save').click(function(e) {
			e.preventDefault();
			var empcode = parseInt($('span#empcode').text());
			$.post('<?php echo site_url('main/update_employee') ?>', $('#frm-employee').serialize(), null, 'json')
			.done(function(data) {
				if (data.status) {
					toastr.success('Employee information updated.');
					$('#myModal').modal('hide');
				} else {
					toastr.warning('Cannot update employee information.')
				}
			})
			.fail(function() {
				toastr.error('Error updating employee information.');
			})
		});
	});
</script>