<?php

class AddHeader
{
	protected $_headerName;
	protected $_headerValue;

	/**
	 * Construct the authentication object
	 *
	 * @param array $args
	 */
	public function __construct($args)
	{
		if (isset($args['header_name']))
			$this->setHeaderName($args['header_name']);
		else
			$this->setHeaderName('');

		if (isset($args['header_value']))
			$this->setHeaderValue($args['header_value']);
		else
			$this->setHeaderValue('');
	}

	/**
	 * Set header name
	 *
	 * @param string $headerName
	 */
	public function setHeaderName($headerName)
	{
		$this->_headerName = $headerName;
	}

	/**
	 * Set header value
	 *
	 * @param string $headerValue
	 */
	public function setHeaderValue($headerValue)
	{
		$this->_headerValue = $headerValue;
	}


	/**
	 * Set the header
	 *
	 * @param Spore $spore (reference)
	 */
	public function execute(&$spore)
	{
		// modify the request headers
		$client = RESTHttpClient:: getHttpClient();
		$client->createOrUpdateHeader($this->_headerName, $this->_headerValue);
	}
}
