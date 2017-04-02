<?php

use Restserver\Libraries\REST_Controller;

require(APPPATH . 'libraries/REST_Controller.php');

class SoldController extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('RequestValidator');
        $this->load->library('RequestProcessor');
    }

    public function sold_post()
    {
        $email = $this->post('email');
        $requestData['Email'] = $email;
        $requestData['Amount'] = $this->post('orderData')['amount'];
        $requestData['Currency'] = $this->post('orderData')['currency'];

        $requestCredentials = explode(',', $this->head('Authorization'));
        $clientId = $requestCredentials[0];
        $secretKey = $requestCredentials[1];

        try {
            $this->requestvalidator->validateRequestCredentials($email, $clientId, $secretKey);
            $this->requestprocessor->processRequest($requestData);

            $apiResponse['Message'] = 'Operation successful';
            $this->response(['Status' => 'Success']);
        } catch (Exception $e) {
            $apiResponse['Message'] = $e->getMessage();
            $this->response(['Status' => 'Error', 'Message' => $e->getMessage()]);
        }
    }
 }
