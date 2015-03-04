<div class="row">
	<div class="col-md-12">
		<div class="page-header">
			<h1><?php echo __('Clientes'); ?></h1>
		</div>
		<?php echo $this->Session->flash(); ?>	
	</div><!-- end col md 12 -->
	<div class="col-xs-10">
		<p>
		<?php 
			$this->Html->addCrumb(__('Clientes'));
			echo $this->Html->getCrumbs(' > ', __('Inicio'));
		?>
		</p>
	</div>
	<div class="col-xs-2">
		<?php echo $this->Html->link(__('Crear Cliente'), array(
			'controller' => 'customers',
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
      	<i class="fa fa-user-plus"></i> - 
        <?php echo __('Lista de clientes') ?>
      </div>
      <!-- /.panel-heading -->
      <div class="panel-body">
        <div class="dataTable_wrapper">
          <table class="table table-striped table-bordered" id="customers">
          	<?php  ?>
            <thead>
            <?php echo $this->Html->tableHeaders(array(
							__('Nombre'),
							__('Email'),
							__('Número teléfonico'),
							__('Número teléfonico'),
							__('Dirección'),
							__('Ciudad'),
							__('País'),
							__('Acción')));
						?>
            </thead>
            <tfoot>
            <?php echo $this->Html->tableHeaders(array(
							__('Nombre'),
							__('Email'),
							__('Número teléfonico'),
							__('Número teléfonico'),
							__('Dirección'),
							__('Ciudad'),
							__('País'),
							__('Acción')));
						?>
            </tfoot>
            <tbody>
						<?php 
						foreach ($customers as $key => $customer) :
							$form =
							$this->BsForm->create('Customer', array('action' => 'delete/' . $customer['Customer']['id'], 'id' => 'CustomerDelete' . $customer['Customer']['id'])) .
							__('<p>¿Seguro que desea eliminar el cliente <b>%s</b>?</p>', $customer['Customer']['name']) .
							$this->BsForm->end();
							echo $this->Html->tableCells(array(
								$customer['Customer']['name'],
								$customer['Customer']['email'],
								$customer['Customer']['phone_number'],
								$customer['Customer']['phone_number2'],
								$customer['Customer']['address'],
								$customer['Customer']['city'],
								$this->Country->resolveCountryCode($customer['Customer']['country']),
								$this->Bs->btn(__('Ver'), array(
									'controller' => 'customers',
									'action' => 'view',
									$customer['Customer']['id']),
									array(
										'size' => 'xs',
										'tag' => 'a',
										'type' => 'primary')) . ' ' .
								$this->Bs->btn(__('Editar'), array(
									'controller' => 'customers',
									'action' => 'edit',
									$customer['Customer']['id']),
									array(
										'size' => 'xs',
										'tag' => 'a',
										'type' => 'warning')) . ' ' .
								$this->Bs->modal(
								__('Eliminar Cliente'),
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
<?php echo $this->Html->script('/js/customers/index'); ?>
<?php $this->end();