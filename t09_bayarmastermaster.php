<?php

// tahunajaran_id
// siswa_id
// Tanggal
// NomorBayar
// Jumlah

?>
<?php if ($t09_bayarmaster->Visible) { ?>
<!-- <h4 class="ewMasterCaption"><?php echo $t09_bayarmaster->TableCaption() ?></h4> -->
<table id="tbl_t09_bayarmastermaster" class="table table-bordered table-striped ewViewTable">
<?php echo $t09_bayarmaster->TableCustomInnerHtml ?>
	<tbody>
<?php if ($t09_bayarmaster->tahunajaran_id->Visible) { // tahunajaran_id ?>
		<tr id="r_tahunajaran_id">
			<td><?php echo $t09_bayarmaster->tahunajaran_id->FldCaption() ?></td>
			<td<?php echo $t09_bayarmaster->tahunajaran_id->CellAttributes() ?>>
<span id="el_t09_bayarmaster_tahunajaran_id">
<span<?php echo $t09_bayarmaster->tahunajaran_id->ViewAttributes() ?>>
<?php echo $t09_bayarmaster->tahunajaran_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t09_bayarmaster->siswa_id->Visible) { // siswa_id ?>
		<tr id="r_siswa_id">
			<td><?php echo $t09_bayarmaster->siswa_id->FldCaption() ?></td>
			<td<?php echo $t09_bayarmaster->siswa_id->CellAttributes() ?>>
<span id="el_t09_bayarmaster_siswa_id">
<span<?php echo $t09_bayarmaster->siswa_id->ViewAttributes() ?>>
<?php echo $t09_bayarmaster->siswa_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t09_bayarmaster->Tanggal->Visible) { // Tanggal ?>
		<tr id="r_Tanggal">
			<td><?php echo $t09_bayarmaster->Tanggal->FldCaption() ?></td>
			<td<?php echo $t09_bayarmaster->Tanggal->CellAttributes() ?>>
<span id="el_t09_bayarmaster_Tanggal">
<span<?php echo $t09_bayarmaster->Tanggal->ViewAttributes() ?>>
<?php echo $t09_bayarmaster->Tanggal->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t09_bayarmaster->NomorBayar->Visible) { // NomorBayar ?>
		<tr id="r_NomorBayar">
			<td><?php echo $t09_bayarmaster->NomorBayar->FldCaption() ?></td>
			<td<?php echo $t09_bayarmaster->NomorBayar->CellAttributes() ?>>
<span id="el_t09_bayarmaster_NomorBayar">
<span<?php echo $t09_bayarmaster->NomorBayar->ViewAttributes() ?>>
<?php echo $t09_bayarmaster->NomorBayar->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t09_bayarmaster->Jumlah->Visible) { // Jumlah ?>
		<tr id="r_Jumlah">
			<td><?php echo $t09_bayarmaster->Jumlah->FldCaption() ?></td>
			<td<?php echo $t09_bayarmaster->Jumlah->CellAttributes() ?>>
<span id="el_t09_bayarmaster_Jumlah">
<span<?php echo $t09_bayarmaster->Jumlah->ViewAttributes() ?>>
<?php echo $t09_bayarmaster->Jumlah->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
<?php } ?>
