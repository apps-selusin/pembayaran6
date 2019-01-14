<?php

// Global user functions
// Page Loading event
function Page_Loading() {

	//echo "Page Loading";
}

// Page Rendering event
function Page_Rendering() {

	//echo "Page Rendering";
}

// Page Unloaded event
function Page_Unloaded() {

	//echo "Page Unloaded";
}

function f_updatesiswabayar($rs) {

	// array periode
	$abulan = array(
		1 => "Januari", "Februari", "Maret",
		"April", "Mei", "Juni", "Juli", "Agustus", "September",
		"Oktober", "November", "Desember");

	// nol-kan dulu di data pembayaran sesuai tahun ajaran dan siswa
	$q = "update t11_siswabayar set
		b07 = '0', b08 = '0', b09 = '0', b10 = '0', b11 = '0', b12 = '0',
		b01 = '0', b02 = '0', b03 = '0', b04 = '0', b05 = '0', b06 = '0'
		where siswaspp_id in (select id from t08_siswaspp where siswa_id = ".$rs["siswa_id"].")";
	ew_Execute($q);

	// ambil data pembayaran sesuai tahunajaran_id dan siswa_id
	$q = "select * from v02_pembayaran where
		tahunajaran_id = ".$rs["tahunajaran_id"]."
		and siswa_id = ".$rs["siswa_id"]."";
	$r = ew_Execute($q);

	// recordset dilooping hingga eof
	while (!$r->EOF) {
		$Keterangan = $r->fields["Keterangan"];
		if (!is_null($Keterangan)) {
			$Periode = substr($Keterangan, 0, (strlen($Keterangan) - 5));
			$indexarray = array_search($Periode, $abulan);
			$q = "update t11_siswabayar set b" . substr("00" . $indexarray, -2)
				. " = '1' where siswaspp_id = ".$r->fields["siswaspp_id"];
			ew_Execute($q);
		}
		$Keterangan2 = $r->fields["Keterangan2"];
		if (!is_null($Keterangan2)) {
			$Periode2 = substr($Keterangan2, 0, (strlen($Keterangan2) - 5));
			$indexarray2 = array_search($Periode2, $abulan);
			for ($i = $indexarray; $i <= $indexarray2; $i++) {
				$q = "update t11_siswabayar set b" . substr("00" . $i, -2)
					. " = '1' where siswaspp_id = ".$r->fields["siswaspp_id"];
				ew_Execute($q);
			}
		}
		$r->MoveNext();
	}
}

function f_createsiswabayar($rs) {
	$q = "insert into t11_siswabayar (siswaspp_id) values (".$rs["id"].")";
	ew_Execute($q);
}

function f_updatekartuiuran($rs) {
	/*var_dump($rs);
	$q = "select * from v02_pembayaran where bayarmaster_id = ".$rs["id"]."";

	//echo $q; exit;
	$r = ewExecute($q);
	while (!$r->EOF) {
		$q = "insert into t11_kartuiuran (
			tahunajaran_id,
			siswa_id,
			) values ()";
		ewExecute($q);
		$r->MoveNext();
	}*/
}

function GetNextNomorBayar() {
	$sNextKode = "";
	$sLastKode = "";
	$value = ew_ExecuteScalar("SELECT NomorBayar FROM t09_bayarmaster ORDER BY NomorBayar DESC");
	if ($value != "") { // jika sudah ada, langsung ambil dan proses...
		$sLastKode = intval(substr($value, 3, 3)); // ambil 3 digit terakhir
		$sLastKode = intval($sLastKode) + 1; // konversi ke integer, lalu tambahkan satu
		$sNextKode = "BYR" . sprintf('%03s', $sLastKode); // format hasilnya dan tambahkan prefix
		if (strlen($sNextKode) > 6) {
			$sNextKode = "BYR999";
		}
	}
	else { // jika belum ada, gunakan kode yang pertama
		$sNextKode = "BYR001";
	}
	return $sNextKode;
}
?>
