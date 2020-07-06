<?php
defined('BASEPATH') or exit('No direct script access allowed');

class kawasan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('m_login');
        if (!$this->m_login->status_login())
            redirect(site_url());
        $this->load->model('Sync/m_kawasan');
        $this->load->model('m_core');
        global $jabatan;
        $jabatan = $this->m_core->jabatan();
        global $project;
        $project = $this->m_core->project();
        global $menu;
        $menu = $this->m_core->menu();
    }
    
    public function index()
    {
        $data = $this->db->get('v_list_kawasan')->result();
        if(!$data){
            $dataTmp = $this->db
            ->select("COLUMN_NAME")
            ->from("INFORMATION_SCHEMA.COLUMNS")
            ->WHERE("TABLE_NAME = 'v_list_kawasan' AND TABLE_SCHEMA='dbo'")
            ->get()->result();
            foreach ($dataTmp as $v)               array_push($data,$v->COLUMN_NAME);    
            $dataTmp = array_flip($data);
            $data = [];
            $data[0] = $dataTmp;
            foreach ($data[0] as $key => $value)    $data[0][$key] = '';
        }
        $this->load->view('core/header');
        $this->load->view('core/side_bar', ['menu' => $GLOBALS['menu']]);
        $this->load->view('core/top_bar', ['jabatan' => $GLOBALS['jabatan'], 'project' => $GLOBALS['project']]);
        $this->load->view('core/body_header', ['title' => 'Sync > Kawasan ', 'subTitle' => 'List']);
        $this->load->view('core/list', [
            'table' => $data
            ]);
        $this->load->view('core/body_footer');
        $this->load->view('core/footer');
    }
    public function add()
    {
        $this->load->view('core/header');
        $this->load->view('core/side_bar', ['menu' => $GLOBALS['menu']]);
        $this->load->view('core/top_bar', ['jabatan' => $GLOBALS['jabatan'], 'project' => $GLOBALS['project']]);
        $this->load->view('core/body_header', ['title' => 'Sync > Kawasan', 'subTitle' => 'Add']);
        $this->load->view('sync/kawasan');
        $this->load->view('core/body_footer');
        $this->load->view('core/footer');
    }
    public function save(){
        $data = $this->input->post('data_id'); 
        if($data){
            echo json_encode($this->m_kawasan->save($data,$this->input->post("source"),$GLOBALS['project']));
        }
            // print_r($this->input->get('data_id'));
        
    }
    public function erems(){
        $db_erems = $this->load->database('EREMS');
        
    }
    public function get_ajax_kawasan_by_source(){
        echo json_encode($this->m_kawasan->get_ajax_kawasan_by_source($this->input->POST('source'),$GLOBALS['project']));
    }
}
