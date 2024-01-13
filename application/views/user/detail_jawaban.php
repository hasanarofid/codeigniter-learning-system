<!--
@Project: Skybook
@Programmer: Syauqi Zaidan Khairan Khalaf
@Website: https://linktr.ee/syauqi
@Email : syaokay@gmail.com

@About-Skybook :
Web Edukasi Open Source yang dibuat oleh Syauqi Zaidan Khairan Khalaf.
Skybook adalah Web edukasi yang dilengkapi video, materi dan sistem ujian
yang tersedia secara gratis. Skybook dibuat ditujukan agar para siswa dan
guru dapat terus belajar dan mengajar dimana saja dan kapan saja.
-->

<!doctype html>
<html lang="en">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="<?= base_url('assets/') ?>img/new/SB2.png" type="image/png">
    <title>Hasil Quiz Anda - <?php
                                $data['user'] = $this->db->get_where('siswa', ['email' =>
                                $this->session->userdata('email')])->row_array();
                                echo $data['user']['nama'];
                                ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/bootstrap.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendors/linericon/style.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendors/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendors/lightbox/simpleLightbox.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendors/nice-select/css/nice-select.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendors/animate-css/animate.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendors/popup/magnific-popup.css">
    <!-- Main CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/style.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/responsive.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/materi_style.css">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.4/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/afterglowplayer@1.x"></script>
    <script src="<?= base_url('assets/') ?>js/jquery-3.3.1.min.js"></script>
    
</head>

<body style="overflow-x:hidden;background-color:#fbf9fa">

    <!-- Start Navigation Bar -->
    <header class="header_area" style="background-color: white !important;">
        <div class="main_menu">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <a class="navbar-brand logo_h" href="<?= base_url('welcome') ?>"><img src="<?= base_url('assets/') ?>img/new/SB2.png" width="150px" height="100px" alt=""></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav ml-auto">
                            <li class="nav-item "><a class="nav-link" href="javascript:void(0)">Hai, <?php
                                                                                                        $data['user'] = $this->db->get_where('siswa', ['email' =>
                                                                                                        $this->session->userdata('email')])->row_array();
                                                                                                        echo $data['user']['nama'];
                                                                                                        ?></a>
                            </li>
                            <li class="nav-item active"><a class="nav-link" href="<?= base_url('user') ?>">Beranda</a>
                            </li>
                            <li class=" nav-item "><a class=" nav-link text-danger" href="<?= base_url('welcome/logout') ?>">Log Out</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <!-- End Navigation Bar -->


    <!-- Start Greeting Cards -->
    <div class="container">
        <div class="bg-white mx-auto p-4 buat-text" data-aos="fade-down" data-aos-duration="1400" style="width: 100%; border-radius:10px;">
            <div class="row" style="color: black; font-family: 'poppins';">
                <div class="col-md-12 mt-1 ml-4">
                    <h1 class="display-4" style="color: black; font-family:'poppins';" data-aos="fade-down" data-aos-duration="1400">Berikut Hasil Score Anda !
                    </h1>
                    <h4 data-aos="fade-down" data-aos-duration="1700"><?php
                                                                        $data['user'] = $this->db->get_where('siswa', ['email' =>
                                                                        $this->session->userdata('email')])->row_array();
                                                                        echo $data['user']['nama'];
                                                                        ?> - Skybook Students</h3>
                        <p><?= 
                        $jawaban[0]->nama_mapel ?> </p>
<?php 
$hitung = 0;
$benarCount = 0;
$salahCount = 0;

foreach ($jawaban as $list):
    $hitung += $list->skor;
    $benarCount += ($list->benar == 1) ? 1 : 0;
    $salahCount += ($list->benar == 0) ? 1 : 0;
endforeach;
?>

Total Score: <?php echo $hitung; ?><br>
Correct Answers: <?php echo $benarCount; ?><br>
Incorrect Answers: <?php echo $salahCount; ?>

                        
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <?php $index = 0; ?>
        <?php foreach ($jawaban as $list): ?>
            <input  type="hidden" name="id_quiz[<?= $list->id ?>]"  value="<?= $list->id ?>">
                    
            <div class="card materi border-0 question" id="question<?= $index ?>" data-question-id="<?= $list->id ?>">
                <div class="card-body p-5">
                    <h3 class="card-title display-5">Question <?= $index + 1 ?>: <?= $list->pertanyaan; ?></h3>
                    <hr style="background-color: white;">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jawaban[<?= $list->id ?>]" id="optionA<?= $index ?>" value="A">
                        <label class="form-check-label" for="optionA<?= $index ?>">
                            <?= $list->pilihan_a; ?>
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jawaban[<?= $list->id ?>]" id="optionB<?= $index ?>" value="B">
                        <label class="form-check-label" for="optionB<?= $index ?>">
                            <?= $list->pilihan_b; ?>
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jawaban[<?= $list->id ?>]" id="optionC<?= $index ?>" value="C">
                        <label class="form-check-label" for="optionC<?= $index ?>">
                            <?= $list->pilihan_c; ?>
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jawaban[<?= $list->id ?>]" id="optionD<?= $index ?>" value="D">
                        <label class="form-check-label" for="optionD<?= $index ?>">
                            <?= $list->pilihan_d; ?>
                        </label>
                    </div>

                    <div class="mt-3">
                    <strong>Your Answer:</strong>
                    <?php echo isset($list->jawaban_siswa) ?$list->jawaban_siswa : 'Not answered'; ?>
                    <br>
                    <strong>Correct Answer:</strong> <?= $list->jawaban_benar; ?>
                    <br>
                    <?php
                        // Provide feedback based on correctness
                        $userAnswer = isset($list->jawaban_siswa) ? $list->jawaban_siswa : '';
                        if ($userAnswer === $list->jawaban_benar) {
                            echo '<span style="color: green;">Correct!</span>';
                        } else {
                            echo '<span style="color: red;">Incorrect. Correct answer is ' . $list->jawaban_benar . '</span>';
                            echo ' <br>';
                            echo '<span style="color: red;">Pembahasan :  ' . $list->pembahasan . '</span>';
                        }
                    ?>
                </div>
                
                
                </div>

               
            </div>
            <br>
            <?php $index++; ?>
        <?php endforeach; ?>

</div>
