$(document).ready(function(){
  var dataTable = $('#gallery_data').DataTable({
    "processing":true,
    "serverSide":true,
    "order":[],
    "ajax":{
      url:"modul/gallery/load_data.php",
      type:"POST"
    },
    "columnDefs":[
      {
        "targets":[0, 3, 4],
        "orderable":false,
      },
    ],

  });

  $('#add_button').click(function(){
    $('#form_input')[0].reset();
    $.post('modul/gallery/gallery_c.php',{act:'btn-add'}, function(data){
      $('.modal-title').text("Add New gallery");
      $('#category_gallery').html('<div class="form-group"><div class="fg-line"><label id="category_label">Category gallery <span class="color-red">*</span></label><div class="select"><select class="form-control" name="category" id="category"  required="require"><option disabled="disable" value="" selected="select">- Pilih -</option>' + data.category +'</select></div></div></div>');
      $('#action').val("Add");
      $('#operation').val("Add");
      $('#image_gallery').html('');
      }, 'json');

  });
  $(document).on('submit', '#form_input', function(event){
      event.preventDefault();
      var title = $('#title').val();
      var status = $("input[name='status']:checked").val();
      var data = new FormData(this);
     
     /* if(title != ''){*/
        $.ajax({
          url:"modul/gallery/gallery_c.php",
          method:'POST',
          data:data,
          contentType:false,
          processData:false,
          beforeSend:function(){
            $('#action').val("sending...");
          },
          success:function(data)
          {
            // alert(data)
            $('#action').val("Add");
            $('#form_input')[0].reset();
            $('#galleryModal').modal('hide');
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

  $(document).on('click', '.update', function(){
    var id = $(this).attr("id");
    var act = 'btn-edit';
    $.ajax({
      url:"modul/gallery/gallery_c.php",
      method:"POST",
      data:{id:id, act:act},
      dataType:"json",
      success:function(data)
      {
        $('#galleryModal').modal('show');
        $('#title').val(data.title);
        $('#category_gallery').html('<div class="form-group"><div class="fg-line"><label id="category_label">Category gallery <span class="color-red">*</span></label><div class="select"><select class="form-control" name="category" id="category"  required="require"><option disabled="disable" value="" selected="select">- Pilih -</option>' + data.category +'</select></div></div></div>');
        $('#image_gallery').html(data.image_gallery);
        if (data.status == 0) {
          $('#statusFalse').prop("checked", true);
        }
        $('.modal-title').text("Edit gallery");
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
        url:"modul/gallery/gallery_c.php",
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

  $(document).on('change', '#category', function(){
    var id = $(this).val();
    var loader = '<div style="text-align:center;"><img src="dist/img/ajax-loader.gif"></div>';
    $('#image_gallery').html(loader);
    var html = '';
    if (id == 'video') {
      html += '<div class="col-md-8">';
      html += '<div class="form-group">';
      html += '<label for="title">link *</label>';
      html += '<textarea name="link" id="link" class="form-control" placeholder="Enter link" required></textarea>';
      html += '</div>';
      html += '</div>';
     
    }else{
      html +='<div class="col-sm-12">';
      html +='<label>Select Image (jpg, png, jpeg max 2mb) maksimal upload 12 image</label>';
      html +='<input type="file" name="fupload[]" id="fupload" multiple required/>';
      html +='<div id="msg_images" class="mt-20"></div>';
      html +='<div class="row mt-20" id="image_preview"></div>';
      html +='</div>';
    }
    $('#image_gallery').html(html);

  });
  
  $(document).on('change', '#fupload', function(){
   
    var error_images = '';
    $('#image_preview').html("");
    var files = $('#fupload')[0].files;
    var fupload = document.getElementById("fupload");
    
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


});

