<main role="main" class="flex-shrink-0">
  <div class="container content-news">
  
    <ol class="breadcrumb bg-transparent p-0 mt-3">
      <li class="breadcrumb-item"><a href="<?php echo $config['web_index']?>">Beranda</a></li>
      <li class="breadcrumb-item active">Berita</li>
    </ol>
  
    <div class="row justify-content-center">
      <div class="col-md-12 col-lg-8 page-result">
        <div id="hidden_value"></div>
       <div class="row row-8 view-group" id="data_news"></div>
       <div id="btn_loader" class="text-center"> </div>
      </div>
      <div class="col-lg-4 d-none d-lg-block">
         <?php include 'joinc/contents/sidebar_info.php'; ?>
      </div>
    </div>
  </div>
</main>
<script type="text/javascript">
  var limit_news = 10;
  $(function(){
    load_more_data(1, limit_news);
  });
  function lazzy_loader_news(limit_news){
    var output_news = '';
    for(var count=0; count<limit_news; count++)
    {
      output_news += '<div class="item placeholder list-group-item news-item"><div class="thumbnail card">';
      output_news += '<div class="img-event wave-image"><img class="group list-group-image img-fluid" src="" alt="" /></div>';
      output_news += '<div class="caption card-body"><div class="wave-title"></div><div class="wave-date"></div><div class="d-none d-md-block wave-description"></div></div>';
      output_news += '</div></div>';
    }
    $('#data_news').append(output_news);

  }
  $(document).on('click', '.btn-load-news', function() {
    var total_pages = parseInt($("#total_pages").val());
    var page = parseInt($("#page").val())+1;
    
    if(page <= total_pages) {
      lazzy_loader_news(limit_news);
      setTimeout(function(){
        load_more_data(page, limit_news)
      }, 1000);
    } 
  });

  function load_more_data(page, limit_news) {   
    $("#total_pages, #page").remove();  
    $.ajax({
      url: 'load_news',
      type: "POST",
      data: {
        page:page,
        limit_news:limit_news
      },
      dataType: "json",
      beforeSend: function(){
        lazzy_loader_news(limit_news);
      },
      complete: function(){
        lazzy_loader_news(0);
        $(".placeholder").remove();
        var total_pages = parseInt($("#total_pages").val());
          if(page == total_pages || total_pages == 0) {
            $("#btn_loader").html('');

          }else{
            $("#btn_loader").html('<button class="btn-load-news btn  mt-4">Muat Lainnya <i class="mdi mdi-chevron-double-down"></i></button>').show();
          }
      },
      success: function(data){
        $("#hidden_value").html(data.hidden_value);
        $("#data_news").append(data.results);
      }

    });
  }
</script>

