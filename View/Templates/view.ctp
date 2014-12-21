<div class="templates view">
<?
//abandoning disqus to do it myself, their API is too annoying
//eventually I hope to make this into a plugin and put it into OC
// only display if Auth
if ($user){
	echo $this->Form->create('sComment');
	//echo $this->Form->input('vgalid');
	echo $this->Form->input('comment',array('type'=>'textarea'));		
	//echo $this->Form->input('rating',array('type'=>'number'));		
	echo $this->Form->input('Add',array('type'=>'button','id'=>'comment_add','label'=>false));	
	
	//echo $this->Form->submit('Submit');
	echo $this->Form->end(); 

	$data = $this->Js->get('#sCommentViewForm')->serializeForm(array('isForm' => true, 'inline' => true));
	$this->Js->get('#comment_add')->event(
        'click', $this->Js->request(
            array('controller' => 'commentsUsers', 'action' => 'comment_add',$id), array(
				'update' => '#comments',
				'async' => true,
				'data'=>$data,
				'dataExpression'=>true,
				'method'=>'POST'
                )
            )
    );
    
	echo $this->Js->writeBuffer();
 }
 else echo 'you must login to comment';
	?>
	<div id="comments" style="height: 300px; width:500px; border: solid black; padding: 12px 12px 12px 12px">
		<p>this is some text here</p>
	</div>
	<?


//debug($template['Asset']);
//this is a very quick example, obviously we'll want some lightbox here
foreach ($template['Asset'] as $asset){
	if ($asset['name']=='treasure'){
		echo $this->Html->image('uploads/'.$template['Template']['id'].'_'.$asset['id'].'.jpg', array(
			'alt'=>$asset['asset_text'],
			'url'=>'/img/uploads/'.$template['Template']['id'].'_'.$asset['filename'].'.jpg'
			
		));
	}
}
?>
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

