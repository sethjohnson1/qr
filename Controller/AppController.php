<?php

App::uses('Controller', 'Controller');

class AppController extends Controller {

	public $components = array('Users.RememberMe','DebugKit.Toolbar','Session','Cookie','Auth'=>array()
	
	);
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow();

		//users plugin blackhole fix, started somewhere in CakePHP 2.5.3
		if (isset($this->Security) && ( $this->action == 'login' || $this->action == 'reset_password')) {
			$this->Security->validatePost = false;
		}
			
			//for getting the user back to whence they came after logging in, using a whitelist for now
			if ($this->request->params['action']=='index'||$this->request->params['action']=='view'){
				//this is dirty, but for some reason it writes /qr/qr whenever redirecting, and I don't know how it will behave on its own domain (probably fine), 
				//so for now this little bit of dickery
				$current=explode('/',$this->here);
				unset($current[0]);
				unset($current[1]);
				$current=implode('/',$current);
				$current='/'.$current;
				$this->Session->write('location',$current);
			}
		require_once(APP.'Vendor'.DS.'disqusapi/disqusapi.php');
		$disqus = new DisqusAPI(Configure::read('disqusSecret'));
		/*debug($disqus->posts->create(array(
			//'forum'=>'centerofthewest',
			'message'=>'test message',
			'thread'=>1
		
		)));*/
		//3340880605 is the id of forum: iscouttest thread:test1
		$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		//don't enable this unless you want to make a thread for the url, eventually this will be somewhere else
		//debug($disqus->threads->create(array('url'=>$url,'forum'=>'iscouttest','title'=>'test1','access_token'=>Configure::read('disqusAccessToken'))));
	}
	

}
