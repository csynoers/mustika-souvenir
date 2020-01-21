<main role="main" class="flex-shrink-0">
  <div class="container">
  
    <ol class="breadcrumb bg-transparent p-0 mt-3">
      <li class="breadcrumb-item"><a href="<?php echo $config['web_index']?>">Beranda</a></li>
      <li class="breadcrumb-item active">Galeri</li>
    </ol>
  
    <div class="row justify-content-center">
      <div class="col-md-12 page-result">
        <div id="hidden_value"></div>
        <div class="row row-8 view-group" id="data_gallery"></div>
        <div id="btn_loader" class="text-center"> </div>
      </div>
    </div>
  </div>
</main>
<script type="text/javascript">
  var limit_gallery = 20;
  $(function(){
    load_more_data(1, limit_gallery);
  });
  function lazzy_loader_gallery(limit_gallery){
    var output_gallery = '';
    for(var count=0; count<limit_gallery; count++)
    {
      output_gallery += '<div class="item col-gallery col-6 col-xs-4 col-md-3 col-lg-3 placeholder grid-group-item gallery-item"><div class="thumbnail card">';
      output_gallery += '<div class="img-event wave-image"><img class="group list-group-image img-fluid" src="" alt="" /></div>';
      output_gallery += '</div></div>';
    }
    $('#data_gallery').append(output_gallery);

  }
  $(document).on('click', '.btn-load-gallery', function() {
    var total_pages = parseInt($("#total_pages").val());
    var page = parseInt($("#page").val())+1;
    if(page <= total_pages) {
      lazzy_loader_gallery(limit_gallery);
      setTimeout(function(){
        load_more_data(page, limit_gallery)
      }, 1000);
    } 
  });

  function load_more_data(page, limit_gallery) {   
    $("#total_pages, #page").remove();  
    $.ajax({
      url: 'load_gallery',
      type: "POST",
      data: {
        page:page,
        limit_gallery:limit_gallery
      },
      dataType: "json",
      beforeSend: function(){
        lazzy_loader_gallery(limit_gallery);
      },
      complete: function(){
        zoomImage();
        zoomVideo();
        lazzy_loader_gallery(0);
        $(".placeholder").remove();
        var total_pages = parseInt($("#total_pages").val());
          if(page == total_pages || total_pages == 0) {
            $("#btn_loader").html('');

          }else{
            $("#btn_loader").html('<button class="btn-load-gallery btn  mt-4">Muat Lainnya <i class="mdi mdi-chevron-double-down"></i></button>').show();
          }
      },
      success: function(data){
        $("#hidden_value").html(data.hidden_value);
        $("#data_gallery").append(data.results);
      }

    });
  }
</script>

