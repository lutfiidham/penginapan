<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Fasilitas extends CI_Controller
{
    
        
    function __construct()
    {
        parent::__construct();
        $this->load->model('Fasilitas_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $fasilitas = $this->Fasilitas_model->get_all();

        $data = array(
            'fasilitas_data' => $fasilitas
        );

        $this->template->load('template','fasilitas/fasilitas_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Fasilitas_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_fasilitas' => $row->id_fasilitas,
		'nama_fasilitas' => $row->nama_fasilitas,
		'status_fasilitas' => $row->status_fasilitas,
	    );
            $this->template->load('template','fasilitas/fasilitas_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('fasilitas'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('fasilitas/create_action'),
	    'id_fasilitas' => set_value('id_fasilitas'),
	    'nama_fasilitas' => set_value('nama_fasilitas'),
	    'status_fasilitas' => set_value('status_fasilitas'),
	);
        $this->template->load('template','fasilitas/fasilitas_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
              'id_fasilitas' => gen_id("fs", "fasilitas", "id_fasilitas", "4"),
		'nama_fasilitas' => $this->input->post('nama_fasilitas',TRUE),
		'status_fasilitas' => $this->input->post('status_fasilitas',TRUE),
	    );

            $this->Fasilitas_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('fasilitas'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Fasilitas_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('fasilitas/update_action'),
		'id_fasilitas' => set_value('id_fasilitas', $row->id_fasilitas),
		'nama_fasilitas' => set_value('nama_fasilitas', $row->nama_fasilitas),
		'status_fasilitas' => set_value('status_fasilitas', $row->status_fasilitas),
	    );
            $this->template->load('template','fasilitas/fasilitas_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('fasilitas'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_fasilitas', TRUE));
        } else {
            $data = array(
		'nama_fasilitas' => $this->input->post('nama_fasilitas',TRUE),
		'status_fasilitas' => $this->input->post('status_fasilitas',TRUE),
	    );

            $this->Fasilitas_model->update($this->input->post('id_fasilitas', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('fasilitas'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Fasilitas_model->get_by_id($id);

        if ($row) {
            $this->Fasilitas_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('fasilitas'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('fasilitas'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_fasilitas', 'nama fasilitas', 'trim|required');
	$this->form_validation->set_rules('status_fasilitas', 'status fasilitas', 'trim|required');

	$this->form_validation->set_rules('id_fasilitas', 'id_fasilitas', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "fasilitas.xls";
        $judul = "fasilitas";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Fasilitas");
	xlsWriteLabel($tablehead, $kolomhead++, "Status Fasilitas");

	foreach ($this->Fasilitas_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_fasilitas);
	    xlsWriteLabel($tablebody, $kolombody++, $data->status_fasilitas);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    function pdf()
    {
        $data = array(
            'fasilitas_data' => $this->Fasilitas_model->get_all(),
            'start' => 0
        );
        
        ini_set('memory_limit', '32M');
        $html = $this->load->view('fasilitas_pdf', $data, true);
        $this->load->library('pdf');
        $pdf = $this->pdf->load();
        $pdf->WriteHTML($html);
        $pdf->Output('fasilitas.pdf', 'D'); 
    }

}

/* End of file Fasilitas.php */
/* Location: ./application/controllers/Fasilitas.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-05-25 19:35:04 */
/* http://harviacode.com */