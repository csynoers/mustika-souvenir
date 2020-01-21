
  $('.valid-string-uppercase').keypress(function(event) {
    var charCode = (event.which) ? event.which : event.keyCode
    if ((charCode >= 65 && charCode <= 90))
    return true;
    return false;
  });

  $('#add_button').click(function(){
    $('#form_input')[0].reset();
    $('.modal-title').text("Add New city");
    $('#action').val("Add");
    $('#operation').val("Add");
  });
  
  var dataTable = $('#city_data').DataTable({
    "processing":true,
    "serverSide":true,
    "order":[],
    "ajax":{
      url:"modul/city/load_data.php",
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
    var title = $('#city_name').val();
    var status = $("input[name='status']:checked").val();

    if(title != '' && status != '' ){
      $.ajax({
        url:"modul/city/city_c.php",
        method:'POST',
        data:new FormData(this),
        contentType:false,
        processData:false,
        beforeSend: function() {
          $('#action').val("Loading .....");
        },
        success:function(data)
        {
          $('#form_input')[0].reset();
          $('#cityModal').modal('hide');
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
      url:"modul/city/city_c.php",
      method:"POST",
      data:{id:id, act:act},
      dataType:"json",
      success:function(data)
      {
        $('#cityModal').modal('show');
        $('#city_name').val(data.city_name);
        
        if (data.status == 0) {
          $('#statusFalse').prop("checked", true);
        }
        $('.modal-title').text("Edit city");
        $('#id').val(id);
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
        url:"modul/city/city_c.php",
        method:"POST",
        data:{id:id, act:act},
        success:function(data)
        {
          alert(data);
          dataTable.ajax.reload();
        }
      });
    }
    else{
      return false; 
    }
  });
