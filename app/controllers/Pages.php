<?php
class Pages extends Controller{
    public function __construct(){
      // echo "pages construct";
    }
    public function index(){
      $data=[
        'title'=>'My Title'
      ];
      $this->view('pages/index', $data);
    }
    public function about(){
$this->view('pages/about');
    }
}

?>
