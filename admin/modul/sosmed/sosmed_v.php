<link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <section class="content">
    <ol class="breadcrumb mb-0">
      <li><a href="media.php?module=home"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Contact Us</li>
       <li class="active">Social Media</li>
    </ol>
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <button type="button" id="add_button" data-toggle="modal" data-target="#sosmedModal" class="btn btn-primary btn-sm btn-flat pull-right"><i class="fa fa-plus"></i> Add New sosmed</button>
          </div>

          <div class="box-body table-responsive">
            <table id="sosmed_data" class="table table-bordered table-striped" style="width: 100%">
              <thead>
                <tr>
                  <th width="2%">No</th>
                  <th width="25%">Title</th>
                  <th width="30%">link</th>
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
  <div id="sosmedModal" class="modal fade">
  <div class="modal-dialog">
    <form method="post" id="form_input" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add New sosmed</h4>
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
                <label for="title">link *</label>
                <input type="text" name="link" id="link" class="form-control" placeholder="Enter link">
              </div>
            </div>
          
            <div class="col-sm-12">
              <label>Status</label>
              <div class="form-group">
                <input type="radio" value="1" id="statusTrue" name="status" checked=""> <span>Publish</span>
                <input type="radio" value="0" id="statusFalse" name="status"> <span>Hidden</span>
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
<script src="modul/sosmed/sosmed.js?v=1"></script>