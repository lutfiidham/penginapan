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

        $this->template->load('template','promo/promo_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Promo_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_promo' => $row->id_promo,
		'promo_awal' => $row->promo_awal,
		'promo_akhir' => $row->promo_akhir,
		'harga_promo' => $row->harga_promo,
		'keterangan_promo' => $row->keterangan_promo,
	    );
            $this->template->load('template','promo/promo_read', $data);
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
	    'id_promo' => set_value('id_promo'),
	    'promo_awal' => set_value('promo_awal'),
	    'promo_akhir' => set_value('promo_akhir'),
	    'harga_promo' => set_value('harga_promo'),
	    'keterangan_promo' => set_value('keterangan_promo'),
	);
        $this->template->load('template','promo/promo_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
            'id_promo' => gen_id("pm", "promo", "id_promo", "4"),
		'promo_awal' => $this->input->post('promo_awal',TRUE),
		'promo_akhir' => $this->input->post('promo_akhir',TRUE),
		'harga_promo' => $this->input->post('harga_promo',TRUE),
		'keterangan_promo' => $this->input->post('keterangan_promo',TRUE),
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
		'id_promo' => set_value('id_promo', $row->id_promo),
		'promo_awal' => set_value('promo_awal', $row->promo_awal),
		'promo_akhir' => set_value('promo_akhir', $row->promo_akhir),
		'harga_promo' => set_value('harga_promo', $row->harga_promo),
		'keterangan_promo' => set_value('keterangan_promo', $row->keterangan_promo),
	    );
            $this->template->load('template','promo/promo_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('promo'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_promo', TRUE));
        } else {
            $data = array(
		'promo_awal' => $this->input->post('promo_awal',TRUE),
		'promo_akhir' => $this->input->post('promo_akhir',TRUE),
		'harga_promo' => $this->input->post('harga_promo',TRUE),
		'keterangan_promo' => $this->input->post('keterangan_promo',TRUE),
	    );

            $this->Promo_model->update($this->input->post('id_promo', TRUE), $data);
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
	$this->form_validation->set_rules('promo_awal', 'promo awal', 'trim|required');
	$this->form_validation->set_rules('promo_akhir', 'promo akhir', 'trim|required');
	$this->form_validation->set_rules('harga_promo', 'harga promo', 'trim|required');
	$this->form_validation->set_rules('keterangan_promo', 'keterangan promo', 'trim|required');

	$this->form_validation->set_rules('id_promo', 'id_promo', 'trim');
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
	xlsWriteLabel($tablehead, $kolomhead++, "Promo Awal");
	xlsWriteLabel($tablehead, $kolomhead++, "Promo Akhir");
	xlsWriteLabel($tablehead, $kolomhead++, "Harga Promo");
	xlsWriteLabel($tablehead, $kolomhead++, "Keterangan Promo");

	foreach ($this->Promo_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->promo_awal);
	    xlsWriteLabel($tablebody, $kolombody++, $data->promo_akhir);
	    xlsWriteNumber($tablebody, $kolombody++, $data->harga_promo);
	    xlsWriteLabel($tablebody, $kolombody++, $data->keterangan_promo);

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
/* Generated by Harviacode Codeigniter CRUD Generator 2017-05-25 19:35:04 */
/* http://harviacode.com */