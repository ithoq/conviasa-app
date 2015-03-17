<div class="row">
	<div class="col-md-12">
		<div class="page-header">
			<h1><?php echo __('Definitivo'); ?></h1>
		</div>
		<?php echo $this->Session->flash(); ?>	
	</div><!-- end col md 12 -->
	<div class="col-xs-10">
		<p>
		<?php 
			$this->Html->addCrumb(__('Definitivo'));
			echo $this->Html->getCrumbs(' > ', __('Inicio'));
		?>
		</p>
	</div>
	<div class="col-xs-2">
		<?php echo $this->Html->link(__('Registrar Entrenamiento'), array(
			'controller' => 'trains',
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
      	<i class="fa fa-check-square-o"></i> - 
        <?php echo __('Definitivo') ?>
      </div>
      <!-- /.panel-heading -->
      <div class="panel-body">
        <div class="dataTable_wrapper">
          <table class="table table-striped table-bordered" id="final">
          	<?php  ?>
            <thead>
            <?php echo $this->Html->tableHeaders(array(
							__('Slot'),
							__('Capitán'),
							__('Primer Oficial'),
							__('Fecha'),
							__('instructor'),
							__('Lugar'),
							__('Acción')));
						?>
            </thead>
            <tbody>
						<?php 
						foreach ($trains as $key => $train) :
								$now = time(); // or your date as well
							  $train['Train']['date'] = strtotime($train['Train']['date']);
								$datediff = abs($now - $train['Train']['date']);
								$datediff = floor($datediff/(60*60*24));
								if ($datediff <= 60) {
									$train['Train']['date'] = '<td style="font-weight: bold; color: red">' . $this->Time->format($train['Train']['date'], '%d/%m/%Y') . '</td>';
								} else {
									$train['Train']['date'] = '<td>' . $this->Time->format($train['Train']['date'], '%d/%m/%Y') . '</td>';
								}
							$form =
							$this->BsForm->create('Train', array('action' => 'delete/' . $train['Train']['id'], 'id' => 'TrainDelete' . $train['Train']['id'])) .
							__('<p>¿Seguro que desea eliminar el entrnamiento?</p>') .
							$this->BsForm->end(); ?>
							<tr>
								<td><?php echo $train['Train']['slot'] ?></td>
								<td><?php echo $train['Train']['captain'] ?></td>
								<td><?php echo $train['Train']['oficer'] ?></td>
								<?php echo $train['Train']['date'] ?>
								<td><?php echo $train['Train']['instructor'] ?></td>
								<td><?php echo $train['Train']['place']?></td>
								<td>
								<?php
								echo $this->Bs->btn(__('Editar'), array(
									'controller' => 'trains',
									'action' => 'edit',
									$train['Train']['id']),
									array(
										'size' => 'xs',
										'tag' => 'a',
										'type' => 'warning')) . ' ' .
								$this->Bs->modal(
								__('Eliminar Entrenamiento'),
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
									'class' => 'btn-danger'))); ?>
								</td>
							</tr>
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

<!-- /.row -->
<?php $this->append('script'); ?>
<?php echo $this->Html->script('/js/trains/index'); ?>
<?php $this->end();