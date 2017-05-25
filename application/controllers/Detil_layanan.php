<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Detil_layanan extends CI_Controller
{
    
        
    function __construct()
    {
        parent::__construct();
        $this->load->model('Detil_layanan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $detil_layanan = $this->Detil_layanan_model->get_all();

        $data = array(
            'detil_layanan_data' => $detil_layanan
        );

        $this->template->load('template','detil_layanan_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Detil_layanan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'ID_DETIL_LAYANAN' => $row->ID_DETIL_LAYANAN,
		'KAMAR_ID' => $row->KAMAR_ID,
		'LAYANAN_ID' => $row->LAYANAN_ID,
	    );
            $this->template->load('template','detil_layanan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('detil_layanan'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('detil_layanan/create_action'),
	    'ID_DETIL_LAYANAN' => set_value('ID_DETIL_LAYANAN'),
	    'KAMAR_ID' => set_value('KAMAR_ID'),
	    'LAYANAN_ID' => set_value('LAYANAN_ID'),
	);
        $this->template->load('template','detil_layanan_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'KAMAR_ID' => $this->input->post('KAMAR_ID',TRUE),
		'LAYANAN_ID' => $this->input->post('LAYANAN_ID',TRUE),
	    );

            $this->Detil_layanan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('detil_layanan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Detil_layanan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('detil_layanan/update_action'),
		'ID_DETIL_LAYANAN' => set_value('ID_DETIL_LAYANAN', $row->ID_DETIL_LAYANAN),
		'KAMAR_ID' => set_value('KAMAR_ID', $row->KAMAR_ID),
		'LAYANAN_ID' => set_value('LAYANAN_ID', $row->LAYANAN_ID),
	    );
            $this->template->load('template','detil_layanan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('detil_layanan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('ID_DETIL_LAYANAN', TRUE));
        } else {
            $data = array(
		'KAMAR_ID' => $this->input->post('KAMAR_ID',TRUE),
		'LAYANAN_ID' => $this->input->post('LAYANAN_ID',TRUE),
	    );

            $this->Detil_layanan_model->update($this->input->post('ID_DETIL_LAYANAN', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('detil_layanan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Detil_layanan_model->get_by_id($id);

        if ($row) {
            $this->Detil_layanan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('detil_layanan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('detil_layanan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('KAMAR_ID', 'kamar id', 'trim|required');
	$this->form_validation->set_rules('LAYANAN_ID', 'layanan id', 'trim|required');

	$this->form_validation->set_rules('ID_DETIL_LAYANAN', 'ID_DETIL_LAYANAN', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "detil_layanan.xls";
        $judul = "detil_layanan";
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
	xlsWriteLabel($tablehead, $kolomhead++, "LAYANAN ID");

	foreach ($this->Detil_layanan_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->KAMAR_ID);
	    xlsWriteLabel($tablebody, $kolombody++, $data->LAYANAN_ID);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    function pdf()
    {
        $data = array(
            'detil_layanan_data' => $this->Detil_layanan_model->get_all(),
            'start' => 0
        );
        
        ini_set('memory_limit', '32M');
        $html = $this->load->view('detil_layanan_pdf', $data, true);
        $this->load->library('pdf');
        $pdf = $this->pdf->load();
        $pdf->WriteHTML($html);
        $pdf->Output('detil_layanan.pdf', 'D'); 
    }

}

/* End of file Detil_layanan.php */
/* Location: ./application/controllers/Detil_layanan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-05-23 18:30:25 */
/* http://harviacode.com */