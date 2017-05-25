<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Promo extends CI_Controller
{
    
        
    function __construct()
    {
        parent::__construct();
        $this->load->model('Promo_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $promo = $this->Promo_model->get_all();

        $data = array(
            'promo_data' => $promo
        );

        $this->template->load('template','promo_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Promo_model->get_by_id($id);
        if ($row) {
            $data = array(
		'ID_PROMO' => $row->ID_PROMO,
		'PROMO_AWAL' => $row->PROMO_AWAL,
		'PROMO_AKHIR' => $row->PROMO_AKHIR,
		'HARGA_PROMO' => $row->HARGA_PROMO,
		'KETERANGAN_PROMO' => $row->KETERANGAN_PROMO,
	    );
            $this->template->load('template','promo_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('promo'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('promo/create_action'),
	    'ID_PROMO' => set_value('ID_PROMO'),
	    'PROMO_AWAL' => set_value('PROMO_AWAL'),
	    'PROMO_AKHIR' => set_value('PROMO_AKHIR'),
	    'HARGA_PROMO' => set_value('HARGA_PROMO'),
	    'KETERANGAN_PROMO' => set_value('KETERANGAN_PROMO'),
	);
        $this->template->load('template','promo_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'PROMO_AWAL' => $this->input->post('PROMO_AWAL',TRUE),
		'PROMO_AKHIR' => $this->input->post('PROMO_AKHIR',TRUE),
		'HARGA_PROMO' => $this->input->post('HARGA_PROMO',TRUE),
		'KETERANGAN_PROMO' => $this->input->post('KETERANGAN_PROMO',TRUE),
	    );

            $this->Promo_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('promo'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Promo_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('promo/update_action'),
		'ID_PROMO' => set_value('ID_PROMO', $row->ID_PROMO),
		'PROMO_AWAL' => set_value('PROMO_AWAL', $row->PROMO_AWAL),
		'PROMO_AKHIR' => set_value('PROMO_AKHIR', $row->PROMO_AKHIR),
		'HARGA_PROMO' => set_value('HARGA_PROMO', $row->HARGA_PROMO),
		'KETERANGAN_PROMO' => set_value('KETERANGAN_PROMO', $row->KETERANGAN_PROMO),
	    );
            $this->template->load('template','promo_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('promo'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('ID_PROMO', TRUE));
        } else {
            $data = array(
		'PROMO_AWAL' => $this->input->post('PROMO_AWAL',TRUE),
		'PROMO_AKHIR' => $this->input->post('PROMO_AKHIR',TRUE),
		'HARGA_PROMO' => $this->input->post('HARGA_PROMO',TRUE),
		'KETERANGAN_PROMO' => $this->input->post('KETERANGAN_PROMO',TRUE),
	    );

            $this->Promo_model->update($this->input->post('ID_PROMO', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('promo'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Promo_model->get_by_id($id);

        if ($row) {
            $this->Promo_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('promo'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('promo'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('PROMO_AWAL', 'promo awal', 'trim|required');
	$this->form_validation->set_rules('PROMO_AKHIR', 'promo akhir', 'trim|required');
	$this->form_validation->set_rules('HARGA_PROMO', 'harga promo', 'trim|required');
	$this->form_validation->set_rules('KETERANGAN_PROMO', 'keterangan promo', 'trim|required');

	$this->form_validation->set_rules('ID_PROMO', 'ID_PROMO', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "promo.xls";
        $judul = "promo";
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
	xlsWriteLabel($tablehead, $kolomhead++, "PROMO AWAL");
	xlsWriteLabel($tablehead, $kolomhead++, "PROMO AKHIR");
	xlsWriteLabel($tablehead, $kolomhead++, "HARGA PROMO");
	xlsWriteLabel($tablehead, $kolomhead++, "KETERANGAN PROMO");

	foreach ($this->Promo_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->PROMO_AWAL);
	    xlsWriteLabel($tablebody, $kolombody++, $data->PROMO_AKHIR);
	    xlsWriteNumber($tablebody, $kolombody++, $data->HARGA_PROMO);
	    xlsWriteLabel($tablebody, $kolombody++, $data->KETERANGAN_PROMO);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    function pdf()
    {
        $data = array(
            'promo_data' => $this->Promo_model->get_all(),
            'start' => 0
        );
        
        ini_set('memory_limit', '32M');
        $html = $this->load->view('promo_pdf', $data, true);
        $this->load->library('pdf');
        $pdf = $this->pdf->load();
        $pdf->WriteHTML($html);
        $pdf->Output('promo.pdf', 'D'); 
    }

}

/* End of file Promo.php */
/* Location: ./application/controllers/Promo.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-05-23 18:30:25 */
/* http://harviacode.com */