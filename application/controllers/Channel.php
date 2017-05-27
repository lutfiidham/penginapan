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

        $data = array(
            'channel_data' => $channel,
            'judul' => basename($this->uri->segment(1))
        );

        $this->template->load('template','channel/channel_list', $data);
    }

    public function read($id)
    {
        $row = $this->Channel_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_channel' => $row->id_channel,
		'nama_channel' => $row->nama_channel,
            'judul' => basename($this->uri->segment(1))
	    
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
	    'id_channel' => set_value('id_channel'),
	    'nama_channel' => set_value('nama_channel'),
            'judul' => basename($this->uri->segment(1))

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
              'id_channel' => gen_id("ch", "channel", "id_channel", "4"),
		'nama_channel' => $this->input->post('nama_channel',TRUE),
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
		'id_channel' => set_value('id_channel', $row->id_channel),
		'nama_channel' => set_value('nama_channel', $row->nama_channel),
            'judul' => basename($this->uri->segment(1))
	    
        );
            $this->template->load('template','channel/channel_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('channel'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_channel', TRUE));
        } else {
            $data = array(
		'nama_channel' => $this->input->post('nama_channel',TRUE),
	    );

            $this->Channel_model->update($this->input->post('id_channel', TRUE), $data);
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
	$this->form_validation->set_rules('nama_channel', 'nama channel', 'trim|required');

	$this->form_validation->set_rules('id_channel', 'id_channel', 'trim');
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Channel");

	foreach ($this->Channel_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_channel);

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
/* Generated by Harviacode Codeigniter CRUD Generator 2017-05-25 19:35:04 */
/* http://harviacode.com */
