<div class="row">
	<div class="col-md-12">
		<div class="page-header">
			<h1><?php echo __('Propuesta'); ?></h1>
		</div>
		<?php echo $this->Session->flash(); ?>
		</div><!-- end col md 12 -->
		<div class="col-xs-10">
			<p>
				<?php
					$this->Html->addCrumb(__('Propuesta'));
					echo $this->Html->getCrumbs(' > ', __('Inicio'));
				?>
			</p>
		</div>
		<div class="col-xs-2">
			<?php echo $this->Html->link(__('Registrar Tripulante'), array(
				'controller' => 'crews',
				'action' => 'add'),
				array(
					'class' => 'pull-right btn btn-success btn-sm'));
			?>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-edit"></i> -
					<?php echo __('Lista de propuestas') ?>
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body">
					<div class="dataTable_wrapper">
						<table class="table table-striped table-bordered" id="crews">
							<?php  ?>
							<thead>
								<?php echo $this->Html->tableHeaders(array(
															__('Capitan'),
															__('Sim Semestral'),
															__('Sim Anual'),
															__('Oficial'),
															__('Sim Semestral'),
															__('Sim Anual')));
								?>
							</thead>
							<tfoot>
							<?php echo $this->Html->tableHeaders(array(
															__('Capitan'),
															__('Sim Semestral'),
															__('Sim Anual'),
															__('Oficial'),
															__('Sim Semestral'),
															__('Sim Anual')));
							?>
							</tfoot>
							<tbody>
								<?php
								for ($i = 0; $i < $index; $i++) :
									$captainName = '';
									$captainSemestral = '';
									$captainAnnual = '';
									$oficerName = '';
									$oficerSemestral = '';
									$oficerAnnual = '';
									if (isset($captains[$i])) {
										if ($captains[$i]['Crew']['visa'] == 1) {
											$captainName = '<span style="color: green"><b>' . $captains[$i]['Crew']['name'] . '</b></span>';
										} else {
											$captainName = '<span style="color: blue"><b>' . $captains[$i]['Crew']['name'] . '</b></span>';
										}
										$captainSemestral = $captains[$i]['Crew']['semestral_date'];
										$captainAnnual = $captains[$i]['Crew']['annual_date'];
									}
									if (isset($oficers[$i])) {
										if ($oficers[$i]['Crew']['visa'] == 1) {
											$oficerName = '<span style="color: green"><b>' . $oficers[$i]['Crew']['name'] . '</b></span>';
										} else {
											$oficerName = '<span style="color: blue"><b>' . $oficers[$i]['Crew']['name'] . '</b></span>';
										}
										$oficerSemestral = $oficers[$i]['Crew']['semestral_date'];
										$oficerAnnual = $oficers[$i]['Crew']['annual_date'];
									}
									//Date Captains
									if ($captainSemestral != '' && $captainAnnual != '') {
										$now = time(); // or your date as well
										$captainSemestral = strtotime($captainSemestral);
										$captainAnnual = strtotime($captainAnnual);

										$datediffSemestral = abs($now - $captainSemestral);
										$datediffSemestral = floor($datediffSemestral/(60*60*24));
										if ($datediffSemestral <= 60) {
											$captainSemestral = '<span style="color: red">' . $this->Time->format($captainSemestral, '%d/%m/%Y') . '</span>';
										} else {
											$captainSemestral = $this->Time->format($captainSemestral, '%d/%m/%Y');
										}
										$datediffAnnual = abs($now - $captainAnnual);
										$datediffAnnual = floor($datediffAnnual/(60*60*24));
										if ($datediffAnnual <= 60) {
											$captainAnnual = '<span style="color: red">' . $this->Time->format($captainAnnual, '%d/%m/%Y') . '</span>';
										} else {
											$captainAnnual = $this->Time->format($captainAnnual, '%d/%m/%Y');
										}
									}
									//En Date Captain
									
									//Date Captains
									if ($oficerSemestral != '' && $oficerAnnual != '') {
										$now = time(); // or your date as well
										$oficerSemestral = strtotime($oficerSemestral);
										$oficerAnnual = strtotime($oficerAnnual);

										$datediffSemestral = abs($now - $oficerSemestral);
										$datediffSemestral = floor($datediffSemestral/(60*60*24));
										if ($datediffSemestral <= 60) {
											$oficerSemestral = '<span style="color: red">' . $this->Time->format($oficerSemestral, '%d/%m/%Y') . '</span>';
										} else {
											$oficerSemestral = $this->Time->format($oficerSemestral, '%d/%m/%Y');
										}
										$datediffAnnual = abs($now - $oficerAnnual);
										$datediffAnnual = floor($datediffAnnual/(60*60*24));
										if ($datediffAnnual <= 60) {
											$oficerAnnual = '<span style="color: red">' . $this->Time->format($oficerAnnual, '%d/%m/%Y') . '</span>';
										} else {
											$oficerAnnual = $this->Time->format($oficerAnnual, '%d/%m/%Y');
										}
									}
									//En Date Captain
									echo $this->Html->tableCells(array(
										$captainName,
										$captainSemestral,
										$captainAnnual,
										$oficerName,
										$oficerSemestral,
										$oficerAnnual)); ?>
								<?php
								endfor;
								?>
							</tbody>
						</table>
					</div>
				</div>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<?php $this->append('script'); ?>
	<?php echo $this->Html->script('/js/crews/index'); ?>
	<?php $this->end();