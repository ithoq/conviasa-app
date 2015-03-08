<div class="row">
	<div class="col-md-12">
		<div class="page-header">
			<h1><?php echo __('Tripulantes'); ?></h1>
		</div>
		<?php echo $this->Session->flash(); ?>	
	</div><!-- end col md 12 -->
	<div class="col-xs-10">
		<p>
		<?php 
			$this->Html->addCrumb(__('Tripulantes'));
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
      	<i class="fa fa-users"></i> - 
        <?php echo __('Lista de tripulantes') ?>
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
							__('Tipo de Tripulación'),
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
							__('Tipo de Tripulación'),
							__('Exp Simulador semestral'),
							__('Exp Simulador anual'),
							__('Visa'),
							__('Acción')));
						?>
            </tfoot>
            <tbody>
						<?php 
						foreach ($crews as $key => $crew) :
							$form =
							$this->BsForm->create('Crew', array('action' => 'delete/' . $crew['Crew']['id'], 'id' => 'CrewDelete' . $crew['Crew']['id'])) .
							__('<p>¿Seguro que desea eliminar el tripulante <b>%s</b>?</p>', $crew['Crew']['name']) .
							$this->BsForm->end();
							echo $this->Html->tableCells(array(
								$crew['Crew']['first_name'],
								$crew['Crew']['last_name'],
								$crew['Crew']['role_enum'],
								$this->Time->format($crew['Crew']['semestral_date'], '%d/%m/%Y'),
								$this->Time->format($crew['Crew']['annual_date'], '%d/%m/%Y'),
								$crew['Crew']['visa'] == 1 ? __('Sí') : __('No'),
								$this->Bs->btn(__('Ver'), array(
									'controller' => 'crews',
									'action' => 'view',
									$crew['Crew']['id']),
									array(
										'size' => 'xs',
										'tag' => 'a',
										'type' => 'primary')) . ' ' .
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