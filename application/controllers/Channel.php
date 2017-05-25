<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Channel extends CI_Controller
{


    function __construct()
    {
        parent::__construct();
        $this->load->model('Channel_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $channel = $this->Channel_model->get_all();
        echo gen_id("CH", "channel", "id_channel");

        $data = array(
            'channel_data' => $channel
        );

        $this->template->load('template','channel/channel_list', $data);
    }

    public function read($id)
    {
        $row = $this->Channel_model->get_by_id($id);
        if ($row) {
            $data = array(
		'ID_CHANNEL' => $row->ID_CHANNEL,
		'NAMA_CHANNEL' => $row->NAMA_CHANNEL,
	    );
            $this->template->load('template','channel/channel_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('channel'));
        }
    }

    public function create()
    {

        $data = array(
            'button' => 'Create',
            'action' => site_url('channel/create_action'),
	    'ID_CHANNEL' => set_value('ID_CHANNEL'),
	    'NAMA_CHANNEL' => set_value('NAMA_CHANNEL'),
	);
        $this->template->load('template','channel/channel_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'NAMA_CHANNEL' => $this->input->post('NAMA_CHANNEL',TRUE),
	    );

            $this->Channel_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('channel'));
        }
    }

    public function update($id)
    {
        $row = $this->Channel_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('channel/update_action'),
            		'ID_CHANNEL' => set_value('ID_CHANNEL', $row->ID_CHANNEL),
            		'NAMA_CHANNEL' => set_value('NAMA_CHANNEL', $row->NAMA_CHANNEL),
            	    );
            $this->template->load('template','channel_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('channel'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('ID_CHANNEL', TRUE));
        } else {
            $data = array(
		'NAMA_CHANNEL' => $this->input->post('NAMA_CHANNEL',TRUE),
	    );

            $this->Channel_model->update($this->input->post('ID_CHANNEL', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('channel'));
        }
    }

    public function delete($id)
    {
        $row = $this->Channel_model->get_by_id($id);

        if ($row) {
            $this->Channel_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('channel'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('channel'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('NAMA_CHANNEL', 'nama channel', 'trim|required');

	$this->form_validation->set_rules('ID_CHANNEL', 'ID_CHANNEL', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "channel.xls";
        $judul = "channel";
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
	xlsWriteLabel($tablehead, $kolomhead++, "NAMA CHANNEL");

	foreach ($this->Channel_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->NAMA_CHANNEL);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Channel.php */
/* Location: ./application/controllers/Channel.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-05-23 18:30:25 */
/* http://harviacode.com */
