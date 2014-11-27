<?php
App::uses('AppController', 'Controller');
/**
 * Assets Controller
 *
 * @property Asset $Asset
 * @property PaginatorComponent $Paginator
 */
class AssetsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Asset->recursive = 0;
		$this->set('assets', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Asset->exists($id)) {
			throw new NotFoundException(__('Invalid asset'));
		}
		$options = array('conditions' => array('Asset.' . $this->Asset->primaryKey => $id));
		$this->set('asset', $this->Asset->find('first', $options));
	}


	public function add($type=null,$id = null) {

		if ($this->request->is('post')) {
			if (isset($this->request->data['Asset']['vgaljson'])){
				$vgal=json_decode($this->request->data['Asset']['vgaljson'],true);
				//again, need to do this Delete after save somehow but this is Q&D
				$this->Asset->deleteAll(array('Asset.template_id'=>$id));
				
				//loop through treasures
				foreach ($vgal['apivar']['Items'] as $key=>$value){
					if (isset($value['TreasuresUsergal']['comments'])) $comment=$value['TreasuresUsergal']['comments'];
					else $comment=$value['Treasure']['synopsis'];
					$this->Asset->create();
					$asset['name']='treasure';
					$asset['asset_text']=$comment;
					$asset['asset_image']=$value['Treasure']['img'];
					$asset['sortorder']=$value['TreasuresUsergal']['ord'];
					$asset['template_id']=$this->request->data['Asset']['template_id'];
					//debug($value);
					//need to set some login for this Delete after the save . . .
					
					if ($this->Asset->save($asset)) {
						//$this->Session->setFlash(__('The asset has been saved.'));
						//return $this->redirect(array('action' => 'index'));
					}
					else {
						$this->Session->setFlash(__('Something went horribly wrong.'));
					}
				}
				//complete other saves
				$asset=array();
				$this->Asset->create();
				$asset['template_id']=$this->request->data['Asset']['template_id'];
				$asset['name']='description';
				$asset['asset_text']=$vgal['apivar']['Usergal']['Usergal']['gloss'];
				
				if ($this->Asset->save($asset)) ;
				else $this->Session->setFlash(__('Something went horribly wrong.'));
				
				//debug($vgal);
				//need some redirect, session msg, etc. here for now just this
				return true;	
			}
			if (isset($this->request->data['Asset']['blogjson'])){
			
				$blog=json_decode($this->request->data['Asset']['blogjson']);
				debug((array)$this->request->data['Asset']['blogjson']);
				
				/****
				LEFT OFF HREE
				need null check as some results don't encode (i.e. blog id 23294 returns null and 23159 encodes properly)
				**/
				debug($blog);
				return true;
			}
			
		//debug($this->request->data);
		$asset=array();
		
		//left as proof of concept but now img and text can be a single field
		foreach ($this->request->data['Attribute'] as $key=>$value){
			$this->Asset->create();
			$asset['name']=$key;
			$asset['asset_text']=$value;
			$asset['template_id']=$this->request->data['Asset']['template_id'];
			
			//need to set some login for this Delete after the save . . .
			$this->Asset->deleteAll(array('Asset.template_id'=>$id));
			if ($this->Asset->save($asset)) {
				$this->Session->setFlash(__('The asset has been saved.'));
				//return $this->redirect(array('action' => 'index'));
			}
			else {
				$this->Session->setFlash(__('Something went horribly wrong.'));
			}
			//debug($asset);
		}
		/*
			$this->Asset->create();
			if ($this->Asset->save($this->request->data)) {
				$this->Session->setFlash(__('The asset has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The asset could not be saved. Please, try again.'));
			}
			*/
		}
		$template = $this->Asset->Template->find('first',array('conditions'=>array('Template.id'=>$id)));
		$this->set(compact('type','template','id'));
	}

	public function ajaxblog() {
		//disabled for testing
		//if ($this->request->is('ajax')) {
		
		$ch = curl_init();
		$timeout = 5;
 		curl_setopt($ch,CURLOPT_URL,'http://centerofthewest.org/wp-json/posts/'.$this->request->data['Asset']['blogid'].'/');
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
		$data = curl_exec($ch);
		curl_close($ch);
		//just send straight data and we'll decode when the form is submitted
         $this->set('content', $data); 

        $this->render('ajax_response', 'ajax');
		//}
    }
	
	public function ajaxvgal() {
		//disabled for testing
		//if ($this->request->is('ajax')) {
		
		$ch = curl_init();
		$timeout = 5;
 		curl_setopt($ch,CURLOPT_URL,'http://collections.centerofthewest.org/usergals/view/'.$this->request->data['Asset']['vgalid'].'.json');
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
		$data = curl_exec($ch);
		curl_close($ch);
		//just send straight data and we'll decode when the form is submitted
         $this->set('content', $data); 

        $this->render('ajax_response', 'ajax');
		//}
    }

/*
	public function edit($id = null) {
		if (!$this->Asset->exists($id)) {
			throw new NotFoundException(__('Invalid asset'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Asset->save($this->request->data)) {
				$this->Session->setFlash(__('The asset has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The asset could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Asset.' . $this->Asset->primaryKey => $id));
			$this->request->data = $this->Asset->find('first', $options);
		}
		$templates = $this->Asset->Template->find('list');
		$this->set(compact('templates'));
	}


	public function delete($id = null) {
		$this->Asset->id = $id;
		if (!$this->Asset->exists()) {
			throw new NotFoundException(__('Invalid asset'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Asset->delete()) {
			$this->Session->setFlash(__('The asset has been deleted.'));
		} else {
			$this->Session->setFlash(__('The asset could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	*/
}
