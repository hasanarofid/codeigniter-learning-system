<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        // $this->session->set_flashdata('not-login', 'Gagal!');
        // if (!$this->session->userdata('email')) {
        //     redirect('welcome');
    }

    public function index()
    {
        $this->load->model('m_quiz');

        $data['user'] = $this->db->get_where('siswa', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['quiz'] = $this->m_quiz->tampil_data2();
        // var_dump($data['quiz']);die;

        $this->load->view('user/index', $data);
        $this->load->view('template/footer');
    }

    public function quiz($id)
    {
        $this->load->model('m_quiz');
        $where = array('quiz.id_materi' => $id);
        $data['quiz'] = $this->m_quiz->update_quiz($where, 'quiz');
        // var_dump($data['quiz']);die;
        $data['id'] = $id;
        $this->load->view('user/quiz', $data);
        $this->load->view('template/footer');
    }

    public function submit_jawaban($id){
        // var_dump($_POST);die;
        $this->load->model('m_quiz');
        $where = array('quiz.id_materi' => $id);
        $data['quiz'] = $this->m_quiz->update_quiz($where, 'quiz');
        $siswa = $this->db->get_where('siswa', ['email' =>
        $this->session->userdata('email')])->row_array();
        foreach ($_POST['id_quiz'] as $quizId => $value) {
            $where = array('id' => $value);
            $checkjawaban = $this->m_quiz->detail_quiz($where);
            $jawabanSiswa = $_POST['jawaban'][$quizId];
            // Perform scoring logic based on correct answers. Update 'benar' and 'skor' accordingly.
        
            // Example scoring logic:
            $benar = ($jawabanSiswa === $checkjawaban->jawaban_benar) ? 1 : 0;
            $skor = ($benar === 1) ? 1 : 0;
            // var_dump($benar.' '.$skor);die;
            // Insert into Jawaban table
            $jawabanData = array(
                'id_siswa' =>$siswa['id'],
                'id_quiz' => $value,
                'jawaban_siswa' => $jawabanSiswa,
                'benar' => $benar,
                'skor' => $skor,
                'created_at' => date('Y-m-d H:i:s')
            );
            $this->db->insert('jawaban', $jawabanData);
        }


        $this->session->set_flashdata('success-reg', 'Berhasil!');
        // redirect(base_url('welcome'));
        $redirectUrl = base_url('user/detail_jawaban').'/'.$id.'/'.$siswa['id'];
        redirect($redirectUrl);
    }

    //detail_jawaban
    public function detail_jawaban($id, $id_siswa) {

        $this->load->model('m_jawaban');
        $where = array('jawaban.id_siswa' => $id_siswa,'quiz.id_materi'=>$id);
        $data['jawaban'] = $this->m_jawaban->jawaban_siswa($where, 'jawaban');
        // var_dump($data['jawaban']);die;

        $data['user'] = $this->db->get_where('siswa', ['email' =>
            $this->session->userdata('email')])->row_array();

        $this->load->view('user/detail_jawaban',$data);
        $this->load->view('template/footer');

    }
    

    public function kelas10()
    {
        $data['user'] = $this->db->get_where('siswa', ['email' =>
            $this->session->userdata('email')])->row_array();

        $this->load->view('user/kelas10');
        $this->load->view('template/footer');
    }

    public function kelas11()
    {
        $data['user'] = $this->db->get_where('siswa', ['email' =>
            $this->session->userdata('email')])->row_array();

        $this->load->view('user/kelas11');
        $this->load->view('template/footer');
    }

    public function kelas12()
    {
        $data['user'] = $this->db->get_where('siswa', ['email' =>
            $this->session->userdata('email')])->row_array();

        $this->load->view('user/kelas12');
        $this->load->view('template/footer');
    }

    public function registration()
    {
        $this->load->view('user/registration');
        $this->load->view('template/footer');
    }

    public function registration_act()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim|min_length[4]', [
            'required' => 'Harap isi kolom username.',
            'min_length' => 'Nama terlalu pendek.',
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[siswa.email]', [
            'is_unique' => 'Email ini telah digunakan!',
            'required' => 'Harap isi kolom email.',
            'valid_email' => 'Masukan email yang valid.',
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]|matches[retype_password]', [
            'required' => 'Harap isi kolom Password.',
            'matches' => 'Password tidak sama!',
            'min_length' => 'Password terlalu pendek',
        ]);
        $this->form_validation->set_rules('retype_password', 'Password', 'required|trim|matches[password]', [
            'matches' => 'Password tidak sama!',
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('template/nav');
            $this->load->view('user/registration');
            $this->load->view('template/footer');
        } else {
            $email = $this->input->post('email', true);
            $data = [
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'email' => htmlspecialchars($email),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'is_active' => 1,
                'date_created' => time(),
            ];

            //siapkan token

            // $token = base64_encode(random_bytes(32));
            // $user_token = [
            //     'email' => $email,
            //     'token' => $token,
            //     'date_created' => time(),
            // ];

            $this->db->insert('siswa', $data);
            // $this->db->insert('token', $user_token);

            // $this->_sendEmail($token, 'verify');

            $this->session->set_flashdata('success-reg', 'Berhasil!');
            redirect(base_url('welcome'));
        }
    }

    private function _sendEmail($token, $type)
    {
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'ini email disini',
            'smtp_pass' => 'Isi Password gmail disini',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n",
        ];

        $this->email->initialize($config);

        $data = array(
            'name' => 'syauqi',
            'link' => ' ' . base_url() . 'welcome/verify?email=' . $this->input->post('email') . '& token' . urlencode($token) . '"',
        );

        $this->email->from('LearnifyEducations@gmail.com', 'Learnify');
        $this->email->to($this->input->post('email'));

        if ($type == 'verify') {
            $link =
            $this->email->subject('Verifikasi Akun');
            $body = $this->load->view('template/email-template.php', $data, true);
            $this->email->message($body);
        } else {
        }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die();
        }
    }

}
