<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Inventori extends CI_Controller
{
    
        
    function __construct()
    {
        parent::__construct();
        $this->load->model('Inventori_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $inventori = $this->Inventori_model->get_all();

        $data = array(
            'inventori_data' => $inventori
        );

        $this->template->load('template','inventori/inventori_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Inventori_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_inventori' => $row->id_inventori,
		'nama_inventori' => $row->nama_inventori,
		'harga_inventori' => $row->harga_inventori,
	    );
            $this->template->load('template','inventori/inventori_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('inventori'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('inventori/create_action'),
	    'id_inventori' => set_value('id_inventori'),
	    'nama_inventori' => set_value('nama_inventori'),
	    'harga_inventori' => set_value('harga_inventori'),
	);
        $this->template->load('template','inventori/inventori_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
              'id_inventori' => gen_id("in", "inventori", "id_inventori", "4"),
		'nama_inventori' => $this->input->post('nama_inventori',TRUE),
		'harga_inventori' => $this->input->post('harga_inventori',TRUE),
	    );

            $this->Inventori_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('inventori'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Inventori_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('inventori/update_action'),
		'id_inventori' => set_value('id_inventori', $row->id_inventori),
		'nama_inventori' => set_value('nama_inventori', $row->nama_inventori),
		'harga_inventori' => set_value('harga_inventori', $row->harga_inventori),
	    );
            $this->template->load('template','inventori/inventori_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('inventori'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_inventori', TRUE));
        } else {
            $data = array(
		'nama_inventori' => $this->input->post('nama_inventori',TRUE),
		'harga_inventori' => $this->input->post('harga_inventori',TRUE),
	    );

            $this->Inventori_model->update($this->input->post('id_inventori', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('inventori'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Inventori_model->get_by_id($id);

        if ($row) {
            $this->Inventori_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('inventori'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('inventori'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_inventori', 'nama inventori', 'trim|required');
	$this->form_validation->set_rules('harga_inventori', 'harga inventori', 'trim|required|numeric');

	$this->form_validation->set_rules('id_inventori', 'id_inventori', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "inventori.xls";
        $judul = "inventori";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Inventori");
	xlsWriteLabel($tablehead, $kolomhead++, "Harga Inventori");

	foreach ($this->Inventori_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_inventori);
	    xlsWriteNumber($tablebody, $kolombody++, $data->harga_inventori);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    function pdf()
    {
        $data = array(
            'inventori_data' => $this->Inventori_model->get_all(),
            'start' => 0
        );
        
        ini_set('memory_limit', '32M');
        $html = $this->load->view('inventori_pdf', $data, true);
        $this->load->library('pdf');
        $pdf = $this->pdf->load();
        $pdf->WriteHTML($html);
        $pdf->Output('inventori.pdf', 'D'); 
    }

}

/* End of file Inventori.php */
/* Location: ./application/controllers/Inventori.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-05-25 19:35:04 */
/* http://harviacode.com */