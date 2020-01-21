<div class="footer-mobile d-block d-md-none">
	<div class="d-flex justify-content-between text-center">
		<a href="<?php echo $linkCall;?>" class="p-2 flex-fill bd-highlight"><i class="mdi mdi-phone-in-talk"></i> Call</a>
		<a href="<?php echo $linkWaText;?>" class="p-2 flex-fill bd-highlight link-center"><i class="mdi mdi-whatsapp"></i> WhatsApp</a>
		<a href="<?php echo $linkEmail;?>" class="p-2 flex-fill bd-highlight"><i class="mdi mdi-gmail"></i> Email</a>
	</div>
</div>
<footer class="p-4 bg-light mt-5 border-top">
  <div class="footer-top">
    <div class="container">
      <div class="row d-none d-md-flex justify-content-between">
      	<div class=" col-md-4">
          <h3>Mustika Souvenir</h3>
          <?php
           $about = $database->select($fields="*", $table="modul", $where_clause="WHERE id_modul = '5' ", $fetch="");
           $abDesc = strip_tags(substr($about["static_content"],0,250));
           echo '<p>'.$abDesc.'..</p>';
           ?>
          
        </div>
        <div class=" col-md-4">
          <h3>Hubungi Kami</h3>
          <ul class="list-unstyled contact-info footer mb-3">
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
        </div>
        <div class=" col-md-4">
          <h3>Ikuti Kami</h3>
          <ul class="list-inline social-media">
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
      
      <hr class="d-none d-md-block">
      <div class="copyright text-center">
          Copyright &copy; <?php echo date( "Y"); ?> <a href="www.mustikasouvenir.com/">mustikasouvenir.com</a>
          
		  </div>
    </div>
  </div>
</footer>