<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jabatan extends CI_Controller
{
    
        
    function __construct()
    {
        parent::__construct();
        $this->load->model('Jabatan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $jabatan = $this->Jabatan_model->get_all();

        $data = array(
            'jabatan_data' => $jabatan
        );

        $this->template->load('template','jabatan_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Jabatan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_jabatan' => $row->id_jabatan,
		'nama_jabatan' => $row->nama_jabatan,
	    );
            $this->template->load('template','jabatan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jabatan'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('jabatan/create_action'),
	    'id_jabatan' => set_value('id_jabatan'),
	    'nama_jabatan' => set_value('nama_jabatan'),
	);
        $this->template->load('template','jabatan_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_jabatan' => $this->input->post('nama_jabatan',TRUE),
	    );

            $this->Jabatan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('jabatan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Jabatan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('jabatan/update_action'),
		'id_jabatan' => set_value('id_jabatan', $row->id_jabatan),
		'nama_jabatan' => set_value('nama_jabatan', $row->nama_jabatan),
	    );
            $this->template->load('template','jabatan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jabatan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_jabatan', TRUE));
        } else {
            $data = array(
		'nama_jabatan' => $this->input->post('nama_jabatan',TRUE),
	    );

            $this->Jabatan_model->update($this->input->post('id_jabatan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('jabatan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Jabatan_model->get_by_id($id);

        if ($row) {
            $this->Jabatan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('jabatan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jabatan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_jabatan', 'nama jabatan', 'trim|required');

	$this->form_validation->set_rules('id_jabatan', 'id_jabatan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "jabatan.xls";
        $judul = "jabatan";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Jabatan");

	foreach ($this->Jabatan_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_jabatan);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    function pdf()
    {
        $data = array(
            'jabatan_data' => $this->Jabatan_model->get_all(),
            'start' => 0
        );
        
        ini_set('memory_limit', '32M');
        $html = $this->load->view('jabatan_pdf', $data, true);
        $this->load->library('pdf');
        $pdf = $this->pdf->load();
        $pdf->WriteHTML($html);
        $pdf->Output('jabatan.pdf', 'D'); 
    }

}

/* End of file Jabatan.php */
/* Location: ./application/controllers/Jabatan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-05-25 19:35:04 */
/* http://harviacode.com */