<div class="row">
	<div class="col-md-12">
		<div class="page-header">
			<h1><?php echo __('Detalle de Cliente'); ?></h1>
		</div>
		<?php echo $this->Session->flash(); ?>
	</div>
	<div class="col-xs-12">
		<p>
		<?php
			$this->Html->addCrumb(__('Clientes'), '/customers');
			$this->Html->addCrumb(__('Detalle de Cliente'));
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
				<?php echo __('Detalle de Cliente') ?>
			</div>
			<div class="panel-body">
				<dl class="dl-horizontal">
					<dt><?php echo __('Nombre'); ?></dt>
					<dd>
						<?php echo h($customer['Customer']['name']); ?>
					</dd>
					<dt><?php echo __('Email'); ?></dt>
					<dd>
						<?php echo h($customer['Customer']['email']); ?>
					</dd>
					<dt><?php echo __('Número de teléfono - 1'); ?></dt>
					<dd>
						<?php echo h($customer['Customer']['phone_number']); ?>
					</dd>
					<dt><?php echo __('Número de teléfono - 2'); ?></dt>
					<dd>
						<?php echo h($customer['Customer']['phone_number2']); ?>
					</dd>			
					<dt><?php echo __('Pais'); ?></dt>
					<dd>
						<?php echo h($this->Country->resolveCountryCode($customer['Customer']['country'])); ?>
					</dd>
					<dt><?php echo __('Ciudad'); ?></dt>
					<dd>
						<?php echo h($customer['Customer']['city']); ?>
					</dd>
					<dt><?php echo __('Dirección'); ?></dt>
					<dd>
						<?php echo h($customer['Customer']['address']); ?>
					</dd>
					<dt><?php echo __('Cliente creado por:'); ?></dt>
					<dd>
						<?php echo h($customer['User']['first_name'] . ' ' . $customer['User']['last_name']); ?>
					</dd>		
					</br>
					<dd></dd>
					<dt><?php echo $this->Html->link(__('Volver'), array('action' => 'index'), array('class' => 'btn btn-primary')); ?></dt>
				</dl>
			</div>
		</div>
	</div><!-- end col md 9 -->
</div>