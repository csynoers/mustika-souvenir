$(document).ready(function(){
  $('#add_button').click(function(){
    $('#form_input')[0].reset();
    $('.modal-title').text("Add New slide");
    $('#action').val("Add");
    $('#operation').val("Add");
    $('#uploaded_image').html('');
  });
  
  var dataTable = $('#slide_data').DataTable({
    "processing":true,
    "serverSide":true,
    "order":[],
    "ajax":{
      url:"modul/slide/load_data.php",
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
    var link = $('#link').val();
    var status = $("input[name='status']:checked").val();
    var extension = $('#fupload').val().split('.').pop().toLowerCase();
    //alert(extension)
    if(extension != ''){
      if(jQuery.inArray(extension, ['png','jpg','jpeg']) == -1){
        alert("Invalid Image File");
        $('#fupload').val('');
        return false;
      }
    }

  /*  if(title != '' && link != ''){*/
      $.ajax({
        url:"modul/slide/slide_c.php",
        method:'POST',
        data:new FormData(this),
        contentType:false,
        processData:false,
        success:function(data)
        {
          $('#form_input')[0].reset();
          $('#slideModal').modal('hide');
          alert('Sukses ! Data Berhasil Disimpan');
          dataTable.ajax.reload();
        }
      });
   /* }
    else
    {
      alert("Both Fields are Required");
    }*/
  });

  /*$('#fupload').bind('change', function() {
    var s = this.files[0].size;
    if (s > 300000) {
      alert('file terlalu besar');
      $('#form_input')[0].reset();
      return false;
    }
  });*/

  $(document).on('click', '.update', function(){
    var id = $(this).attr("id");
    var act = 'btn-edit';
    $.ajax({
      url:"modul/slide/slide_c.php",
      method:"POST",
      data:{id:id, act:act},
      dataType:"json",
      success:function(data)
      {
        $('#slideModal').modal('show');
        $('#title').val(data.title);
        $('#link').val(data.link);
        if (data.status == 0) {
          $('#statusFalse').prop("checked", true);
        }
        $('.modal-title').text("Edit slide");
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
        url:"modul/slide/slide_c.php",
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