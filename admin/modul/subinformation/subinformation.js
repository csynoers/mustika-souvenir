$(document).ready(function(){
  $('.valid-number').keypress(function(event) {
    if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
      event.preventDefault();
    }
  });

   $(".valid-number-decimal").on("input", function(evt) {
      var self = $(this);
      self.val(self.val().replace(/[^0-9\.]/g, ''));
      if ((evt.which != 46 || self.val().indexOf('.') != -1) && (evt.which < 48 || evt.which > 57)) 
       {
         evt.preventDefault();
       }
    });
  var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
  };

  var id_information = getUrlParameter('id');
  var name_information = getUrlParameter('name');
  breadcrumb = '<li><a href="media.php?module=home"><i class="fa fa-dashboard"></i> Dashboard</a></li>';
  breadcrumb += '<li class="active">Menu</li>';
  breadcrumb += '<li><a href="media.php?module=information">Category</a></li>';
  breadcrumb += '<li class="active">'+name_information+'</li>';
  $(".name_information").html(breadcrumb);
  
  $('#add_button').click(function(){
     $.post('modul/subinformation/subinformation_c.php', {act:'btn-add'}, 
      function(data){
      $('#form_input')[0].reset();
      $('.modal-title').text("Add New");
      $('#action').val("Add");
      $('#operation').val("Add");
      $('.title_legend').text('Category ('+name_information+')');
      $('#id_information').val(id_information);
      $('#uploaded_image').html('');
    }, 'json');
  });
  
  var dataTable = $('#subinformation_data').DataTable({
    "processing":true,
    "serverSide":true,
    "order":[],
    "ajax":{
      url:"modul/subinformation/load_data.php",
      type:"POST",
      data: {
        id: id_information
      }
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
    var price = $('#price').val();
    
    var kode = $('#kode').val();
    var status = $("input[name='status']:checked").val();
    var extension = $('#fupload').val().split('.').pop().toLowerCase();
    if(extension != ''){
      if(jQuery.inArray(extension, ['png','jpg','jpeg']) == -1){
        alert("Invalid Image File");
        $('#fupload').val('');
        return false;
      }
    } 
    if(title != '' && price != '' && kode != ''){
      $.ajax({
        url:"modul/subinformation/subinformation_c.php",
        method:'POST',
        data:new FormData(this),
        contentType:false,
        processData:false,
        beforeSend:function(){
          $('#action').val("loading ...");
        },
        success:function(data)
        {
          $('#form_input')[0].reset();
          $('#action').val("Add");
          $('#subinformationModal').modal('hide');
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
    $('#form_input')[0].reset();
    $.ajax({
      url:"modul/subinformation/subinformation_c.php",
      method:"POST",
      data:{id:id, act:act},
      dataType:"json",
      success:function(data)
      {
      
        $('#subinformationModal').modal('show');
        $('#title').val(data.title);
        $('#price').val(data.price);
        $('#kode').val(data.kode);
        var ed = tinyMCE.get('description');
          ed.setProgressState(1); // Show progress
          window.setTimeout(function() {
              ed.setProgressState(0); // Hide progress
              ed.setContent(data.description);
          }, 1000);
        $('.modal-title').text("Edit ");
        $('#id').val(id);
        $('.title_legend').text('Category ('+name_information+')');
        $('#id_information').val(id_information);
        $('#uploaded_image').html(data.fupload);
        $('#action').val("Edit");
        $('#operation').val("Edit");

        if (data.status == 0) {
          $('#statusFalse').prop("checked", true);
        }else{
          $('#statusTrue').prop("checked", true);
        }

      }
    })
  });

  $(document).on('click', '.delete', function(){
    var id = $(this).attr("id");
    var act = 'btn-delete';
    if(confirm("Are you sure you want to delete this? Data akan hilang permanen !!")){
      $.ajax({
        url:"modul/subinformation/subinformation_c.php",
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

  $(document).on('click', '.add-image-info', function(){
    var id = $(this).attr("data-id");
    var act = 'load-data-info-image';
    $('#data_image_info').html('');
    $('#image_preview').html('');
    $('#image_preview').html('');
    $('#fupload_info').val('');
    $.ajax({
      url:"modul/subinformation/subinformation_c.php",
      method:"POST",
      data:{id:id, act:act},
      dataType:"json",
      beforeSend:function(){
        $('#action').val("sending...");
      },
      success:function(data)
      {
        $('#imageInfoModal').modal('show');
        $('.modal-title.image-info').text('Image ' +data.title);
        $('#data_image_info').html(data.image);
        $('#title_imageinfo').val(data.title);
        $('#id_subinformation').val(id);
        $('#action').val("Save");
      }
    })
  });

  $(document).on('change', '#fupload_info', function(){
   
    var error_images = '';
    $('#image_preview').html("");
    var files = $('#fupload_info')[0].files;
    var fupload = document.getElementById("fupload_info");
    
    if(files.length > 12)
    {
       error_images += 'max upload 12 image';
    }
    else
    {
      for(var i=0;i<files.length;i++)
       {
        var name = fupload.files[i].name;
        var ext = name.split('.').pop().toLowerCase();
        var oFReader = new FileReader();
        oFReader.readAsDataURL(fupload.files[i]);
        var f = fupload.files[i];
        var fsize = f.size;
        if(jQuery.inArray(ext, ['png','jpg','jpeg']) == -1 || fsize > 2000000) 
        {
          error_images += '<ul><li>Invalid '+name+' </li></ul>';
        }
       
        else
        {
          $('#image_preview').append("<div class='col-md-2'><img class='img-thumbnail img-gallery' src='"+URL.createObjectURL(event.target.files[i])+"'></div>");
        }
       }
     }

    $('#msg_images').html(error_images);

  });

  $(document).on('submit', '#form_input_image', function(event){
    event.preventDefault();
     var data = new FormData(this);
      $.ajax({
        url:"modul/subinformation/subinformation_c.php",
        method:'POST',
        data:data,
        contentType:false,
        processData:false,
        beforeSend:function(){
          $('#action_img').val("sending...");
        },
        success:function(data)
        {
          $('#action_img').val("Save");
          $('#form_input_image')[0].reset();
          $('#image_preview').html('<div class="col-md-12"><p>Image berhasil disimpan, Silahkan upload lagi jika ada tambahan !!</p></div>');
          $('#data_image_info').html(data);
        }
      });
  });

  $(document).on('click', '.remove-image-gallery', function(){
    var id = $(this).attr("data-id");
    var act = 'btn-delete-image';
    if(confirm("Are you sure you want to delete this?")){
      $.ajax({
        url:"modul/subinformation/subinformation_c.php",
        method:"POST",
        data:{id:id, act:act},
        success:function(data)
        {
          $('#data_image_info').html(data);
        }
      });
    }
    else{
      return false; 
    }
  });

  $('#fupload').change(function () {
      var files = this.files;
      var name = files[0].name;
      var fsize = files[0].size;
      var ext = name.split('.').pop().toLowerCase();
   
      if(jQuery.inArray(ext, ['png','jpg','jpeg']) == -1 || fsize > 2000000) 
      {
        $(this).val('');
        $('#msg_img').html('<p>Format Image JPG, PNG or JPEG max size 2mb</p>');
      }
  });

  $(document).on('change', '.change-status', function(){
    var id_check = $(this).attr('data-id');
    var value_check = $(this).val();
    var act = 'change-status';
    $.ajax({
      type: "POST",
      url: "modul/subinformation/subinformation_c.php",
      data: {id: id_check, value: value_check, act:act},
      beforeSend: function(){  
         $('<span class="loading-radio"><span>').insertBefore('.change-status[data-id='+id_check+']');
        
      },
      success: function(data){
        $('.change-status[data-id='+id_check+']').removeClass('loading-radio');
        alert(data);
        dataTable.ajax.reload();
      }
    });
  });

  $(document).on('change', '.change-premium', function(){
    var id_check = $(this).attr('data-id');
    var value_check = $(this).attr('value');
    var act = 'change-premium';
    $.ajax({
      type: "POST",
      url: "modul/subinformation/subinformation_c.php",
      data: {id: id_check, value: value_check, act:act},
      beforeSend: function(){  
        $('<span class="loading-radio"><span>').insertBefore('.change-premium[data-id='+id_check+']');
        
      },
      success: function(data){
        $('.change-premium[data-id='+id_check+']').removeClass('loading-radio');
        alert(data);
        dataTable.ajax.reload();
      }
    });
  });

});