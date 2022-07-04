<!DOCTYPE html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>JOBTECH</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/header.css">
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="css/company/kelola-lowongan.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="jquery.min.js"></script>

</head>

<script>
$(document).ready(function() {
  $(".answer1").hide();
  $(".answer2").hide();
  $(".answer3").hide();
  $(".answer4").hide();
  $(".question1").click(function() {
    $(".answer1").slideToggle();
  });
  $(".question2").click(function() {
    $(".answer2").slideToggle();
  });
  $(".question3").click(function() {
    $(".answer3").slideToggle();
  });
  $(".question4").click(function() {
    $(".answer4").slideToggle();
  });
});
</script>

<style>
.company-card {
  background-color: #2a41e8;
}

.question1 {
  color: white;
}

.question2 {
  color: white;
}

.question3 {
  color: white;
}

.question4 {
  color: white;
}

.answer1 {
  color: white;
}

.answer2 {
  color: white;
}

.answer3 {
  color: white;
}

.answer4 {
  color: white;
}
</style>
<div class="section">
  <div class="container">
    <h2>FAQ</h2>
    <div class="dashboard-content">
      <div class="company-card">
        <div class="company-info company-detail">
          <div class="question1">
            <br>
            <h3>Apa Itu JobTech ?</h3><br>
          </div>
          <div class="answer1">JobTech adalah singkatan dari Job dan Technology. Aplikasi Jobtech bertujuan untuk
            mempertemukan para pencari kerja dengan Para Perusahaan/Startup yang membuka lowongan secara gratis.</div>
        </div>
      </div>
      <div class="dashboard-content">
        <div class="company-card">
          <div class="company-info company-detail">
            <div class="question2">
              <br>
              <h3> Account And Login</h3><br>
            </div>
            <div class="answer2">Untuk dapat menggunakan JobTech, peserta harus melakukan log in dengan menggunakan
              username Email dan Password. Untuk dapat melamar pada lowongan yang diinginkan, Peserta wajib melengkapi
              seluruh form resume yang telah sediakan setelah Log In</div>
          </div>
        </div>
        <div class="dashboard-content">
          <div class="company-card">
            <div class="company-info company-detail">
              <div class="question3">
                <br>
                <h3> Bagaimana cara agar bisa mendaftar pekerjaan di JobTech</h3> <br>
              </div>
              <div class="answer3">Kamu bisa mencari lowongan-lowongan pekerjaan dengan memilih menu “Find Jobs” yang
                terdapat di menu utama. Setelah itu klik “View Detail” pada lowongan yang kamu pilih, silahkan baca
                deskripsi pekerjaannya dan kebutuhannya lalu setelah itu klik “Apply Now” saat kamu sudah memutuskan
                untuk melamar pekerjaan tersebut. Setelah kamu klik “Apply Now”, akan muncul tampilan konfirmasi. Klik
                sekali lagi pada tampilan konfirmasi tersebut sekali lagi untuk melamar pekerjaan tersebut.</div>
            </div>
          </div>
        </div>
        <div class="dashboard-content">
          <div class="company-card">
            <div class="company-info company-detail">
              <div class="question4">
                <br>
                <h3> Apa yang selanjutnya saya lakukan setelah berhasil masuk ke dalam akun JOBTECH</h3> <br>
              </div>
              <div class="answer4">Untuk mengaktifkan akun SIMONAS kamu dan membuat profil kamu dapat dilihat oleh
                perusahaan, hal yang harus dilakukan adalah memperbaharui profil/data diri terlebih dahulu dan mengisi
                data-data yang dibutuhkan, seperti :
                <br>
                1) Foto <br>
                2) CV <br>
                3) Tentang Saya <br>
                4) Diploma <br>
                5) Keahlian <br>
                6) Pendidikan <br>
                7) Portofolio <br>
                8) Pengalaman Kerja
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>

</html>