<?php
class Supermarket_model extends CI_Model{

    // Get product best price data for given quantity 
    function getProductPrice($title,$itemQuantity) {
        try {
            $this->db->where('item_name', $title);
            $result = $this->db->get('product_details')->row();
            $unitPrice = '';
        if (is_object($result)) {
            $unitPrice = $result->unit_price;  
            $specialTotalPrice = 0;              

            $responseArr = array();
            if ($result->has_special_price == 1) {
                $this->db->where('item_id', $result->id);
                $this->db->where('special_unit <=', $itemQuantity);
                $specialPriceData = $this->db->get('special_price')->result();
                if ( count($specialPriceData) > 0 ) {
                    foreach ($specialPriceData as $specialPrice) {
                        $specialUnit = $specialPrice->special_unit;
                        $specialPrice = $specialPrice->special_price;
                        $specialSlot = floor($itemQuantity / $specialUnit);
                        $specialSlotTotal = $specialSlot * $specialUnit;
                        $remainingQuantity = $itemQuantity - $specialSlotTotal;
                        if ($remainingQuantity > 0) {
                            $totalPrice = ($specialSlot * $specialPrice) + ($remainingQuantity * $unitPrice);
                        } else {
                            $totalPrice = $specialSlot * $specialPrice;
                        }
                            if ($specialTotalPrice == 0 || $totalPrice < $specialTotalPrice) 
                                $specialTotalPrice = $totalPrice;
                        }
                        $responseArr['unit_price'] = $unitPrice;
                        $responseArr['price'] = $specialTotalPrice;                    
                    } else {
                        $responseArr['unit_price'] = $unitPrice;
                        $responseArr['price'] = $unitPrice * $itemQuantity;
                    }

                } else {
                    $responseArr['unit_price'] = $unitPrice;
                    $responseArr['price'] = $unitPrice * $itemQuantity;
                }

            } else {
                $responseArr['unit_price']= $unitPrice;
                $responseArr['price']= $unitPrice * $itemQuantity;
            }
            return $responseArr;
        } catch (Exception $e) {
                log_message('error: ',$e->getMessage());
                return;
        }
    }

    //Get all product's data
    function getAllProducts() {
        try {
            return $this->db->get('product_details')->result();
        } catch (Exception $e) {
            log_message('error: ',$e->getMessage());
            return;
    }
    }
 
}