<div class="panel panel-default">
	<div class="panel-heading"><strong>OT Approval</strong></div>
	<div class="panel-body">
		<table class="table" id="ot-tbl">
			<thead>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Start</th>
					<th>End</th>
					<th>HRS</th>
					<th>Date</th>
				</tr>
			</thead>
			<tbody></tbody>
		</table>	
	</div>
</div>

<hr>

<div class="panel panel-default">
	<div class="panel-heading"><strong>Change Shift Approval</strong></div>
	<div class="panel-body">
		<table class="table" id="cs-tbl">
			<thead>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Purpose</th>
					<th>Date Filed</th>
					<th>From Date</th>
					<th>To Date</th>
					<th>From Shift</th>
					<th>To Shift</th>
					<th>Reason</th>
				</tr>
			</thead>
			<tbody></tbody>
		</table>	
	</div>
</div>

<hr>

<div class="panel panel-default">
	<div class="panel-heading"><strong>Leave Approval</strong></div>
	<div class="panel-body">
		<table class="table" id="l-tbl">
			<thead>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>From</th>
					<th>To</th>
				</tr>
			</thead>
			<tbody></tbody>
		</table>	
	</div>
</div>

<div id="ot-modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Approve Overtime</h4>
      </div>
      <div class="modal-body">
      	<input type="hidden" id="recid">
        <strong>Name: </strong><span id="name"></span><br>
        <strong>Date Filed: </strong><span id="date"></span><br>
        <strong>Overtime Hours: </strong><span id="from_to"></span><br>
        <strong>Total Hours: </strong><span id="hrs"></span><br>
        <strong>Reason: </strong><span id="reason"></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" id="ot_approve">Approve</button>
      </div>
    </div>

  </div>
</div>

<div id="cs-modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Approve Change Schedule</h4>
      </div>
      <div class="modal-body">
        <strong>Name: </strong><span id="name"></span><br><br>
        <strong>Date Filed: </strong><span id="date"></span><br><br>
        <strong>Purpose: </strong><span id="purpose"></span><br><br>
        <strong>From (Date): </strong><span id="from_date"></span><br><br>
        <strong>To (Date): </strong><span id="from_date"></span><br><br>
        <strong>From (Time): </strong><span id="from_time"></span><br><br>
        <strong>To (Time): </strong><span id="from_time"></span><br><br>
        <strong>Reason: </strong><span id="reason"></span><br><br>

        <form id="cs-form">
      		<input type="hidden" name="id" id="recid">
      		<div class="form-group">
      			<label for="status">Update Request</label>
      			<select name="status" id="status" class="form-control">
      				<option value="APPROVED">Approve</option>
      				<option value="DENIED">Deny</option>
      			</select>
      		</div>
      	</form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" id="cs-submit">Submit</button>
      </div>
    </div>

  </div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		var ot_table = $('#ot-tbl').DataTable({
			"ajax": "<?php echo site_url('main/get_ot_for_approval') ?>",
			"columns": [
	            { "data": "id" },
	            { "data": "name" },
	            { "data": "start_time" },
	            { "data": "end_time" },
	            { "data": "hrs" },
	            { "data": "date_filed" },
	            { "data": "reason" },
	        ],
	        "columnDefs": [
                {
                    "targets": [ 0, 6],
                    "visible": false,
                    "searchable": false
                },
            ]
		});

		var cs_tbl = $('#cs-tbl').DataTable({
			"ajax": "<?=site_url('schedule/for_approval')?>",
			"columns": [
	            { "data": "id" },
	            { "data": "name" },
	            { "data": "purpose" },
	            { "data": "date_filed" },
	            { "data": "from_time" },
	            { "data": "to_time" },
	            { "data": "from_date" },
	            { "data": "to_date" },
	            { "data": "reason" },
	        ],
	        "columnDefs": [
                {
                    "targets": [0, 8],
                    "visible": false,
                    "searchable": false
                },
            ],
            "order": [
		    	['3', 'desc']
		    ]
		});

		$('#cs-tbl tbody').on('click', 'tr', function() {
			var data = cs_tbl.row( this ).data();

			$('#cs-modal input#recid').val(data['id']);
			$('#cs-modal span#name').text(data['name']);
			$('#cs-modal span#date').text(data['date_filed']);
			$('#cs-modal span#purpose').text(data['purpose']);
			$('#cs-modal span#from_date').text(data['from_date']);
			$('#cs-modal span#to_date').text(data['to_date']);
			$('#cs-modal span#from_time').text(data['from_time']);
			$('#cs-modal span#to_time').text(data['to_time']);
			$('#cs-modal span#reason').text(data['reason']);

			$('#cs-modal').modal('show');
		});

		$('#cs-submit').click(function(event) {
			event.preventDefault();

			$.post('<?=site_url('schedule/approve')?>', $('#cs-form').serialize(), function(data) {
				$('#cs-modal').modal('hide');
	        	toastr.success('Change Schedule Updated!', 'Success');
				cs_tbl.ajax.reload();
			}, 'json');
		});

		var l_tbl = $('#l-tbl').DataTable();


		$.noConflict();
		$('#ot-tbl tbody').on('click', 'tr', function () {
	        var data = ot_table.row( this ).data();
	        var recid = data['id'];
	        var name = data['name'];
	        var date = data['date_filed'];
	        var from_to = data['start_time'] + ' - ' + data['end_time'];
	        var hrs = data['hrs'];
	        var reason = data['reason'];

	        $('input#recid').val(recid);
	        $('span#name').text(name);
	        $('span#date').text(date);
	        $('span#from_to').text(from_to);
	        $('span#hrs').text(hrs);
	        $('span#reason').text(reason);
	        $('#ot-modal').modal('show');
	    });

	    $('.modal #ot_approve').click(function(e) {
	    	e.preventDefault();
	    	var recid = $('input#recid').val();

	    	$.post('<?php echo site_url('main/approve_ot') ?>', {id : recid, approve: 1}, null, 'json')
	    	.done(function(data) {
	    		if (data.status) {
	        		$('#ot-modal').modal('hide');
	        		toastr.success('Overtime Approved', 'Success');
	    			ot_table.ajax.reload();	
	    		} else {
	    			toastr.error('Error processing approval', 'Error');
	    		}
	    	})
	    	.fail(function() {
	    		toastr.error('Cannot process approve request.', 'Error');
	    	})
	    })
	});
</script>