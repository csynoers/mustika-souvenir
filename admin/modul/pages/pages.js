$(document).ready(function(){
   $('#msgInfo').html('');
    $(document).on('submit', '#form_input', function(event){
    event.preventDefault();
    var description = $('#description').val();
    if(description != ''){
      $('#btn-edit').html('Sending .....');
      $.ajax({
        url:"modul/pages/pages_c.php",
        method:'POST',
        data:new FormData(this),
        contentType:false,
        processData:false,
        success:function(data)
        {
          $('#btn-edit').html('Edit');
          $('#msgInfo').html('<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fa fa-check"></i> Data Berhasil Disimpan ..!!</div>');
          $('#form_input').reload();
        }
      });
    }
    else
    {
      $('#msgInfo').html('<div class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fa fa-warning"></i> Data Tidak Boleh Kosong ..!!</div>');
      $('#form_input').reload();
    }
  });

  $(document).on('click', '.cancel', function(){
    $('#form_input').reload();
  });

});