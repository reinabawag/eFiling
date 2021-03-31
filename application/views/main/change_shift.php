<div class="panel panel-default">
	<div class="panel-heading">Request For Change Shift</div>
	<div class="panel-body">
		<?php if($this->session->success): ?>
			<div class="alert alert-success">
				<strong>Success!</strong> <?=$this->session->success?>
			</div>
		<?php endif; ?>
		<?php echo form_open('schedule/store') ?>
			<input type="hidden" name="emp" value="<?=$this->session->empcode?>">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label for="purpose">REQUEST FOR</label>
						<select name="purpose" id="purpose" class="form-control">
							<option value="CHANGE SHIFT">CHANGE SHIFT</option>
							<option value="SWAPPING/OFFSETTING">SWAPPING/OFFSETTING</option>
							<option value="WORK FROM HOME">WORK FROM HOME</option>
							<option value="FULL COMPRESSED WORK WEEK">FULL COMPRESSED WORK WEEK</option>
							<option value="ALTERNATING WORK SCHEDULE">ALTERNATING WORK SCHEDULE</option>
							<option value="TELECOMMUTING">TELECOMMUTING</option>
						</select>
					</div>
				</div>
				<!-- <div class="col-md-6">
					<div class="form-group">
						<label for="alt">ALTERNATIVE WORK SCHEDULE</label>
						<select name="alt" id="alt" class="form-control" disabled>
							<option value=""></option>
							<option value="WORK FROM HOME">WORK FROM HOME</option>
							<option value="FULL COMPRESSED WORK WEEK">FULL COMPRESSED WORK WEEK</option>
							<option value="ALTERNATING WORK SCHEDULE">ALTERNATING WORK SCHEDULE</option>
							<option value="TELECOMMUTING">TELECOMMUTING</option>
						</select>
					</div>
				</div> -->
			</div>
			<div class="row">			
				<div class="col-md-6">
					<div class="form-group">
						<label for="">FROM (DATE)</label>
						<input type="date" name="from_date" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="">FROM (TIME)</label>
						<input type="text" name="from_time" class="form-control" placeholder="From Time" required>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="">TO (DATE)</label>
						<input type="date" name="to_date" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="">TO (TIME)</label>
						<input type="text" name="to_time" class="form-control" class="form-control" placeholder="To Time" required>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label for="">REASON(S)</label>
				<textarea name="reason" id="" cols="30" rows="5" class="form-control" placeholder="REASON" required></textarea>
			</div>
			<div class="form-group">
				<label for="">IF THERE IS A RELIEVER STATE HIS NAME</label>
				<input type="text" name="reliever" class="form-control" placeholder="NAME OF RELIEVER">
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="approver">APPROVED BY</label>
						<select name="approver" id="approver" class="form-control">
							<?php foreach ($approvers as $approver): ?>
							    <option value="<?=$approver->empcode?>"><?=$approver->name?></option>
							<?php endforeach; ?>
						</select>
						<p><strong>Supervisor/Section Head/Department Head/Division Head</strong></p>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="">NOTED BY</label>
						<select name="" id="" class="form-control" disabled>
							<option value="">N.A</option>
						</select>
						<p><strong>PERSONNEL OFFICE</strong></p>
					</div>
				</div>
			</div>
			<button class="btn btn-primary">SAVE</button>
		</form>
	</div>
</div>

<div class="panel panel-default">
	<div class="panel-heading">Request(s)</div>
	<div class="panel-body">
		<table class="table">
			<thead>
				<th>ID</th>
				<th>REQUEST FOR</th>
				<th>FROM (DATE)</th>
				<th>TO (DATE)</th>
				<th>FROM (TIME)</th>
				<th>TO (TIME)</th>
				<th>STATUS</th>
			</thead>
			<tbody>
				<?php foreach($schedules as $schedule): ?>
					<tr>
						<td><?=str_pad($schedule->id, 6, "0", STR_PAD_LEFT)?></td>
						<td><?=$schedule->purpose?></td>
						<td><?=$schedule->from_date?></td>
						<td><?=$schedule->to_date?></td>
						<td><?=$schedule->from_time?></td>
						<td><?=$schedule->to_time?></td>
						<td><?=$schedule->status?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		var table = $('table').DataTable({
		    "order": [
		    	[0, 'desc']
		    ]
		});

		$('table tbody').on('click', 'tr', function() {
			var data = table.row(this).data();
			alert('You clicked on '+data[0]+'\'s row');
		});
	});
</script>