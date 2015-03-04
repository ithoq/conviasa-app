<div class="row">
	<div class="col-md-12">
		<div class="page-header">
			<h1><?php echo __('Almacenes'); ?></h1>
		</div>
		<?php echo $this->Session->flash(); ?>	
	</div><!-- end col md 12 -->
	<div class="col-xs-10">
		<p>
		<?php 
			$this->Html->addCrumb(__('Almacenes'));
			echo $this->Html->getCrumbs(' > ', __('Inicio'));
		?>
		</p>
	</div>
	<div class="col-xs-2">
		<?php echo $this->Html->link(__('Crear Almacen'), array(
			'controller' => 'warehouses',
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
      	<i class="fa fa-building"></i> - 
        <?php echo __('Lista de almacenes') ?>
      </div>
      <!-- /.panel-heading -->
      <div class="panel-body">
        <div class="dataTable_wrapper">
          <table class="table table-striped table-bordered" id="warehouses">
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
						foreach ($warehouses as $key => $warehouse) :
							$form =
							$this->BsForm->create('Warehouse', array(
								'action' => 'delete/' . $warehouse['Warehouse']['id'],
								'id' => 'WarehouseDelete' . $warehouse['Warehouse']['id'])) .
							__('<p>¿Seguro que desea eliminar el almacen <b>%s</b>?</p>', $warehouse['Warehouse']['name']) .
							$this->BsForm->end();
							echo $this->Html->tableCells(array(
								$warehouse['Warehouse']['name'],
								$this->Bs->btn(__('Ver'), array(
									'controller' => 'warehouses',
									'action' => 'view',
									$warehouse['Warehouse']['id']),
									array(
										'size' => 'xs',
										'tag' => 'a',
										'type' => 'primary')) . ' ' .
								$this->Bs->btn(__('Editar'), array(
									'controller' => 'warehouses',
									'action' => 'edit',
									$warehouse['Warehouse']['id']),
									array(
										'size' => 'xs',
										'tag' => 'a',
										'type' => 'warning')) . ' ' .
								$this->Bs->modal(
								__('Eliminar Almacén'),
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
<?php echo $this->Html->script('/js/warehouses/index'); ?>
<?php $this->end();