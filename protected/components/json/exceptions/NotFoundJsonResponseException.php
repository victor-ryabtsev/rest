<?php

class NotFoundJsonResponseException extends JsonResponseException
{

	public function __construct($message="Not Found", $data = array())
	{
		parent::__construct(404, $message, 2, $data);
	}

}