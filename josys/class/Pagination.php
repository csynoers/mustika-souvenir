
<?php
class Paging{
	function cariPosisi($batas){
		$halaman = $_GET['page'];
		if(empty($halaman)){
			$position = 0;
			$halaman = 1;
		}else{
			$position = ($halaman - 1) * $batas;
		}
		return $position;
	}
	
	function jmlHalaman($jmlData,$batas){
		$jmlHal = ceil($jmlData/$batas);
		return $jmlHal;
	}
	
	Function navHalaman($halamanAktif,$jumlahHalaman){
		$link_halaman ='<ul>';
		$link_halaman .= "";
		
		// Link First dan Previous
		$prev = $halamanAktif-1;
		if($halamanAktif < 2){
			$link_halaman .= "<li><button type='button' class='disabled'><i class='fa fa-angle-left'> </i></button></li>";
		}else{
			$link_halaman .= "<li><button type='button' onClick='changeUrl(\"page\",\"".$prev."\")' ><i class='fa fa-angle-left'></i> </button></li>  ";
		}
		
		// link halaman 1,2,3,...
		// Angka awal
		$angka = ($halamanAktif > 3 ? "<li><button type='button' onClick='changeUrl(\"page\",\"1\")'>1</button></li> <li><span class='page-number dots'>...</span></li>  " : " ");
		for($i=$halamanAktif-2;$i<$halamanAktif;$i++){
			if ($i < 1 )continue;
			$angka .= "<li><button type='button' onClick='changeUrl(\"page\",\"".$i."\")'>$i</button></li>  ";
		}
		
		// Angka tengah
		if (empty($_GET['page'])) {
			$angka .= "";
		}else{
			$angka .= "<li><button type='button' class='page-number current'>".$halamanAktif."</button><li>";
		}
		
		for($i=$halamanAktif+1;$i<($halamanAktif+3);$i++){
			if($i > $jumlahHalaman) break;
			$angka .= "<li><button type='button' onClick='changeUrl(\"page\",\"".$i."\")'>$i</button></li> ";
		}
		
		// ANgka Akhir
		$angka .= ($halamanAktif+2<$jumlahHalaman ? " <li><span class='page-number dots'>...</span></li>  <li><button type='button' onClick='changeUrl(\"page\",\"".$jumlahHalaman."\")'> $jumlahHalaman</button></li> " : "");
		
		$link_halaman .= $angka;
		
		// Link Next dan Last
		if($halamanAktif < $jumlahHalaman){
			$next = $halamanAktif+1;
			$link_halaman .= "<li><button type='button' onClick='changeUrl(\"page\",\"".$next."\")'><i class='fa fa-angle-right'></i></button></li> ";
		}else{
			$link_halaman .="<li><button type='button' class='disabled'><i class='fa fa-angle-right'></i></button></li>";
		}
		return $link_halaman;

		$link_halaman .= '</ul>';
	}
}
?>
