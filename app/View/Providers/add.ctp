<div class="row">
	<div class="col-md-12">
		<div class="page-header">
			<h1><?php echo __('Crear Proveedor'); ?></h1>
		</div>
		<?php echo $this->Session->flash(); ?>	
	</div>
	<div class="col-xs-12">
		<p>
		<?php 
			$this->Html->addCrumb(__('Proveedores'), '/providers');
			$this->Html->addCrumb(__('Crear Proveedor'));
			echo $this->Html->getCrumbs(' > ', __('Inicio'));
		?>
		</p>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
      	<i class="fa fa-heartbeat"></i> - 
				<?php echo __('Crear proveedor') ?>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-6">
						<?php 
							echo $this->BsForm->create('Provider', array(
								'role' => 'form'));
							echo $this->BsForm->input('name', array(
								'placeholder' => __('Nombre de proveedor'),
								'label' => __('Proveedor')));
							echo $this->Form->submit(__('Crear Proveedor'), array(
								'class' => 'btn btn-primary',
								'div' => 'form-group',
								'before' => '<div class="col-md-offset-3 col-md-6">',
								'after' => '</div>'
								));
							echo $this->BsForm->end();
						?>
					</div>
				</div>
			</div>
		</div>
	</div><!-- end col md 12 -->
</div><!-- end row -->
<?php $this->append('script') ?>
<?php echo $this->Html->script('/js/providers/add'); ?>
<?php $this->end();