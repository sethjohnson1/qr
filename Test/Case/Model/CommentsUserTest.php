<?php
App::uses('CommentsUser', 'Model');

/**
 * CommentsUser Test Case
 *
 */
class CommentsUserTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.comments_user',
		'app.user',
		'app.comment'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->CommentsUser = ClassRegistry::init('CommentsUser');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->CommentsUser);

		parent::tearDown();
	}

}
