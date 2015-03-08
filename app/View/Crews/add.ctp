<?php $this->append('css') ?>
<?php echo $this->Html->css(array(
	'/bower/bootstrap-datepicker/css/datepicker3',
));
?>
<?php $this->end(); ?>
<div class="row">
	<div class="col-md-12">
		<div class="page-header">
			<h1><?php echo __('Registrar Tripulante'); ?></h1>
		</div>
		<?php echo $this->Session->flash(); ?>	
	</div>
	<div class="col-xs-12">
		<p>
		<?php 
			$this->Html->addCrumb(__('Tripulantes'), '/crews');
			$this->Html->addCrumb(__('Registrar Tripulante'));
			echo $this->Html->getCrumbs(' > ', __('Inicio'));
		?>
		</p>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-user-plus"></i> - 
				<?php echo __('Registrar tripulante') ?>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-6">
						<?php 
							echo $this->BsForm->create('Crew', array(
								'role' => 'form'));
							echo $this->BsForm->input('first_name', array(
								'placeholder' => __('Nombre'),
								'label' => __('Nombre')));
							echo $this->BsForm->input('last_name', array(
								'placeholder' => __('Apellido'),
								'label' => __('Apellido')));
							echo $this->BsForm->select('role', $crew, array(
								'required' => true,
								'label' => __('Tipo')));
							echo $this->BsForm->input('semestral_date', array(
								'placeholder' => __('Fecha de vencimiento semestral'),
								'label' => __('Fecha de vencimiento semestral'),
								'type' => 'text',
								'required' => 'true'));
							echo $this->BsForm->input('annual_date', array(
								'placeholder' => __('Fecha de vencimiento anual'),
								'label' => __('Fecha de vencimiento anual'),
								'type' => 'text',
								'required' => 'true'));
							echo $this->BsForm->checkbox('visa', array(
								'label' => __('¿Tiene Visa?')));
							echo $this->Form->submit(__('Registrar Tripulante'), array(
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
<?php echo $this->Html->script('/bower/bootstrap-datepicker/js/bootstrap-datepicker') ?>
<?php echo $this->Html->script('/bower/bootstrap-datepicker/js/locales/bootstrap-datepicker.es') ?>
<?php echo $this->Html->script('/js/crews/add'); ?>
<?php $this->end();