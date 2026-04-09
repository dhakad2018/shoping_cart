<?php
class Cart extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Cart_model');
    }

    public function index(){
        $data['products'] = $this->Cart_model->get_products();
        $this->load->view('home',$data);
    }

    public function add(){
        $id = $this->input->post('id');
        $cart = $this->session->userdata('cart') ?? [];

        if(isset($cart[$id])){
            $cart[$id]['qty']++;
        } else {
            $p = $this->Cart_model->get_product($id);
            $cart[$id] = [
                'id'=>$p->id,
                'name'=>$p->name,
                'price'=>$p->price,
                'qty'=>1
            ];
        }

        $this->session->set_userdata('cart',$cart);
        echo json_encode(['status'=>'success']);
    }

    public function remove(){
        $id = $this->input->post('id');
        $cart = $this->session->userdata('cart');
        unset($cart[$id]);
        $this->session->set_userdata('cart',$cart);
    }

    public function cart(){
        $this->load->view('cart');
    }

    public function checkout(){
        $data = $this->input->post();
        $cart = $this->session->userdata('cart');

        $order_id = $this->Cart_model->save_order($data,$cart);
        $this->session->unset_userdata('cart');

        echo json_encode(['order_id'=>$order_id]);
    }

    public function success($id){
        $data['order_id']=$id;
        $this->load->view('success',$data);
    }
}