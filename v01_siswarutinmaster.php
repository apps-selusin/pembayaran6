<?php

// id
// siswa_id
// nis
// nama
// rutin_id
// tahunajaran_id
// nilai
// total

?>
<?php if ($v01_siswarutin->Visible) { ?>
<!-- <h4 class="ewMasterCaption"><?php echo $v01_siswarutin->TableCaption() ?></h4> -->
<table id="tbl_v01_siswarutinmaster" class="table table-bordered table-striped ewViewTable">
<?php echo $v01_siswarutin->TableCustomInnerHtml ?>
	<tbody>
<?php if ($v01_siswarutin->id->Visible) { // id ?>
		<tr id="r_id">
			<td><?php echo $v01_siswarutin->id->FldCaption() ?></td>
			<td<?php echo $v01_siswarutin->id->CellAttributes() ?>>
<span id="el_v01_siswarutin_id">
<span<?php echo $v01_siswarutin->id->ViewAttributes() ?>>
<?php echo $v01_siswarutin->id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($v01_siswarutin->siswa_id->Visible) { // siswa_id ?>
		<tr id="r_siswa_id">
			<td><?php echo $v01_siswarutin->siswa_id->FldCaption() ?></td>
			<td<?php echo $v01_siswarutin->siswa_id->CellAttributes() ?>>
<span id="el_v01_siswarutin_siswa_id">
<span<?php echo $v01_siswarutin->siswa_id->ViewAttributes() ?>>
<?php echo $v01_siswarutin->siswa_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($v01_siswarutin->nis->Visible) { // nis ?>
		<tr id="r_nis">
			<td><?php echo $v01_siswarutin->nis->FldCaption() ?></td>
			<td<?php echo $v01_siswarutin->nis->CellAttributes() ?>>
<span id="el_v01_siswarutin_nis">
<span<?php echo $v01_siswarutin->nis->ViewAttributes() ?>>
<?php echo $v01_siswarutin->nis->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($v01_siswarutin->nama->Visible) { // nama ?>
		<tr id="r_nama">
			<td><?php echo $v01_siswarutin->nama->FldCaption() ?></td>
			<td<?php echo $v01_siswarutin->nama->CellAttributes() ?>>
<span id="el_v01_siswarutin_nama">
<span<?php echo $v01_siswarutin->nama->ViewAttributes() ?>>
<?php echo $v01_siswarutin->nama->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($v01_siswarutin->rutin_id->Visible) { // rutin_id ?>
		<tr id="r_rutin_id">
			<td><?php echo $v01_siswarutin->rutin_id->FldCaption() ?></td>
			<td<?php echo $v01_siswarutin->rutin_id->CellAttributes() ?>>
<span id="el_v01_siswarutin_rutin_id">
<span<?php echo $v01_siswarutin->rutin_id->ViewAttributes() ?>>
<?php echo $v01_siswarutin->rutin_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($v01_siswarutin->tahunajaran_id->Visible) { // tahunajaran_id ?>
		<tr id="r_tahunajaran_id">
			<td><?php echo $v01_siswarutin->tahunajaran_id->FldCaption() ?></td>
			<td<?php echo $v01_siswarutin->tahunajaran_id->CellAttributes() ?>>
<span id="el_v01_siswarutin_tahunajaran_id">
<span<?php echo $v01_siswarutin->tahunajaran_id->ViewAttributes() ?>>
<?php echo $v01_siswarutin->tahunajaran_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($v01_siswarutin->nilai->Visible) { // nilai ?>
		<tr id="r_nilai">
			<td><?php echo $v01_siswarutin->nilai->FldCaption() ?></td>
			<td<?php echo $v01_siswarutin->nilai->CellAttributes() ?>>
<span id="el_v01_siswarutin_nilai">
<span<?php echo $v01_siswarutin->nilai->ViewAttributes() ?>>
<?php echo $v01_siswarutin->nilai->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($v01_siswarutin->total->Visible) { // total ?>
		<tr id="r_total">
			<td><?php echo $v01_siswarutin->total->FldCaption() ?></td>
			<td<?php echo $v01_siswarutin->total->CellAttributes() ?>>
<span id="el_v01_siswarutin_total">
<span<?php echo $v01_siswarutin->total->ViewAttributes() ?>>
<?php echo $v01_siswarutin->total->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
<?php } ?>
