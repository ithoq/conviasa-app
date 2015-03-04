<div class="row">
	<div class="col-md-12">
		<div class="page-header">
			<h1><?php echo __('Detalle de Usuario'); ?></h1>
		</div>
		<?php echo $this->Session->flash(); ?>
	</div>
	<div class="col-xs-12">
		<p>
		<?php
			$this->Html->addCrumb(__('Usuarios'), '/users');
			$this->Html->addCrumb(__('Detalle de Usuario'));
			echo $this->Html->getCrumbs(' > ', __('Inicio'));
		?>
		</p>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-user"></i> - 
				<?php echo __('Detalle de Usuario') ?>
			</div>
			<div class="panel-body">
				<dl class="dl-horizontal">
					<dt><?php echo __('Usuario'); ?></dt>
					<dd>
						<?php echo h($user['User']['username']); ?>
					</dd>
					<dt><?php echo __('Nombre'); ?></dt>
					<dd>
						<?php echo h($user['User']['first_name']); ?>
					</dd>
					<dt><?php echo __('Apellido'); ?></dt>
					<dd>
						<?php echo h($user['User']['last_name']); ?>
					</dd>
					<dt><?php echo __('Posición'); ?></dt>
					<dd>
						<?php echo h($user['User']['position']); ?>
					</dd>
					<dt><?php echo __('Email'); ?></dt>
					<dd>
						<?php echo h($user['User']['email']); ?>
					</dd>
					</br>
					<dd></dd>
					<dt><?php echo $this->Html->link(__('Volver'), array('action' => 'index'), array('class' => 'btn btn-primary')); ?></dt>
				</dl>
			</div>
		</div>
	</div><!-- end col md 9 -->
</div>