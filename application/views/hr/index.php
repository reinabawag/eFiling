<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title">Generate Report</h3>
    </div>
    <div class="panel-body">
        <?php echo form_open('report', ['method' => 'get']) ?>
            <div class="form-group">
                <label for="start_date">Start date</label>
                <input type="date" class="form-control" name="start_date" id="start_date" required>            
            </div>
            <div class="form-group">
                <label for="end_date">End date</label>
                <input type="date" class="form-control" name="end_date" id="end_date" required>            
            </div>
            <div class="form-group">
                <label for="report_type">Report type</label>
                <select name="report_type" id="report_type" class="form-control">
                    <option value="change_shift">Change Shift</option>
                    <option value="leave">Leave</option>
                    <option value="overtime">Overtime</option>
                    <option value="undertime">Undertime</option>
                    <option value="loan">Loan</option>
                </select>
            </div>
            <input type="submit" class="btn btn-success"></button>
        <?php echo form_close() ?>
    </div>
</div>

<script>
    
</script>