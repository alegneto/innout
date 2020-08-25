<main class="content">
	<?php
		renderTitle(
			'Relatório Gerencial',
			'Resumo das horas trabalhadas dos funcionários',
			'icofont-chart-histogram'
		);
	?>

	<div class="summary-boxes">
		<div class="summary-box bg-primary">
			<i class="icofont-users"></i>
			<p class="tittle">Qtde de Funcionários</p>
			<h3 class="value"><?= $activeUsersCount ?></h3>
		</div>
		<div class="summary-box bg-danger">
			<i class="icofont-patient-bed"></i>
			<p class="tittle">Faltas</p>
			<h3 class="value"><?= count($absentUsers) ?></h3>
		</div>
		<div class="summary-box bg-success">
			<i class="icofont-sand-clock"></i>
			<p class="tittle">Horas no mês</p>
			<h3 class="value"><?= $hoursInMonth ?></h3>
		</div>
	</div>

	<?php if (count($absentUsers) > 0): ?>
		<div class="card mt-4">
			<div class="card-header">
				<h4 class="card-tittle">Faltosos do Dia</h4>
				<p class="card-category">Relação dos funcionários que ainda não bateram o ponto</p>
			</div>
			<div class="card-body">
				<table class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th>Nome</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($absentUsers as $name): ?>
							<tr>
								<td>
									<?= $name ?>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	<?php endif; ?>
</main>