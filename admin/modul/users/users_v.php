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
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Add New</h3>
            <button type="button" id="add_button" data-toggle="modal" data-target="#usersModal" class="btn btn-primary btn-sm btn-flat pull-right"><i class="fa fa-plus"></i> Add New users</button>
          </div>
          <div class="box-body table-responsive">
            <table id="users_data" class="table table-bordered table-striped" style="width: 100%">
              <thead>
                <tr>
                  <th width="2%">No</th>
                  <th width="10%">Image</th>
                  <th width="15%">Fullname</th>
                  <th width="15%">Username / Email</th>
                  <th width="10%">Password</th>
                  <th width="10%">Level</th>
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
  <div id="usersModal" class="modal fade">
  <div class="modal-dialog">
    <form method="post" id="form_input" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add New users</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-12">
              <div class="row">
                <div class="col-sm-3">
                  <div class="form-group">
                    <span id="uploaded_image"></span>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label>Select Image</label>
                    <input type="file" name="fupload" id="fupload" />
                  </div>
                </div>
               
                <div class="col-sm-5">
                  <div class="form-group">
                    <label for="title">Fullname *</label>
                    <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Enter fullname">
                  </div>
                </div>
              </div>
            </div>
           
           
            <div class="col-sm-6">
              <div class="form-group">
                <label for="title">Username * (<i>huruf dan angka</i>)</label>
                <input type="text" class="form-control" name="username" id="username" placeholder="Enter username" onkeyup="validAngkaHuruf(this)">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="title">Password *</label>
                <input type="text" class="form-control" name="password" id="password" placeholder="Enter password">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="title">Email </label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="title">Phone </label>
                <input type="tel" class="form-control" name="phone" id="phone" placeholder="Enter phone">
              </div>
            </div>
            <div class="col-sm-6" id="level-users">
                 <!-- data category --> 
            </div>
            <div class="col-sm-6">
              <label>Status</label>
              <div class="form-group">
                <input type="radio" value="Y" id="statusTrue" name="status"> <span>Blokir</span>
                <input type="radio" value="N" id="statusFalse" name="status" checked=""> <span>Active</span>
              </div>
            </div>
           
          </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="id" id="id" />
          <input type="hidden" name="operation" id="operation" />
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
<script src="modul/users/users.js"></script>