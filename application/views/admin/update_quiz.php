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

<!DOCTYPE html>
<html lang="en" style="scroll-behavior:smooth !important;">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Update Data Quiz - Skybook </title>
    <!-- General CSS Files -->
    <link rel="icon" href="<?= base_url('assets/') ?>img/new/SB2.png" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:500,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>stisla-assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>stisla-assets/css/components.css">
</head>

<body>


    <!-- Start Sidebar -->
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class=" navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a>
                        </li>
                    </ul>
                </form>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" style="margin-bottom:4px !important;" src="../assets/stisla-assets/img/avatar/avatar-3.png" class="rounded-circle mr-1 my-auto">
                            <div class="d-sm-none d-lg-inline-block" style="font-size:15px;">Hello, <?php
                                                                                                    $data['user'] = $this->db->get_where('admin', ['email' =>
                                                                                                    $this->session->userdata('email')])->row_array();
                                                                                                    echo $data['user']['username'];
                                                                                                    ?></div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-title">Admin - Skybook</div>
                            <a href="<?= base_url('welcome/logout') ?>" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand text-danger">
                        <div>
                            <a href="<?= base_url('admin') ?>" >
                                <img src="<?= base_url('assets/') ?>img/new/SB2.png" width="200px" height="170px" style="margin-top: -35px;" >
                            </a>
                        </div>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="<?= base_url('admin') ?>">LY</a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="menu-header ">Dashboard</li>
                        <li class="nav-item dropdown ">
                            <a href="<?= base_url('admin') ?>" class="nav-link"><i class="fas fa-desktop"></i><span>Dashboard</span></a>
                        </li>
                        <li class="menu-header">Management Siswa</li>
                        <li class="nav-item dropdown ">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-user"></i>
                                <span>Siswa</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="<?= base_url('admin/data_siswa') ?>">Data Siswa</a></li>
                            </ul>
                        </li>
                        <li class="menu-header">Management Guru</li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link has-dropdown"><i class="fas fa-chalkboard-teacher"></i>
                                <span>Guru</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="<?= base_url('admin/data_guru') ?>">Data Guru</a>
                                </li>
                                <li><a class="nav-link" href="<?= base_url('admin/add_guru') ?>">Tambah Data Guru</a>
                                </li>

                            </ul>
                        </li>
                        <li class="menu-header">Management Materi</li>
                        <li class="nav-item dropdown ">
                            <a href="#" class="nav-link has-dropdown"><i class="fas fa-book"></i>
                                <span>Materi</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="<?= base_url('admin/data_materi') ?>">Data Materi</a>
                                </li>
                                <li><a class="nav-link" href="<?= base_url('admin/tambah_materi') ?>">Tambah Materi</a>
                                </li>

                            </ul>
                        </li>
                        <li class="menu-header">Management Quiz</li>
                            <li class="nav-item dropdown active">
                                <a href="#" class="nav-link has-dropdown"><i class="fas fa-question"></i>
                                    <span>Quiz</span></a>
                                <ul class="dropdown-menu">
                                    <li><a class="nav-link" href="<?= base_url('admin/data_quiz') ?>">Data Quiz</a>
                                    </li>
                                    <li><a class="nav-link" href="<?= base_url('admin/tambah_quiz') ?>">Tambah Quiz</a>
                                    </li>
                                </ul>
                        </li>
                        
                </aside>
            </div>
            <!-- End Sidebar -->

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="">
                        <div class="card" style="width:100%;">
                            <div class="card-body">
                                <h2 class="card-title" style="color: black;">Update Data Quiz</h2>
                                <a href="#detail" class="btn btn-info">Saya paham dan
                                    ingin melanjutkan ⭢</a>
                            </div>
                        </div>
                        <div class="card card-success">
                            <div class="col-md-12 text-center">
                                <p class="registration-title font-weight-bold display-4 mt-4" style="color:black; font-size: 50px;">
                                    Update Quiz</p>
                                <p style="line-height:-30px;margin-top:-20px;">Silahkan isi data data yang diperlukan
                                    dibawah </p>
                                <hr>
                            </div>
                            <?php foreach ($user as $u) { ?>
                            <div id="detail" class="card-body">
                                <form method="POST" enctype="multipart/form-data" action="<?= base_url('admin/quiz_edit') ?>">
                                    <div class="col-md-12 bg-white" style="border-radius:3px;box-shadow:rgba(0, 0, 0, 0.03) 0px 4px 8px 0px">
                                        <form method="post" enctype="multipart/form-data" action="<?= base_url('guru/quiz_edit') ?>">
                                            <input type="hidden" name="id" value="<?= $u->id ?>" >
                                            <input type="hidden" name="id_materi" value="<?= $u->id_materi ?>" >
                                            <div class="form-group">
                                                <label for="nip">Nama Guru</label>

                                                <input readonly id="nama_mapel" type="text" class="form-control" value="<?= $u->nama_mapel ?>" name="nama_mapel">
                                                <?= form_error('nama_mapel', '<small class="text-danger">', '</small>'); ?>
                                                <div class="invalid-feedback">
                                                </div>
                                            </div>


                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1">Pertanyaan</label>
                                                <textarea class="form-control" required name="pertanyaan" id="exampleFormControlTextarea1" rows="3"><?= $u->pertanyaan ?></textarea>
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1">Pilihan A</label>
                                                <input type="text" class="form-control" name="pilihan_a" id="pilihan_a" value="<?= $u->pilihan_a ?>" >
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1">Pilihan B</label>
                                                <input type="text" class="form-control" name="pilihan_b" id="pilihan_b" value="<?= $u->pilihan_b ?>" >
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1">Pilihan C</label>
                                                <input type="text" class="form-control" name="pilihan_c" id="pilihan_c" value="<?= $u->pilihan_c ?>" >
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1">Pilihan D</label>
                                                <input type="text" class="form-control" name="pilihan_d" id="pilihan_d" value="<?= $u->pilihan_d ?>" >
                                            </div>
                                            <div class="form-group">
                                                <label for="inputState">Jawaban Benar</label>
                                                <select required id="inputState" name="jawaban_benar" class="form-control">
                                                    <option <?php echo ($u->jawaban_benar == 'A') ? 'selected' : ''; ?> value="A">A</option>
                                                    <option <?php echo ($u->jawaban_benar == 'B') ? 'selected' : ''; ?> value="B">B</option>
                                                    <option <?php echo ($u->jawaban_benar == 'C') ? 'selected' : ''; ?> value="C">C</option>
                                                    <option <?php echo ($u->jawaban_benar == 'D') ? 'selected' : ''; ?> value="D">D</option>
                                                </select>

                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1">Pembahasan</label>
                                                <textarea class="form-control" required name="pembahasan" id="exampleFormControlTextarea1" rows="3"><?= $u->pembahasan ?></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-block btn-info">Edit
                                                Quiz ⭢</button>
                                    </div>
                                </form>
                            </div>

                            <?php } ?>

                        </div>
                        <br>
                    </div>
                </section>
            </div>
        </div>
        <!-- End Main Content -->

        <!-- Start Footer -->
        <footer class="main-footer">
            <div class="text-center">
                Copyright &copy; 2020 <div class="bullet"></div><a href="https://github.com/syauqi">Syauqi Zaidan Khairan Khalaf</a>
            </div>
        </footer>
        <!-- End Footer -->

        <!-- General JS Scripts -->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script>
           document.getElementById('nama_materi').addEventListener('input', function() {
        var selectedOption = document.querySelector('#namamateri option[value="' + this.value + '"]');
        if (selectedOption) {
            var namaMapel = selectedOption.getAttribute('data-nama');
            var idMateri = selectedOption.value;

            // Menyimpan nilai id_materi ke hidden input
            document.getElementById('id_materi_hidden').value = idMateri;

            // Mengganti nilai input dengan nama_mapel
            this.value = namaMapel;
        } else {
            // Reset nilai hidden input jika tidak ada opsi yang cocok
            document.getElementById('id_materi_hidden').value = '';
        }
    });
            function autofill() {
                var nama_guru = $("#namaguru").val();
                $.ajax({
                    url: '../autofill.php',
                    data: "nama_guru=" + nama_guru,
                }).done(function(data) {
                    var json = data,
                        obj = JSON.parse(json);
                    $('#nama_mapel').val(obj.nama_mapel);
                });
            }
        </script>
        <script>
            $('.custom-file-input').on('change', function() {
                let fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').addClass("selected").html(fileName);
            });
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
        <script src="<?= base_url('assets/') ?>stisla-assets/js/stisla.js"></script>
        <!-- JS Libraies -->
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#example').DataTable();
            });
        </script>
        <!-- Template JS File -->
        <script src="<?= base_url('assets/') ?>stisla-assets/js/scripts.js"></script>
        <script src="<?= base_url('assets/') ?>stisla-assets/js/custom.js"></script>
        <!-- Page Specific JS File -->
</body>

</html>