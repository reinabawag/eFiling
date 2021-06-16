<?php echo anchor('/loan/create', 'Apply for company loan', ['class' => 'btn btn-success']) ?>


<table class="table table-hover table-border">
    <thead>
        <tr>
            <th>Date filed</th>
            <th>Amount</th>
            <th>Date Approved</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($loans as $loan): ?>
        <tr>
            <td><?php echo $loan->created_date ?></td>
            <td><?php echo $loan->amount ?></td>
            <td><?php echo $loan->approved_date ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>