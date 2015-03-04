<div class="row">
	<div class="col-md-12">
		<div class="page-header">
			<h1><?php echo __('Editar Usuario'); ?></h1>
		</div>
		<?php echo $this->Session->flash(); ?>	
	</div>
	<div class="col-xs-12">
		<p>
		<?php 
			$this->Html->addCrumb(__('Usuarios'), '/users');
			$this->Html->addCrumb(__('Editar Usuario'));
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
				<?php echo __('Editar Usuario') ?>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-6">
						<?php 
							echo $this->BsForm->create('User', array(
								'role' => 'form'));
							echo $this->BsForm->hidden('id');
							echo $this->BsForm->input('username', array(
								'placeholder' => __('Usuario'),
								'label' => __('Usuario'),
								'minlength' => '5'));
							echo $this->BsForm->input('first_name', array(
								'placeholder' => __('Nombre'),
								'label' => __('Nombre')));
							echo $this->BsForm->input('last_name', array(
								'placeholder' => __('Apellido'),
								'label' => __('Apellido')));
							echo $this->BsForm->input('position', array(
								'placeholder' => __('Posición'),
								'label' => __('Posición')));
							echo $this->BsForm->input('email', array(
								'placeholder' => __('Email'),
								'label' => __('Email')));
							echo $this->BsForm->select('role', $user, array(
								'selected' => $this->params->data['User']['role'],
								'required' => true,
								'label' => __('Grupo')));
							echo $this->BsForm->input('password', array(
								'required' => false,
								'placeholder' => __('Contraseña'),
								'label' => __('Contraseña'),
								'minlength' => '5'));
							echo $this->BsForm->input('password_confirmation', array(
								'required' => false,
								'placeholder' => __('Confirmar contraseña'),
								'label' => __('Confirmar contraseña'),
								'data-fv-identical' => 'true',
								'data-fv-identical-field' => 'data[User][password]',
								'data-fv-identical-message' => __('Las contraseñas no coinciden'),
								'type' => 'password'));
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
<?php echo $this->Html->script('/js/users/edit'); ?>
<?php $this->end();