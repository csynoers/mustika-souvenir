$(document).ready(function(){
  $('#add_button').click(function(){
    $('#form_input')[0].reset();
    $('.modal-title').text("Add New");
    $('#action').val("Add");
    $('#operation').val("Add");
    $('#uploaded_image').html('');
  });
  
  var dataTable = $('#search_data').DataTable({
    "processing":true,
    "serverSide":true,
    "order":[],
    "ajax":{
      url:"modul/search/load_data.php",
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
    var nama = $('#nama').val();
    var email = $('#email').val();
    var phone = $('#phone').val();
    var description = $('#description').val();
    var status = $("input[name='status']:checked").val();
    var desc_email = $('#desc_email').val();
    var subject = $('#subject').val();
    if(subject != '' && desc_email != ''){
      $.ajax({
        url:"modul/search/search_c.php",
        method:'POST',
        data:new FormData(this),
        contentType:false,
        processData:false,
        success:function(data)
        {
          $('#form_input')[0].reset();
          $('#searchModal').modal('hide');
          alert('Sukses ! Pesan Berhasil Dikirim');
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
    var status = $(this).attr("data-status");
    var act = 'btn-edit';
    $.ajax({
      url:"modul/search/search_c.php",
      method:"POST",
      data:{id:id, act:act},
      dataType:"json",
      success:function(data)
      {
        $('#searchModal').modal('show');
        $('#nama').val(data.nama);
        $('#email').val(data.email);
        $('#phone').val(data.phone);
        $('#description').val(data.description);
        $('#facilities').val(data.facilities);
        $('#information').val(data.information);
        $('#city').val(data.city);
        if (status == '1') {
          $('#desc_email').attr('disabled', true);
          $('#subject').attr('disabled', true);
          $('#action').attr('disabled', true);
          $('#msgInfo').html('<b style="color:red;font-style: italic;">Status Pesan Sudah dibalas !!</b>');
        }else{
          $('#desc_email').attr('disabled', false);
          $('#subject').attr('disabled', false);
          $('#action').attr('disabled', false);
          $('#msgInfo').html('<b style="color:red;font-style: italic;">Status Pesan Masih Menunggu !!</b>');
        }
        $('.modal-title').text("Detail search");
        $('#id').val(id);
        $('#action').val("Send search");
        $('#operation').val("Reply");
      }
    })
  });

  $(document).on('click', '.delete', function(){
    var id = $(this).attr("id");
    var act = 'btn-delete';
    if(confirm("Are you sure you want to delete this?")){
      $.ajax({
        url:"modul/search/search_c.php",
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