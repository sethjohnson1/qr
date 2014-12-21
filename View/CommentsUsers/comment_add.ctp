<?
//I think this same view will be used for all the comments, not just add
//this should be a loop and formatted just like the comments section on the main view
foreach ($comments as $comment){
echo '<div style="border: 1px double green">';
	echo $this->Form->create($comment['Comment']['id']);
	//echo $this->Form->input('comment',array('type'=>'textarea'));		
	//echo $this->Form->input('rating',array('type'=>'number'));		
	echo $this->Form->input('UpVote',array(
		'div'=>false,'label'=>'[ + ]'.$comment['Comment']['upvotes'],
		'type'=>'button','id'=>'comment_up'.$comment['Comment']['id']
	));	
	echo $this->Form->input('DownVote',array(
		'div'=>false,'label'=>'[ + ]'.$comment['Comment']['downvotes'],
		'type'=>'button','id'=>'comment_down'.$comment['Comment']['id']
		));	
	
	echo $this->Form->input('Flag',array('div'=>false,'type'=>'button','id'=>'comment_flag'.$comment['Comment']['id'],'label'=>false));

//not sure even want to bother with nested. If so, it should be limited to 2 levels deep	
	//echo $this->Form->input('Reply',array('type'=>'button','id'=>'comment_reply'.$comment['Comment']['id'],'label'=>false));	
	
	//echo $this->Form->submit('Submit');
	echo $this->Form->end(); 

	$data = $this->Js->get('#'.$comment['Comment']['id'].'CommentAddForm')->serializeForm(array('isForm' => true, 'inline' => true));
	$this->Js->get('#comment_up'.$comment['Comment']['id'])->event(
        'click', $this->Js->request(
            array('controller' => 'commentsUsers', 'action' => 'comment_up',$comment['Comment']['id'],$comment['Comment']['template_id'],1), array(
				'update' => '#comments',
				'async' => true,
				'data'=>$data,
				'dataExpression'=>true,
				'method'=>'POST'
                )
            )
    );

	$this->Js->get('#comment_down'.$comment['Comment']['id'])->event(
        'click', $this->Js->request(
            array('controller' => 'commentsUsers', 'action' => 'comment_up',$comment['Comment']['id'],$comment['Comment']['template_id'],-1), array(
				'update' => '#comments',
				'async' => true,
				'data'=>$data,
				'dataExpression'=>true,
				'method'=>'POST'
                )
            )
    );
    
	echo $this->Js->writeBuffer();
	$total=$comment['Comment']['upvotes']-$comment['Comment']['downvotes'];
	echo $comment['Comment']['id'].'     '.$total.'<br />';
	
	echo '</div>';
	
	
}
?>