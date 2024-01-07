<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Download-PDF</title>
    <style>

    .row1 {
        width: 80%; /* Atur lebar container sesuai kebutuhan Anda */
        margin: 0 auto;
        padding-top: 7%;
    }

    .content1 {
        width: 35%; /* Memberikan lebar untuk setiap content (memberikan jarak 2% antara keduanya) */
        padding: 10px;
        float: left;
    }
    .content2 {
        width: 55%; /* Memberikan lebar untuk setiap content (memberikan jarak 2% antara keduanya) */
        padding: 10px;
        float: right;
    }
    .row2 {
        width: 80%; /* Atur lebar container sesuai kebutuhan Anda */
        margin: 0 auto;
        padding-top: 30%;
    }

    .content-1 {
        width: 42%; /* Memberikan lebar untuk setiap content (memberikan jarak 2% antara keduanya) */
        float: left;
        margin-right: 40px;
    }
    .content-2 {
        width: 40%; /* Memberikan lebar untuk setiap content (memberikan jarak 2% antara keduanya) */
        float: right;
        padding-right: 47px;
    }

    </style>
</head>
<body>
    <div class="card">
        <div class="card-body">
            <div id="pdf">
                <center id="top">
                    <div class="info">
                        <h4>SURAT PERNYATAAN <br> TIDAK AKAN DATANG TERLAMBAT KESEKOLAH</h4><br><br>
                    </div>
                </center>
                <div class="data" >
                    <div class="catatan" >
                    <p>Yang bertanda tangan dibawah ini : <br>
                        NIS     :  {{ $lates->student->nis }} <br>
                        Nama    :  {{ $lates->student->name }} <br>
                        Rombel  :  {{ $lates->student->rombel->rombel }} <br>
                        Rayon   :  {{ $lates->student->rayon->rayon }} <br>
                        <br>
                        <br>
                        Dengan ini menyatakan bahwa saya telah melakukan pelanggaran tata tertib sekolah, yaitu terlambat
                        data ke sekolah sebanyak <b>3 Kali </b>yang mana hal tersebut termasuk kedalam pelanggaran 
                        kedisiplinan. Saya berjanji tidak akan terlambat datang ke sekolah lagi. Apabila saya terlambat
                        lagi saya siap diberikan sanksi yang sesuai dengan peraturan sekolah.
                        <br>
                        <br>
                        Demikian surat pernyataan terlambat ini saya buat dengan penuh penyesalan.
                        <br>
                        <br> 
                    </div>
                    <div class="row1">
                                <p id="tanggalDiv" style="padding-left: 53%;">
                                    Bogor,......
                                </p><br>
                                <div class="content1">
                                <center>
                                  Peserta Didik,
                                  <br><br><br><br><br>
                                  ( {{ $lates->student->name }} )
                                </center>
                                </div>
                                <div class="content2">
                                <center>
                                  Orang Tua/Wali Peserta Didik,
                                  <br><br><br><br><br>
                                  (..............)
                                </center>
                                </div>
                            </div>
                        <br>
                            <div class="row2">
                                <div class="content-1">
                                <center>
                                    Pembimbing Siswa,
                                    <br><br><br><br><br>
                                    ( {{ $lates->student->rayon->user->name }} )
                                </center>
                                </div>
                                <div class="content-2">
                                <center>
                                    Kesiswaan,
                                    <br><br><br><br><br>
                                    (..............)
                                </center>
                                </div>
                            </div>
                    </p>
                </div>
            </div>
        </div>
        <script src="{{ asset('js/tanggal-pdf.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
      </div>
</body>
</html>