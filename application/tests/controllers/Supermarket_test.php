<?php

class Supermarket_test extends TestCase
{
	public function test_index()
	{
		$output = $this->request('GET', 'supermarket/index');
		$this->assertStringContainsString('Shopping Cart', $output);
	}
    
    public function test_getProductPrice(){
        $_POST["title"] = 'A';
		$_POST["quantity"] = '3';

		$this->CI->getProductPrice();
		$out = output();

		$searchString = $this->CI->input->post("searchString");
		echo $searchString;
    }
}
