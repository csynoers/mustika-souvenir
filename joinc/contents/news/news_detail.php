<?php
$articles = $database->select($fields="*", $table="articles", $where_clause="WHERE status = '1' AND id_articles = '$_GET[id]'", $fetch="");
$hits = $articles['view']+1;
$form_data = array(
    "view"      => "$hits",
    "dateTime"  => "$articles[dateTime]"
);
$database->update($table="articles", $array=$form_data, $fields_key="id_articles", $id="$_GET[id]");

$linkUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?> 
<main role="main" class="flex-shrink-0">
  <div class="container content-news">
  
    <ol class="breadcrumb bg-transparent p-0 mt-3">
      <li class="breadcrumb-item"><a href="<?php echo $config['web_index']?>">Beranda</a></li>
      <li class="breadcrumb-item"><a href="berita-souvenir">Berita</a></li>
      <li class="breadcrumb-item active text-nowrap" aria-current="page"><?php echo $articles["title"];?></li>
    </ol>
  
    <div class="row">
      <div class="col-md-12 col-lg-8 page-result">
        <h5><?php echo $articles["title"];?></h5>
        <p class="meta-date"><span><i class="mdi mdi-calendar-text"></i> <?php echo $tanggal->indo($articles["dateTime"]);?></span> - <span><?php echo $articles["view"];?> view</span></p>
        <div class="social-share mb-3">
          <div class="d-inline-block">
          <div class="text-share">
              <span class="icon-share"><i class="mdi mdi-share-variant"></i></span>
              <span class="icon-share-text d-none d-md-inline-block">Share</span>
          </div>
          <div class="d-inline-block icon-social">
            <a href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fmustikasouvenir.com&t=<?php echo $articles[seo]?>" title="Share on Facebook" target="_blank" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(document.URL) + '&t=' + encodeURIComponent(document.URL)); return false;" class="icon-share facebook mr-2"><i class="mdi mdi-facebook"></i></a>
            <a href="https://twitter.com/intent/tweet?source=http%3A%2F%2Fmustikasouvenir.com&text=<?php echo $articles[seo]?>:%20http%3A%2F%2Fmustikasouvenir.com" target="_blank" title="Tweet" onclick="window.open('https://twitter.com/intent/tweet?text=' + encodeURIComponent(document.title) + ':%20'  + encodeURIComponent(document.URL)); return false;" class="icon-share twitter mr-2"><i class="mdi mdi-twitter"></i></a>
            <a href="https://plus.google.com/share?url=http%3A%2F%2Fmustikasouvenir.com" target="_blank" title="Share on Google+" onclick="window.open('https://plus.google.com/share?url=' + encodeURIComponent(document.URL)); return false;" class="icon-share google-plus mr-2"><i class="mdi mdi-google-plus"></i></a>
            <a href="whatsapp://send?text=<?php echo $linkUrl; ?>" class="icon-share whatsapp" title="whatsapp"><i class="mdi mdi-whatsapp"></i></a>
          </div>
          </div>
        </div>
        <div>
          <img src="joimg/articles/<?php echo $articles["image"];?>" class="img-fluid">
        </div>
        <div class="mt-3 description-tiny">
          <?php echo $articles["description"];?>
        </div>
      

      </div>
      <div class="col-lg-4 d-none d-lg-block">
          <?php include 'joinc/contents/sidebar_info.php'; ?>
      </div>
    </div>
  </div>
</main>


