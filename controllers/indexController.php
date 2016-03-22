<?php
class indexController extends Controller{
    public function __construct() {
        parent::__construct();
    }
    public function index() 
    {
       header('Location: ' . BASE_URL . 'login');
    }

}

