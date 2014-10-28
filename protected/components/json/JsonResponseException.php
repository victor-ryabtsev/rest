<?php

class JsonResponseException extends CHttpException
{
	/**
	 * @var array Error data
	 */
	protected $data;

	/**
	 * Constructor
	 *
	 * @param int $status
	 * @param null $message
	 * @param int $code
	 * @param array $data
	 */
	public function __construct($status, $message = null, $code = 0, $data=null)
	{
		$this->data = $data;
		parent::__construct($status, $message, $code);

	}

	public function getData() {
		return $this->data;
	}
}