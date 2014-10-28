<?php

class UserController extends RestController {

	public function actionList() {
		$sort = (isset($_GET['sort']) && $_GET['sort'] === 'desc') ? 'desc' : 'asc';
		$users = User::model()->getList($sort);

		$this->renderJson(User::usersToArray($users));
	}
}