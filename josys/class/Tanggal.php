<?php
class Tanggal {
    function indo($value) {
        $tanggal    = substr($value,8,2);
		$bulan      = $this->BulanIndo(substr($value,5,2));
		$tahun      = substr($value,0,4);
		return $tanggal.' '.$bulan.' '.$tahun;
    }

    function BulanIndo($bln) {
        switch ($bln) {
            case 1:
                return "Jan";
                break;
            case 2:
                return "Feb";
                break;
            case 3:
                return "Mar";
                break;
            case 4:
                return "Apr";
                break;
            case 5:
                return "Mei";
                break;
            case 6:
                return "Jun";
                break;
            case 7:
                return "Jul";
                break;
            case 8:
                return "Agu";
                break;
            case 9:
                return "Sep";
                break;
            case 10:
                return "Okt";
                break;
            case 11:
                return "Nov";
                break;
            case 12:
                return "Des";
                break;
        }
    }

    function english($value) {
        $tanggal    = $this->TanggalEnglish(substr($value,8,2));
		$bulan      = $this->BulanEnglish(substr($value,5,2));
		$tahun      = substr($value,0,4);
		return $bulan.' '.$tanggal.', '.$tahun;
    }

    function BulanEnglish($bln) {
		switch ($bln) {
			case 1:
			    return "Jan";
			    break;
			case 2:
				return "Feb";
				break;
			case 3:
				return "Mar";
				break;
			case 4:
				return "Apr";
				break;
			case 5:
				return "May";
				break;
			case 6:
				return "Jun";
				break;
			case 7:
				return "Jul";
				break;
			case 8:
				return "Aug";
				break;
			case 9:
				return "Sep";
				break;
			case 10:
				return "Oct";
				break;
			case 11:
				return "Nov";
				break;
			case 12:
				return "Dec";
				break;
		}
	}

    function TanggalEnglish($tgl) {
		switch ($tgl) {
			case 1:
				return "1st";
				break;
			case 2:
				return "2nd";
				break;
			case 3:
				return "3rd";
				break;
			case 4:
				return "4th";
				break;
		    case 5:
				return "5th";
				break;
			case 6:
				return "6th";
				break;
			case 7:
				return "7th";
				break;
			case 8:
				return "8th";
				break;
			case 9:
				return "9th";
				break;
			case 10:
				return "10th";
				break;
			case 11:
				return "11th";
				break;
			case 12:
				return "12th";
				break;
			case 13:
				return "13th";
				break;
			case 14:
				return "14th";
				break;
			case 15:
				return "15th";
				break;
			case 16:
				return "16th";
				break;
			case 17:
				return "17th";
				break;
			case 18:
				return "18th";
				break;
			case 19:
				return "19th";
				break;
			case 20:
				return "20th";
                case 21:
				break;
				return "21st";
				break;
			case 22:
				return "22nd";
				break;
			case 23:
				return "23rd";
				break;
			case 24:
				return "24th";
				break;
			case 25:
				return "25th";
				break;
			case 26:
				return "26th";
				break;
			case 27:
				return "27th";
				break;
			case 28:
				return "28th";
				break;
			case 29:
				return "29th";
				break;
			case 30:
				return "30th";
				break;
			case 31:
				return "31st";
				break;
		}
	}

	function TimeElapsedString($datetime, $full = false) {
		date_default_timezone_set('Asia/Jakarta');
	    $now = new DateTime;
	    $ago = new DateTime($datetime);
	    $diff = $now->diff($ago);

	    $diff->w = floor($diff->d / 7);
	    $diff->d -= $diff->w * 7;

	    $string = array(
	        'y' => 'tahun',
	        'm' => 'bulan',
	        'w' => 'minggu',
	        'd' => 'hari',
	        'h' => 'jam',
	        'i' => 'menit',
	        's' => 'detik',
	    );
	    foreach ($string as $k => &$v) {
	        if ($diff->$k) {
	            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
	        } else {
	            unset($string[$k]);
	        }
	    }

	    if (!$full) $string = array_slice($string, 0, 1);
	    return $string ? implode(', ', $string) . '' : 'baru saja';
	}
}


