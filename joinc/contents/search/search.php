<main role="main" class="flex-shrink-0">
  <div class="container content-news">
  
    <ol class="breadcrumb bg-transparent p-0 mt-3">
      <li class="breadcrumb-item"><a href="<?php echo $config['web_index']?>">Beranda</a></li>
      <li class="breadcrumb-item active">Cari Properti Area Jogja dan Sekitar</li>
    </ol>
  
    <div class="row">
      <div class="col-lg-6 col-md-6">
          <div class="sidebar-sticky">
            <div class="sticky-content">
              <div class="right-list">
                <div class="mb-3">
                  <img src="assets/images/search-page-wd.jpg" class="img-fluid">
                </div>
                <p class="mb-3">Jelaskan rumah seperti apa yang Anda inginkan. Kami akan mencarikan yang sesuai dengan kriteria Anda.</p>
                <ul class="list-unstyled contact-info mb-3">
                  <li class="media">
                    <a href="<?php echo $linkCall;?>" class="d-flex align-items-center">
                      <div class="icon">
                        <i class="mdi mdi-phone-in-talk"></i>
                      </div>
                      <div class="media-body">
                        <h6 class="mt-0 mb-0"><?php echo $noCall['description'];?></h6>
                      </div>
                    </a>
                  </li>
                  <li class="media">
                    <a href="<?php echo $linkWaText;?>" class="d-flex align-items-center">
                      <div class="icon">
                        <i class="mdi mdi-whatsapp"></i>
                      </div>
                      <div class="media-body">
                        <h6 class="mt-0 mb-0">Chat via WhatsApp</h6>
                      </div>
                    </a>
                  </li>
                  <li class="media">
                    <a href="<?php echo $linkEmail;?>" class="d-flex align-items-center">
                      <div class="icon">
                        <i class="mdi mdi-email-outline"></i>
                      </div>
                      <div class="media-body">
                        <h6 class="mt-0 mb-0"><?php echo $email['description'];?></h6>
                      </div>
                    </a>
                  </li>
                </ul>
                <?php
                $address = $database->select($fields="*", $table="address", $where_clause="WHERE status = '1'", $fetch="");
                  
                    echo '
                    <p class="mb-1">'.$address["title"].' : '.$address["description"].'</p>
                    <p><strong><a href="'.$address["link"].'" target="_blank"><i class="mdi mdi-google-maps"></i> Lihat Google Maps</a></strong></p>
                    ';
                  
                ?>
                <h6>Ikuti Kami di Sosial Media</h6>
                <ul class="list-inline social-media mb-0">
                  <?php 
                  $sosmed = $database->select($fields="*", $table="sosmed", $where_clause="WHERE status = '1' ORDER BY id_sosmed ASC", $fetch="all");
                      foreach ($sosmed as $key => $value) {
                        $class = strtolower( str_replace(' ', '-', $value["title"]));
                        echo '
                        <li class="list-inline-item"><a href="'.$value["link"].'" class="rounded-circle" title="'.$value["title"].'" target="_blank"><i class="mdi mdi-'.$class.'"></i></a></li>
                        ';
                      }
                  ?>
                </ul>
              </div>
              
            </div>
          </div>
      </div>
      <div class="col-lg-6 col-md-6 page-result mt-3 mt-md-0">
        <div class="card p-2 p-md-3">
          <form id="form-search-souvenir" class="form-page" novalidate>
          <div class="form-group">
            <label>Nama Lengkap *</label>
            <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Nama Lengkap" required>
            <div class="invalid-feedback">
              Nama tidak boleh kosong
            </div>
          </div>
          <div class="form-group">
            <label>Email *</label>
            <input type="email" class="form-control" id="email_address" name="email_address" placeholder="Email" required>
            <div class="invalid-feedback">
              Email tidak boleh kosong (example@example.example)
            </div>
          </div>
          <div class="form-group">
            <label>Phone *</label>
            <input type="text" class="form-control valid-number" id="phone" name="phone" placeholder="No.Telp" maxlength="12" required>
            <div class="invalid-feedback">
              No. telp tidak boleh kosong (hanya angka)
            </div>
          </div>
          <div class="form-group">
            <label>Pilih Properti *</label>
            <select class="form-control" name="category" id="category" required>
              
            </select>
            <div class="invalid-feedback">
              Kategori tidak boleh kosong
            </div>
          </div>
           <div class="form-group">
            <label>Pilih Area *</label>
            <select class="form-control" name="area" id="area" required>

            </select>
            <div class="invalid-feedback">
              Area tidak boleh kosong
            </div>
          </div>
          <div class="form-group">
            <label>Ingin beli rumah di daerah mana? Tuliskan sejumlah alternatif</label>
            <textarea class="form-control" name="description" id="description" placeholder="" required></textarea>
            <div class="invalid-feedback">
              Deskripsi tidak boleh kosong
            </div>
          </div>
          <div class="form-group">
            <label>Fasilitas apa saja yang Anda inginkan?</label>
            <textarea class="form-control" name="facilities" id="facilities" placeholder="" required></textarea>
            <div class="invalid-feedback">
              Deskripsi tidak boleh kosong
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="captchaLabel"></span>
              </div>
              <input type="text" class="form-control valid-number" name="captcha" id="captcha" required="">
              <div class="invalid-feedback captcha">
                captcha boleh kosong
              </div>
            </div>
           
          </div>
          <div class="form-group">  
            <div class="form-check">  
              <input class="form-check-input" type="checkbox" value="" id="checked" required>  
              <label class="form-check-label" for="checked">  
                  Saya menyatakan data yang saya buat adalah benar
              </label>  
            </div>  
          </div>  
          <div id="info_msg">
            
          </div>
          <input type="hidden" id="action" value="insert">
          <button type="submit" id="send-prop-search" class="btn-more-souvenir btn btn-block">Kirim Pesan</button>
          </form>
        </div>
      </div>
      <div class="col-lg-12 col-md-12 mt-5">
        <h5 class="title-underline">Properti Dijual di Jogja</h5>
         <div id="owl-souvenir" class="owl-slider-nav-top owl-carousel owl-theme">
          <?php
          $sub_information   = $database->select($fields="*", $table="sub_information", $where_clause="WHERE status = '1' order by RAND() limit 8", $fetch='all');
          foreach ($sub_information as $key => $value) {
            $cat = $database->select($fields="*", $table="information", $where_clause="WHERE id_information = $value[id_information]", $fetch='');
            $arrSer = explode(' ', $value["sertification"]);
            $sertif = $arrSer[0];
            if ($value["premium"] == '1') {
              $label = '<div class="badge images-badge">Premium</div>';
            }else{
              $label = '';
            }
            echo '
              <div class="item grid-group-item">
                <a href="souvenir-'.$cat["seo"].'-'.$value["seo"].'-'.$value["id_subinformation"].'">
                  '.$label.'
                  <div class="thumbnail card">
                    <div class="img-event">
                      <img src="joimg/information/thumbnail/'.$value["image"].'" alt="'.$value["title"].'" class="img-fluid">
                    </div>
                    <div class="caption card-body">
                      <h5 class="title-text title-nowrap">'.$value["title"].'</h5>
                      <h6 class="subtitle-nowrap mb-1 mb-md-2">'.$value["address"].'</h6>
                      <div class="d-flex mb-1 mb-md-2">
                        <ul class="text-nowrap flex-grow-1 list-border-right list-unstyled list-inline mb-0">
                          <li class="list-inline-item">LT: '.$value["land_area"].' m<sup>2</sup></li>
                          <li class="list-inline-item">LB: '.$value["building_area"].' m<sup>2</sup></li>
                        </ul>
                        <ul class="text-nowrap list-border list-unstyled list-inline mb-0">
                          <li class="list-inline-item">'.$cat["title"].'</li>
                          <li class="list-inline-item">'.$sertif.'</li>
                        </ul>
                      </div>
                      <div class="d-flex align-items-center">
                        <h6 class="mb-0 title-nowrap flex-grow-1">'.Rupiah::tanpa_nol($value["price"]).' </h6>
                        <p class="mb-0"><small><i class="mdi mdi-clock"></i> '.$tanggal->TimeElapsedString($value["dateTime"]).'</small></p>
                      </div>
                    </div>
                  </div>
                </a>
              </div>

            ';
          }
          ?>
         </div>
       
      </div>
    </div>
  </div>
