<form method="post" action="<?php echo admin_url('admin-ajax.php') ?>" class="js--contact-form">
	<?php wp_nonce_field('send-form'); ?>
	<input type="hidden" name="action" value="send-form">
	<div class="form-group">
		<label for="exampleInputEmail1">Email address</label>
		<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="email" required>
	</div>
	<div class="form-group">
		<label for="exampleFormControlTextarea1">Message</label>
		<textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="message"></textarea>
	</div>
	<button type="submit" class="btn btn-primary">Submit</button>
</form>
