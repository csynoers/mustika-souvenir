$(document).ready(function(){
  $('#add_button').click(function(){
    $('#form_input')[0].reset();
    $('.modal-title').text("Add New address");
    $('#action').val("Add");
    $('#operation').val("Add");
    $('#uploaded_image').html('');
  });
  
  var dataTable = $('#address_data').DataTable({
    "processing":true,
    "serverSide":true,
    "order":[],
    "ajax":{
      url:"modul/address/load_data.php",
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
    var title = $('#title').val();
    var description = $('#description').val();
    var status = $("input[name='status']:checked").val();
    var extension = $('#fupload').val().split('.').pop().toLowerCase();
    if(extension != ''){
      if(jQuery.inArray(extension, ['png','jpg','jpeg']) == -1){
        alert("Invalid Image File");
        $('#fupload').val('');
        return false;
      }
    } 
    if(title != '' && description != ''){
      $.ajax({
        url:"modul/address/address_c.php",
        method:'POST',
        data:new FormData(this),
        contentType:false,
        processData:false,
        success:function(data)
        {
          $('#form_input')[0].reset();
          $('#addressModal').modal('hide');
          alert('Sukses ! Data Berhasil Disimpan');
          dataTable.ajax.reload();
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
      url:"modul/address/address_c.php",
      method:"POST",
      data:{id:id, act:act},
      dataType:"json",
      success:function(data)
      {
        $('#addressModal').modal('show');
        $('#title').val(data.title);
        $('#description').val(data.description);
        $('#link').val(data.link);
        $('#maps').val(data.maps);
       /* var ed = tinyMCE.get('description');
          ed.setProgressState(1); // Show progress
          window.setTimeout(function() {
              ed.setProgressState(0); // Hide progress
              ed.setContent(data.description);
          }, 1000);*/
        if (data.status == 0) {
          $('#statusFalse').prop("checked", true);
        }
        $('.modal-title').text("Edit address");
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
        url:"modul/address/address_c.php",
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