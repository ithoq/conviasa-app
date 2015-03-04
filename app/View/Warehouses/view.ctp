<div class="row">
	<div class="col-md-12">
		<div class="page-header">
			<h1><?php echo __('Detalle de Almacén'); ?></h1>
		</div>
		<?php echo $this->Session->flash(); ?>
	</div>
	<div class="col-xs-12">
		<p>
		<?php
			$this->Html->addCrumb(__('Almacenes'), '/warehouses');
			$this->Html->addCrumb(__('Detalle de Almacen'));
			echo $this->Html->getCrumbs(' > ', __('Inicio'));
		?>
		</p>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-building"></i> - 
				<?php echo __('Detalle de Almacén') ?>
			</div>
			<div class="panel-body">
				<dl class="dl-horizontal">
					<dt><?php echo __('Nombre de almacén'); ?></dt>
					<dd>
						<?php echo h($warehouse['Warehouse']['name']); ?>
					</dd>
					</br>
					<dd></dd>
					<dt><?php echo $this->Html->link(__('Volver'), array('action' => 'index'), array('class' => 'btn btn-primary')); ?></dt>
				</dl>
			</div>
		</div>
	</div><!-- end col md 9 -->
</div>