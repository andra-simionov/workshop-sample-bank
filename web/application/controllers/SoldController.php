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
        $requestData['Email'] = $this->post(['Email']);
        $requestData['Amount'] = $this->post(['Amount']);
        $requestData['Currency'] = $this->post(['Currency']);

        $requestData['ClientId'] = $this->head('ClientId');
        $requestData['SecretKey'] = $this->head('SecretKey');

        try {
            $this->requestvalidator->checkUserCredentials($requestData);
            $this->requestprocessor->processRequest($requestData);

            $apiResponse['Message'] = 'Operation successful';
            $this->response(['Status' => 'Success']);
        } catch (Exception $e) {
            $apiResponse['Message'] = $e->getMessage();
            $this->response(['Status' => 'Error']);
        }
    }
 }
