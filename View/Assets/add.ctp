<div class="assets form">
<?php 
	echo $this->Form->create('Asset');
		if ($type=='splash'){
			echo $this->Form->input('Attribute.image_path');
			echo $this->Form->input('Attribute.brief_text');
		}
		else if ($type=='vgal'){
		
			echo $this->Form->input('vgalid');
			echo $this->Form->input('Get info',array('type'=>'button','id'=>'vgalbutton'));
			echo $this->Form->input('vgaljson',array('id'=>'vgaljson','type'=>'textarea'));
			
		}
		else if ($type=='blog'){
			echo $this->Form->input('blogid');
			echo $this->Form->input('Get info',array('type'=>'button','id'=>'blogbutton'));
			echo $this->Form->input('blogjson',array('id'=>'blogjson','type'=>'textarea'));
		}
		else {
			echo $this->Form->input('name');
			echo $this->Form->input('asset_value');
			echo $this->Form->input('sortorder');
			
		}
		
		echo $this->Form->input('template_id',array('value'=>$id,'type'=>'hidden'));
		echo $this->Form->submit('Submit');
		echo $this->Form->end(); 
		//debug($template);

		?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Assets'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Templates'), array('controller' => 'templates', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Template'), array('controller' => 'templates', 'action' => 'add')); ?> </li>
	</ul>
</div>

<?php
	
	$data = $this->Js->get('#AssetAddForm')->serializeForm(array('isForm' => true, 'inline' => true));
    //on button click send request to controller and displays response data in chosen field
    /*$this->Js->get('#vgalbutton')->event(
            'click', $this->Js->request(
                array('controller' => 'assets', 'action' => 'ajaxvgal'), array(
					'update' => '#vgaljson',
					'async' => true,
					'data'=>$data,
					'dataExpression'=>true
                )
            )
    );
	*/
	$this->Js->get('#vgalbutton')->event(
            'click', $this->Js->request(
                array('controller' => 'assets', 'action' => 'ajaxvgal'), array(
					'update' => '#vgaljson',
					'async' => true,
					'data'=>$data,
					'dataExpression'=>true,
					'method'=>'POST'
                )
            )
    );
	
	$this->Js->get('#blogbutton')->event(
            'click', $this->Js->request(
                array('controller' => 'assets', 'action' => 'ajaxblog'), array(
					'update' => '#blogjson',
					'async' => true,
					'data'=>$data,
					'dataExpression'=>true,
					'method'=>'POST'
                )
            )
    );
    
	echo $this->Js->writeBuffer();
	?>
