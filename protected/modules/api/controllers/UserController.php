<?php

class UserController extends RestController {

	public function actionList() {
		$sort = (isset($_GET['sort']) && $_GET['sort'] === 'desc') ? 'desc' : 'asc';
		$users = User::model()->getList($sort);

		$this->renderJson(User::usersToArray($users));
	}

	public function actionView($id) {
		$user = User::model()->findByPk($id);
		if (!$user) {
			$this->sendErrors(array('User not found'));
		}

		$this->renderJson(User::userToArray($user));
	}
}