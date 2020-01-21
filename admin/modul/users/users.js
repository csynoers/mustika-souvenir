$(document).ready(function(){
  $('#add_button').click(function(){
    var act = 'btn-add';
      $.ajax({
        url:"modul/users/users_c.php",
        method:"POST",
        data:{act:act},
        dataType:"json",
        success:function(data)
        {
          $('#level-users').html('<div class="form-group"><div class="fg-line"><label id="level_label">Level Users <span class="color-red">*</span></label><div class="select"><select class="form-control" name="level" id="level" required="require"><option disabled="disable" value="" selected="select">- Pilih -</option>' + data.level +'</select></div></div></div>');
          $("#usersModal").modal('show');
          $('#form_input')[0].reset();
          $('.modal-title').text("Add New Users");
          $('#action').val("Add");
          $('#operation').val("Add");
          $('#uploaded_image').html('');
        }
    })
  });
  
  var dataTable = $('#users_data').DataTable({
    "processing":true,
    "serverSide":true,
    "order":[],
    "ajax":{
      url:"modul/users/load_data.php",
      type:"POST"
    },
    "columnDefs":[
      {
        "targets":[0, 3, 4],
        "orderable":false,
      },
    ],

  });

  $(document).on('submit', '#form_input', function(event){
    event.preventDefault();
    var fullname = $('#fullname').val();
    var username = $('#username').val();
    var password = $('#password').val();
    var level    = $('#level').val();
    var email   = $('#email').val();
    var phone   = $('#phone').val();
    var status  = $("input[name='status']:checked").val();
    var extension = $('#fupload').val().split('.').pop().toLowerCase();
    if(extension != ''){
      if(jQuery.inArray(extension, ['png','jpg','jpeg']) == -1){
        alert("Invalid Image File");
        $('#fupload').val('');
        return false;
      }
    } 
    if(fullname != '' && username != '' && level != '' && password != ''){
      $.ajax({
        url:"modul/users/users_c.php",
        method:'POST',
        data:new FormData(this),
        contentType:false,
        processData:false,
        success:function(data)
        {
          if (data == 'false') {
            alert('Gagal, Username atau email sudah digunakan')
          }else{
            $('#form_input')[0].reset();
            $('#usersModal').modal('hide');
            alert('Sukses ! Data Berhasil Disimpan');
            dataTable.ajax.reload();
          }
         
        }
      });
    }
    else
    {
      alert("Both Fields are Required");
    }
  });

  $(document).on('click', '.update', function(){
    var id = $(this).attr("id");
    var act = 'btn-edit';

    $.ajax({
      url:"modul/users/users_c.php",
      method:"POST",
      data:{id:id, act:act},
      dataType:"json",
      success:function(data)
      {
        $('#usersModal').modal('show');
        $('#fullname').val(data.fullname);
        $('#username').val(data.username);
        $('#password').val(data.password);
        $('#level-users').html('<div class="form-group"><div class="fg-line"><label id="level_label">level users <span class="color-red">*</span></label><div class="select"><select class="form-control" name="level" id="level" required="require"><option disabled="disable" value="" selected="select">- Pilih -</option>' + data.level +'</select></div></div></div>');
        $('#email').val(data.email);
        $('#phone').val(data.phone);
        if (data.status == 'N') {
          $('#statusFalse').prop("checked", true);
        }
        $('.modal-title').text("Edit users");
        $('#id').val(id);
        $('#uploaded_image').html(data.fupload);
        $('#action').val("Edit");
        $('#operation').val("Edit");
      }
    })
  });

  $(document).on('click', '.delete', function(){
    var id = $(this).attr("id");
    var act = 'btn-delete';
    if(confirm("Are you sure you want to delete this?")){
      $.ajax({
        url:"modul/users/users_c.php",
        method:"POST",
        data:{id:id, act:act},
        success:function(data)
        {
          dataTable.ajax.reload();
        }
      });
    }
    else{
      return false; 
    }
  });

});

function validAngkaHuruf(a){
  if(!/^[a-zA-Z0-9]+$/.test(a.value))
  {
  a.value = a.value.substring(0,a.value.length-1000);
  }
}