</main>
<script type="text/javascript">

  $(function(){
    
    
     $.post('send_messages_search', {action:'load-data'}, function(data){
      $("#category").html(data.category);
      $("#area").html(data.area);
      $('#captchaLabel').html(data.randomNumber1+' + '+data.randomNumber2);
    }, 'json');
  })
 
  $('#form-search-souvenir').submit(function (event) {
      event.preventDefault();
      if ($('#form-search-souvenir')[0].checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
      } else {
        var name = $("#fullname").val();
        var email = $("#email_address").val();
        var phone = $("#phone").val();
        var category = $("#category").val();
        var area = $("#area").val();
        var description = $("#description").val();
        var facilities = $("#facilities").val();
        var action = $("#action").val();
        var captcha = $("#captcha").val();
        var c = $("#captchaLabel").text().split('+');
        var c1 = parseInt(c[0]) + parseInt(c[1]);
        
        if (captcha == c1 ) {
          $.ajax({
            type: "POST",
            url: 'send_messages_search',
            data: {
              action:action,
              fullname:name,
              email_address:email,
              phone:phone,
              category:category,
              area:area,
              description:description,
              facilities:facilities
            },
            dataType : 'json',
            beforeSend: function(){
              $('#send-prop-search').text('Sending ...');
            },
            success: function(data){
              $('#captchaLabel').html(data.randomNumber1+' + '+data.randomNumber2);
              $('#form-search-souvenir')[0].reset();
              $('.invalid-feedback.captcha').css('display','block').html('captcha tidak boleh kosong');
              // $('.invalid-feedback').css('display','none');
              $('#send-prop-search').text('Kirim Pesan');
              $('#info_msg').html(data.msg);
              
            }
          });
        }else{
          $('.invalid-feedback.captcha').css('display','block').html('captcha salah');
        }
      }
      $('#form-search-souvenir').addClass('was-validated');
  });
</script>
