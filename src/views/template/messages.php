<?php
if (!empty($exception)) {
	$message = [
		'type' => 'error',
		'message' => $exception->getMessage()
	];
}
?>

<?php if (!empty($message)): ?>
	<div class="my-3 alert alert-danger" role="alert">
		<?= $message['message'] ?>
	</div>
<?php endif ?>