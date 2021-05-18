<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supermarket extends CI_Controller {

	public function index()
	{
        $data = array();
        $products = $this->supermarket_model->getAllProducts();
        $data['products'] = $products;
        $this->load->view('cart_checkout', $data);
	}

    // Check the special price for this item
    public function getProductPrice(){
        if (isset($_POST['title']) && isset($_POST['quantity'])) {
            $result = $this->supermarket_model->getProductPrice($_POST['title'],$_POST['quantity']);
            if ($result) {
                echo json_encode($result);
            }
        }
    }
}
