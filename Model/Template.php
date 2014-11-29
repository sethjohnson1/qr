<?php
App::uses('AppModel', 'Model');
/**
 * Template Model
 *
 * @property Asset $Asset
 * @property Beacon $Beacon
 */
class Template extends AppModel {

	public function beforeSave($options=array()){
		if(!empty($this->data['Template']['nextid'])){
			if($prev=$this->find('first',array('conditions'=>array('Template.id'=>$this->data['Template']['nextid'])))){
				$savedata['id']=$prev['Template']['id'];
				$savedata['previd']=$this->data['Template']['id'];
				$this->Template->create();
				if ($this->Template->save($savedata)) return true;
				else return false;
				//debug($prev);
				//return false;
			}
			//lazy error checking, a message might be nice...
			else return false;
		}
		
		$this->data['Template']['ip'] = $_SERVER["REMOTE_ADDR"]; 

		//this should be return TRUE, but false for testing
		return true;
			
	}


	public $hasMany = array(
		'Asset' => array(
			'className' => 'Asset',
			'foreignKey' => 'template_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Beacon' => array(
			'className' => 'Beacon',
			'foreignKey' => 'template_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
