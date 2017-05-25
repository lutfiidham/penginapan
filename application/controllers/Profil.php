<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Profil extends CI_Controller
{
    
        
    function __construct()
    {
        parent::__construct();
        $this->load->model('Profil_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $profil = $this->Profil_model->get_all();

        $data = array(
            'profil_data' => $profil
        );

        $this->template->load('template','profil/profil_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Profil_model->get_by_id($id);
        if ($row) {
            $data = array(
		'ID_PROFIL' => $row->ID_PROFIL,
		'NAMA' => $row->NAMA,
		'ALAMAT' => $row->ALAMAT,
		'TELP' => $row->TELP,
	    );
            $this->template->load('template','profil/profil_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('profil'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('profil/create_action'),
	    'ID_PROFIL' => set_value('ID_PROFIL'),
	    'NAMA' => set_value('NAMA'),
	    'ALAMAT' => set_value('ALAMAT'),
	    'TELP' => set_value('TELP'),
	);
        $this->template->load('template','profil/profil_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'NAMA' => $this->input->post('NAMA',TRUE),
		'ALAMAT' => $this->input->post('ALAMAT',TRUE),
		'TELP' => $this->input->post('TELP',TRUE),
	    );

            $this->Profil_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('profil'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Profil_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('profil/update_action'),
		'ID_PROFIL' => set_value('ID_PROFIL', $row->ID_PROFIL),
		'NAMA' => set_value('NAMA', $row->NAMA),
		'ALAMAT' => set_value('ALAMAT', $row->ALAMAT),
		'TELP' => set_value('TELP', $row->TELP),
	    );
            $this->template->load('template','profil/profil_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('profil'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('ID_PROFIL', TRUE));
        } else {
            $data = array(
		'NAMA' => $this->input->post('NAMA',TRUE),
		'ALAMAT' => $this->input->post('ALAMAT',TRUE),
		'TELP' => $this->input->post('TELP',TRUE),
	    );

            $this->Profil_model->update($this->input->post('ID_PROFIL', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('profil'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Profil_model->get_by_id($id);

        if ($row) {
            $this->Profil_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('profil'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('profil'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('NAMA', 'nama', 'trim|required');
	$this->form_validation->set_rules('ALAMAT', 'alamat', 'trim|required');
	$this->form_validation->set_rules('TELP', 'telp', 'trim|required');

	$this->form_validation->set_rules('ID_PROFIL', 'ID_PROFIL', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "profil.xls";
        $judul = "profil";
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
	xlsWriteLabel($tablehead, $kolomhead++, "NAMA");
	xlsWriteLabel($tablehead, $kolomhead++, "ALAMAT");
	xlsWriteLabel($tablehead, $kolomhead++, "TELP");

	foreach ($this->Profil_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->NAMA);
	    xlsWriteLabel($tablebody, $kolombody++, $data->ALAMAT);
	    xlsWriteLabel($tablebody, $kolombody++, $data->TELP);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    function pdf()
    {
        $data = array(
            'profil_data' => $this->Profil_model->get_all(),
            'start' => 0
        );
        
        ini_set('memory_limit', '32M');
        $html = $this->load->view('profil/profil_pdf', $data, true);
        $this->load->library('pdf');
        $pdf = $this->pdf->load();
        $pdf->WriteHTML($html);
        $pdf->Output('profil.pdf', 'D'); 
    }

}

/* End of file Profil.php */
/* Location: ./application/controllers/Profil.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-05-23 18:30:25 */
/* http://harviacode.com */