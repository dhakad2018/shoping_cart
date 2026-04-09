<?php
class Cart_model extends CI_Model {

    public function get_products(){
        return $this->db->get('products')->result();
    }

    public function get_product($id){
        return $this->db->get_where('products',['id'=>$id])->row();
    }

    public function save_order($data,$cart){

        $total = 0;
        foreach($cart as $item){
            $total += $item['price'] * $item['qty'];
        }

        $order = [
            'name'=>$data['name'],
            'mobile'=>$data['mobile'],
            'email'=>$data['email'],
            'total'=>$total
        ];

        $this->db->insert('orders',$order);
        $order_id = $this->db->insert_id();

        foreach($cart as $item){
            $this->db->insert('order_items',[
                'order_id'=>$order_id,
                'product_id'=>$item['id'],
                'quantity'=>$item['qty'],
                'price'=>$item['price']
            ]);
        }

        return $order_id;
    }
}