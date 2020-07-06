<?php
defined('BASEPATH') or exit('No direct script access allowed');

class P_master_channel extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('m_login');
        if (!$this->m_login->status_login())
            redirect(site_url());
        $this->load->model('m_channel');
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
        $data = $this->m_channel->get();
        $this->load->view('core/header');
        $this->load->view('core/side_bar', ['menu' => $GLOBALS['menu']]);
        $this->load->view('core/top_bar', ['jabatan' => $GLOBALS['jabatan'], 'project' => $GLOBALS['project']]);
        $this->load->view('core/body_header', ['title' => 'Master > Service > Channel', 'subTitle' => 'List']);
        // $this->load->view('proyek/master/item_tvi/view', ['data' => $data]);
        $this->load->view('proyek/master/channel/view',['data' => $data]);
        $this->load->view('core/body_footer');
        $this->load->view('core/footer');
    }

    public function add()
    {
        $this->load->model('alert');
        $this->load->view('core/header');
		$this->alert->css();
        $this->load->view('core/side_bar', ['menu' => $GLOBALS['menu']]);
        $this->load->view('core/top_bar', ['jabatan' => $GLOBALS['jabatan'], 'project' => $GLOBALS['project']]);
        $this->load->view('core/body_header', ['title' => 'Master > Service > Channel', 'subTitle' => 'Add']);
        $this->load->view('proyek/master/channel/add');
        $this->load->view('core/body_footer');
        $this->load->view('core/footer');
    }
    public function edit()
    {
        $dataSelect = $this->m_channel->get_edit($this->input->get("id"));
        $this->load->model('m_log');
        $data = $this->m_log->get('channel', $this->input->get('id'));
        $this->load->view('core/header');
        $this->load->model('alert');
		$this->alert->css();
        $this->load->view('core/side_bar', ['menu' => $GLOBALS['menu']]);
        $this->load->view('core/top_bar', ['jabatan' => $GLOBALS['jabatan'], 'project' => $GLOBALS['project']]);
        $this->load->view('core/body_header', ['title' => 'Master > Service > Channel', 'subTitle' => 'Edit']);
        $this->load->view('proyek/master/channel/edit',["data"=>$data, "dataSelect"=>$dataSelect]);
        $this->load->view('core/body_footer');
        $this->load->view('core/footer');
    }
    public function ajax_save(){
        echo(json_encode($this->m_channel->save($this->input->get())));
    }
    public function ajax_edit(){
        echo(json_encode($this->m_channel->edit($this->input->get())));
    }

    public function delete()
    {
        $this->load->model('alert');

        $status = $this->m_channel->delete([
                'id' => $this->input->get('id'),
        ]);

        $this->alert->css();

        $data = $this->m_channel->get();
        $this->load->view('core/header');
        $this->load->view('core/side_bar', ['menu' => $GLOBALS['menu']]);
        $this->load->view('core/top_bar', ['jabatan' => $GLOBALS['jabatan'], 'project' => $GLOBALS['project']]);
        $this->load->view('core/body_header', ['title' => 'Master > Service > Channel', 'subTitle' => 'List']);
        $this->load->view('proyek/master/channel/view', ['data' => $data]);
        $this->load->view('core/body_footer');
        $this->load->view('core/footer');
        if ($status == 'success') {
            $this->load->view('core/alert', ['title' => 'Berhasil', 'text' => 'Data Berhasil di Delete', 'type' => 'success']);
        } 
    }
    
}
