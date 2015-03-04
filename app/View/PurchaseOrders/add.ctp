<?php $this->append('css') ?>
<?php echo $this->Html->css(array(
	'/bower/jqueryui/themes/base/jquery-ui.min',
	'/bower/bootstrap-datepicker/css/datepicker3',
));
?>
<?php $this->end(); ?>
<div class="row">
	<div class="col-md-12">
		<div class="page-header">
			<h1><?php echo __('Crear Orden de Compra'); ?></h1>
		</div>
		<?php echo $this->Session->flash(); ?>
	</div>
	<div class="col-xs-12">
		<p>
		<?php
			$this->Html->addCrumb(__('Ordenes de Compra'), '/purchaseOrders');
			$this->Html->addCrumb(__('Crear Ordern de Compra'));
			echo $this->Html->getCrumbs(' > ', __('Inicio'));
		?>
		</p>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-file-archive-o"></i> -
				<?php echo __('Crear Orden de Compra') ?>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-7">
						<?php
							echo $this->BsForm->create('PurchaseOrder', array(
								'role' => 'form'));
							echo $this->Form->hidden('Product.id');
							echo $this->BsForm->input('date', array(
								'placeholder' => __('Fecha'),
								'label' => __('Fecha'),
								'type' => 'text',
								'required' => 'true'));
							echo $this->BsForm->select('Provider.id', $providers, array(
								'label' => __('Proveedor'),
								'empty' => __('Seleccione un proveedor')));
							echo $this->BsForm->select('Warehouse.id', $warehouses, array(
								'label' => __('Almacén'),
								'empty' => __('Seleccione un almacén')));
							echo $this->BsForm->input('Product.code', array(
								'placeholder' => __('Código de producto'),
								'label' => __('Código de producto'),
								'data-fv-callback' => 'true',
								'data-fv-callback-message' => __('Código Producto no existe en la Base de datos (Seleccione un resultado)'),
								'data-fv-callback-callback' => 'validateProductCode',
								'required' => 'true'));
							echo $this->BsForm->input('Product.name', array(
								'placeholder' => __('Nombre de producto'),
								'label' => __('Nombre de producto'),
								'data-fv-callback' => 'true',
								'data-fv-callback-message' => __('Nombre Producto no existe en la Base de datos (Seleccione un resultado)'),
								'data-fv-callback-callback' => 'validateProductName',
								'required' => 'true'));
							echo $this->BsForm->input('Item.serial', array(
								'required' => 'true',
								'placeholder' => __('Serial'),
								'label' => __('Serial')));
							echo $this->BsForm->radio('ProductType', array(
								'single' => __('Unitario'),
								'batch' => __('Lote')),
								array(
									'label' => __('Tipo'),
									'required' => 'true',
									'data-fv-notempty-message' => __('Seleccione una opción')));
							echo $this->BsForm->input('Batch.quantity', array(
								'placeholder' => __('Cantidad'),
								'label' => __('Cantidad'),
								'disabled' => 'true',
								'data-fv-numeric' => 'true',
								'min' => '1'));
							echo $this->BsForm->input('Item.expiration_date', array(
								'placeholder' => __('Fecha de vencimiento'),
								'label' => __('Fecha de vencimiento'),
								'type' => 'text',
								'required' => 'true'));
							?>
							<div class="col-xs-12 col-sm-offset-2">
								<div class="btn-toolbar">
								<?php
									echo $this->Bs->btn(__('Regresar'), '', array(
										'size' => 'md',
										'tag' => 'button',
										'type' => 'warning',
										'disabled' => 'disabled',
										'id' => 'prev'));
									echo $this->Bs->btn(__('Siguiente'), '', array(
										'size' => 'md',
										'tag' => 'button',
										'type' => 'info',
										'disabled' => 'disabled',
										'id' => 'next'));
									echo $this->Form->button(__('Limpiar'), array(
										'type' => 'reset',
										'id' => 'reset',
										'class' => 'btn btn-danger'));
									echo $this->Bs->btn(__('Agregar producto'), '', array(
										'size' => 'md',
										'tag' => 'button',
										'type' => 'success',
										'id' => 'add'));
									echo $this->Form->button(__('Crear Orden'), array(
										'type' => 'reset',
										'id' => 'reset',
										'class' => 'btn btn-primary'));
								?>
								</div>
							</div>
							<?php echo $this->BsForm->end(); ?>
					</div>
				</div>
			</div>
		</div>
	</div><!-- end col md 12 -->
</div><!-- end row -->
<?php $this->append('script') ?>
<?php echo $this->Html->script('/bower/jqueryui/jquery-ui.min') ?>
<?php echo $this->Html->script('/bower/bootstrap-datepicker/js/bootstrap-datepicker') ?>
<?php echo $this->Html->script('/bower/bootstrap-datepicker/js/locales/bootstrap-datepicker.es') ?>
<?php echo $this->Html->script('/js/purchase_orders/add'); ?>
<?php $this->end();