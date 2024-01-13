<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guru extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->session->set_flashdata('not-login', 'Gagal!');
        if (!$this->session->userdata('email')) {
            redirect('welcome/guru');
        }
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('guru', ['email' =>
            $this->session->userdata('email')])->row_array();

        $this->load->view('guru/index');
    }

    //hapus quiz
    public function delete_quiz($id)
    {
        $this->load->model('m_quiz');
        $where = array('id' => $id);
        $this->m_quiz->delete_quiz($where, 'quiz');
        $this->session->set_flashdata('user-delete', 'berhasil');
        redirect('admin/data_quiz');
    }
    // Management Quiz
    public function data_quiz(){
        $this->load->model('m_quiz');

        $data['user'] = $this->db->get_where('admin', ['email' =>
            $this->session->userdata('email')])->row_array();

        $data['user'] = $this->m_quiz->tampil_data();
        $this->load->view('admin/data_quiz', $data);
    }

    // tambah quiz
    public function tambah_quiz()
    {
        $this->form_validation->set_rules('id_materi', 'Materi', 'required', [
            'required' => 'Harap isi kolom materi.'
        ]);
        if ($this->form_validation->run() == false) {
            $this->load->view('admin/add_quiz');
        } else {
            // var_dump($this->session->userdata());die;

            $data = [
                'id_materi' => htmlspecialchars($this->input->post('id_materi', true)),
                'pertanyaan' => htmlspecialchars($this->input->post('pertanyaan', true)),
                'pilihan_a' => htmlspecialchars($this->input->post('pilihan_a', true)),
                'pilihan_b' => htmlspecialchars($this->input->post('pilihan_b', true)),
                'pilihan_c' => htmlspecialchars($this->input->post('pilihan_c', true)),
                'pilihan_d' => htmlspecialchars($this->input->post('pilihan_d', true)),
                'jawaban_benar' => htmlspecialchars($this->input->post('jawaban_benar', true)),
                'pembahasan' => htmlspecialchars($this->input->post('pembahasan', true)),
            ];

            $this->db->insert('quiz', $data);
            $this->session->set_flashdata('success-reg', 'Berhasil!');
            redirect(base_url('admin/data_quiz'));
        }
    }

    // update_quiz
    public function update_quiz($id){
        $this->load->model('m_quiz');
        $where = array('quiz.id' => $id);
        $data['user'] = $this->m_quiz->update_quiz($where, 'quiz');
        $this->load->view('admin/update_quiz', $data);
    }
    //quiz_edit
    public function quiz_edit()
    {
        $this->load->model('m_quiz');

        $id = $this->input->post('id');
        $id_materi = $this->input->post('id_materi');
        $pertanyaan = $this->input->post('pertanyaan');
        $pilihan_a = $this->input->post('pilihan_a');
        $pilihan_b = $this->input->post('pilihan_b');
        $pilihan_c = $this->input->post('pilihan_c');
        $pilihan_d = $this->input->post('pilihan_d');
        $jawaban_benar = $this->input->post('jawaban_benar');
        $pembahasan = $this->input->post('pembahasan');

        $data = array(
            'pertanyaan' => $pertanyaan,
            'pilihan_a' => $pilihan_a,
            'pilihan_b' => $pilihan_b,
            'pilihan_b' => $pilihan_b,
            'pilihan_c' => $pilihan_c,
            'pilihan_d' => $pilihan_d,
            'jawaban_benar' => $jawaban_benar,
            'pembahasan' => $pembahasan,
        );

        $where = array(
            'id' => $id,
        );

        $this->m_quiz->update_data($where, $data, 'quiz');
        $this->session->set_flashdata('success-edit', 'berhasil');
        redirect('admin/data_quiz');
    }
    
     

    public function add_materi()
    {
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim|min_length[1]', [
            'required' => 'Harap isi kolom deskripsi.',
            'min_length' => 'deskripsi terlalu pendek.',
        ]);
        if ($this->form_validation->run() == false) {
            $this->load->view('guru/add_materi');
        } else {
            $upload_video = $_FILES['video'];
            // var_dump($upload_video);die;
            if ($upload_video) {
                $config['allowed_types'] = 'mp4|mkv';
                $config['max_size'] = '0';
                $config['upload_path'] = './assets/materi_video';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('video')) {
                    $video = $this->upload->data('file_name');
                } else {
                    $this->upload->display_errors();
                }
            }
            $data = [
                'nama_guru' => htmlspecialchars($this->input->post('nama_guru', true)),
                'nama_mapel' => htmlspecialchars($this->input->post('nama_mapel', true)),
                'video' => $video,
                'deskripsi' => htmlspecialchars($this->input->post('deskripsi', true)),
                'kelas' => htmlspecialchars($this->input->post('kelas', true)),
            ];

            $this->db->insert('materi', $data);
            $this->session->set_flashdata('success-reg', 'Berhasil!');
            redirect(base_url('guru'));
        }
    }

    private function _uploadImage()
    {
        $config['upload_path'] = './assets/materi_video';
        $config['allowed_types'] = 'mp4|mkv';
        $config['file_name'] = $this->product_id;
        $config['overwrite'] = true;
        $config['max_size'] = 0; // 1MB
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('image')) {
            return $this->upload->data("file_name");
        }

        return "default.mp4";
    }
}
