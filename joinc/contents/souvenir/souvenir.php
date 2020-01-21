<div class="filter-mobile" id="filter-popup">
	<div class="fm-bg">
		<div class="fm-header">
			<div class="fm-hd d-flex">
				<div class="flex-grow-1 d-flex align-items-center"><a href="javascript:void(0);" id="filter-popup-close" class="icon-close"><i class="mdi mdi-close"></i></a> <span>Filter</span></div>
			</div>
		</div>
		<form id="form-filter-popup">
			<div class="fm-content" id="filter-xs-popup">
				
			</div>
			<div class="fm-footer">
				<div class="fmft">
					<button class="btn btn-block btn-submit" type="submit">Filter</button>
				</div>
			</div>
		</form>
	</div>
</div>
<main role="main" class="flex-shrink-0">
		<div class="container">    
		  <ol class="breadcrumb bg-transparent p-0 mt-1 mt-md-3 mb-2 mb-md-3 ">
		    <li class="breadcrumb-item"><a href="<?php echo $config['web_index']?>">Beranda</a></li>
	    	<li class="breadcrumb-item"><a href="souvenir">Souvenir</a></li>
	    	<li class="breadcrumb-item active" aria-current="page"><?php echo $iklan["title"];?></li>
		  </ol>
			<div id="data-filter-all"></div>
			<div class="row">
				<div class="col-lg-3 col-md-12 d-none d-lg-block card">
					<div class="sidebar-sticky">
						<div class="sticky-content">
							<div class="list-group sidebar-filter">
								<div class="list-group-item">
								  	<p class="list-title mb-0" data-toggle="collapse" data-target="#sidebar_category"><strong>Kategori </strong></p>
								  	<div class="list-item collapse show" id="sidebar_category">							  	
									</div>
								</div>
								<div class="list-group-item">
								  	<p class="list-title mb-0" data-toggle="collapse" data-target="#sidebar_price"><strong>Harga </strong></p>
								  	<div class="list-item collapse show" id="sidebar_price">
										<form id="form-sidebar-price" class="d-flex align-items-center mt-2">
									   	</form>
								   </div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-9 col-md-12 page-result">
					<div class="filter-box d-lg-flex flex-justify">
						<p class="mb-3 mb-lg-0 mt-0 count-data"></p>							
			            <div class="ml-auto d-flex flex-justify">
			            	<div class="flex-grow-1 d-lg-none"><a href="javascript:void(0);" id="filter-popup-open" class="btn-collapse-filter"><i class="mdi mdi-sort"></i> Filter <span class="float-right"></span></a></div>
				            <div class="d-flex flex-justify view-mode">
				               <label class="d-none d-md-inline-block mb-0 mr-1">Tampilan:</label>
				               <a id="list" class="list-inline-item view-icons" data-toggle="tooltip" data-placement="top" title="" href="javascript:void(0);" data-target="list" data-original-title="List"><i class="icons icons-list"></i></a>
				               <a id="grid" href="javascript:void(0);" class="list-inline-item view-icons active" data-toggle="tooltip" data-placement="top" title="" data-target="grid" data-original-title="Grid"><i class="icons icons-grid"></i></a>
				            </div>
				            <div class="sorting d-flex flex-justify">
				              <label class="d-none d-md-inline-block mb-0 mr-1">Urutkan:</label>
								<select class="filter-sort-by" name="sorting" >
								</select>
				            </div>
				          </div>
			        </div>
				    <hr>
		  		 	<div id="souvenir">
		  		 		<div id="hidden_value"></div>
		  		 		<div class="row row-8 view-group" id="data_souvenir"></div>
		  		 		<div id="btn_loader" class="text-center"> </div>
		          	</div>
				</div>
			</div>
		</div>
	</main>
	<script type="text/javascript">
		var limit = 12;
		$(function(){
			load_more_data(1, limit);
		});

		$('#list').click(function(event){
    	event.preventDefault();
    	$(this).addClass('active');
    	$('#grid').removeClass('active');
    	$('#souvenir .item').addClass('list-group-item');
    	$('#souvenir .item').removeClass('grid-group-item');
    	$('#souvenir .item .title-text').removeClass('title-nowrap');
  	});

    $('#grid').click(function(event){
    	event.preventDefault();
    	$(this).addClass('active');
    	$('#list').removeClass('active');
    	$('#souvenir .item').removeClass('list-group-item');
    	$('#souvenir .item').addClass('grid-group-item');
    	$('#souvenir .item .title-text').addClass('title-nowrap');
    });

		function viewStatus(){
			let a = {};
			if ($( "#grid" ).hasClass( "active" )) {
	    	a.active_view = 'grid-group-item';
	    	a.title_nowrap = 'title-nowrap';
			}else{
				a.active_view = 'list-group-item';
	    	a.title_nowrap = '';
			}
			return a;
		}
		
		function lazzy_loader(limit){
      var output = '';
     
      for(var count=0; count<limit; count++)
      {
        output += '<div class="item placeholder col-xs-4 col-md-4 col-lg-4 '+viewStatus().active_view+'"><div class="thumbnail card">';
				output += '<div class="img-event wave-image"><img class="group list-group-image img-fluid" src="" alt="" /></div>';
				output += '<div class="caption card-body"><div class="wave-title"></div><div class="wave-location"></div><div class="wave-inline d-flex"><span class="wave-info left"></span><span class="wave-sertifikat right"></span></div><div class="wave-inline d-flex"><div class="wave-price"></div><div class="wave-date"></div></div></div>';
				output += '</div></div>';
      }
      $('#data_souvenir').append(output);

    }
		$(document).on('click', '.btn-load-souvenir', function() {
				var total_pages = parseInt($("#total_pages").val());
				var page = parseInt($("#page").val())+1;
				
				if(page <= total_pages) {
					lazzy_loader(limit);
			 		setTimeout(function(){
						load_more_data(page, limit)
					}, 1000);
				} 
		});
	
		function load_more_data(page, limit) {
			$('.sidebar-sticky').removeClass('open');		
	 		$("#total_pages, #page").remove();	 	
			$.ajax({
				url: 'load_souvenir',
				type: "POST",
				data: {
					page:page, 
					limit:limit, 
					active_view: viewStatus().active_view, 
					title_nowrap:viewStatus().title_nowrap
				},
				dataType: "json",
				beforeSend: function(){
					lazzy_loader(limit);
					// var load_side = '';
					// load_side += '<div class="list-group sidebar-filter placeholder">';
				  	// 	load_side += '<div class="list-group-item category"></div>';
				  	// 	load_side += '<div class="list-group-item sertificate"></div>';
				  	// 	load_side += '<div class="list-group-item price"></div>';
				  	// 	load_side += '<div class="list-group-item lt"></div>';
				  	// 	load_side += '</div>';
					// $(".sidebar-filter").html(load_side);
					$('.count-data').html('<div class="count-data placeholder"></div>');
				},
				complete: function(){
					$(".placeholder").remove();
					lazzy_loader(0);
					validNumber();
					var total_pages = parseInt($("#total_pages").val());
					if(page == total_pages || total_pages == 0) {
						$("#btn_loader").html('');
					}else{
						$("#btn_loader").html('<button class="btn-load-souvenir btn  mt-4">Muat Lainnya <i class="mdi mdi-chevron-double-down"></i></button>').show();
					}
				},
				success: function(data){
					$("#sidebar_category").html(data.sidebar_category);
					$("#form-sidebar-price").html(data.sidebar_price);
					$("#filter-xs-popup").html(data.popup_filter);
					$(".filter-sort-by").html(data.sorting);
					$("#data-filter-all").html(data.remove_filter_all);
					$('.count-data').html('<h5><span>'+data.count_rows+'</span> produk ditemukan</h5>');
					$("#hidden_value").html(data.hidden_value);
					$("#data_souvenir").append(data.results);
					if(data.count_rows == 0){
						$(".filter-sort-by").attr('disabled','disabled');
					}else{
						$(".filter-sort-by").removeAttr('disabled','disabled');
					}
				},
				error: function(){
					$("#btn_loader").html('<p>... No data found! ...</p>');
				}
	
			});
		}
		function getParameterByName(name) {
		    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
		    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
		    results = regex.exec(location.search);
		    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
		}

		function changeUrl(key,value) {
	    var searchUrl=location.search;
	    if(searchUrl.indexOf("?")== "-1") {
	        var urlValue='?'+key+'='+value;
	        history.pushState({state:1, rand: Math.random()}, '', urlValue);
	    }
	    else {
	        //Check for key in query string, if not present
	        if(searchUrl.indexOf(key)== "-1") {
	            var urlValue=searchUrl+'&'+key+'='+value;
	        }
	        else {  //If key present in query string
	            oldValue = getParameterByName(key);
	            if(searchUrl.indexOf("?"+key+"=")!= "-1") {
	                urlValue = searchUrl.replace('?'+key+'='+oldValue,'?'+key+'='+value);
	            }
	            else {
	                urlValue = searchUrl.replace('&'+key+'='+oldValue,'&'+key+'='+value);   
	            }
	        }
	        history.pushState({state:1, rand: Math.random()}, '', urlValue);
	    }
	    $("#data_souvenir").html('');
	   	load_more_data(1, limit);
		}

		function removeQString(key) {
		    var urlValue=document.location.href;
		    
		    //Get query string value
		    var searchUrl=location.search;
		    if(key!="") {
		        oldValue = getParameterByName(key);
		        removeVal=key+"="+oldValue;
		        if(searchUrl.indexOf('?'+removeVal+'&')!= "-1") {
		            urlValue=urlValue.replace('?'+removeVal+'&','?');
		        }
		        else if(searchUrl.indexOf('&'+removeVal+'&')!= "-1") {
		            urlValue=urlValue.replace('&'+removeVal+'&','&');
		        }
		        else if(searchUrl.indexOf('?'+removeVal)!= "-1") {
		            urlValue=urlValue.replace('?'+removeVal,'');
		        }
		        else if(searchUrl.indexOf('&'+removeVal)!= "-1") {
		            urlValue=urlValue.replace('&'+removeVal,'');
		        }
		        
		    }
		    else {
		        var searchUrl=location.search;
		        urlValue=urlValue.replace(searchUrl,'');
		    }
		    history.pushState({state:1, rand: Math.random()}, '', urlValue);
		    $("#data_souvenir").html('');
		    load_more_data(1, limit);
		}

		(function(filter,key){
			    filter('.filter-sort-by').on('change',function(){
			        key('sorting',filter(this).val());
			    });
			     filter('.filter-location').on('change',function(){     
			        key('location',filter(this).val());
			    });
		})(jQuery,changeUrl);
		
		$('#filter-popup-open').click(function(){
      $('#filter-popup').show();
		});

		$('#form-filter-popup').submit(function (event) {
      event.preventDefault();
	    var category = $('#filter-xs-popup input[name=category_popup]:checked').val();
	    var pMin = $('#filter-xs-popup input[name="price-min"]').val();
	    var pMax = $('#filter-xs-popup input[name="price-max"]').val();
	    var price = pMin+'_'+pMax;
      $.post('load_souvenir',{ category:category, price:price},function(data){
      	window.location.assign('souvenir?category='+category+'&price='+price);
      });
    });

		$('#filter-popup-close').click(function(){
			$('#filter-popup').hide();
		});

    $('#form-sidebar-price').submit(function (event) {
      event.preventDefault();
      
	    var pMin = $('#sidebar_price input[name="price-min"]').val();
	    var pMax = $('#sidebar_price input[name="price-max"]').val();
	    var price = pMin+'_'+pMax;
	 
      $.post('load_souvenir',{price:price},function(data){
      	window.location.assign('souvenir?price='+price);
      });
    });

    $('#form-sidebar-lt').submit(function (event) {
      event.preventDefault();
	    var ltMin = $('#sidebar_lt input[name="lt-min"]').val();
	    var ltMax = $('#sidebar_lt input[name="lt-max"]').val();
	    var luas_tanah = ltMin+'_'+ltMax;
      $.post('load_souvenir',{lt:luas_tanah},function(data){
      	window.location.assign('souvenir?lt='+luas_tanah);
      });
    });
	</script>
	