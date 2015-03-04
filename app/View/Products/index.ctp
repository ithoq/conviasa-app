<div class="row">
	<div class="col-md-12">
		<div class="page-header">
			<h1><?php echo __('Productos'); ?></h1>
		</div>
		<?php echo $this->Session->flash(); ?>	
	</div><!-- end col md 12 -->
	<div class="col-xs-10">
		<p>
		<?php 
			$this->Html->addCrumb(__('Productos'));
			echo $this->Html->getCrumbs(' > ', __('Inicio'));
		?>
		</p>
	</div>
	<div class="col-xs-2">
		<?php echo $this->Html->link(__('Crear Producto'), array(
			'controller' => 'products',
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
      	<i class="fa fa-shopping-cart"></i> - 
        <?php echo __('Lista de productos') ?>
      </div>
      <!-- /.panel-heading -->
      <div class="panel-body">
        <div class="dataTable_wrapper">
          <table class="table table-striped table-bordered" id="products">
          	<?php  ?>
            <thead>
            <?php echo $this->Html->tableHeaders(array(
							__('Código'),
							__('Nombre'),
							__('Acción')));
						?>
            </thead>
            <tfoot>
            <?php echo $this->Html->tableHeaders(array(
							__('Código'),
							__('Nombre'),
							__('Acción')));
						?>
            </tfoot>
            <tbody>
						<?php 
						foreach ($products as $key => $product) :
							$form =
							$this->BsForm->create('Product', array('action' => 'delete/' . $product['Product']['id'], 'id' => 'ProductDelete' . $product['Product']['id'])) .
							__('<p>¿Seguro que desea eliminar el producto <b>%s</b>?</p>', $product['Product']['name']) .
							$this->BsForm->end();
							echo $this->Html->tableCells(array(
								$product['Product']['code'],
								$product['Product']['name'],
								$this->Bs->btn(__('Ver'), array(
									'controller' => 'products',
									'action' => 'view',
									$product['Product']['id']),
									array(
										'size' => 'xs',
										'tag' => 'a',
										'type' => 'primary')) . ' ' .
								$this->Bs->btn(__('Editar'), array(
									'controller' => 'products',
									'action' => 'edit',
									$product['Product']['id']),
									array(
										'size' => 'xs',
										'tag' => 'a',
										'type' => 'warning')) . ' ' .
								$this->Bs->modal(
								__('Eliminar Producto'),
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
<?php echo $this->Html->script('/js/products/index'); ?>
<?php $this->end();