<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kamar extends CI_Controller
{
    
        
    function __construct()
    {
        parent::__construct();
        $this->load->model('Kamar_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $kamar = $this->Kamar_model->get_all();

        $data = array(
            'kamar_data' => $kamar
        );

        $this->template->load('template','kamar_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Kamar_model->get_by_id($id);
        if ($row) {
            $data = array(
		'ID_KAMAR' => $row->ID_KAMAR,
		'NAMA_KAMAR' => $row->NAMA_KAMAR,
		'NO_KAMAR' => $row->NO_KAMAR,
		'KAPASITAS' => $row->KAPASITAS,
		'STATUS_KAMAR' => $row->STATUS_KAMAR,
	    );
            $this->template->load('template','kamar_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kamar'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('kamar/create_action'),
	    'ID_KAMAR' => set_value('ID_KAMAR'),
	    'NAMA_KAMAR' => set_value('NAMA_KAMAR'),
	    'NO_KAMAR' => set_value('NO_KAMAR'),
	    'KAPASITAS' => set_value('KAPASITAS'),
	    'STATUS_KAMAR' => set_value('STATUS_KAMAR'),
	);
        $this->template->load('template','kamar_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'NAMA_KAMAR' => $this->input->post('NAMA_KAMAR',TRUE),
		'NO_KAMAR' => $this->input->post('NO_KAMAR',TRUE),
		'KAPASITAS' => $this->input->post('KAPASITAS',TRUE),
		'STATUS_KAMAR' => $this->input->post('STATUS_KAMAR',TRUE),
	    );

            $this->Kamar_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('kamar'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Kamar_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('kamar/update_action'),
		'ID_KAMAR' => set_value('ID_KAMAR', $row->ID_KAMAR),
		'NAMA_KAMAR' => set_value('NAMA_KAMAR', $row->NAMA_KAMAR),
		'NO_KAMAR' => set_value('NO_KAMAR', $row->NO_KAMAR),
		'KAPASITAS' => set_value('KAPASITAS', $row->KAPASITAS),
		'STATUS_KAMAR' => set_value('STATUS_KAMAR', $row->STATUS_KAMAR),
	    );
            $this->template->load('template','kamar_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kamar'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('ID_KAMAR', TRUE));
        } else {
            $data = array(
		'NAMA_KAMAR' => $this->input->post('NAMA_KAMAR',TRUE),
		'NO_KAMAR' => $this->input->post('NO_KAMAR',TRUE),
		'KAPASITAS' => $this->input->post('KAPASITAS',TRUE),
		'STATUS_KAMAR' => $this->input->post('STATUS_KAMAR',TRUE),
	    );

            $this->Kamar_model->update($this->input->post('ID_KAMAR', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('kamar'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Kamar_model->get_by_id($id);

        if ($row) {
            $this->Kamar_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('kamar'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kamar'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('NAMA_KAMAR', 'nama kamar', 'trim|required');
	$this->form_validation->set_rules('NO_KAMAR', 'no kamar', 'trim|required');
	$this->form_validation->set_rules('KAPASITAS', 'kapasitas', 'trim|required');
	$this->form_validation->set_rules('STATUS_KAMAR', 'status kamar', 'trim|required');

	$this->form_validation->set_rules('ID_KAMAR', 'ID_KAMAR', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "kamar.xls";
        $judul = "kamar";
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
	xlsWriteLabel($tablehead, $kolomhead++, "NAMA KAMAR");
	xlsWriteLabel($tablehead, $kolomhead++, "NO KAMAR");
	xlsWriteLabel($tablehead, $kolomhead++, "KAPASITAS");
	xlsWriteLabel($tablehead, $kolomhead++, "STATUS KAMAR");

	foreach ($this->Kamar_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->NAMA_KAMAR);
	    xlsWriteLabel($tablebody, $kolombody++, $data->NO_KAMAR);
	    xlsWriteNumber($tablebody, $kolombody++, $data->KAPASITAS);
	    xlsWriteLabel($tablebody, $kolombody++, $data->STATUS_KAMAR);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    function pdf()
    {
        $data = array(
            'kamar_data' => $this->Kamar_model->get_all(),
            'start' => 0
        );
        
        ini_set('memory_limit', '32M');
        $html = $this->load->view('kamar_pdf', $data, true);
        $this->load->library('pdf');
        $pdf = $this->pdf->load();
        $pdf->WriteHTML($html);
        $pdf->Output('kamar.pdf', 'D'); 
    }

}

/* End of file Kamar.php */
/* Location: ./application/controllers/Kamar.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-05-23 18:30:25 */
/* http://harviacode.com */