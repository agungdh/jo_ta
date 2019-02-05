<?php 
namespace agungdh;

class Pustaka {
	public static function decimalRand($iMin, $iMax, $fSteps = 0.5)
	{
	    $a = range($iMin, $iMax, $fSteps);

	    return $a[mt_rand(0, count($a)-1)];
	}
	
	public static function dropTableView($host, $user, $pass, $db)
	{
		$mysqli = new \mysqli($host, $user, $pass, $db);
		
		$mysqli->query('SET foreign_key_checks = 0');

		if ($tables = $mysqli->query("SHOW FULL TABLES IN " . $db . " WHERE TABLE_TYPE LIKE 'BASE TABLE'"))
		{
		    while($row = $tables->fetch_array(MYSQLI_NUM))
		    {
		        $mysqli->query('DROP TABLE IF EXISTS '.$row[0]);
		    }
		}

		if ($views = $mysqli->query("SHOW FULL TABLES IN " . $db . " WHERE TABLE_TYPE LIKE 'VIEW'"))
		{
		    while($row = $views->fetch_array(MYSQLI_NUM))
		    {
		        $mysqli->query('DROP VIEW IF EXISTS '.$row[0]);
		    }
		}

		$mysqli->query('SET foreign_key_checks = 1');
		
		$mysqli->close();
	}
	
	public static function arrangeForSelectCollective($raw, $params)
    {
        $selectValue = $params[0];
        
        unset($params[0]);
        $params = array_values($params);

        $datas = [];
        
        foreach ($raw as $value) {
            $display = '';
            foreach ($params as $forDisplay) {
                if (strpos($forDisplay, '__') !== false) {
                    $toDisplay = str_replace('__', '', $forDisplay);
                    $display .= $value->$toDisplay;
                } else {
                    $display .= $forDisplay;
                }
            }
            $datas[$value->$selectValue] = $display;
        }

        return $datas;
    }

	public static function parseTanggalIndo($tanggal)
	{
		return date_format(date_create($tanggal),"Y-m-d");
	}

	public static function rupiah($angka, $rp = true, $koma = true) {
		if ($koma == true) {
			$dua = 2;
		} else {
			$dua = 0;
		}

		$hasil_rupiah = number_format($angka,$dua,',','.');

		if ($rp == true) {
			$hasil_rupiah = 'Rp' . $hasil_rupiah;
		}

		return $hasil_rupiah;
	}

	public static function tanggalIndo($tanggal) {
		return date("d-m-Y", strtotime($tanggal));
	}	

	public static function tanggalWaktuIndo($tanggalWaktu) {
		return date("d-m-Y H:i:s", strtotime($tanggalWaktu));
	}	

	public static function tanggalIndoString($tanggal){
		$bulan = array (
			1 =>   'Januari',
			'Februari',
			'Maret',
			'April',
			'Mei',
			'Juni',
			'Juli',
			'Agustus',
			'September',
			'Oktober',
			'November',
			'Desember'
		);
		$pecahkan = explode('-', $tanggal);
	 
		return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
	}
	
	public static function tanggalIndoStringBulanTahun($bulanTahun){
		$bulan = array (
			1 =>   'Januari',
			'Februari',
			'Maret',
			'April',
			'Mei',
			'Juni',
			'Juli',
			'Agustus',
			'September',
			'Oktober',
			'November',
			'Desember'
		);
		$pecahkan = explode('-', $bulanTahun);
	 
		return $bulan[ (int)$pecahkan[0] ] . ' ' . $pecahkan[1];
	}

	public static function tanggalWaktuIndoString($tanggalWaktu){
		$bulan = array (
			1 =>   'Januari',
			'Februari',
			'Maret',
			'April',
			'Mei',
			'Juni',
			'Juli',
			'Agustus',
			'September',
			'Oktober',
			'November',
			'Desember'
		);
		$tanggal = explode(' ', $tanggalWaktu)[0];
		$waktu = explode(' ', $tanggalWaktu)[1];
		$pecahkan = explode('-', $tanggal);
	 
		return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0] . ' ' . $waktu;
	}
}