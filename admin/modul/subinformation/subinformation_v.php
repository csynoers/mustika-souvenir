<link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<script type="text/javascript" src="../jolib/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
    tinymce.init({
        selector: "textarea#description",
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
    <ol class="breadcrumb mb-0 name_information">
      
    </ol>
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <a class="btn btn-default btn-sm btn-flat" href="media.php?module=information"><i class="fa fa-arrow-left"></i> Back</a>
            <button type="button" id="add_button" data-toggle="modal" data-target="#subinformationModal" class="btn btn-primary btn-sm btn-flat pull-right"><i class="fa fa-plus"></i> Add New </button>
          </div>

          <div class="box-body table-responsive">
            <table id="subinformation_data" class="table table-bordered table-striped" style="width: 100%">
              <thead>
                <tr>
                  <th width="2%">No</th>
                  <th width="10%">Image (Cover)</th>
                  <th width="10%">Kode & image</th>
                  <th width="15%">Title</th>
                  <th width="10%">Harga</th>
                  <th width="10%">Date</th>
                  <th width="10%">Premium</th>
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
  <div id="subinformationModal" class="modal fade">
  <div class="modal-dialog">
    <form method="post" id="form_input" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add New</h4>
        </div>
        <div class="modal-body">
          <fieldset class="scheduler-border">
            <legend class="title_legend">Category </legend>
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="title">Judul *</label>
                  <input type="text" class="form-control" name="title" id="title" placeholder="Enter title">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="price">Harga *</label>
                  <input type="text" class="form-control valid-number" name="price" id="price" placeholder="Enter price">
                </div>
              </div>

              <div class="col-sm-6">
                <div class="form-group">
                  <label for="price">Kode</label>
                  <input type="text" class="form-control" name="kode" id="kode" placeholder="Enter kode">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="description">Description </label>
                  <textarea name="description" id="description" placeholder="Enter description"></textarea>
                </div>
              </div>
              <div class="col-sm-6">
                <label>Iklan Premium ?</label>
                <div class="form-group">
                  <input type="radio" value="1" id="premiumTrue" name="premium"> <span>Yes</span>
                  <input type="radio" value="0" id="premiumFalse" name="premium" checked=""> <span>No</span>
                </div>
              </div>
              <div class="col-sm-6">
                <label>Publish Iklan ?</label>
                <div class="form-group">
                  <input type="radio" value="1" id="statusTrue" name="status" checked=""> <span>Yes</span>
                  <input type="radio" value="0" id="statusFalse" name="status"> <span>No</span>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Select Image (Cover)</label>
                      <input type="file" name="fupload" id="fupload" />
                    </div>
                    <div class="form-group" id="msg_img"></div>
                  </div>
                  <div class="col-sm-6">
                    <span id="uploaded_image"></span>
                  </div>
                </div>
              </div>
            </div>
          </fieldset>

        </div>
        <div class="modal-footer">
          <input type="hidden" name="id" id="id" />
           <input type="hidden" name="id_information" id="id_information" />
          <input type="hidden" name="operation" id="operation" />
          <span class="pull-left" style="font-style: italic; color: red">Image size 700 x 450 px (PNG* or JPG*)</span>
          <input type="submit" name="action" id="action" class="btn btn-success" value="Add" />
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </form>
  </div>
</div>
<div id="imageInfoModal" class="modal fade">
  <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h5 class="modal-title image-info"></h5>
        </div>
        <div class="modal-body">
            <form method="post" id="form_input_image" enctype="multipart/form-data">
              <div class="row">
                <div class="col-sm-3">
                  <label>Select Image (jpg, png, jpeg max 2mb) album image</label>
                  <input type="file" name="fupload_info[]" multiple="" id="fupload_info" required/>
                </div>
                <div class="col-sm-9">
                  <div id="msg_images"></div>
                  <div class="row row-8" id="image_preview"></div>
                </div>
              </div>
              <div class="col-sm-12 mt-1 text-right">
                <input type="hidden" name="id_subinformation" id="id_subinformation" />
                <input type="hidden" name="title_imageinfo" id="title_imageinfo" />
                <input type="hidden" name="act" value="insert-imageinfo" />
                <input type="submit" name="action_img" id="action_img" class="btn btn-success" value="Save" />
              </div>
            </form>
            <hr>
            <h4>Data Image Info</h4>
            <div class="row" id="data_image_info"></div>
        </div>
        
    </div>
  </div>
</div>

<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="modul/subinformation/subinformation.js?v="></script>