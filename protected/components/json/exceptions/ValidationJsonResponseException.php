<?php

class ValidationJsonResponseException extends JsonResponseException
{

	public function __construct($message='Validation Errors', $data = array())
	{
		parent::__construct(400, $message, 3, $data);
	}

}