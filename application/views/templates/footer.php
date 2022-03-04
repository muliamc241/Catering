        <?php
            $cek_iklan =  $this -> db -> get_where('iklan') -> row_array();
            $tgl_sekarang = date('d F Y');
            $batas = (time()+((60*60*24)*2)); //  strtotime('2020-02-02 14:18:00');
            $jam = date('H', strtotime($cek_iklan['tgl_selesai']));
            $menit = date('i', strtotime($cek_iklan['tgl_selesai']));
            $detik = date('s', strtotime($cek_iklan['tgl_selesai']));
            $hari = date('d',  strtotime($cek_iklan['tgl_selesai']));
            $bulan = date('m', strtotime($cek_iklan['tgl_selesai']));
            $tahun = date('Y', strtotime($cek_iklan['tgl_selesai']));
            $waktu_tujuan = mktime($jam,$menit,$detik,$bulan,$hari,$tahun);
            $waktu_sekarang = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"));
            $selisih_waktu = $waktu_tujuan - $waktu_sekarang;
            $jumlah_hari = floor($selisih_waktu/86400);
            $sisa = $selisih_waktu % 86400;
            $jumlah_jam = floor($sisa/3600);
            $sisa = $sisa % 3600;
            $jumlah_menit = floor($sisa/60);
            $sisa = $sisa % 60;
            $jumlah_detik = floor($sisa/1);                             
        ?>
        <form action="<?= base_url('admin/valid_iklan') ?>" id="batas_terima" method='POST' > 
          <input type="hidden" name="tgl_sekarang" value="<?= date('d F Y') ?>">
        </form>
    <div id="copyright">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 mb-2 mb-lg-0">
            <p class="text-center text-lg-left">©<?= Date('Y')?> Ta Catering.</p>
          </div>
          <div class="col-lg-6">
            <p class="text-center text-lg-right">design by <a href="">Catering Mart</a>
            </p>
          </div>
        </div>
      </div>
    </div>
    
    <!-- *** COPYRIGHT END ***-->
    <!-- JavaScript files-->
    <script src="<?php echo base_url().'ckeditor/ckeditor.js'?>"></script>
    <script src="<?php echo base_url('assets/jquery/jquery.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
    <script src="<?php echo base_url('assets//jquery.cookie/jquery.cookie.js')?>"> </script>
    <script src="<?php echo base_url('assets/owl.carousel/owl.carousel.min.js')?>"></script>
    <script src="<?php echo base_url('assets//owl.carousel2.thumbs/owl.carousel2.thumbs.js')?>"></script>
    <script src="<?php echo base_url('js/front.js')?>"></script>

    
    <script type="text/javascript">
    effectsSlide = 'rain,stairs,fade,blinds';
    var gezzSlider = Slidergezz.slider({container: 'main-slider', width: 1000, height: 236, effects: effectsSlide,repeat(),
     display: {
      autoplay: 0,1,
      }
    });
    </script>
    <script type="text/javascript">
    $(function () {
      CKEDITOR.replace('ckeditor');
    });
  </script>


  <script>

    CKEDITOR.config.removePlugins = 'elementspath';

  </script>
<script>
    function nilai(st1) {
        document.querySelector('#volume').value = st1;
    }
</script>

<script>
    function nilai(st2) {
        document.querySelector('#volume').value = st2;
    }
</script>

<script>
    function nilai(st3) {
        document.querySelector('#volume').value = st3;
    }
</script>

<script>
    function nilai(st4) {
        document.querySelector('#volume').value = st4;
    }
</script>

<script>
    function nilai(st5) {
        document.querySelector('#volume').value = st5;
    }
</script>
  
  <script>
  window.onload = PilihGambar;
 
  var gambar = new Array("images/gambar2.jpg","images/gambar3.jpg","images/gambar4.jpg");
 
  function PilihGambar() {
      var randomNum = Math.floor(Math.random() * gambar.length);
      document.getElementById("gambarSaya").src = gambar[randomNum];
  }
  </script>
    <script>
      // angka 500 dibawah ini artinya pesan akan muncul dalam 0,5 detik setelah document ready
      var ik = 5000;
        $(document).ready(function(){
           setTimeout(function(){
            $('#myiklan').modal('show');
          }, ik);
        });

      // angka 3000 dibawah ini artinya pesan akan hilang dalam 3 detik setelah muncul
      //  setInterval(function(){
      //   $('#myiklan').modal('hide');
      // }, 8000);
    </script>


    <script type="text/javascript">
      var days = <?php echo $jumlah_hari; ?>  
      var hours = <?php echo $jumlah_jam; ?>  
      var minutes = <?php echo $jumlah_menit; ?>  
      var seconds = <?php echo $jumlah_detik; ?> 
      function setCountDown ()
      {
          seconds--;
          if (seconds < 0){
             minutes--;
             seconds = 59
          }
          if (minutes < 0){
              hours--;
              minutes = 59
          }
          if (hours < 0){
              hours = 23
          }
          document.getElementById("remain").innerHTML = "  "+days+" day "+hours+" hr "+minutes+" min    "+seconds+" sec";
          SD=window.setTimeout( "setCountDown()", 1000 );
          if (minutes == '00' && seconds == '00') { 
              seconds = "00";
              document.batas_terima.submit();
          } 

       }
    </script>

     <script>
  $(document).ready(function(){ // Ketika halaman sudah siap (sudah selesai di load)
    
    $("#kecamatan").change(function(){ // Ketika user mengganti atau memilih data provinsi
      $("#kodepos").hide(); // Sembunyikan dulu combobox kota nya
    
      $.ajax({
        type: "POST", // Method pengiriman data bisa dengan GET atau POST
        url: "<?php echo base_url("user/listKodePos"); ?>", // Isi dengan url/path file php yang dituju
        data: {id_kecamatan : $("#kecamatan").val()}, // data yang akan dikirim ke file yang dituju
        dataType: "json",
        beforeSend: function(e) {
          if(e && e.overrideMimeType) {
            e.overrideMimeType("application/json;charset=UTF-8");
          }
        },
        success: function(response){ // Ketika proses pengiriman berhasil
          // set isi dari combobox kota
          // lalu munculkan kembali combobox kotanya
          $("#kodepos").html(response.list_kodepos).show();
        },
        error: function (xhr, ajaxOptions, thrownError) { // Ketika ada error
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
        }
      });
    });
  });
  </script>

  <script type="text/javascript">
  jQuery('<div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>').insertAfter('.quantity input');
    jQuery('.quantity').each(function() {
      var spinner = jQuery(this),
        input = spinner.find('input[type="number"]'),
        btnUp = spinner.find('.quantity-up'),
        btnDown = spinner.find('.quantity-down'),
        min = input.attr('min'),
        max = input.attr('max');

      btnUp.click(function() {
        var oldValue = parseFloat(input.val());
        if (oldValue >= max) {
          var newVal = oldValue;
        } else {
          var newVal = oldValue + 1;
        }
        spinner.find("input").val(newVal);
        spinner.find("input").trigger("change");
      });

      btnDown.click(function() {
        var oldValue = parseFloat(input.val());
        if (oldValue <= min) {
          var newVal = oldValue;
        } else {
          var newVal = oldValue - 1;
        }
        spinner.find("input").val(newVal);
        spinner.find("input").trigger("change");
      });

    });
              </script>

  </body>
</html>