<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
	    <div class="login-panel panel panel-info">
	      <div class="panel-heading">
	    		<h3 class="panel-title"><i class="fa fa-user"></i> - <?php echo __('ConviasaApp - Por favor inicie sesión') ?></h3>
	      </div>
				<div class="panel-body">
					<?php
						$this->assign('title', __('Login'));
						echo $this->Session->flash();
						echo $this->BsForm->create();
						echo $this->BsForm->input('username', array(
															'required' => true,
															'maxLength' => '45',
															'label' => __('Usuario'),
															'placeholder' => __('Nombre de Usuario'),
															'between' => '<div class="col-md-12">'));
						echo $this->BsForm->input('password', array(
															'required' => true,
															'minlength' => '5',
															'maxlength' => '255',
															'label' => __('Contraseña'),
															'placeholder' => __('Contraseña'),
															'between' => '<div class="col-md-12">'));
						echo $this->BsForm->checkbox('auto_login', array('label' => '¿Recordar Sesión?'));
						echo $this->Form->submit(__('Entrar'), array(
																					'class' => 'btn btn-success col-xs-4 col-xs-offset-4'));
						echo $this->BsForm->end();
					?>
				</div><!-- /.panel-body -->
			</div><!-- /.panel-info -->
		</div><!-- /.col-md-4-->
	</div><!-- /.row -->
</div><!-- /.container -->
<?php $this->append('script'); ?>
<script>
$(document).ready(function() {
  $('#UserLoginForm').formValidation({
      framework: 'bootstrap',
      locale: 'es_ES'
  })
});
</script>
<?php echo $this->end();