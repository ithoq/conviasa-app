<div class="row">
	<div class="col-md-12">
		<div class="page-header">
			<h1><?php echo __('Editar Producto'); ?></h1>
		</div>
		<?php echo $this->Session->flash(); ?>	
	</div>
	<div class="col-xs-12">
		<p>
		<?php 
			$this->Html->addCrumb(__('Productos'), '/products');
			$this->Html->addCrumb(__('Editar Producto'));
			echo $this->Html->getCrumbs(' > ', __('Inicio'));
		?>
		</p>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-shopping-cart"></i> - 
				<?php echo __('Editar Producto') ?>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-6">
						<?php 
							echo $this->BsForm->create('Product', array(
								'role' => 'form'));
							echo $this->BsForm->hidden('id');
							echo $this->BsForm->input('code', array(
								'placeholder' => __('Código'),
								'label' => __('Código')));
							echo $this->BsForm->input('name', array(
								'placeholder' => __('Nombre de producto'),
								'label' => __('Nombre')));
							echo $this->Form->submit(__('Editar Usuario'), array(
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
<?php echo $this->Html->script('/js/products/edit'); ?>
<?php $this->end();