<?php

class AuthorizationJsonResponseException extends JsonResponseException
{

	public function __construct($message = 'Authorization Required', $data = array())
	{
		parent::__construct(401, $message, 1, $data);
	}

}