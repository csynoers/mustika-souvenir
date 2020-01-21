<link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <section class="content">
    <ol class="breadcrumb mb-0 name_services">
      <li><a href="media.php?module=home"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Messages</a></li>
      <li class="active">Pesan Masuk</a></li>
    </ol>
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-body table-responsive">
            <table id="messages_data" class="table table-bordered table-striped" style="width: 100%">
              <thead>
                <tr>
                  <th width="2%">No</th>
                  <th width="15%">Fullname</th>
                  <th width="15%">Email</th>
                  <th width="15%">Phone</th>
                  <th width="15%">Deskripsi</th>
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
  <div id="messagesModal" class="modal fade">
  <div class="modal-dialog">
    <form method="post" id="form_input" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add New messages</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-6">
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="nama">nama *</label>
                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Enter nama" readonly="">
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="nama">Email *</label>
                    <input type="text" class="form-control" name="email" id="email" placeholder="Enter nama" readonly="">
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="nama">Phone *</label>
                    <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter nama" readonly="">
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="nama">Description *</label>
                    <textarea name="description" id="description" class="form-control" placeholder="Enter description" readonly="" rows="5"></textarea>
                  </div>
                </div>
              
                <div class="col-sm-12">
                  <label>Status</label>
                  <div class="form-group">
                    <p id="msgInfo"></p>
                  </div>
                </div>
              </div>
            </div> 
            <div class="col-sm-6">
              <div class="row">
                <div class="col-sm-12">
                  <h4>Reply via Email</h4>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="nama">Subject *</label>
                    <input type="text" class="form-control" name="subject" id="subject" placeholder="Enter Subject">
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="nama">Description *</label>
                    <textarea name="desc_email" id="desc_email" class="form-control" placeholder="Enter Description" rows="10"></textarea>
                  </div>
                </div>
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
<script src="modul/messages/messages.js?v=1.0.0"></script>