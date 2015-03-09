<?php $this->append('css') ?>
<?php echo $this->Html->css(array(
	'/bower/bootstrap-datepicker/css/datepicker3',
));
?>
<?php $this->end(); ?>
<div class="row">
	<div class="col-md-12">
		<div class="page-header">
			<h1><?php echo __('Editar Entrenamiento'); ?></h1>
		</div>
		<?php echo $this->Session->flash(); ?>	
	</div>
	<div class="col-xs-12">
		<p>
		<?php 
			$this->Html->addCrumb(__('Entrenamientos'), '/trains');
			$this->Html->addCrumb(__('Editar Entrenamiento'));
			echo $this->Html->getCrumbs(' > ', __('Inicio'));
		?>
		</p>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-check-square-o"></i> - 
				<?php echo __('Editar Entrenamiento') ?>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-6">
						<?php 
							echo $this->BsForm->create('Train', array(
								'role' => 'form'));
							echo $this->BsForm->hidden('id');
							echo $this->BsForm->input('slot', array(
								'placeholder' => __('Slot'),
								'label' => __('Slot')));
							echo $this->BsForm->select('captain', $captains, array(
								'label' => __('Capitán')));
							echo $this->BsForm->select('oficer', $oficers, array(
								'label' => __('Primer oficial')));
							echo $this->BsForm->input('date', array(
								'placeholder' => __('Fecha'),
								'label' => __('Fecha'),
								'type' => 'text',
								'required' => 'true'));
							echo $this->BsForm->input('instructor', array(
								'placeholder' => __('Instructor'),
								'label' => __('Instructor')));
							echo $this->BsForm->input('place', array(
								'placeholder' => __('Lugar'),
								'label' => __('Lugar')));
							echo $this->Form->submit(__('Editar Entrenamiento'), array(
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
<?php echo $this->Html->script('/js/trains/edit'); ?>
<?php $this->end();