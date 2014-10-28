<?php

/**
 * RestCHttpRequest class to work with POST, PUT and DELETE requests with params in json format.
 */
class RestCHttpRequest extends CHttpRequest
{
	private $_restPutParams;
	private $_restPostParams;
	private $_restDeleteParams;

	public function getPutParams()
	{
		if ($this->_restPutParams === null) {
			$this->_restPutParams = $this->getIsPutRequest() ? CJSON::decode(file_get_contents('php://input')) : array();
		}
		return $this->_restPutParams;
	}

	public function getPut($name, $defaultValue = null)
	{
		$params = $this->getPutParams();
		return isset($params[$name]) ? $params[$name] : $defaultValue;
	}

	public function getPostParams()
	{
		if ($this->_restPostParams === null) {
			$this->_restPostParams = $this->getIsPostRequest() ? CJSON::decode(file_get_contents('php://input')) : array();
		}
		return $this->_restPostParams;
	}

	public function getPost($name, $defaultValue = null)
	{
		$params = $this->getPostParams();
		return isset($params[$name]) ? $params[$name] : $defaultValue;
	}

	public function getDeleteParams()
	{
		if ($this->_restDeleteParams === null) {
			$this->_restDeleteParams = $this->getIsDeleteRequest() ? CJSON::decode(file_get_contents('php://input')) : array();
		}
		return $this->_restDeleteParams;
	}

	public function getDelete($name, $defaultValue = null)
	{
		$params = $this->getDeleteParams();
		return isset($params[$name]) ? $params[$name] : $defaultValue;
	}

}

