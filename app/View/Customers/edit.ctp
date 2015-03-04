<div class="row">
	<div class="col-md-12">
		<div class="page-header">
			<h1><?php echo __('Editar Cliente'); ?></h1>
		</div>
		<?php echo $this->Session->flash(); ?>	
	</div>
	<div class="col-xs-12">
		<p>
		<?php 
			$this->Html->addCrumb(__('Clientes'), '/customers');
			$this->Html->addCrumb(__('Editar Cliente'));
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
				<?php echo __('Editar Cliente') ?>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-6">
						<?php 
							echo $this->BsForm->create('Customer', array(
								'role' => 'form'));
							echo $this->BsForm->hidden('id');
							echo $this->BsForm->input('name', array(
								'placeholder' => __('Nombre'),
								'label' => __('Nombre')));
							echo $this->BsForm->input('email', array(
								'placeholder' => __('Email'),
								'label' => __('Email')));
							echo $this->BsForm->input('phone_number', array(
								'placeholder' => __('Número telefónico'),
								'label' => __('Número telefónico')));
							echo $this->BsForm->input('phone_number2', array(
								'placeholder' => __('Número telefónico'),
								'label' => __('Número telefónico')));
							echo $this->Country->countries('Customer.country', array(
								'label' => __('País')));
							echo $this->BsForm->input('city', array(
								'placeholder' => __('Ciudad'),
								'label' => __('Ciudad')));
							echo $this->BsForm->input('address', array(
								'placeholder' => __('Dirección'),
								'label' => __('Dirección'),
								'type' => 'textarea'));
							echo $this->Form->submit(__('Crear Cliente'), array(
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
<?php echo $this->Html->script('/js/customers/edit'); ?>
<?php $this->end();