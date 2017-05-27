<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Layanan extends CI_Controller
{
    
        
    function __construct()
    {
        parent::__construct();
        $this->load->model('Layanan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $layanan = $this->Layanan_model->get_all();

        $data = array(
            'layanan_data' => $layanan
        );

        $this->template->load('template','layanan/layanan_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Layanan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_layanan' => $row->id_layanan,
		'nama_layanan' => $row->nama_layanan,
	    );
            $this->template->load('template','layanan/layanan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('layanan'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('layanan/create_action'),
	    'id_layanan' => set_value('id_layanan'),
	    'nama_layanan' => set_value('nama_layanan'),
	);
        $this->template->load('template','layanan/layanan_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
            'id_layanan' => gen_id("ly", "layanan", "id_layanan", "4"),
		'nama_layanan' => $this->input->post('nama_layanan',TRUE),
	    );

            $this->Layanan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('layanan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Layanan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('layanan/update_action'),
		'id_layanan' => set_value('id_layanan', $row->id_layanan),
		'nama_layanan' => set_value('nama_layanan', $row->nama_layanan),
	    );
            $this->template->load('template','layanan/layanan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('layanan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_layanan', TRUE));
        } else {
            $data = array(
		'nama_layanan' => $this->input->post('nama_layanan',TRUE),
	    );

            $this->Layanan_model->update($this->input->post('id_layanan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('layanan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Layanan_model->get_by_id($id);

        if ($row) {
            $this->Layanan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('layanan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('layanan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_layanan', 'nama layanan', 'trim|required');

	$this->form_validation->set_rules('id_layanan', 'id_layanan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "layanan.xls";
        $judul = "layanan";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Layanan");

	foreach ($this->Layanan_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_layanan);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    function pdf()
    {
        $data = array(
            'layanan_data' => $this->Layanan_model->get_all(),
            'start' => 0
        );
        
        ini_set('memory_limit', '32M');
        $html = $this->load->view('layanan_pdf', $data, true);
        $this->load->library('pdf');
        $pdf = $this->pdf->load();
        $pdf->WriteHTML($html);
        $pdf->Output('layanan.pdf', 'D'); 
    }

}

/* End of file Layanan.php */
/* Location: ./application/controllers/Layanan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-05-25 19:35:04 */
/* http://harviacode.com */