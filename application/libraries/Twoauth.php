<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Twoauth
{
    protected $ci;

    public function __construct()
    {
        
        $this->ci =& get_instance();
        log_message('Debug', 'Two-factor class is loaded.');
    }
    function Twoauth_loaded()
    {
        include_once APPPATH.'third_party/GoogleAuthenticator.php';
        return new GoogleAuthenticator();
    }
    
    

}