<main role="main" class="flex-shrink-0">
  <div class="banner_home mb-md-5 mb-3">
    <div class="img_bnr slider owl-carousel owl-theme zoom-image" id="slidehome" >
      <?php 
      $slide   = $database->select($fields="*", $table="slide", $where_clause="WHERE status = '1'", $fetch='all');
      foreach ($slide as $key => $vslide) {
        echo ' <div class="item"><img src="joimg/slide/'.$vslide["image"].'" class="img-fluid"></div>';
      }
      ?>
    </div>
  </div>
	<div class="container">
    <h5 class="gochi">Rekomendasi Terbaru</h5>
    <div class="row row-8 view-group" id="data_souvenir_home"></div>
    <div class="mt-4 text-center">
      <a href="souvenir" class="btn-more-souvenir btn gochi">Lihat Lainnya <i class="mdi mdi-chevron-double-right"></i></a>
    </div>
  </div>
</main>
<script type="text/javascript">
  var winWidht = $(window).width();
  var limit_home = 20;
  $(function(){
    load_more_data(limit_home);
  });
  function lazzy_loader_home(limit_home){
    var output_home = '';
    if ( winWidht < 768) {
      var gI = 'list-group-item';
    }else{
      var gI = 'grid-group-item';
    }
    for(var count=0; count<limit_home; count++)
    {
      output_home += '<div class="item placeholder col-xs-3 col-md-3 col-lg-3 '+gI+'"><div class="thumbnail card">';
      output_home += '<div class="img-event wave-image"><img class="group list-group-image img-fluid" src="" alt="" /></div>';
      output_home += '<div class="caption card-body"><div class="wave-title"></div><div class="wave-location"></div><div class="wave-inline d-flex"><span class="wave-info left"></span><span class="wave-sertifikat right"></span></div><div class="wave-inline d-flex"><div class="wave-price"></div><div class="wave-date"></div></div></div>';
      output_home += '</div></div>';
    }
    $('#data_souvenir_home').append(output_home);

  }
 
  function load_more_data(limit_home) {   
    $.ajax({
      url: 'load_souvenir_home',
      type: "POST",
      data: {
        limit_home:limit_home
      },
      dataType: "json",
      beforeSend: function(){
        lazzy_loader_home(limit_home);
      },
      complete: function(){
        lazzy_loader_home(0);
        $(".placeholder").remove();
      },
      success: function(data){
        $(".placeholder").remove();
        $("#data_souvenir_home").append(data.results);
        if ( winWidht < 768) {
          $('#data_souvenir_home').find('.item').removeClass('grid-group-item').addClass('list-group-item');
        }else{
          $('#data_souvenir_home').find('.item').removeClass('list-group-item').addClass('grid-group-item');
        }
      }

    });
  }
</script>