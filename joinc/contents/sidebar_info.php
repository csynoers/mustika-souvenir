<div class="sidebar-sticky">
  <div class="sticky-content">
    <?php if ($_GET['mod'] == 'news-detail'): ?>
      <div class="right-list sidebar-news">
      <div class="text-title">
        <h3 class="mb-0">Artikel Lainnya</h3>
      </div>
      
      <ul class="list-unstyled">
        <?php
        $articlesMore = $database->select($fields="*", $table="articles", $where_clause="WHERE status = '1' AND id_articles != '$_GET[id]' order by RAND() limit 5", $fetch="all");
          foreach ($articlesMore as $key => $value) {
            echo '
            <li class="media">
              <a href="berita-'.$value["seo"].'-'.$value["id_articles"].'">
              <img class="mr-3" src="joimg/articles/thumbnail/'.$value["image"].'" width="80px" alt="'.$value["title"].'">
              </a>
              <div class="media-body">
                <h5 class="mt-0 mb-1"><a href="berita-'.$value["seo"].'-'.$value["id_articles"].'">'.$value["title"].'</a></h5>
                <small><i class="mdi mdi-calendar-text"></i> '.$tanggal->indo($value["dateTime"]).'</small>
              </div>

            </li>

            ';
          }
        ?>
      </ul>
    </div>
    <?php endif ?>
    
    <div class="right-list sidebar-news">
      <div class="text-title">
        <h3 class="mb-0">Souvenir</h3>
      </div>
      <ul class="list-unstyled">
        <?php
        $sub_information   = $database->select($fields="*", $table="sub_information", $where_clause="WHERE status = '1' order by RAND() LIMIT 8", $fetch='all');
          foreach ($sub_information as $key => $value) {
            $cat = $database->select($fields="*", $table="information", $where_clause="WHERE id_information = $value[id_information]", $fetch='');
            $description = strip_tags(substr($value["description"],0,150));
            echo '
            <li class="media">
              <a href="souvenir-'.$cat["seo"].'-'.$value["seo"].'-'.$value["id_subinformation"].'">
              <div class="media-body">
                <h5 class="mt-0 mb-1">'.$value["title"].'</h5>
                <p class="mb-0">'.$description.' [....]</p>
              </div>
              </a>
            </li>
            ';
          }
        ?>
      </ul>
    </div>
  </div>
</div>