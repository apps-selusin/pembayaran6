<?php

// tahunajaran_id
// sekolah_id
// kelas_id

?>
<?php if ($t05_daftarsiswamaster->Visible) { ?>
<!-- <h4 class="ewMasterCaption"><?php echo $t05_daftarsiswamaster->TableCaption() ?></h4> -->
<table id="tbl_t05_daftarsiswamastermaster" class="table table-bordered table-striped ewViewTable">
<?php echo $t05_daftarsiswamaster->TableCustomInnerHtml ?>
	<tbody>
<?php if ($t05_daftarsiswamaster->tahunajaran_id->Visible) { // tahunajaran_id ?>
		<tr id="r_tahunajaran_id">
			<td><?php echo $t05_daftarsiswamaster->tahunajaran_id->FldCaption() ?></td>
			<td<?php echo $t05_daftarsiswamaster->tahunajaran_id->CellAttributes() ?>>
<span id="el_t05_daftarsiswamaster_tahunajaran_id">
<span<?php echo $t05_daftarsiswamaster->tahunajaran_id->ViewAttributes() ?>>
<?php echo $t05_daftarsiswamaster->tahunajaran_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t05_daftarsiswamaster->sekolah_id->Visible) { // sekolah_id ?>
		<tr id="r_sekolah_id">
			<td><?php echo $t05_daftarsiswamaster->sekolah_id->FldCaption() ?></td>
			<td<?php echo $t05_daftarsiswamaster->sekolah_id->CellAttributes() ?>>
<span id="el_t05_daftarsiswamaster_sekolah_id">
<span<?php echo $t05_daftarsiswamaster->sekolah_id->ViewAttributes() ?>>
<?php echo $t05_daftarsiswamaster->sekolah_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t05_daftarsiswamaster->kelas_id->Visible) { // kelas_id ?>
		<tr id="r_kelas_id">
			<td><?php echo $t05_daftarsiswamaster->kelas_id->FldCaption() ?></td>
			<td<?php echo $t05_daftarsiswamaster->kelas_id->CellAttributes() ?>>
<span id="el_t05_daftarsiswamaster_kelas_id">
<span<?php echo $t05_daftarsiswamaster->kelas_id->ViewAttributes() ?>>
<?php echo $t05_daftarsiswamaster->kelas_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
<?php } ?>
