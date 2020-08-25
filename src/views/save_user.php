<main class="content">
	<?php
		renderTitle(
			'Cadastro de usuário',
			'Crei e atualize o usuário',
			'icofont-user'
		);

		include(TEMPLATE_PATH . '/messages.php');
	?>

	<form action="" method="post">
		<div class="form-row">
			<div class="form-group col-md-6">
				<label for="name">Nome</label>
				<input type="text" id="name" name="name" placeholder="Informe o nome" 
					class="form-control <?= isset($errors['name']) ? 'is-invalid' : '' ?>"
					value="<?= $name ?? '' ?>">
				<div class="invalid-feedback">
					<?= isset($errors['name']) ?>
				</div>
			</div>
			<div class="form-group col-md-6">
				<label for="email">E-mail</label>
				<input type="email" id="email" name="email" placeholder="Informe o e-mail" 
					class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>"
					value="<?= $email ?? '' ?>">
				<div class="invalid-feedback">
					<?= isset($errors['email']) ?>
				</div>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-6">
				<label for="password">Senha</label>
				<input type="password" id="password" name="password" placeholder="Informe a senha" 
					class="form-control <?= isset($errors['password']) ? 'is-invalid' : '' ?>">
				<div class="invalid-feedback">
					<?= isset($errors['password']) ?>
				</div>
			</div>
			<div class="form-group col-md-6">
				<label for="confirm_password">Confirme a senha</label>
				<input type="password" id="confirm_password" name="confirm_password" placeholder="Confirme a senha" 
					class="form-control <?= isset($errors['confirm_password']) ? 'is-invalid' : '' ?>">
				<div class="invalid-feedback">
					<?= isset($errors['confirm_password']) ?>
				</div>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-6">
				<label for="start_date">Data de admissão</label>
				<input type="date" id="start_date" name="start_date"
					class="form-control <?= isset($errors['start_date']) ? 'is-invalid' : '' ?>"
					value="<?= $start_date ?? '' ?>">
				<div class="invalid-feedback">
					<?= isset($errors['start_date']) ?>
				</div>
			</div>
			<div class="form-group col-md-6">
				<label for="end_date">Data de desligamento</label>
				<input type="date" id="end_date" name="end_date" 
					class="form-control <?= isset($errors['end_date']) ? 'is-invalid' : '' ?>"
					value="<?= $end_date ?? '' ?>">
				<div class="invalid-feedback">
					<?= isset($errors['end_date']) ?>
				</div>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-6">
				<label for="is_admin">Adminstrador?</label>
				<input type="checkbox" id="is_admin" name="is_admin" 
					<?= isset($errors['is_admin']) ? 'is-invalid' : '' ?>"
					<?= !empty($is_admin) ? 'checked' : '' ?>>
				<div class="invalid-feedback">
					<?= isset($errors['is_admin']) ?>
				</div>
			</div>
		</div>
		<div>
			<button class="btn btn-lg btn-primary">Salvar</button>
			<a href="/users.php" class="btn btn-lg btn-secondary">Cancelar</a>
		</div>
	</form>
</main>