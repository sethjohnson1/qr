<?php
App::uses('AppController', 'Controller');

class CommentsUsersController extends AppController {

	public $components = array('Paginator');
	
	public function comment_add($id = null, $parentid=null) {
	//technically this should be on the Comment controller, as the junc table has nothing to do with add
	//but for now I just leave it..
	//be sure to turn this on in production
		//if ($this->request->is('ajax')){
			if ($this->Auth->user()){
			//debug($this->request->data);
				$uuid=String::uuid();
				$comment['id']=$uuid;
				$comment['thoughts']=$this->request->data['sComment']['comment'];
				if(isset($comment['rating'])) $comment['rating']=$this->request->data['sComment']['rating'];
				$comment['user_id']=$this->Auth->user('id');
				$comment['template_id']=$id;
				if (isset($parentid)) $comment['parent_id']=$parentid;
				$comment['visible']=1;
				$this->CommentsUser->Comment->create();
				if ($this->CommentsUser->Comment->save($comment)){
					//if that worked, find all the comments again for the view
					//this should be paginated, for now just finding them
					//and then it will be a basic mirror of the find on the CommentController
					$comments=$this->CommentsUser->Comment->find('all',array(
					'conditions'=>array('Comment.template_id'=>$id),
					'recursive'=>-1
					));
					
				}
				//this find is just to make testing easier
				$comments=$this->CommentsUser->Comment->find('all',array(
					'conditions'=>array('Comment.template_id'=>$id),
					'recursive'=>-1
					));
				$this->set('comments', $comments);
				//$this->render('comment_add', 'ajax');
				$this->layout = false;
				//$this->render('comment_add');
				//eventually we'll need something like 'inline' layout
			}
			else {
				echo 'you must be logged in to do this';
				$this->render(false,'ajax');
			}
		//}
	}	
	
	//this upvotes and downvotes
	public function comment_up($id = null, $templateid=null, $vote=null) {
		//if ($this->request->is('ajax')){
			if ($this->Auth->user()){
				$data['user_id']=$this->Auth->user('id');
				$data['comment_id']=$id;
				//this button should be disabled if they already upvoted, but we'll check the count here anyway
				$comment=$this->CommentsUser->find('first',array(
					'conditions'=>array('CommentsUser.comment_id'=>$id,'CommentsUser.user_id'=>$this->Auth->user('id')),
					'recursive'=>-1
				));
				$this->CommentsUser->create();
				if(!empty($comment)){
					if ($vote==1 && $comment['CommentsUser']['upvoted']!=true){
						$data['id']=$comment['CommentsUser']['id'];
						//$data['vote']=1;
					}
					else if ($vote==-1 && $comment['CommentsUser']['downvoted']!=true){
						$data['id']=$comment['CommentsUser']['id'];
						//$data['vote']=$comment['CommentsUser']['vote']-1;
					}
					else {
						//they have already voted this way or something else is wrong
						return false;
					}
				}

				if ($vote==1) $data['upvoted']=true;
				if ($vote==1 && $comment['CommentsUser']['downvoted']==true){
					$data['upvoted']=false;
					$data['downvoted']=false;

				}
				
				if ($vote==-1) $data['downvoted']=1;
				if ($vote==-1 && $comment['CommentsUser']['upvoted']==true){
					$data['upvoted']=false;
					$data['downvoted']=false;

				}
				//debug($comment);
				if($this->CommentsUser->save($data)){
					//update the actual comment with the new total
					$commentdata=$this->CommentsUser->Comment->find('first',array('recursive'=>-1));
					//debug($commentdata);
					if ($vote==1 && is_null($comment['CommentsUser']['upvoted'])) 
						$commentdata['Comment']['upvotes']=$commentdata['Comment']['upvotes']+1;
					if ($vote==-1 && is_null($comment['CommentsUser']['downvoted'])) 
						$commentdata['Comment']['downvotes']=$commentdata['Comment']['downvotes']+1;

					$this->CommentsUser->Comment->create();
					$commentdata['Comment']['id']=$id;
					//debug($commentdata);
					if ($this->CommentsUser->Comment->save($commentdata)){

					}

				}
				//$this->layout = false;
				$comments=$this->CommentsUser->Comment->find('all',array(
					'conditions'=>array('Comment.template_id'=>$templateid),
					'recursive'=>-1
					));
						//debug($comments);
				$this->set('comments',$comments);
				$this->render('comment_add','ajax');
			}
			else {
				echo 'you must be logged in to do this';
				$this->render(false,'ajax');
			}
		//}
	
	}
	

	public function index() {
		$this->CommentsUser->recursive = 0;
		$this->set('commentsUsers', $this->Paginator->paginate());
	}

	public function view($id = null) {
		if (!$this->CommentsUser->exists($id)) {
			throw new NotFoundException(__('Invalid comments user'));
		}
		$options = array('conditions' => array('CommentsUser.' . $this->CommentsUser->primaryKey => $id));
		$this->set('commentsUser', $this->CommentsUser->find('first', $options));
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->CommentsUser->create();
			if ($this->CommentsUser->save($this->request->data)) {
				$this->Session->setFlash(__('The comments user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The comments user could not be saved. Please, try again.'));
			}
		}
		$users = $this->CommentsUser->User->find('list');
		$comments = $this->CommentsUser->Comment->find('list');
		$this->set(compact('users', 'comments'));
	}

	public function edit($id = null) {
		if (!$this->CommentsUser->exists($id)) {
			throw new NotFoundException(__('Invalid comments user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->CommentsUser->save($this->request->data)) {
				$this->Session->setFlash(__('The comments user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The comments user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('CommentsUser.' . $this->CommentsUser->primaryKey => $id));
			$this->request->data = $this->CommentsUser->find('first', $options);
		}
		$users = $this->CommentsUser->User->find('list');
		$comments = $this->CommentsUser->Comment->find('list');
		$this->set(compact('users', 'comments'));
	}

	public function delete($id = null) {
		$this->CommentsUser->id = $id;
		if (!$this->CommentsUser->exists()) {
			throw new NotFoundException(__('Invalid comments user'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->CommentsUser->delete()) {
			$this->Session->setFlash(__('The comments user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The comments user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
