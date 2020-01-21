
  $('#add_button').click(function(){
    $.post('modul/information/information_c.php', {act:'btn-add'}, 
      function(data){
      $('#form_input')[0].reset();
      $('.modal-title').text("Add New information");
      $('#action').val("Add");
      $('#operation').val("Add");
      $('#data_category').html('<option selected disabled="">-- pilih kategori --</option>'+data.category.join(''));
    }, 'json');
  });
  
  var dataTable = $('#information_data').DataTable({
    "processing":true,
    "serverSide":true,
    "order":[],
    "ajax":{
      url:"modul/information/load_data.php",
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
    var status = $("input[name='status']:checked").val();

    if(title != '' && status != '' ){
      $.ajax({
        url:"modul/information/information_c.php",
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
          $('#informationModal').modal('hide');
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
      url:"modul/information/information_c.php",
      method:"POST",
      data:{id:id, act:act},
      dataType:"json",
      success:function(data)
      {
        $('#informationModal').modal('show');
        $('#title').val(data.title);
        if (data.status == 0) {
          $('#statusFalse').prop("checked", true);
        }
        $('.modal-title').text("Edit information");
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
        url:"modul/information/information_c.php",
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
