<div class="panel panel-primary">
	<div class="panel-heading"><strong>File leave</strong></div>
	<div class="panel-body">
		<?=form_open('leave/create')?>
			<div class="form-group">
				<label for="">Employee ID</label>
				<input type="text" class="form-control" name="empcode" value="<?=$this->session->empcode?>" readonly>
			</div>
			<div class="form-group">
				<label for="">Name</label>
				<input type="text" class="form-control" name="name" value="<?=$this->session->name?>" readonly>
			</div>
			<div class="form-group">
				<label for="">Date Filed</label>
				<input type="date" class="form-control" name="date_filed" value="<?=date('Y-m-d')?>" readonly>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Start of leave</label>
						<input type="date" class="form-control" name="date_start" placeholder="Start of leave">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="">End of leave</label>
						<input type="date" class="form-control" name="date_end" placeholder="End of leave">
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Leave</label>
						<select name="pay" id="" class="form-control">
							<option value="with pay">With pay</option>
							<option value="without pay">Without pay</option>
						</select>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Application for</label>
						<select name="type" id="" class="form-control">
							<option value="Vacation">Vacation</option>
							<option value="Sick">Sick</option>
							<option value="Emergency">Emergency</option>
							<option value="Paternity">Paternity</option>
							<option value="Maternity">Maternity</option>
							<option value="Bereavement">Bereavement</option>
							<option value="Special leave for woman">Special leave for woman</option>
							<option value="Single parent leave">Single parent leave	</option>
						</select>
					</div>
				</div>
			</div>

			<div class="form-group">
				<label for="">Reason</label>
				<textarea name="reason" id="" class="form-control" cols="30" rows="3" placeholder="Kindly state your reason here"></textarea>
			</div>

			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Recommeding approver</label>
						<?=form_dropdown('recommended_by', $recommender, NULL, ['class' => 'form-control'])?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Approver</label>
						<?=form_dropdown('approved_by', $approver, NULL, ['class' => 'form-control'])?>
					</div>
				</div>
			</div>

			<button type="reset" class="btn btn-primary">Reset</button>
			<button type="submit" class="btn btn-success">Submit</button>

		<?=form_close()?>
	</div>
</div>

<div class="panel panel-primary">
  	<div class="panel-heading">
    	<strong>Request(s)</strong>
  	</div>
  	<div class="panel-body">
	  	<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>Date filed</th>
					<th>Date start</th>
					<th>Date end</th>
					<th>Pay</th>
					<th>Type</th>
					<th>Reason</th>
					<th>Status</th>
				</tr>
			</thead>
		</table>
  	</div>
</div>

<script>
	$(document).ready(function() {
		$(':input').attr('required', true);

		var table = $('.table').DataTable({
			"ajax": '<?=site_url('leave/get')?>',
			"columns": [
				{ "data": "id"},
				{ "data": "date_filed"},
				{ "data": "date_start"},
				{ "data": "date_end"},
				{ "data": "pay"},
				{ "data": "type"},
				{ "data": "reason"},
				{ "data": "status"},
			]
		});

		$('form').submit(function(e) {
			e.preventDefault();
			var form = $(this);

			$.ajax({
				url: form.attr('action'),
				data: form.serialize(),
				type: form.attr('method'),
				dataType: 'JSON'
			})
			.then(function(data) {
				if (data.status) {
					toastr.success(data.message, 'Success');
					table.ajax.reload();
				}
			})
		})
	})
</script>