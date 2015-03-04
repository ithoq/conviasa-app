<div class="row">
	<div class="col-md-12">
		<div class="page-header">
			<h1><?php echo __('Proveedores'); ?></h1>
		</div>
		<?php echo $this->Session->flash(); ?>	
	</div><!-- end col md 12 -->
	<div class="col-xs-10">
		<p>
		<?php 
			$this->Html->addCrumb(__('Proveedores'));
			echo $this->Html->getCrumbs(' > ', __('Inicio'));
		?>
		</p>
	</div>
	<div class="col-xs-2">
		<?php echo $this->Html->link(__('Crear Proveedor'), array(
			'controller' => 'providers',
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
      	<i class="fa fa-heartbeat"></i> - 
        <?php echo __('Lista de Proveedores') ?>
      </div>
      <!-- /.panel-heading -->
      <div class="panel-body">
        <div class="dataTable_wrapper">
          <table class="table table-striped table-bordered" id="providers">
          	<?php  ?>
            <thead>
            <?php echo $this->Html->tableHeaders(array(
							__('Nombre'),
							__('Acción')));
						?>
            </thead>
            <tfoot>
            <?php echo $this->Html->tableHeaders(array(
							__('Nombre'),
							__('Acción')));
						?>
            </tfoot>
            <tbody>
						<?php 
						foreach ($providers as $key => $provider) :
							$form =
							$this->BsForm->create('Provider', array(
								'action' => 'delete/' . $provider['Provider']['id'],
								'id' => 'ProviderDelete' . $provider['Provider']['id'])) .
							__('<p>¿Seguro que desea eliminar el proveedor <b>%s</b>?</p>', $provider['Provider']['name']) .
							$this->BsForm->end();
							echo $this->Html->tableCells(array(
								$provider['Provider']['name'],
								$this->Bs->btn(__('Ver'), array(
									'controller' => 'providers',
									'action' => 'view',
									$provider['Provider']['id']),
									array(
										'size' => 'xs',
										'tag' => 'a',
										'type' => 'primary')) . ' ' .
								$this->Bs->btn(__('Editar'), array(
									'controller' => 'providers',
									'action' => 'edit',
									$provider['Provider']['id']),
									array(
										'size' => 'xs',
										'tag' => 'a',
										'type' => 'warning')) . ' ' .
								$this->Bs->modal(
								__('Eliminar Proveedor'),
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
<?php echo $this->Html->script('/js/providers/index'); ?>
<?php $this->end();