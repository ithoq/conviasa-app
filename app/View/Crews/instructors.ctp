<div class="row">
	<div class="col-md-12">
		<div class="page-header">
			<h1><?php echo __('Instructores'); ?></h1>
		</div>
		<?php echo $this->Session->flash(); ?>
		</div><!-- end col md 12 -->
		<div class="col-xs-10">
			<p>
				<?php
					$this->Html->addCrumb(__('Instructores'));
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
					<i class="fa fa-graduation-cap"></i> -
					<?php echo __('Lista de Instructores') ?>
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body">
					<div class="dataTable_wrapper">
						<table class="table table-striped table-bordered" id="crews">
							<?php  ?>
							<thead>
								<?php echo $this->Html->tableHeaders(array(
															__('Nombre'),
															__('Apellido'),
															__('Exp Simulador semestral'),
															__('Exp Simulador anual'),
															__('Visa'),
															__('Acción')));
								?>
							</thead>
							<tfoot>
							<?php echo $this->Html->tableHeaders(array(
														__('Nombre'),
														__('Apellido'),
														__('Exp Simulador semestral'),
														__('Exp Simulador anual'),
														__('Visa'),
														__('Acción')));
							?>
							</tfoot>
							<tbody>
								<?php
								foreach ($crews as $key => $crew) :
									$now = time(); // or your date as well
								$crew['Crew']['semestral_date'] = strtotime($crew['Crew']['semestral_date']);
								$crew['Crew']['annual_date'] = strtotime($crew['Crew']['annual_date']);
									$datediffSemestral = abs($now - $crew['Crew']['semestral_date']);
									$datediffSemestral = floor($datediffSemestral/(60*60*24));
									if ($datediffSemestral <= 30) {
										$crew['Crew']['semestral_date'] = '<b style="color: red">' . $this->Time->format($crew['Crew']['semestral_date'], '%d/%m/%Y') . '</b>';
									} else {
										$crew['Crew']['semestral_date'] = '<b>' . $this->Time->format($crew['Crew']['semestral_date'], '%d/%m/%Y') . '</b>';
									}
									$datediffAnnual = abs($now - $crew['Crew']['annual_date']);
									$datediffAnnual = floor($datediffAnnual/(60*60*24));
									if ($datediffAnnual <= 30) {
										$crew['Crew']['annual_date'] = '<b style="color: red">' . $this->Time->format($crew['Crew']['annual_date'], '%d/%m/%Y') . '</b>';
									} else {
										$crew['Crew']['annual_date'] = '<b>' . $this->Time->format($crew['Crew']['annual_date'], '%d/%m/%Y') . '</b>';
									}
									$form =
									$this->BsForm->create('Crew', array('action' => 'delete/' . $crew['Crew']['id'], 'id' => 'CrewDelete' . $crew['Crew']['id'])) .
									__('<p>¿Seguro que desea eliminar el tripulante <b>%s</b>?</p>', $crew['Crew']['name']) .
									$this->BsForm->end();
									echo $this->Html->tableCells(array(
										$crew['Crew']['first_name'],
										$crew['Crew']['last_name'],
										$crew['Crew']['semestral_date'],
										$crew['Crew']['annual_date'],
										$crew['Crew']['visa'] == 1 ? __('Sí') : __('No'),
										$this->Bs->btn(__('Editar'), array(
											'controller' => 'crews',
											'action' => 'edit',
											$crew['Crew']['id']),
											array(
												'size' => 'xs',
												'tag' => 'a',
												'type' => 'warning')) . ' ' .
										$this->Bs->modal(
										__('Eliminar Tripulante'),
										$form, array('form' => true),
										array(
										'close' => array(
											'name' => __('Cancelar'),
											'class' => 'btn-primary'),
										'open' => array(
											'name' => __('Eliminar'),
											'class' => 'btn-danger btn-xs'),
										'confirm' => array(
											'name' => __('Eliminar'),
								'class' => 'btn-danger'))))); ?>
								<?php
								endforeach;
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