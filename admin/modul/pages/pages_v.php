
<?php
  $modul = $database->select($fields="*", $table="modul", $where_clause="WHERE id_modul = $_GET[id]", $fetch="");
  if ($_GET[id] == '6' || $_GET[id] == '5' || $_GET[id] == '7') {?>
    

<script type="text/javascript" src="../jolib/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
    tinymce.init({
        selector: "textarea",
        height:250,
        theme: "modern",
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality jbimages",
            "emoticons template paste textcolor colorpicker textpattern imagetools"
        ],

       toolbar1: "undo redo | styleselect | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | media jbimages | link forecolor backcolor emoticons | pagebreak print preview | sizeselect | fontselect | fontsizeselect",
        image_advtab: true,
        relative_urls: false
    });
  </script>
  <?php } ?>
  <section class="content">
    <ol class="breadcrumb mb-0 name_services">
      <li><a href="media.php?module=home"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Pages</a></li>
      <li><?php echo $modul['nama_modul'];?></li>
    </ol>
    <div class="row">
      <div class="col-sm-12" id="msgInfo">
        
      </div>
      <div class="col-sm-12">
        <form method="post" id="form_input" enctype="multipart/form-data">
          <div class="box">
            <div class="box-body">
              <?php if ($_GET[id] == '4') {?>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="title"> Fullname *</label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="Enter title" value="<?php echo $modul['link'];?>">
                  </div>
                </div>
              <?php }else{
                echo '<input type="hidden" value="#" id="title" name="title">';
              } ?>
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="description"> Description </label>
                  <textarea name="description" id="description" class="form-control" placeholder="Enter Description" rows="10"><?php echo $modul['static_content'];?></textarea> 
                </div>
              </div>
              <?php if ( $_GET[id] == '4' || $_GET[id] == '7') {?>
               <div class="col-sm-12">
                <div class="row">
                  <div class="col-sm-6">
                    <label>Image</label>
                    <div class="mb-1">
                       <img src="../joimg/modul/<?php echo $modul['image'];?>" class="img-thumbnail" width="200px">
                    </div>
                    <label>Change Image</label>
                    <input type="file" name="fupload" id="fupload" />
                  </div>
                </div>
              </div>
              <?php } ?>
            </div>
            <div class="box-footer">
              <input type="hidden" name="id" id="id" value="<?php echo $_GET[id];?>" />
              <input type="hidden" name="act" id="act" value="Edit" />
              <button type="reset" class="btn btn-default cancel">Cancel</button>
              <button type="submit" class="btn btn-info pull-right" id="btn-edit">Edit</button>
            </div>
          </div>
        </form>
       </div>
    </div>
  </section>

<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="modul/pages/pages.js?v=1.0.0"></script>