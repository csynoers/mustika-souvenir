<link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Add New</h3>
            <button type="button" id="add_button" data-toggle="modal" data-target="#galleryModal" class="btn btn-primary btn-sm btn-flat pull-right"><i class="fa fa-plus"></i> Add New gallery</button>
          </div>

          <div class="box-body table-responsive">
            <table id="gallery_data" class="table table-bordered table-striped" style="width: 100%">
              <thead>
                <tr>
                  <th width="2%">No</th>
                  <th width="5%">Thumb</th>
                  <th width="5%">Category</th>
                  <th width="25%">Title</th>
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
  <div id="galleryModal" class="modal fade">
  <div class="modal-dialog">
    <form method="post" id="form_input" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add New gallery</h4>
        </div>
        <div class="modal-body">
          <div class="row">
           
            <div class="col-sm-8">
              <div class="form-group">
                <label for="title">Title </label>
                <input type="text" class="form-control" name="title" id="title" placeholder="Enter title">
              </div>
            </div>
            <div class="col-sm-4">
              <label>Status</label>
              <div class="form-group">
                <input type="radio" value="1" id="statusTrue" name="status" checked=""> <span>Publish</span>
                <input type="radio" value="0" id="statusFalse" name="status"> <span>Hidden</span>
              </div>
            </div>
            <div class="col-sm-6" id="category_gallery">
               
            </div>
           <!--  <div class="col-sm-12">
               <input type="file" id="uploadFile" name="uploadFile[]" multiple/>
               <span id="error_multiple_files" class="mt-20"></span>
               <div class="row mt-20" id="image_preview"></div>
            </div> -->
            <!-- <input type="file" name="fupload" id="fupload" multiple /> -->
            </div>
            <div class="row" id="image_gallery">
              
            </div>
           
        </div>
        <div class="modal-footer">
          <input type="hidden" name="id" id="id" />
          <input type="hidden" name="operation" id="operation" />
          <input type="submit" name="action" id="action" class="btn btn-success" value="Add" />
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="modul/gallery/gallery.js?v=1.0"></script>