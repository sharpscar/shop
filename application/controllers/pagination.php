<?php

class Pagination_lib extends CI_Controller {
  function __construct() {
      parent::__construct();
  }

  function index(){
      $this->load->library('pagination');

      $config['base_url'] = 'http://localhost/shop/index.php/test/index';
      $config['total_rows'] = 100;
      $config['per_page'] = 10;
      $config['uri_segment'] = 4;

      $this->pagination->initialize($config);
      $data['pagination'] = $this->pagination->create_links();

      $this->load->view('test',$data);
  }

}
?>
