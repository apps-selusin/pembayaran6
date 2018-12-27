<?php include_once "t96_employeesinfo.php" ?>
<?php

// Create page object
if (!isset($t08_siswaspp_grid)) $t08_siswaspp_grid = new ct08_siswaspp_grid();

// Page init
$t08_siswaspp_grid->Page_Init();

// Page main
$t08_siswaspp_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t08_siswaspp_grid->Page_Render();
?>
<?php if ($t08_siswaspp->Export == "") { ?>
<script type="text/javascript">

// Form object
var ft08_siswasppgrid = new ew_Form("ft08_siswasppgrid", "grid");
ft08_siswasppgrid.FormKeyCountName = '<?php echo $t08_siswaspp_grid->FormKeyCountName ?>';

// Validate form
ft08_siswasppgrid.Validate = function() {
	if (!this.ValidateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.GetForm(), $fobj = $(fobj);
	if ($fobj.find("#a_confirm").val() == "F")
		return true;
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.FormKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = $fobj.find("#a_list").val() == "gridinsert";
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
		var checkrow = (gridinsert) ? !this.EmptyRow(infix) : true;
		if (checkrow) {
			addcnt++;
			elm = this.GetElements("x" + infix + "_tahunajaran_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t08_siswaspp->tahunajaran_id->FldCaption(), $t08_siswaspp->tahunajaran_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_spp_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t08_siswaspp->spp_id->FldCaption(), $t08_siswaspp->spp_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Nilai");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t08_siswaspp->Nilai->FldCaption(), $t08_siswaspp->Nilai->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Nilai");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t08_siswaspp->Nilai->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_Terbayar");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t08_siswaspp->Terbayar->FldCaption(), $t08_siswaspp->Terbayar->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Terbayar");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t08_siswaspp->Terbayar->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_Potensi");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t08_siswaspp->Potensi->FldCaption(), $t08_siswaspp->Potensi->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Potensi");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t08_siswaspp->Potensi->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
ft08_siswasppgrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "tahunajaran_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "spp_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "Nilai", false)) return false;
	if (ew_ValueChanged(fobj, infix, "Terbayar", false)) return false;
	if (ew_ValueChanged(fobj, infix, "Potensi", false)) return false;
	return true;
}

