<div class="templates view">
<h2><?php echo __('Template'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($template['Template']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($template['Template']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($template['Template']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($template['Template']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Active'); ?></dt>
		<dd>
			<?php echo h($template['Template']['active']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Meta Title'); ?></dt>
		<dd>
			<?php echo h($template['Template']['meta_title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Meta Desc'); ?></dt>
		<dd>
			<?php echo h($template['Template']['meta_desc']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nextid'); ?></dt>
		<dd>
			<?php echo h($template['Template']['nextid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Previd'); ?></dt>
		<dd>
			<?php echo h($template['Template']['previd']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Code'); ?></dt>
		<dd>
			<?php echo h($template['Template']['code']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Template'), array('action' => 'edit', $template['Template']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Template'), array('action' => 'delete', $template['Template']['id']), array(), __('Are you sure you want to delete # %s?', $template['Template']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Templates'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Template'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Assets'), array('controller' => 'assets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Asset'), array('controller' => 'assets', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Beacons'), array('controller' => 'beacons', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Beacon'), array('controller' => 'beacons', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Assets'); ?></h3>
	<?php if (!empty($template['Asset'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Asset Value'); ?></th>
		<th><?php echo __('Template Id'); ?></th>
		<th><?php echo __('Sortorder'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($template['Asset'] as $asset): ?>
		<tr>
			<td><?php echo $asset['id']; ?></td>
			<td><?php echo $asset['name']; ?></td>
			<td><?php echo $asset['asset_value']; ?></td>
			<td><?php echo $asset['template_id']; ?></td>
			<td><?php echo $asset['sortorder']; ?></td>
			<td><?php echo $asset['created']; ?></td>
			<td><?php echo $asset['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'assets', 'action' => 'view', $asset['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'assets', 'action' => 'edit', $asset['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'assets', 'action' => 'delete', $asset['id']), array(), __('Are you sure you want to delete # %s?', $asset['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Asset'), array('controller' => 'assets', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Beacons'); ?></h3>
	<?php if (!empty($template['Beacon'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Active'); ?></th>
		<th><?php echo __('Uuid'); ?></th>
		<th><?php echo __('Major'); ?></th>
		<th><?php echo __('Minor'); ?></th>
		<th><?php echo __('Strength'); ?></th>
		<th><?php echo __('Museum'); ?></th>
		<th><?php echo __('Template Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($template['Beacon'] as $beacon): ?>
		<tr>
			<td><?php echo $beacon['id']; ?></td>
			<td><?php echo $beacon['name']; ?></td>
			<td><?php echo $beacon['created']; ?></td>
			<td><?php echo $beacon['modified']; ?></td>
			<td><?php echo $beacon['active']; ?></td>
			<td><?php echo $beacon['uuid']; ?></td>
			<td><?php echo $beacon['major']; ?></td>
			<td><?php echo $beacon['minor']; ?></td>
			<td><?php echo $beacon['strength']; ?></td>
			<td><?php echo $beacon['museum']; ?></td>
			<td><?php echo $beacon['template_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'beacons', 'action' => 'view', $beacon['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'beacons', 'action' => 'edit', $beacon['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'beacons', 'action' => 'delete', $beacon['id']), array(), __('Are you sure you want to delete # %s?', $beacon['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Beacon'), array('controller' => 'beacons', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
