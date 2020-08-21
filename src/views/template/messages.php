<?php
$errors = [];

if (isset($_SESSION['message'])) {
	$message = $_SESSION['message'];
	unset($_SESSION['message']);
} elseif (!empty($exception)) {
	$message = [
		'type' => 'danger',
		'message' => $exception->getMessage()
	];

	if (get_class($exception) === 'ValidationException') {
		$errors = $exception->getErrors();
	}
}
?>

<?php if (!empty($message)): ?>
	<div class="my-3 alert alert-<?= $message['type'] ?? 'success' ?>" role="alert">
		<?= $message['message'] ?>
	</div>
<?php endif ?>