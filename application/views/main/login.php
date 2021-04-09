<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<?php echo form_open('login/auth') ?>
		<div class="form-group">
			<label for="username">User ID</label>
			<input type="text" class="form-control" name="username" id="username" placeholder="User ID">
			<span id="username"></span>
		</div>
		<div class="form-group">
			<label for="password">Password</label>
			<input type="password" class="form-control" name="password" id="password" placeholder="Password">
			<span id="password"></span>
		</div>
		<button class="btn btn-block btn-primary">Login</button>
		<?php echo form_close() ?>	
	</div>
	<!-- <div class="col-md-6">
	</div> -->
</div>

<?php

// echo $x = 0 . ' ';
// echo $y = 1 . ' ';

// var_dump($x);

// for ($i=0; $i < 15; $i++) { 
// 	$z = $x + $y;
// 	echo $z.' ';
// 	$x = $y;
// 	$y = $z;
// }

// $num = 10;

// for ($i=1; $i < $num; $i++) { 
// 	echo $i;
// }

// for ($i=$num; $i > 0; $i--) { 
// 	echo $i;
// }
?>

<script type="text/javascript">
	$(document).ready(function() {
		$('form').submit(function(e) {
			e.preventDefault();
			var form = $(this);

			$.ajax({
				url : form.attr('action'),
				data: form.serialize(),
				type: 'POST',
				dataType: 'json'
			})
			.done(function(data) {
				console.log(data);
				if (data.status) {
					window.location = data.url;
				} else {					
					$.each(data.validation, function(index, elem) {
						if (elem != '') {
							$('input#'+index).parent('div').addClass('has-error');
							$("span#"+index).html(elem);
						} else {
							$('input#'+index).parent('div').removeClass('has-error').addClass('has-success');
							$("span#"+index+"").html('');
						}
					});
					
					if (data.msg != '') {
						toastr.info(data.msg);
					}
				}
			})
			.fail(function() {
				toastr.error('Error Logging In.');
			})
		})
	});
</script>