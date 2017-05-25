<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Detil_fasilitas extends CI_Controller
{
    
        
    function __construct()
    {
        parent::__construct();
        $this->load->model('Detil_fasilitas_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $detil_fasilitas = $this->Detil_fasilitas_model->get_all();

        $data = array(
            'detil_fasilitas_data' => $detil_fasilitas
        );

        $this->template->load('template','detil_fasilitas_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Detil_fasilitas_model->get_by_id($id);
        if ($row) {
            $data = array(
		'ID_DETAIL_FASILITAS' => $row->ID_DETAIL_FASILITAS,
		'KAMAR_ID' => $row->KAMAR_ID,
		'FASILITAS_ID' => $row->FASILITAS_ID,
	    );
            $this->template->load('template','detil_fasilitas_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('detil_fasilitas'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('detil_fasilitas/create_action'),
	    'ID_DETAIL_FASILITAS' => set_value('ID_DETAIL_FASILITAS'),
	    'KAMAR_ID' => set_value('KAMAR_ID'),
	    'FASILITAS_ID' => set_value('FASILITAS_ID'),
	);
        $this->template->load('template','detil_fasilitas_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'KAMAR_ID' => $this->input->post('KAMAR_ID',TRUE),
		'FASILITAS_ID' => $this->input->post('FASILITAS_ID',TRUE),
	    );

            $this->Detil_fasilitas_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('detil_fasilitas'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Detil_fasilitas_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('detil_fasilitas/update_action'),
		'ID_DETAIL_FASILITAS' => set_value('ID_DETAIL_FASILITAS', $row->ID_DETAIL_FASILITAS),
		'KAMAR_ID' => set_value('KAMAR_ID', $row->KAMAR_ID),
		'FASILITAS_ID' => set_value('FASILITAS_ID', $row->FASILITAS_ID),
	    );
            $this->template->load('template','detil_fasilitas_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('detil_fasilitas'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('ID_DETAIL_FASILITAS', TRUE));
        } else {
            $data = array(
		'KAMAR_ID' => $this->input->post('KAMAR_ID',TRUE),
		'FASILITAS_ID' => $this->input->post('FASILITAS_ID',TRUE),
	    );

            $this->Detil_fasilitas_model->update($this->input->post('ID_DETAIL_FASILITAS', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('detil_fasilitas'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Detil_fasilitas_model->get_by_id($id);

        if ($row) {
            $this->Detil_fasilitas_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('detil_fasilitas'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('detil_fasilitas'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('KAMAR_ID', 'kamar id', 'trim|required');
	$this->form_validation->set_rules('FASILITAS_ID', 'fasilitas id', 'trim|required');

	$this->form_validation->set_rules('ID_DETAIL_FASILITAS', 'ID_DETAIL_FASILITAS', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "detil_fasilitas.xls";
        $judul = "detil_fasilitas";
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
	xlsWriteLabel($tablehead, $kolomhead++, "KAMAR ID");
	xlsWriteLabel($tablehead, $kolomhead++, "FASILITAS ID");

	foreach ($this->Detil_fasilitas_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->KAMAR_ID);
	    xlsWriteLabel($tablebody, $kolombody++, $data->FASILITAS_ID);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    function pdf()
    {
        $data = array(
            'detil_fasilitas_data' => $this->Detil_fasilitas_model->get_all(),
            'start' => 0
        );
        
        ini_set('memory_limit', '32M');
        $html = $this->load->view('detil_fasilitas_pdf', $data, true);
        $this->load->library('pdf');
        $pdf = $this->pdf->load();
        $pdf->WriteHTML($html);
        $pdf->Output('detil_fasilitas.pdf', 'D'); 
    }

}

/* End of file Detil_fasilitas.php */
/* Location: ./application/controllers/Detil_fasilitas.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-05-23 18:30:25 */
/* http://harviacode.com */