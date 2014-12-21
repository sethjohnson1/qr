<?php
/**
 * CommentsUserFixture
 *
 */
class CommentsUserFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'comment_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'rating' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'vote' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'flagged' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'user_id' => 1,
			'comment_id' => 1,
			'created' => '2014-12-20 23:54:58',
			'modified' => '2014-12-20 23:54:58',
			'rating' => 1,
			'vote' => 1,
			'flagged' => 1
		),
	);

}
