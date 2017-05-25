<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Detil_inventori extends CI_Controller
{
    
        
    function __construct()
    {
        parent::__construct();
        $this->load->model('Detil_inventori_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $detil_inventori = $this->Detil_inventori_model->get_all();

        $data = array(
            'detil_inventori_data' => $detil_inventori
        );

        $this->template->load('template','detil_inventori_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Detil_inventori_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_detil_inventori' => $row->id_detil_inventori,
		'kamar_id' => $row->kamar_id,
		'inventori_id' => $row->inventori_id,
	    );
            $this->template->load('template','detil_inventori_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('detil_inventori'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('detil_inventori/create_action'),
	    'id_detil_inventori' => set_value('id_detil_inventori'),
	    'kamar_id' => set_value('kamar_id'),
	    'inventori_id' => set_value('inventori_id'),
	);
        $this->template->load('template','detil_inventori_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kamar_id' => $this->input->post('kamar_id',TRUE),
		'inventori_id' => $this->input->post('inventori_id',TRUE),
	    );

            $this->Detil_inventori_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('detil_inventori'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Detil_inventori_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('detil_inventori/update_action'),
		'id_detil_inventori' => set_value('id_detil_inventori', $row->id_detil_inventori),
		'kamar_id' => set_value('kamar_id', $row->kamar_id),
		'inventori_id' => set_value('inventori_id', $row->inventori_id),
	    );
            $this->template->load('template','detil_inventori_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('detil_inventori'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_detil_inventori', TRUE));
        } else {
            $data = array(
		'kamar_id' => $this->input->post('kamar_id',TRUE),
		'inventori_id' => $this->input->post('inventori_id',TRUE),
	    );

            $this->Detil_inventori_model->update($this->input->post('id_detil_inventori', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('detil_inventori'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Detil_inventori_model->get_by_id($id);

        if ($row) {
            $this->Detil_inventori_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('detil_inventori'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('detil_inventori'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('kamar_id', 'kamar id', 'trim|required');
	$this->form_validation->set_rules('inventori_id', 'inventori id', 'trim|required');

	$this->form_validation->set_rules('id_detil_inventori', 'id_detil_inventori', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "detil_inventori.xls";
        $judul = "detil_inventori";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Kamar Id");
	xlsWriteLabel($tablehead, $kolomhead++, "Inventori Id");

	foreach ($this->Detil_inventori_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kamar_id);
	    xlsWriteLabel($tablebody, $kolombody++, $data->inventori_id);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    function pdf()
    {
        $data = array(
            'detil_inventori_data' => $this->Detil_inventori_model->get_all(),
            'start' => 0
        );
        
        ini_set('memory_limit', '32M');
        $html = $this->load->view('detil_inventori_pdf', $data, true);
        $this->load->library('pdf');
        $pdf = $this->pdf->load();
        $pdf->WriteHTML($html);
        $pdf->Output('detil_inventori.pdf', 'D'); 
    }

}

/* End of file Detil_inventori.php */
/* Location: ./application/controllers/Detil_inventori.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-05-25 19:35:04 */
/* http://harviacode.com */