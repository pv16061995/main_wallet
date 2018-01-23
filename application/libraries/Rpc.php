<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rpc
{
    protected $ci;

    public function __construct()
    {
        
        $this->ci =& get_instance();
        log_message('Debug', 'RPC class is loaded.');
    }
    function Rpc_loaded()
    {
        include_once APPPATH.'third_party/Client.php';
        return new Client();
    }
    function RPCClient()
    {
        include_once APPPATH.'third_party/jsonRPCClient.php';

        return new jsonRPCClient();
    }
    

}

/* End of file Rpc.php */
/* Location: ./application/libraries/Rpc.php */
