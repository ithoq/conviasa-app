<div class="row">
	<div class="col-md-12">
		<div class="page-header">
			<h1><?php echo __('Detalle de Proveedor'); ?></h1>
		</div>
		<?php echo $this->Session->flash(); ?>
	</div>
	<div class="col-xs-12">
		<p>
		<?php
			$this->Html->addCrumb(__('Proveedores'), '/providers');
			$this->Html->addCrumb(__('Detalle de Proveedor'));
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
				<?php echo __('Detalle de Proveedor') ?>
			</div>
			<div class="panel-body">
				<dl class="dl-horizontal">
					<dt><?php echo __('Nombre del proveedor'); ?></dt>
					<dd>
						<?php echo h($provider['Provider']['name']); ?>
					</dd>
					<dt><?php echo __('Cliente creado por:'); ?></dt>
					<dd>
						<?php echo h($provider['User']['first_name'] . ' ' . $provider['User']['last_name']); ?>
					</dd>
					</br>
					<dd></dd>
					<dt><?php echo $this->Html->link(__('Volver'), array('action' => 'index'), array('class' => 'btn btn-primary')); ?></dt>
				</dl>
			</div>
		</div>
	</div><!-- end col md 9 -->
</div>