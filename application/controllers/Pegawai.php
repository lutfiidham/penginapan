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

        $this->template->load('template','pegawai_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Pegawai_model->get_by_id($id);
        if ($row) {
            $data = array(
		'ID_PEGAWAI' => $row->ID_PEGAWAI,
		'NAMA_PEGAWAI' => $row->NAMA_PEGAWAI,
		'ALAMAT_PEGAWAI' => $row->ALAMAT_PEGAWAI,
		'TELP_PEGAWAI' => $row->TELP_PEGAWAI,
		'JABATAN_ID' => $row->JABATAN_ID,
		'STATUS_PEGAWAI' => $row->STATUS_PEGAWAI,
	    );
            $this->template->load('template','pegawai_read', $data);
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
	    'ID_PEGAWAI' => set_value('ID_PEGAWAI'),
	    'NAMA_PEGAWAI' => set_value('NAMA_PEGAWAI'),
	    'ALAMAT_PEGAWAI' => set_value('ALAMAT_PEGAWAI'),
	    'TELP_PEGAWAI' => set_value('TELP_PEGAWAI'),
	    'JABATAN_ID' => set_value('JABATAN_ID'),
	    'STATUS_PEGAWAI' => set_value('STATUS_PEGAWAI'),
	);
        $this->template->load('template','pegawai_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'NAMA_PEGAWAI' => $this->input->post('NAMA_PEGAWAI',TRUE),
		'ALAMAT_PEGAWAI' => $this->input->post('ALAMAT_PEGAWAI',TRUE),
		'TELP_PEGAWAI' => $this->input->post('TELP_PEGAWAI',TRUE),
		'JABATAN_ID' => $this->input->post('JABATAN_ID',TRUE),
		'STATUS_PEGAWAI' => $this->input->post('STATUS_PEGAWAI',TRUE),
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
		'ID_PEGAWAI' => set_value('ID_PEGAWAI', $row->ID_PEGAWAI),
		'NAMA_PEGAWAI' => set_value('NAMA_PEGAWAI', $row->NAMA_PEGAWAI),
		'ALAMAT_PEGAWAI' => set_value('ALAMAT_PEGAWAI', $row->ALAMAT_PEGAWAI),
		'TELP_PEGAWAI' => set_value('TELP_PEGAWAI', $row->TELP_PEGAWAI),
		'JABATAN_ID' => set_value('JABATAN_ID', $row->JABATAN_ID),
		'STATUS_PEGAWAI' => set_value('STATUS_PEGAWAI', $row->STATUS_PEGAWAI),
	    );
            $this->template->load('template','pegawai_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pegawai'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('ID_PEGAWAI', TRUE));
        } else {
            $data = array(
		'NAMA_PEGAWAI' => $this->input->post('NAMA_PEGAWAI',TRUE),
		'ALAMAT_PEGAWAI' => $this->input->post('ALAMAT_PEGAWAI',TRUE),
		'TELP_PEGAWAI' => $this->input->post('TELP_PEGAWAI',TRUE),
		'JABATAN_ID' => $this->input->post('JABATAN_ID',TRUE),
		'STATUS_PEGAWAI' => $this->input->post('STATUS_PEGAWAI',TRUE),
	    );

            $this->Pegawai_model->update($this->input->post('ID_PEGAWAI', TRUE), $data);
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
	$this->form_validation->set_rules('NAMA_PEGAWAI', 'nama pegawai', 'trim|required');
	$this->form_validation->set_rules('ALAMAT_PEGAWAI', 'alamat pegawai', 'trim|required');
	$this->form_validation->set_rules('TELP_PEGAWAI', 'telp pegawai', 'trim|required');
	$this->form_validation->set_rules('JABATAN_ID', 'jabatan id', 'trim|required');
	$this->form_validation->set_rules('STATUS_PEGAWAI', 'status pegawai', 'trim|required');

	$this->form_validation->set_rules('ID_PEGAWAI', 'ID_PEGAWAI', 'trim');
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
	xlsWriteLabel($tablehead, $kolomhead++, "NAMA PEGAWAI");
	xlsWriteLabel($tablehead, $kolomhead++, "ALAMAT PEGAWAI");
	xlsWriteLabel($tablehead, $kolomhead++, "TELP PEGAWAI");
	xlsWriteLabel($tablehead, $kolomhead++, "JABATAN ID");
	xlsWriteLabel($tablehead, $kolomhead++, "STATUS PEGAWAI");

	foreach ($this->Pegawai_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->NAMA_PEGAWAI);
	    xlsWriteLabel($tablebody, $kolombody++, $data->ALAMAT_PEGAWAI);
	    xlsWriteLabel($tablebody, $kolombody++, $data->TELP_PEGAWAI);
	    xlsWriteLabel($tablebody, $kolombody++, $data->JABATAN_ID);
	    xlsWriteLabel($tablebody, $kolombody++, $data->STATUS_PEGAWAI);

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
/* Generated by Harviacode Codeigniter CRUD Generator 2017-05-23 18:30:25 */
/* http://harviacode.com */