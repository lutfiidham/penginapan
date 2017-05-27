<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pegawai extends CI_Controller
{
    
        
    function __construct()
    {
        parent::__construct();
        $this->load->model('Pegawai_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $pegawai = $this->Pegawai_model->get_all();

        $data = array(
            'pegawai_data' => $pegawai
        );

        $this->template->load('template','pegawai/pegawai_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Pegawai_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_pegawai' => $row->id_pegawai,
		'nama_pegawai' => $row->nama_pegawai,
		'alamat_pegawai' => $row->alamat_pegawai,
		'telp_pegawai' => $row->telp_pegawai,
		'jabatan_id' => $row->jabatan_id,
		'status_pegawai' => $row->status_pegawai,
	    );
            $this->template->load('template','pegawai/pegawai_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pegawai'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('pegawai/create_action'),
	    'id_pegawai' => set_value('id_pegawai'),
	    'nama_pegawai' => set_value('nama_pegawai'),
	    'alamat_pegawai' => set_value('alamat_pegawai'),
	    'telp_pegawai' => set_value('telp_pegawai'),
	    'jabatan_id' => set_value('jabatan_id'),
	    'status_pegawai' => set_value('status_pegawai'),
	);
        $this->template->load('template','pegawai/pegawai_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
            'id_pegawai' => gen_id("pg", "pegawai", "id_pegawai", "4"),
		'nama_pegawai' => $this->input->post('nama_pegawai',TRUE),
		'alamat_pegawai' => $this->input->post('alamat_pegawai',TRUE),
		'telp_pegawai' => $this->input->post('telp_pegawai',TRUE),
		'jabatan_id' => $this->input->post('jabatan_id',TRUE),
		'status_pegawai' => $this->input->post('status_pegawai',TRUE),
	    );

            $this->Pegawai_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('pegawai'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Pegawai_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('pegawai/update_action'),
		'id_pegawai' => set_value('id_pegawai', $row->id_pegawai),
		'nama_pegawai' => set_value('nama_pegawai', $row->nama_pegawai),
		'alamat_pegawai' => set_value('alamat_pegawai', $row->alamat_pegawai),
		'telp_pegawai' => set_value('telp_pegawai', $row->telp_pegawai),
		'jabatan_id' => set_value('jabatan_id', $row->jabatan_id),
		'status_pegawai' => set_value('status_pegawai', $row->status_pegawai),
	    );
            $this->template->load('template','pegawai/pegawai_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pegawai'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_pegawai', TRUE));
        } else {
            $data = array(
		'nama_pegawai' => $this->input->post('nama_pegawai',TRUE),
		'alamat_pegawai' => $this->input->post('alamat_pegawai',TRUE),
		'telp_pegawai' => $this->input->post('telp_pegawai',TRUE),
		'jabatan_id' => $this->input->post('jabatan_id',TRUE),
		'status_pegawai' => $this->input->post('status_pegawai',TRUE),
	    );

            $this->Pegawai_model->update($this->input->post('id_pegawai', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('pegawai'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Pegawai_model->get_by_id($id);

        if ($row) {
            $this->Pegawai_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('pegawai'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pegawai'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_pegawai', 'nama pegawai', 'trim|required');
	$this->form_validation->set_rules('alamat_pegawai', 'alamat pegawai', 'trim|required');
	$this->form_validation->set_rules('telp_pegawai', 'telp pegawai', 'trim|required');
	$this->form_validation->set_rules('jabatan_id', 'jabatan id', 'trim|required');
	$this->form_validation->set_rules('status_pegawai', 'status pegawai', 'trim|required');

	$this->form_validation->set_rules('id_pegawai', 'id_pegawai', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "pegawai.xls";
        $judul = "pegawai";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Pegawai");
	xlsWriteLabel($tablehead, $kolomhead++, "Alamat Pegawai");
	xlsWriteLabel($tablehead, $kolomhead++, "Telp Pegawai");
	xlsWriteLabel($tablehead, $kolomhead++, "Jabatan Id");
	xlsWriteLabel($tablehead, $kolomhead++, "Status Pegawai");

	foreach ($this->Pegawai_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_pegawai);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alamat_pegawai);
	    xlsWriteLabel($tablebody, $kolombody++, $data->telp_pegawai);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jabatan_id);
	    xlsWriteLabel($tablebody, $kolombody++, $data->status_pegawai);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    function pdf()
    {
        $data = array(
            'pegawai_data' => $this->Pegawai_model->get_all(),
            'start' => 0
        );
        
        ini_set('memory_limit', '32M');
        $html = $this->load->view('pegawai_pdf', $data, true);
        $this->load->library('pdf');
        $pdf = $this->pdf->load();
        $pdf->WriteHTML($html);
        $pdf->Output('pegawai.pdf', 'D'); 
    }

}

/* End of file Pegawai.php */
/* Location: ./application/controllers/Pegawai.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-05-25 19:35:04 */
/* http://harviacode.com */