// Form_CustomValidate event
ft08_siswasppgrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft08_siswasppgrid.ValidateRequired = true;
<?php } else { ?>
ft08_siswasppgrid.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
ft08_siswasppgrid.Lists["x_tahunajaran_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_TahunAjaran","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t01_tahunajaran"};
ft08_siswasppgrid.Lists["x_spp_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_SPP","x_Jenis","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t07_spp"};

// Form object for search
</script>
<?php } ?>
<?php
if ($t08_siswaspp->CurrentAction == "gridadd") {
	if ($t08_siswaspp->CurrentMode == "copy") {
		$bSelectLimit = $t08_siswaspp_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$t08_siswaspp_grid->TotalRecs = $t08_siswaspp->SelectRecordCount();
			$t08_siswaspp_grid->Recordset = $t08_siswaspp_grid->LoadRecordset($t08_siswaspp_grid->StartRec-1, $t08_siswaspp_grid->DisplayRecs);
		} else {
			if ($t08_siswaspp_grid->Recordset = $t08_siswaspp_grid->LoadRecordset())
				$t08_siswaspp_grid->TotalRecs = $t08_siswaspp_grid->Recordset->RecordCount();
		}
		$t08_siswaspp_grid->StartRec = 1;
		$t08_siswaspp_grid->DisplayRecs = $t08_siswaspp_grid->TotalRecs;
	} else {
		$t08_siswaspp->CurrentFilter = "0=1";
		$t08_siswaspp_grid->StartRec = 1;
		$t08_siswaspp_grid->DisplayRecs = $t08_siswaspp->GridAddRowCount;
	}
	$t08_siswaspp_grid->TotalRecs = $t08_siswaspp_grid->DisplayRecs;
	$t08_siswaspp_grid->StopRec = $t08_siswaspp_grid->DisplayRecs;
} else {
	$bSelectLimit = $t08_siswaspp_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($t08_siswaspp_grid->TotalRecs <= 0)
			$t08_siswaspp_grid->TotalRecs = $t08_siswaspp->SelectRecordCount();
	} else {
		if (!$t08_siswaspp_grid->Recordset && ($t08_siswaspp_grid->Recordset = $t08_siswaspp_grid->LoadRecordset()))
			$t08_siswaspp_grid->TotalRecs = $t08_siswaspp_grid->Recordset->RecordCount();
	}
	$t08_siswaspp_grid->StartRec = 1;
	$t08_siswaspp_grid->DisplayRecs = $t08_siswaspp_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$t08_siswaspp_grid->Recordset = $t08_siswaspp_grid->LoadRecordset($t08_siswaspp_grid->StartRec-1, $t08_siswaspp_grid->DisplayRecs);

	// Set no record found message
	if ($t08_siswaspp->CurrentAction == "" && $t08_siswaspp_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$t08_siswaspp_grid->setWarningMessage(ew_DeniedMsg());
		if ($t08_siswaspp_grid->SearchWhere == "0=101")
			$t08_siswaspp_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$t08_siswaspp_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$t08_siswaspp_grid->RenderOtherOptions();
?>
<?php $t08_siswaspp_grid->ShowPageHeader(); ?>
<?php
$t08_siswaspp_grid->ShowMessage();
?>
<?php if ($t08_siswaspp_grid->TotalRecs > 0 || $t08_siswaspp->CurrentAction <> "") { ?>
<div class="panel panel-default ewGrid t08_siswaspp">
<div id="ft08_siswasppgrid" class="ewForm form-inline">
<div id="gmp_t08_siswaspp" class="<?php if (ew_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<table id="tbl_t08_siswasppgrid" class="table ewTable">
<?php echo $t08_siswaspp->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Header row
$t08_siswaspp_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$t08_siswaspp_grid->RenderListOptions();

// Render list options (header, left)
$t08_siswaspp_grid->ListOptions->Render("header", "left");
?>
<?php if ($t08_siswaspp->tahunajaran_id->Visible) { // tahunajaran_id ?>
	<?php if ($t08_siswaspp->SortUrl($t08_siswaspp->tahunajaran_id) == "") { ?>
		<th data-name="tahunajaran_id"><div id="elh_t08_siswaspp_tahunajaran_id" class="t08_siswaspp_tahunajaran_id"><div class="ewTableHeaderCaption"><?php echo $t08_siswaspp->tahunajaran_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tahunajaran_id"><div><div id="elh_t08_siswaspp_tahunajaran_id" class="t08_siswaspp_tahunajaran_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t08_siswaspp->tahunajaran_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t08_siswaspp->tahunajaran_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t08_siswaspp->tahunajaran_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t08_siswaspp->spp_id->Visible) { // spp_id ?>
	<?php if ($t08_siswaspp->SortUrl($t08_siswaspp->spp_id) == "") { ?>
		<th data-name="spp_id"><div id="elh_t08_siswaspp_spp_id" class="t08_siswaspp_spp_id"><div class="ewTableHeaderCaption"><?php echo $t08_siswaspp->spp_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="spp_id"><div><div id="elh_t08_siswaspp_spp_id" class="t08_siswaspp_spp_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t08_siswaspp->spp_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t08_siswaspp->spp_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t08_siswaspp->spp_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t08_siswaspp->Nilai->Visible) { // Nilai ?>
	<?php if ($t08_siswaspp->SortUrl($t08_siswaspp->Nilai) == "") { ?>
		<th data-name="Nilai"><div id="elh_t08_siswaspp_Nilai" class="t08_siswaspp_Nilai"><div class="ewTableHeaderCaption"><?php echo $t08_siswaspp->Nilai->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Nilai"><div><div id="elh_t08_siswaspp_Nilai" class="t08_siswaspp_Nilai">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t08_siswaspp->Nilai->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t08_siswaspp->Nilai->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t08_siswaspp->Nilai->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t08_siswaspp->Terbayar->Visible) { // Terbayar ?>
	<?php if ($t08_siswaspp->SortUrl($t08_siswaspp->Terbayar) == "") { ?>
		<th data-name="Terbayar"><div id="elh_t08_siswaspp_Terbayar" class="t08_siswaspp_Terbayar"><div class="ewTableHeaderCaption"><?php echo $t08_siswaspp->Terbayar->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Terbayar"><div><div id="elh_t08_siswaspp_Terbayar" class="t08_siswaspp_Terbayar">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t08_siswaspp->Terbayar->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t08_siswaspp->Terbayar->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t08_siswaspp->Terbayar->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t08_siswaspp->Potensi->Visible) { // Potensi ?>
	<?php if ($t08_siswaspp->SortUrl($t08_siswaspp->Potensi) == "") { ?>
		<th data-name="Potensi"><div id="elh_t08_siswaspp_Potensi" class="t08_siswaspp_Potensi"><div class="ewTableHeaderCaption"><?php echo $t08_siswaspp->Potensi->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Potensi"><div><div id="elh_t08_siswaspp_Potensi" class="t08_siswaspp_Potensi">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t08_siswaspp->Potensi->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t08_siswaspp->Potensi->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t08_siswaspp->Potensi->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$t08_siswaspp_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$t08_siswaspp_grid->StartRec = 1;
$t08_siswaspp_grid->StopRec = $t08_siswaspp_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($t08_siswaspp_grid->FormKeyCountName) && ($t08_siswaspp->CurrentAction == "gridadd" || $t08_siswaspp->CurrentAction == "gridedit" || $t08_siswaspp->CurrentAction == "F")) {
		$t08_siswaspp_grid->KeyCount = $objForm->GetValue($t08_siswaspp_grid->FormKeyCountName);
		$t08_siswaspp_grid->StopRec = $t08_siswaspp_grid->StartRec + $t08_siswaspp_grid->KeyCount - 1;
	}
}
$t08_siswaspp_grid->RecCnt = $t08_siswaspp_grid->StartRec - 1;
if ($t08_siswaspp_grid->Recordset && !$t08_siswaspp_grid->Recordset->EOF) {
	$t08_siswaspp_grid->Recordset->MoveFirst();
	$bSelectLimit = $t08_siswaspp_grid->UseSelectLimit;
	if (!$bSelectLimit && $t08_siswaspp_grid->StartRec > 1)
		$t08_siswaspp_grid->Recordset->Move($t08_siswaspp_grid->StartRec - 1);
} elseif (!$t08_siswaspp->AllowAddDeleteRow && $t08_siswaspp_grid->StopRec == 0) {
	$t08_siswaspp_grid->StopRec = $t08_siswaspp->GridAddRowCount;
}

// Initialize aggregate
$t08_siswaspp->RowType = EW_ROWTYPE_AGGREGATEINIT;
$t08_siswaspp->ResetAttrs();
$t08_siswaspp_grid->RenderRow();
if ($t08_siswaspp->CurrentAction == "gridadd")
	$t08_siswaspp_grid->RowIndex = 0;
if ($t08_siswaspp->CurrentAction == "gridedit")
	$t08_siswaspp_grid->RowIndex = 0;
while ($t08_siswaspp_grid->RecCnt < $t08_siswaspp_grid->StopRec) {
	$t08_siswaspp_grid->RecCnt++;
	if (intval($t08_siswaspp_grid->RecCnt) >= intval($t08_siswaspp_grid->StartRec)) {
		$t08_siswaspp_grid->RowCnt++;
		if ($t08_siswaspp->CurrentAction == "gridadd" || $t08_siswaspp->CurrentAction == "gridedit" || $t08_siswaspp->CurrentAction == "F") {
			$t08_siswaspp_grid->RowIndex++;
			$objForm->Index = $t08_siswaspp_grid->RowIndex;
			if ($objForm->HasValue($t08_siswaspp_grid->FormActionName))
				$t08_siswaspp_grid->RowAction = strval($objForm->GetValue($t08_siswaspp_grid->FormActionName));
			elseif ($t08_siswaspp->CurrentAction == "gridadd")
				$t08_siswaspp_grid->RowAction = "insert";
			else
				$t08_siswaspp_grid->RowAction = "";
		}

		// Set up key count
		$t08_siswaspp_grid->KeyCount = $t08_siswaspp_grid->RowIndex;

		// Init row class and style
		$t08_siswaspp->ResetAttrs();
		$t08_siswaspp->CssClass = "";
		if ($t08_siswaspp->CurrentAction == "gridadd") {
			if ($t08_siswaspp->CurrentMode == "copy") {
				$t08_siswaspp_grid->LoadRowValues($t08_siswaspp_grid->Recordset); // Load row values
				$t08_siswaspp_grid->SetRecordKey($t08_siswaspp_grid->RowOldKey, $t08_siswaspp_grid->Recordset); // Set old record key
			} else {
				$t08_siswaspp_grid->LoadDefaultValues(); // Load default values
				$t08_siswaspp_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$t08_siswaspp_grid->LoadRowValues($t08_siswaspp_grid->Recordset); // Load row values
		}
		$t08_siswaspp->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($t08_siswaspp->CurrentAction == "gridadd") // Grid add
			$t08_siswaspp->RowType = EW_ROWTYPE_ADD; // Render add
		if ($t08_siswaspp->CurrentAction == "gridadd" && $t08_siswaspp->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$t08_siswaspp_grid->RestoreCurrentRowFormValues($t08_siswaspp_grid->RowIndex); // Restore form values
		if ($t08_siswaspp->CurrentAction == "gridedit") { // Grid edit
			if ($t08_siswaspp->EventCancelled) {
				$t08_siswaspp_grid->RestoreCurrentRowFormValues($t08_siswaspp_grid->RowIndex); // Restore form values
			}
			if ($t08_siswaspp_grid->RowAction == "insert")
				$t08_siswaspp->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$t08_siswaspp->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($t08_siswaspp->CurrentAction == "gridedit" && ($t08_siswaspp->RowType == EW_ROWTYPE_EDIT || $t08_siswaspp->RowType == EW_ROWTYPE_ADD) && $t08_siswaspp->EventCancelled) // Update failed
			$t08_siswaspp_grid->RestoreCurrentRowFormValues($t08_siswaspp_grid->RowIndex); // Restore form values
		if ($t08_siswaspp->RowType == EW_ROWTYPE_EDIT) // Edit row
			$t08_siswaspp_grid->EditRowCnt++;
		if ($t08_siswaspp->CurrentAction == "F") // Confirm row
			$t08_siswaspp_grid->RestoreCurrentRowFormValues($t08_siswaspp_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$t08_siswaspp->RowAttrs = array_merge($t08_siswaspp->RowAttrs, array('data-rowindex'=>$t08_siswaspp_grid->RowCnt, 'id'=>'r' . $t08_siswaspp_grid->RowCnt . '_t08_siswaspp', 'data-rowtype'=>$t08_siswaspp->RowType));

		// Render row
		$t08_siswaspp_grid->RenderRow();

		// Render list options
		$t08_siswaspp_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($t08_siswaspp_grid->RowAction <> "delete" && $t08_siswaspp_grid->RowAction <> "insertdelete" && !($t08_siswaspp_grid->RowAction == "insert" && $t08_siswaspp->CurrentAction == "F" && $t08_siswaspp_grid->EmptyRow())) {
?>
	<tr<?php echo $t08_siswaspp->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t08_siswaspp_grid->ListOptions->Render("body", "left", $t08_siswaspp_grid->RowCnt);
?>
	<?php if ($t08_siswaspp->tahunajaran_id->Visible) { // tahunajaran_id ?>
		<td data-name="tahunajaran_id"<?php echo $t08_siswaspp->tahunajaran_id->CellAttributes() ?>>
<?php if ($t08_siswaspp->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t08_siswaspp_grid->RowCnt ?>_t08_siswaspp_tahunajaran_id" class="form-group t08_siswaspp_tahunajaran_id">
<select data-table="t08_siswaspp" data-field="x_tahunajaran_id" data-value-separator="<?php echo $t08_siswaspp->tahunajaran_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $t08_siswaspp_grid->RowIndex ?>_tahunajaran_id" name="x<?php echo $t08_siswaspp_grid->RowIndex ?>_tahunajaran_id"<?php echo $t08_siswaspp->tahunajaran_id->EditAttributes() ?>>
<?php echo $t08_siswaspp->tahunajaran_id->SelectOptionListHtml("x<?php echo $t08_siswaspp_grid->RowIndex ?>_tahunajaran_id") ?>
</select>
<input type="hidden" name="s_x<?php echo $t08_siswaspp_grid->RowIndex ?>_tahunajaran_id" id="s_x<?php echo $t08_siswaspp_grid->RowIndex ?>_tahunajaran_id" value="<?php echo $t08_siswaspp->tahunajaran_id->LookupFilterQuery() ?>">
</span>
<input type="hidden" data-table="t08_siswaspp" data-field="x_tahunajaran_id" name="o<?php echo $t08_siswaspp_grid->RowIndex ?>_tahunajaran_id" id="o<?php echo $t08_siswaspp_grid->RowIndex ?>_tahunajaran_id" value="<?php echo ew_HtmlEncode($t08_siswaspp->tahunajaran_id->OldValue) ?>">
<?php } ?>
<?php if ($t08_siswaspp->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t08_siswaspp_grid->RowCnt ?>_t08_siswaspp_tahunajaran_id" class="form-group t08_siswaspp_tahunajaran_id">
<select data-table="t08_siswaspp" data-field="x_tahunajaran_id" data-value-separator="<?php echo $t08_siswaspp->tahunajaran_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $t08_siswaspp_grid->RowIndex ?>_tahunajaran_id" name="x<?php echo $t08_siswaspp_grid->RowIndex ?>_tahunajaran_id"<?php echo $t08_siswaspp->tahunajaran_id->EditAttributes() ?>>
<?php echo $t08_siswaspp->tahunajaran_id->SelectOptionListHtml("x<?php echo $t08_siswaspp_grid->RowIndex ?>_tahunajaran_id") ?>
</select>
<input type="hidden" name="s_x<?php echo $t08_siswaspp_grid->RowIndex ?>_tahunajaran_id" id="s_x<?php echo $t08_siswaspp_grid->RowIndex ?>_tahunajaran_id" value="<?php echo $t08_siswaspp->tahunajaran_id->LookupFilterQuery() ?>">
</span>
<?php } ?>
<?php if ($t08_siswaspp->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t08_siswaspp_grid->RowCnt ?>_t08_siswaspp_tahunajaran_id" class="t08_siswaspp_tahunajaran_id">
<span<?php echo $t08_siswaspp->tahunajaran_id->ViewAttributes() ?>>
<?php echo $t08_siswaspp->tahunajaran_id->ListViewValue() ?></span>
</span>
<?php if ($t08_siswaspp->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t08_siswaspp" data-field="x_tahunajaran_id" name="x<?php echo $t08_siswaspp_grid->RowIndex ?>_tahunajaran_id" id="x<?php echo $t08_siswaspp_grid->RowIndex ?>_tahunajaran_id" value="<?php echo ew_HtmlEncode($t08_siswaspp->tahunajaran_id->FormValue) ?>">
<input type="hidden" data-table="t08_siswaspp" data-field="x_tahunajaran_id" name="o<?php echo $t08_siswaspp_grid->RowIndex ?>_tahunajaran_id" id="o<?php echo $t08_siswaspp_grid->RowIndex ?>_tahunajaran_id" value="<?php echo ew_HtmlEncode($t08_siswaspp->tahunajaran_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t08_siswaspp" data-field="x_tahunajaran_id" name="ft08_siswasppgrid$x<?php echo $t08_siswaspp_grid->RowIndex ?>_tahunajaran_id" id="ft08_siswasppgrid$x<?php echo $t08_siswaspp_grid->RowIndex ?>_tahunajaran_id" value="<?php echo ew_HtmlEncode($t08_siswaspp->tahunajaran_id->FormValue) ?>">
<input type="hidden" data-table="t08_siswaspp" data-field="x_tahunajaran_id" name="ft08_siswasppgrid$o<?php echo $t08_siswaspp_grid->RowIndex ?>_tahunajaran_id" id="ft08_siswasppgrid$o<?php echo $t08_siswaspp_grid->RowIndex ?>_tahunajaran_id" value="<?php echo ew_HtmlEncode($t08_siswaspp->tahunajaran_id->OldValue) ?>">
<?php } ?>
<?php } ?>
<a id="<?php echo $t08_siswaspp_grid->PageObjName . "_row_" . $t08_siswaspp_grid->RowCnt ?>"></a></td>
	<?php } ?>
<?php if ($t08_siswaspp->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="t08_siswaspp" data-field="x_id" name="x<?php echo $t08_siswaspp_grid->RowIndex ?>_id" id="x<?php echo $t08_siswaspp_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t08_siswaspp->id->CurrentValue) ?>">
<input type="hidden" data-table="t08_siswaspp" data-field="x_id" name="o<?php echo $t08_siswaspp_grid->RowIndex ?>_id" id="o<?php echo $t08_siswaspp_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t08_siswaspp->id->OldValue) ?>">
<?php } ?>
<?php if ($t08_siswaspp->RowType == EW_ROWTYPE_EDIT || $t08_siswaspp->CurrentMode == "edit") { ?>
<input type="hidden" data-table="t08_siswaspp" data-field="x_id" name="x<?php echo $t08_siswaspp_grid->RowIndex ?>_id" id="x<?php echo $t08_siswaspp_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t08_siswaspp->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($t08_siswaspp->spp_id->Visible) { // spp_id ?>
		<td data-name="spp_id"<?php echo $t08_siswaspp->spp_id->CellAttributes() ?>>
<?php if ($t08_siswaspp->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t08_siswaspp_grid->RowCnt ?>_t08_siswaspp_spp_id" class="form-group t08_siswaspp_spp_id">
<select data-table="t08_siswaspp" data-field="x_spp_id" data-value-separator="<?php echo $t08_siswaspp->spp_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $t08_siswaspp_grid->RowIndex ?>_spp_id" name="x<?php echo $t08_siswaspp_grid->RowIndex ?>_spp_id"<?php echo $t08_siswaspp->spp_id->EditAttributes() ?>>
<?php echo $t08_siswaspp->spp_id->SelectOptionListHtml("x<?php echo $t08_siswaspp_grid->RowIndex ?>_spp_id") ?>
</select>
<input type="hidden" name="s_x<?php echo $t08_siswaspp_grid->RowIndex ?>_spp_id" id="s_x<?php echo $t08_siswaspp_grid->RowIndex ?>_spp_id" value="<?php echo $t08_siswaspp->spp_id->LookupFilterQuery() ?>">
</span>
<input type="hidden" data-table="t08_siswaspp" data-field="x_spp_id" name="o<?php echo $t08_siswaspp_grid->RowIndex ?>_spp_id" id="o<?php echo $t08_siswaspp_grid->RowIndex ?>_spp_id" value="<?php echo ew_HtmlEncode($t08_siswaspp->spp_id->OldValue) ?>">
<?php } ?>
<?php if ($t08_siswaspp->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t08_siswaspp_grid->RowCnt ?>_t08_siswaspp_spp_id" class="form-group t08_siswaspp_spp_id">
<select data-table="t08_siswaspp" data-field="x_spp_id" data-value-separator="<?php echo $t08_siswaspp->spp_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $t08_siswaspp_grid->RowIndex ?>_spp_id" name="x<?php echo $t08_siswaspp_grid->RowIndex ?>_spp_id"<?php echo $t08_siswaspp->spp_id->EditAttributes() ?>>
<?php echo $t08_siswaspp->spp_id->SelectOptionListHtml("x<?php echo $t08_siswaspp_grid->RowIndex ?>_spp_id") ?>
</select>
<input type="hidden" name="s_x<?php echo $t08_siswaspp_grid->RowIndex ?>_spp_id" id="s_x<?php echo $t08_siswaspp_grid->RowIndex ?>_spp_id" value="<?php echo $t08_siswaspp->spp_id->LookupFilterQuery() ?>">
</span>
<?php } ?>
<?php if ($t08_siswaspp->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t08_siswaspp_grid->RowCnt ?>_t08_siswaspp_spp_id" class="t08_siswaspp_spp_id">
<span<?php echo $t08_siswaspp->spp_id->ViewAttributes() ?>>
<?php echo $t08_siswaspp->spp_id->ListViewValue() ?></span>
</span>
<?php if ($t08_siswaspp->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t08_siswaspp" data-field="x_spp_id" name="x<?php echo $t08_siswaspp_grid->RowIndex ?>_spp_id" id="x<?php echo $t08_siswaspp_grid->RowIndex ?>_spp_id" value="<?php echo ew_HtmlEncode($t08_siswaspp->spp_id->FormValue) ?>">
<input type="hidden" data-table="t08_siswaspp" data-field="x_spp_id" name="o<?php echo $t08_siswaspp_grid->RowIndex ?>_spp_id" id="o<?php echo $t08_siswaspp_grid->RowIndex ?>_spp_id" value="<?php echo ew_HtmlEncode($t08_siswaspp->spp_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t08_siswaspp" data-field="x_spp_id" name="ft08_siswasppgrid$x<?php echo $t08_siswaspp_grid->RowIndex ?>_spp_id" id="ft08_siswasppgrid$x<?php echo $t08_siswaspp_grid->RowIndex ?>_spp_id" value="<?php echo ew_HtmlEncode($t08_siswaspp->spp_id->FormValue) ?>">
<input type="hidden" data-table="t08_siswaspp" data-field="x_spp_id" name="ft08_siswasppgrid$o<?php echo $t08_siswaspp_grid->RowIndex ?>_spp_id" id="ft08_siswasppgrid$o<?php echo $t08_siswaspp_grid->RowIndex ?>_spp_id" value="<?php echo ew_HtmlEncode($t08_siswaspp->spp_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t08_siswaspp->Nilai->Visible) { // Nilai ?>
		<td data-name="Nilai"<?php echo $t08_siswaspp->Nilai->CellAttributes() ?>>
<?php if ($t08_siswaspp->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t08_siswaspp_grid->RowCnt ?>_t08_siswaspp_Nilai" class="form-group t08_siswaspp_Nilai">
<input type="text" data-table="t08_siswaspp" data-field="x_Nilai" name="x<?php echo $t08_siswaspp_grid->RowIndex ?>_Nilai" id="x<?php echo $t08_siswaspp_grid->RowIndex ?>_Nilai" size="10" placeholder="<?php echo ew_HtmlEncode($t08_siswaspp->Nilai->getPlaceHolder()) ?>" value="<?php echo $t08_siswaspp->Nilai->EditValue ?>"<?php echo $t08_siswaspp->Nilai->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t08_siswaspp" data-field="x_Nilai" name="o<?php echo $t08_siswaspp_grid->RowIndex ?>_Nilai" id="o<?php echo $t08_siswaspp_grid->RowIndex ?>_Nilai" value="<?php echo ew_HtmlEncode($t08_siswaspp->Nilai->OldValue) ?>">
<?php } ?>
<?php if ($t08_siswaspp->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t08_siswaspp_grid->RowCnt ?>_t08_siswaspp_Nilai" class="form-group t08_siswaspp_Nilai">
<input type="text" data-table="t08_siswaspp" data-field="x_Nilai" name="x<?php echo $t08_siswaspp_grid->RowIndex ?>_Nilai" id="x<?php echo $t08_siswaspp_grid->RowIndex ?>_Nilai" size="10" placeholder="<?php echo ew_HtmlEncode($t08_siswaspp->Nilai->getPlaceHolder()) ?>" value="<?php echo $t08_siswaspp->Nilai->EditValue ?>"<?php echo $t08_siswaspp->Nilai->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t08_siswaspp->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t08_siswaspp_grid->RowCnt ?>_t08_siswaspp_Nilai" class="t08_siswaspp_Nilai">
<span<?php echo $t08_siswaspp->Nilai->ViewAttributes() ?>>
<?php echo $t08_siswaspp->Nilai->ListViewValue() ?></span>
</span>
<?php if ($t08_siswaspp->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t08_siswaspp" data-field="x_Nilai" name="x<?php echo $t08_siswaspp_grid->RowIndex ?>_Nilai" id="x<?php echo $t08_siswaspp_grid->RowIndex ?>_Nilai" value="<?php echo ew_HtmlEncode($t08_siswaspp->Nilai->FormValue) ?>">
<input type="hidden" data-table="t08_siswaspp" data-field="x_Nilai" name="o<?php echo $t08_siswaspp_grid->RowIndex ?>_Nilai" id="o<?php echo $t08_siswaspp_grid->RowIndex ?>_Nilai" value="<?php echo ew_HtmlEncode($t08_siswaspp->Nilai->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t08_siswaspp" data-field="x_Nilai" name="ft08_siswasppgrid$x<?php echo $t08_siswaspp_grid->RowIndex ?>_Nilai" id="ft08_siswasppgrid$x<?php echo $t08_siswaspp_grid->RowIndex ?>_Nilai" value="<?php echo ew_HtmlEncode($t08_siswaspp->Nilai->FormValue) ?>">
<input type="hidden" data-table="t08_siswaspp" data-field="x_Nilai" name="ft08_siswasppgrid$o<?php echo $t08_siswaspp_grid->RowIndex ?>_Nilai" id="ft08_siswasppgrid$o<?php echo $t08_siswaspp_grid->RowIndex ?>_Nilai" value="<?php echo ew_HtmlEncode($t08_siswaspp->Nilai->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t08_siswaspp->Terbayar->Visible) { // Terbayar ?>
		<td data-name="Terbayar"<?php echo $t08_siswaspp->Terbayar->CellAttributes() ?>>
<?php if ($t08_siswaspp->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t08_siswaspp_grid->RowCnt ?>_t08_siswaspp_Terbayar" class="form-group t08_siswaspp_Terbayar">
<input type="text" data-table="t08_siswaspp" data-field="x_Terbayar" name="x<?php echo $t08_siswaspp_grid->RowIndex ?>_Terbayar" id="x<?php echo $t08_siswaspp_grid->RowIndex ?>_Terbayar" size="10" placeholder="<?php echo ew_HtmlEncode($t08_siswaspp->Terbayar->getPlaceHolder()) ?>" value="<?php echo $t08_siswaspp->Terbayar->EditValue ?>"<?php echo $t08_siswaspp->Terbayar->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t08_siswaspp" data-field="x_Terbayar" name="o<?php echo $t08_siswaspp_grid->RowIndex ?>_Terbayar" id="o<?php echo $t08_siswaspp_grid->RowIndex ?>_Terbayar" value="<?php echo ew_HtmlEncode($t08_siswaspp->Terbayar->OldValue) ?>">
<?php } ?>
<?php if ($t08_siswaspp->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t08_siswaspp_grid->RowCnt ?>_t08_siswaspp_Terbayar" class="form-group t08_siswaspp_Terbayar">
<input type="text" data-table="t08_siswaspp" data-field="x_Terbayar" name="x<?php echo $t08_siswaspp_grid->RowIndex ?>_Terbayar" id="x<?php echo $t08_siswaspp_grid->RowIndex ?>_Terbayar" size="10" placeholder="<?php echo ew_HtmlEncode($t08_siswaspp->Terbayar->getPlaceHolder()) ?>" value="<?php echo $t08_siswaspp->Terbayar->EditValue ?>"<?php echo $t08_siswaspp->Terbayar->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t08_siswaspp->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t08_siswaspp_grid->RowCnt ?>_t08_siswaspp_Terbayar" class="t08_siswaspp_Terbayar">
<span<?php echo $t08_siswaspp->Terbayar->ViewAttributes() ?>>
<?php echo $t08_siswaspp->Terbayar->ListViewValue() ?></span>
</span>
<?php if ($t08_siswaspp->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t08_siswaspp" data-field="x_Terbayar" name="x<?php echo $t08_siswaspp_grid->RowIndex ?>_Terbayar" id="x<?php echo $t08_siswaspp_grid->RowIndex ?>_Terbayar" value="<?php echo ew_HtmlEncode($t08_siswaspp->Terbayar->FormValue) ?>">
<input type="hidden" data-table="t08_siswaspp" data-field="x_Terbayar" name="o<?php echo $t08_siswaspp_grid->RowIndex ?>_Terbayar" id="o<?php echo $t08_siswaspp_grid->RowIndex ?>_Terbayar" value="<?php echo ew_HtmlEncode($t08_siswaspp->Terbayar->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t08_siswaspp" data-field="x_Terbayar" name="ft08_siswasppgrid$x<?php echo $t08_siswaspp_grid->RowIndex ?>_Terbayar" id="ft08_siswasppgrid$x<?php echo $t08_siswaspp_grid->RowIndex ?>_Terbayar" value="<?php echo ew_HtmlEncode($t08_siswaspp->Terbayar->FormValue) ?>">
<input type="hidden" data-table="t08_siswaspp" data-field="x_Terbayar" name="ft08_siswasppgrid$o<?php echo $t08_siswaspp_grid->RowIndex ?>_Terbayar" id="ft08_siswasppgrid$o<?php echo $t08_siswaspp_grid->RowIndex ?>_Terbayar" value="<?php echo ew_HtmlEncode($t08_siswaspp->Terbayar->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t08_siswaspp->Potensi->Visible) { // Potensi ?>
		<td data-name="Potensi"<?php echo $t08_siswaspp->Potensi->CellAttributes() ?>>
<?php if ($t08_siswaspp->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t08_siswaspp_grid->RowCnt ?>_t08_siswaspp_Potensi" class="form-group t08_siswaspp_Potensi">
<input type="text" data-table="t08_siswaspp" data-field="x_Potensi" name="x<?php echo $t08_siswaspp_grid->RowIndex ?>_Potensi" id="x<?php echo $t08_siswaspp_grid->RowIndex ?>_Potensi" size="10" placeholder="<?php echo ew_HtmlEncode($t08_siswaspp->Potensi->getPlaceHolder()) ?>" value="<?php echo $t08_siswaspp->Potensi->EditValue ?>"<?php echo $t08_siswaspp->Potensi->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t08_siswaspp" data-field="x_Potensi" name="o<?php echo $t08_siswaspp_grid->RowIndex ?>_Potensi" id="o<?php echo $t08_siswaspp_grid->RowIndex ?>_Potensi" value="<?php echo ew_HtmlEncode($t08_siswaspp->Potensi->OldValue) ?>">
<?php } ?>
<?php if ($t08_siswaspp->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t08_siswaspp_grid->RowCnt ?>_t08_siswaspp_Potensi" class="form-group t08_siswaspp_Potensi">
<input type="text" data-table="t08_siswaspp" data-field="x_Potensi" name="x<?php echo $t08_siswaspp_grid->RowIndex ?>_Potensi" id="x<?php echo $t08_siswaspp_grid->RowIndex ?>_Potensi" size="10" placeholder="<?php echo ew_HtmlEncode($t08_siswaspp->Potensi->getPlaceHolder()) ?>" value="<?php echo $t08_siswaspp->Potensi->EditValue ?>"<?php echo $t08_siswaspp->Potensi->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t08_siswaspp->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t08_siswaspp_grid->RowCnt ?>_t08_siswaspp_Potensi" class="t08_siswaspp_Potensi">
<span<?php echo $t08_siswaspp->Potensi->ViewAttributes() ?>>
<?php echo $t08_siswaspp->Potensi->ListViewValue() ?></span>
</span>
<?php if ($t08_siswaspp->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t08_siswaspp" data-field="x_Potensi" name="x<?php echo $t08_siswaspp_grid->RowIndex ?>_Potensi" id="x<?php echo $t08_siswaspp_grid->RowIndex ?>_Potensi" value="<?php echo ew_HtmlEncode($t08_siswaspp->Potensi->FormValue) ?>">
<input type="hidden" data-table="t08_siswaspp" data-field="x_Potensi" name="o<?php echo $t08_siswaspp_grid->RowIndex ?>_Potensi" id="o<?php echo $t08_siswaspp_grid->RowIndex ?>_Potensi" value="<?php echo ew_HtmlEncode($t08_siswaspp->Potensi->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t08_siswaspp" data-field="x_Potensi" name="ft08_siswasppgrid$x<?php echo $t08_siswaspp_grid->RowIndex ?>_Potensi" id="ft08_siswasppgrid$x<?php echo $t08_siswaspp_grid->RowIndex ?>_Potensi" value="<?php echo ew_HtmlEncode($t08_siswaspp->Potensi->FormValue) ?>">
<input type="hidden" data-table="t08_siswaspp" data-field="x_Potensi" name="ft08_siswasppgrid$o<?php echo $t08_siswaspp_grid->RowIndex ?>_Potensi" id="ft08_siswasppgrid$o<?php echo $t08_siswaspp_grid->RowIndex ?>_Potensi" value="<?php echo ew_HtmlEncode($t08_siswaspp->Potensi->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t08_siswaspp_grid->ListOptions->Render("body", "right", $t08_siswaspp_grid->RowCnt);
?>
	</tr>
<?php if ($t08_siswaspp->RowType == EW_ROWTYPE_ADD || $t08_siswaspp->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
ft08_siswasppgrid.UpdateOpts(<?php echo $t08_siswaspp_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($t08_siswaspp->CurrentAction <> "gridadd" || $t08_siswaspp->CurrentMode == "copy")
		if (!$t08_siswaspp_grid->Recordset->EOF) $t08_siswaspp_grid->Recordset->MoveNext();
}
?>
<?php
	if ($t08_siswaspp->CurrentMode == "add" || $t08_siswaspp->CurrentMode == "copy" || $t08_siswaspp->CurrentMode == "edit") {
		$t08_siswaspp_grid->RowIndex = '$rowindex$';
		$t08_siswaspp_grid->LoadDefaultValues();

		// Set row properties
		$t08_siswaspp->ResetAttrs();
		$t08_siswaspp->RowAttrs = array_merge($t08_siswaspp->RowAttrs, array('data-rowindex'=>$t08_siswaspp_grid->RowIndex, 'id'=>'r0_t08_siswaspp', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($t08_siswaspp->RowAttrs["class"], "ewTemplate");
		$t08_siswaspp->RowType = EW_ROWTYPE_ADD;

		// Render row
		$t08_siswaspp_grid->RenderRow();

		// Render list options
		$t08_siswaspp_grid->RenderListOptions();
		$t08_siswaspp_grid->StartRowCnt = 0;
?>
	<tr<?php echo $t08_siswaspp->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t08_siswaspp_grid->ListOptions->Render("body", "left", $t08_siswaspp_grid->RowIndex);
?>
	<?php if ($t08_siswaspp->tahunajaran_id->Visible) { // tahunajaran_id ?>
		<td data-name="tahunajaran_id">
<?php if ($t08_siswaspp->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t08_siswaspp_tahunajaran_id" class="form-group t08_siswaspp_tahunajaran_id">
<select data-table="t08_siswaspp" data-field="x_tahunajaran_id" data-value-separator="<?php echo $t08_siswaspp->tahunajaran_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $t08_siswaspp_grid->RowIndex ?>_tahunajaran_id" name="x<?php echo $t08_siswaspp_grid->RowIndex ?>_tahunajaran_id"<?php echo $t08_siswaspp->tahunajaran_id->EditAttributes() ?>>
<?php echo $t08_siswaspp->tahunajaran_id->SelectOptionListHtml("x<?php echo $t08_siswaspp_grid->RowIndex ?>_tahunajaran_id") ?>
</select>
<input type="hidden" name="s_x<?php echo $t08_siswaspp_grid->RowIndex ?>_tahunajaran_id" id="s_x<?php echo $t08_siswaspp_grid->RowIndex ?>_tahunajaran_id" value="<?php echo $t08_siswaspp->tahunajaran_id->LookupFilterQuery() ?>">
</span>
<?php } else { ?>
<span id="el$rowindex$_t08_siswaspp_tahunajaran_id" class="form-group t08_siswaspp_tahunajaran_id">
<span<?php echo $t08_siswaspp->tahunajaran_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t08_siswaspp->tahunajaran_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t08_siswaspp" data-field="x_tahunajaran_id" name="x<?php echo $t08_siswaspp_grid->RowIndex ?>_tahunajaran_id" id="x<?php echo $t08_siswaspp_grid->RowIndex ?>_tahunajaran_id" value="<?php echo ew_HtmlEncode($t08_siswaspp->tahunajaran_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t08_siswaspp" data-field="x_tahunajaran_id" name="o<?php echo $t08_siswaspp_grid->RowIndex ?>_tahunajaran_id" id="o<?php echo $t08_siswaspp_grid->RowIndex ?>_tahunajaran_id" value="<?php echo ew_HtmlEncode($t08_siswaspp->tahunajaran_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t08_siswaspp->spp_id->Visible) { // spp_id ?>
		<td data-name="spp_id">
<?php if ($t08_siswaspp->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t08_siswaspp_spp_id" class="form-group t08_siswaspp_spp_id">
<select data-table="t08_siswaspp" data-field="x_spp_id" data-value-separator="<?php echo $t08_siswaspp->spp_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $t08_siswaspp_grid->RowIndex ?>_spp_id" name="x<?php echo $t08_siswaspp_grid->RowIndex ?>_spp_id"<?php echo $t08_siswaspp->spp_id->EditAttributes() ?>>
<?php echo $t08_siswaspp->spp_id->SelectOptionListHtml("x<?php echo $t08_siswaspp_grid->RowIndex ?>_spp_id") ?>
</select>
<input type="hidden" name="s_x<?php echo $t08_siswaspp_grid->RowIndex ?>_spp_id" id="s_x<?php echo $t08_siswaspp_grid->RowIndex ?>_spp_id" value="<?php echo $t08_siswaspp->spp_id->LookupFilterQuery() ?>">
</span>
<?php } else { ?>
<span id="el$rowindex$_t08_siswaspp_spp_id" class="form-group t08_siswaspp_spp_id">
<span<?php echo $t08_siswaspp->spp_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t08_siswaspp->spp_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t08_siswaspp" data-field="x_spp_id" name="x<?php echo $t08_siswaspp_grid->RowIndex ?>_spp_id" id="x<?php echo $t08_siswaspp_grid->RowIndex ?>_spp_id" value="<?php echo ew_HtmlEncode($t08_siswaspp->spp_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t08_siswaspp" data-field="x_spp_id" name="o<?php echo $t08_siswaspp_grid->RowIndex ?>_spp_id" id="o<?php echo $t08_siswaspp_grid->RowIndex ?>_spp_id" value="<?php echo ew_HtmlEncode($t08_siswaspp->spp_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t08_siswaspp->Nilai->Visible) { // Nilai ?>
		<td data-name="Nilai">
<?php if ($t08_siswaspp->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t08_siswaspp_Nilai" class="form-group t08_siswaspp_Nilai">
<input type="text" data-table="t08_siswaspp" data-field="x_Nilai" name="x<?php echo $t08_siswaspp_grid->RowIndex ?>_Nilai" id="x<?php echo $t08_siswaspp_grid->RowIndex ?>_Nilai" size="10" placeholder="<?php echo ew_HtmlEncode($t08_siswaspp->Nilai->getPlaceHolder()) ?>" value="<?php echo $t08_siswaspp->Nilai->EditValue ?>"<?php echo $t08_siswaspp->Nilai->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t08_siswaspp_Nilai" class="form-group t08_siswaspp_Nilai">
<span<?php echo $t08_siswaspp->Nilai->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t08_siswaspp->Nilai->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t08_siswaspp" data-field="x_Nilai" name="x<?php echo $t08_siswaspp_grid->RowIndex ?>_Nilai" id="x<?php echo $t08_siswaspp_grid->RowIndex ?>_Nilai" value="<?php echo ew_HtmlEncode($t08_siswaspp->Nilai->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t08_siswaspp" data-field="x_Nilai" name="o<?php echo $t08_siswaspp_grid->RowIndex ?>_Nilai" id="o<?php echo $t08_siswaspp_grid->RowIndex ?>_Nilai" value="<?php echo ew_HtmlEncode($t08_siswaspp->Nilai->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t08_siswaspp->Terbayar->Visible) { // Terbayar ?>
		<td data-name="Terbayar">
<?php if ($t08_siswaspp->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t08_siswaspp_Terbayar" class="form-group t08_siswaspp_Terbayar">
<input type="text" data-table="t08_siswaspp" data-field="x_Terbayar" name="x<?php echo $t08_siswaspp_grid->RowIndex ?>_Terbayar" id="x<?php echo $t08_siswaspp_grid->RowIndex ?>_Terbayar" size="10" placeholder="<?php echo ew_HtmlEncode($t08_siswaspp->Terbayar->getPlaceHolder()) ?>" value="<?php echo $t08_siswaspp->Terbayar->EditValue ?>"<?php echo $t08_siswaspp->Terbayar->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t08_siswaspp_Terbayar" class="form-group t08_siswaspp_Terbayar">
<span<?php echo $t08_siswaspp->Terbayar->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t08_siswaspp->Terbayar->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t08_siswaspp" data-field="x_Terbayar" name="x<?php echo $t08_siswaspp_grid->RowIndex ?>_Terbayar" id="x<?php echo $t08_siswaspp_grid->RowIndex ?>_Terbayar" value="<?php echo ew_HtmlEncode($t08_siswaspp->Terbayar->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t08_siswaspp" data-field="x_Terbayar" name="o<?php echo $t08_siswaspp_grid->RowIndex ?>_Terbayar" id="o<?php echo $t08_siswaspp_grid->RowIndex ?>_Terbayar" value="<?php echo ew_HtmlEncode($t08_siswaspp->Terbayar->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t08_siswaspp->Potensi->Visible) { // Potensi ?>
		<td data-name="Potensi">
<?php if ($t08_siswaspp->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t08_siswaspp_Potensi" class="form-group t08_siswaspp_Potensi">
<input type="text" data-table="t08_siswaspp" data-field="x_Potensi" name="x<?php echo $t08_siswaspp_grid->RowIndex ?>_Potensi" id="x<?php echo $t08_siswaspp_grid->RowIndex ?>_Potensi" size="10" placeholder="<?php echo ew_HtmlEncode($t08_siswaspp->Potensi->getPlaceHolder()) ?>" value="<?php echo $t08_siswaspp->Potensi->EditValue ?>"<?php echo $t08_siswaspp->Potensi->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t08_siswaspp_Potensi" class="form-group t08_siswaspp_Potensi">
<span<?php echo $t08_siswaspp->Potensi->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t08_siswaspp->Potensi->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t08_siswaspp" data-field="x_Potensi" name="x<?php echo $t08_siswaspp_grid->RowIndex ?>_Potensi" id="x<?php echo $t08_siswaspp_grid->RowIndex ?>_Potensi" value="<?php echo ew_HtmlEncode($t08_siswaspp->Potensi->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t08_siswaspp" data-field="x_Potensi" name="o<?php echo $t08_siswaspp_grid->RowIndex ?>_Potensi" id="o<?php echo $t08_siswaspp_grid->RowIndex ?>_Potensi" value="<?php echo ew_HtmlEncode($t08_siswaspp->Potensi->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t08_siswaspp_grid->ListOptions->Render("body", "right", $t08_siswaspp_grid->RowCnt);
?>
<script type="text/javascript">
ft08_siswasppgrid.UpdateOpts(<?php echo $t08_siswaspp_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($t08_siswaspp->CurrentMode == "add" || $t08_siswaspp->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $t08_siswaspp_grid->FormKeyCountName ?>" id="<?php echo $t08_siswaspp_grid->FormKeyCountName ?>" value="<?php echo $t08_siswaspp_grid->KeyCount ?>">
<?php echo $t08_siswaspp_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t08_siswaspp->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $t08_siswaspp_grid->FormKeyCountName ?>" id="<?php echo $t08_siswaspp_grid->FormKeyCountName ?>" value="<?php echo $t08_siswaspp_grid->KeyCount ?>">
<?php echo $t08_siswaspp_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t08_siswaspp->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ft08_siswasppgrid">
</div>
<?php

// Close recordset
if ($t08_siswaspp_grid->Recordset)
	$t08_siswaspp_grid->Recordset->Close();
?>
<?php if ($t08_siswaspp_grid->ShowOtherOptions) { ?>
<div class="panel-footer ewGridLowerPanel">
<?php
	foreach ($t08_siswaspp_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($t08_siswaspp_grid->TotalRecs == 0 && $t08_siswaspp->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($t08_siswaspp_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($t08_siswaspp->Export == "") { ?>
<script type="text/javascript">
ft08_siswasppgrid.Init();
</script>
<?php } ?>
<?php
$t08_siswaspp_grid->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php
$t08_siswaspp_grid->Page_Terminate();
?>
