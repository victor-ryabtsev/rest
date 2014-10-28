<?php

class BadRequestJsonResponseException extends JsonResponseException
{

	public function __construct($message = "Bad request", $data = array())
	{
		parent::__construct(400, $message, 4, $data);
	}

}