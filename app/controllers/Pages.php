<?php
class Pages extends Controller{
    public function __construct(){
      
    }
    public function index(){
      $data=[
        'title'=>'My Title'
      ];
      $this->view('pages/index', $data);
    }
    public function about($id){
      $this->view('pages/about');
    }
}

?>
