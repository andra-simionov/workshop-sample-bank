<?php

if (! defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class RequestProcessor
{
	/**
	 * RequestProcessor constructor.
	 */
	public function __construct()
	{
		$this->ci = & get_instance();
		$this->ci->load->model('RequestValidatorModel');
		$this->ci->load->model('CardDataModel');
	}

	/**
	 * @param string $email
	 * @return int
	 */
	public function processGetBalanceRequest($email)
	{
		return (int)$this->ci->CardDataModel->getUserBalanceByEmail($email);
	}

	/**
	 * @param string $email
	 * @param int $requestAmount
	 */
	public function processPayRequest($email, $requestAmount)
	{
		//TODO 6: what's the new balance? whou should save it in the database?
	}

	public function processRefundRequest($email, $requestAmount)
	{
		//TODO 9: put the money back to user's balance
	}
}
