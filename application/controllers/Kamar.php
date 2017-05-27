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

        $this->template->load('template','kamar/kamar_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Kamar_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_kamar' => $row->id_kamar,
		'nama_kamar' => $row->nama_kamar,
		'no_kamar' => $row->no_kamar,
		'kapasitas' => $row->kapasitas,
		'status_kamar' => $row->status_kamar,
	    );
            $this->template->load('template','kamar/kamar_read', $data);
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
	    'id_kamar' => set_value('id_kamar'),
	    'nama_kamar' => set_value('nama_kamar'),
	    'no_kamar' => set_value('no_kamar'),
	    'kapasitas' => set_value('kapasitas'),
	    'status_kamar' => set_value('status_kamar'),
	);
        $this->template->load('template','kamar/kamar_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
              'id_kamar' => gen_id("km", "kamar", "id_kamar", "4"),
		'nama_kamar' => $this->input->post('nama_kamar',TRUE),
		'no_kamar' => $this->input->post('no_kamar',TRUE),
		'kapasitas' => $this->input->post('kapasitas',TRUE),
		'status_kamar' => $this->input->post('status_kamar',TRUE),
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
		'id_kamar' => set_value('id_kamar', $row->id_kamar),
		'nama_kamar' => set_value('nama_kamar', $row->nama_kamar),
		'no_kamar' => set_value('no_kamar', $row->no_kamar),
		'kapasitas' => set_value('kapasitas', $row->kapasitas),
		'status_kamar' => set_value('status_kamar', $row->status_kamar),
	    );
            $this->template->load('template','kamar/kamar_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kamar'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_kamar', TRUE));
        } else {
            $data = array(
		'nama_kamar' => $this->input->post('nama_kamar',TRUE),
		'no_kamar' => $this->input->post('no_kamar',TRUE),
		'kapasitas' => $this->input->post('kapasitas',TRUE),
		'status_kamar' => $this->input->post('status_kamar',TRUE),
	    );

            $this->Kamar_model->update($this->input->post('id_kamar', TRUE), $data);
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
	$this->form_validation->set_rules('nama_kamar', 'nama kamar', 'trim|required');
	$this->form_validation->set_rules('no_kamar', 'no kamar', 'trim|required');
	$this->form_validation->set_rules('kapasitas', 'kapasitas', 'trim|required');
	$this->form_validation->set_rules('status_kamar', 'status kamar', 'trim|required');

	$this->form_validation->set_rules('id_kamar', 'id_kamar', 'trim');
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Kamar");
	xlsWriteLabel($tablehead, $kolomhead++, "No Kamar");
	xlsWriteLabel($tablehead, $kolomhead++, "Kapasitas");
	xlsWriteLabel($tablehead, $kolomhead++, "Status Kamar");

	foreach ($this->Kamar_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_kamar);
	    xlsWriteLabel($tablebody, $kolombody++, $data->no_kamar);
	    xlsWriteNumber($tablebody, $kolombody++, $data->kapasitas);
	    xlsWriteLabel($tablebody, $kolombody++, $data->status_kamar);

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
/* Generated by Harviacode Codeigniter CRUD Generator 2017-05-25 19:35:04 */
/* http://harviacode.com */