<?php

use JasperPHP\JasperPHP as JasperPHP;

class Report extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->helper('download');

        $jasper = new JasperPHP;
        $date1 = $this->input->get('start_date');
        $date2 = $this->input->get('end_date');
        $report_type = $this->input->get('report_type');

        $jasper->process(
            'rpt/' . $report_type . '.jrxml',
            false,
            array('pdf'),
            array('date1' => $date1, 'date2' => $date2),
            array(
                'driver' => 'mysql',
                'username' => 'root',
                'password' => '',
                'host' => 'localhost',
                'database' => 'e_filing',
                'port' => '3306',
            )
        )->execute();

        force_download('rpt/' . $report_type . '.pdf', NULL);
    }
}
