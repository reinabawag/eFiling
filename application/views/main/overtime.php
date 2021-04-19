<div class="row">
	<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-heading">File Overtime</div>
			<div class="panel-body">
				<?php echo form_open(null, ['class' => 'form']) ?>
				<div class="form-group">
					<label for="empcode">Employee ID</label>
					<input type="text" name="empcode" class="form-control" id="empcode" value="<?php echo $this->session->empcode ?>" required readonly>
					<input type="hidden" name="deptcode" class="form-control" id="deptcode" required>
				</div>
				<p><strong>Name</strong> <span id="name"></span></p>
				<p><strong>Department</strong> <span id="department"></span></p>
				<hr>
				<div class="form-group">
					<label for="date">Date</label>
					<input type="date" name="date" class="form-control" id="date" value="<?php echo date("Y-m-d"); ?>" required>
				</div>
				<div class="form-group">
					<label for="start">Start</label>
					<input type="time" name="start" class="form-control" id="start" value="<?php echo date('h:i', time()) ?>" required>
				</div>
				<div class="form-group">
					<label for="end">End</label>
					<input type="time" name="end" class="form-control" id="end" value="<?php echo date('h:i', time()) ?>" required>
				</div>
				<div class="form-group">
					<label for="computed_time">HRS</label>
					<input type="text" name="computed_time" class="form-control" id="computed_time" required readonly>
				</div>
				<div class="form-group">
					<label for="rec_approver">Recommeding Approval</label>
					<select name="rec_approver" id="rec_approver" class="form-control"></select>
				</div>
				<div class="form-group">
					<label for="approver">Approver</label>
					<select name="approver" id="approver" class="form-control"></select>
				</div>
				<div class="form-group">
					<label for="reason">Reason</label>
					<textarea class="form-control" name="reason" id="reason" cols="30" rows="5"></textarea>
				</div>
				<input type="reset" role="button" class="btn btn-default" value="Cancel" id="cancel">
				<button class="btn btn-primary">Submit</button>
				<?php echo form_close() ?>
			</div>
		</div>
	</div>
	<div class="col-md-8">
		<table class="table table-hover" id="ot-table">
			<thead>
				<tr>
					<th>Record ID</th>
					<th>Start</th>
					<th>End</th>
					<th>HRS</th>
					<th>Date</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody></tbody>
		</table>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		var empcode = '<?php echo $this->session->empcode ?>';
		var deptcode = '<?php echo $this->session->deptcode ?>';
		var tbl_options = {"order": [[ 0, "desc" ]]};
		var table = $('table#ot-table').DataTable(tbl_options);

		init();

		function init(argument) {
		 	// body...
			var _empcode = $('input#empcode');

			if (_empcode.val().length == 6) {
				$.get('<?php echo site_url('get_employee') ?>/'+_empcode.val(), null, null, 'json')
				.then(function(data) {
					if (data != null) {
						empcode = data.empcode;
						deptcode = data.deptcode;

						$('input#empcode').prop('readonly', true);
						$('input#deptcode').val(data.deptcode);
						$('span#name').text(data.lname+', '+data.fname+' '+data.mname);
						$('span#department').text(data.deptcode+' '+data.name);

						return $.get('<?php echo site_url('main/get_approver') ?>', {deptcode: deptcode}, null, 'json');
					} else {
						empcode = null;
						deptcode = null;
						$('span#name').empty();
						$('span#department').empty();
					}
				})
				.then(function(data){
					$('select#approver').empty()
					$.each(data, function(index, elem) {
						$('select#approver').append('<option value='+elem.empcode+'>'+elem.name+'</option>');
						// $('select#rec_approver').append('<option value='+elem.empcode+'>'+elem.name+'</option>');
					});

						return $.get('<?php echo site_url('main/get_rec_approver') ?>', {deptcode: deptcode}, null, 'json');
				})
				.then(function(data){
					$('select#rec_approver').empty();
					$.each(data, function(index, elem) {
						$('select#rec_approver').append('<option value='+elem.empcode+'>'+elem.name+'</option>');
					});

					return $.get('<?php echo site_url('main/get_filed_overtime') ?>', {empcode: empcode}, null, 'json')
				})
				.then(function(data) {
					table.destroy();
					$('table tbody').empty();
					$.each(data, function(index, elem) {
						$('table#ot-table tbody').append('<tr><td>'+elem.id+'</td><td>'+elem.start_time+'</td><td>'+elem.end_time+'</td><td>'+elem.hrs+'</td><td>'+elem.date_filed+'</td><td>'+elem.status+'</td></tr>');
					});

					table = $('table#ot-table').DataTable(tbl_options);
				})
				.fail(function() {
					toastr.error('Error fetching employee information from the server.');
				});
			}
		};

		$('input#end').on('keyup', function(e) {
			e.preventDefault();

			var start = $('input#start').val();
			var end = $(this).val();

			// if (end < start) {
			// 	$('input#computed_time').val('');
			// } else {
				$.post('<?php echo site_url('main/compute_time_diff') ?>', $('form.form').serialize(), null, 'json')
				.done(function(data) {
					$('input#computed_time').val(data.diff);
				})
				.fail(function() {
					toastr.error('Error in computing time difference');
				})
			// }
		});

		$('form.form').submit(function(e) {
			e.preventDefault();
			var form = $(this);

			if ((empcode != null) && (deptcode != null)) {
				$.post('<?php echo site_url('main/create_overtime') ?>', form.serialize(), null, 'json')
				.then(function(data) {
					if (data.status) {
						toastr.success('OT filed and pending for approval.');
						return load_table_data();						
					} else {
						toastr.error('Error in filing OT. Please contact MIS.');
					}
				})
				.then(function(data) {
					console.log(data);
					table.destroy();
					$('table tbody').empty();

					$.each(data, function(index, elem) {
						$('table#ot-table tbody').append('<tr><td>'+elem.id+'</td><td>'+elem.start_time+'</td><td>'+elem.end_time+'</td><td>'+elem.hrs+'</td><td>'+elem.date_filed+'</td><td>'+elem.status+'</td></tr>');
					});

					table = $('table#ot-table').DataTable(tbl_options);
				})
				.fail(function(data) {
					toastr.error('Error filing overtime.')
				})
			} else {
				toastr.info('Please input your Employee ID first.');
			}
		});

		$('input#cancel').click(function(e) {
			empcode = null;
			deptcode = null;
			// $('span#name').empty();
			// $('span#department').empty();
			// $('input#empcode').prop('readonly', false);
			// $('select#rec_approver').empty();
			// $('select#approver').empty();
			// table.destroy();
			// $('table tbody').empty();
			// table = $('table#ot-table').DataTable(tbl_options);
		});

		$('table#ot-table').on('click', 'tr', function () {
	        var data = table.row( this ).data();
	        alert( 'You clicked on '+data[0]+'\'s row' );
	    });

	    function load_table_data() {
	    	return $.get('<?php echo site_url('main/get_filed_overtime') ?>', {empcode: empcode}, null, 'json');
	    }
	});
</script>