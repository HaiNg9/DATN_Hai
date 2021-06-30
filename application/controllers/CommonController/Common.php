<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Common extends CI_Controller
{
    /**
     * Class constructor
     *
     * @return	void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Error page.
     */
    public function error404()
    {
        $this->load->view('error_404');
    }

    /**
     * Error page.
     */
    public function error500()
    {
        $this->load->view('error_500');
    }
}
