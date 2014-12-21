<?php
App::uses('AppController', 'Controller');

class CommentsUsersController extends AppController {

	public $components = array('Paginator');
	
	public function comment_add() {
		//enable ajax-only before production
		debug($this->request->data);
		//if ($this->request->is('ajax')){

			$comments='after saving, we will find the comments again and display';
			$this->set('comments', $comments);
			//$this->render('comment_add', 'ajax');
			$this->layout = false;
			$this->render('comment_add');
			//eventually we'll need something like 'inline' layout

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
