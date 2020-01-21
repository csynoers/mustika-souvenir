<link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
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
  <section class="content">
    <ol class="breadcrumb mb-0 name_services">
      <li><a href="media.php?module=home"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Articles</a></li>
    </ol>
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <button type="button" id="add_button" data-toggle="modal" data-target="#articlesModal" class="btn btn-primary btn-sm btn-flat pull-right"><i class="fa fa-plus"></i> Add New articles</button>
          </div>

          <div class="box-body table-responsive">
            <table id="articles_data" class="table table-bordered table-striped" style="width: 100%">
              <thead>
                <tr>
                  <th width="2%">No</th>
                  <th width="10%">Image</th>
                  <th width="25%">Title</th>
                  <th width="30%">Description</th>
                  <th width="10%">Date</th>
                  <th width="10%">Status</th>
                  <th width="13%">Action</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
  <div id="articlesModal" class="modal fade">
  <div class="modal-dialog modal-lg">
    <form method="post" id="form_input" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add New articles</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label for="title">Title *</label>
                <input type="text" class="form-control" name="title" id="title" placeholder="Enter title">
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                <label for="title">Description *</label>
                <textarea name="description" id="description" placeholder="Enter description"></textarea>
              </div>
            </div>
          
            <div class="col-sm-12">
              <label>Status</label>
              <div class="form-group">
                <input type="radio" value="1" id="statusTrue" name="status" checked=""> <span>Publish</span>
                <input type="radio" value="0" id="statusFalse" name="status"> <span>Hidden</span>
              </div>
            </div>
            <div class="col-sm-12">
              <div class="row">
                <div class="col-sm-6">
                  <label>Select Image</label>
                  <input type="file" name="fupload" id="fupload" />
                </div>
                <div class="col-sm-6">
                  <span id="uploaded_image"></span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="id" id="id" />
          <input type="hidden" name="operation" id="operation" />
          <span class="pull-left" style="font-style: italic; color: red">Image size 660x370 px (PNG* or JPG*)</span>
          <input type="submit" name="action" id="action" class="btn btn-success" value="Add" />
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="modul/articles/articles.js"></script>