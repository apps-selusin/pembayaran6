<?php include_once "t96_employeesinfo.php" ?>
<?php

// Create page object
if (!isset($t10_bayardetail_grid)) $t10_bayardetail_grid = new ct10_bayardetail_grid();

// Page init
$t10_bayardetail_grid->Page_Init();

// Page main
$t10_bayardetail_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t10_bayardetail_grid->Page_Render();
?>
<?php if ($t10_bayardetail->Export == "") { ?>
<script type="text/javascript">

// Form object
var ft10_bayardetailgrid = new ew_Form("ft10_bayardetailgrid", "grid");
ft10_bayardetailgrid.FormKeyCountName = '<?php echo $t10_bayardetail_grid->FormKeyCountName ?>';

// Validate form
ft10_bayardetailgrid.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_siswaspp_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t10_bayardetail->siswaspp_id->FldCaption(), $t10_bayardetail->siswaspp_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_siswaspp_id");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t10_bayardetail->siswaspp_id->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_Jumlah");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t10_bayardetail->Jumlah->FldCaption(), $t10_bayardetail->Jumlah->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Jumlah");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t10_bayardetail->Jumlah->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
ft10_bayardetailgrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "siswaspp_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "Keterangan", false)) return false;
	if (ew_ValueChanged(fobj, infix, "Keterangan2", false)) return false;
	if (ew_ValueChanged(fobj, infix, "Keterangan3", false)) return false;
	if (ew_ValueChanged(fobj, infix, "Jumlah", false)) return false;
	return true;
}

// Form_CustomValidate event
ft10_bayardetailgrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft10_bayardetailgrid.ValidateRequired = true;
<?php } else { ?>
ft10_bayardetailgrid.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
ft10_bayardetailgrid.Lists["x_siswaspp_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_SPP","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"v01_siswaspp"};
ft10_bayardetailgrid.Lists["x_Keterangan2"] = {"LinkField":"x_Periode","Ajax":true,"AutoFill":false,"DisplayFields":["x_Periode","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t95_periode"};

// Form object for search
</script>
<?php } ?>
<?php
if ($t10_bayardetail->CurrentAction == "gridadd") {
	if ($t10_bayardetail->CurrentMode == "copy") {
		$bSelectLimit = $t10_bayardetail_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$t10_bayardetail_grid->TotalRecs = $t10_bayardetail->SelectRecordCount();
			$t10_bayardetail_grid->Recordset = $t10_bayardetail_grid->LoadRecordset($t10_bayardetail_grid->StartRec-1, $t10_bayardetail_grid->DisplayRecs);
		} else {
			if ($t10_bayardetail_grid->Recordset = $t10_bayardetail_grid->LoadRecordset())
				$t10_bayardetail_grid->TotalRecs = $t10_bayardetail_grid->Recordset->RecordCount();
		}
		$t10_bayardetail_grid->StartRec = 1;
		$t10_bayardetail_grid->DisplayRecs = $t10_bayardetail_grid->TotalRecs;
	} else {
		$t10_bayardetail->CurrentFilter = "0=1";
		$t10_bayardetail_grid->StartRec = 1;
		$t10_bayardetail_grid->DisplayRecs = $t10_bayardetail->GridAddRowCount;
	}
	$t10_bayardetail_grid->TotalRecs = $t10_bayardetail_grid->DisplayRecs;
	$t10_bayardetail_grid->StopRec = $t10_bayardetail_grid->DisplayRecs;
} else {
	$bSelectLimit = $t10_bayardetail_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($t10_bayardetail_grid->TotalRecs <= 0)
			$t10_bayardetail_grid->TotalRecs = $t10_bayardetail->SelectRecordCount();
	} else {
		if (!$t10_bayardetail_grid->Recordset && ($t10_bayardetail_grid->Recordset = $t10_bayardetail_grid->LoadRecordset()))
			$t10_bayardetail_grid->TotalRecs = $t10_bayardetail_grid->Recordset->RecordCount();
	}
	$t10_bayardetail_grid->StartRec = 1;
	$t10_bayardetail_grid->DisplayRecs = $t10_bayardetail_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$t10_bayardetail_grid->Recordset = $t10_bayardetail_grid->LoadRecordset($t10_bayardetail_grid->StartRec-1, $t10_bayardetail_grid->DisplayRecs);

	// Set no record found message
	if ($t10_bayardetail->CurrentAction == "" && $t10_bayardetail_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$t10_bayardetail_grid->setWarningMessage(ew_DeniedMsg());
		if ($t10_bayardetail_grid->SearchWhere == "0=101")
			$t10_bayardetail_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$t10_bayardetail_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$t10_bayardetail_grid->RenderOtherOptions();
?>
<?php $t10_bayardetail_grid->ShowPageHeader(); ?>
<?php
$t10_bayardetail_grid->ShowMessage();
?>
<?php if ($t10_bayardetail_grid->TotalRecs > 0 || $t10_bayardetail->CurrentAction <> "") { ?>
<div class="panel panel-default ewGrid t10_bayardetail">
<div id="ft10_bayardetailgrid" class="ewForm form-inline">
<div id="gmp_t10_bayardetail" class="<?php if (ew_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<table id="tbl_t10_bayardetailgrid" class="table ewTable">
<?php echo $t10_bayardetail->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Header row
$t10_bayardetail_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$t10_bayardetail_grid->RenderListOptions();

// Render list options (header, left)
$t10_bayardetail_grid->ListOptions->Render("header", "left");
?>
<?php if ($t10_bayardetail->siswaspp_id->Visible) { // siswaspp_id ?>
	<?php if ($t10_bayardetail->SortUrl($t10_bayardetail->siswaspp_id) == "") { ?>
		<th data-name="siswaspp_id"><div id="elh_t10_bayardetail_siswaspp_id" class="t10_bayardetail_siswaspp_id"><div class="ewTableHeaderCaption"><?php echo $t10_bayardetail->siswaspp_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="siswaspp_id"><div><div id="elh_t10_bayardetail_siswaspp_id" class="t10_bayardetail_siswaspp_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t10_bayardetail->siswaspp_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t10_bayardetail->siswaspp_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t10_bayardetail->siswaspp_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t10_bayardetail->Keterangan->Visible) { // Keterangan ?>
	<?php if ($t10_bayardetail->SortUrl($t10_bayardetail->Keterangan) == "") { ?>
		<th data-name="Keterangan"><div id="elh_t10_bayardetail_Keterangan" class="t10_bayardetail_Keterangan"><div class="ewTableHeaderCaption"><?php echo $t10_bayardetail->Keterangan->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Keterangan"><div><div id="elh_t10_bayardetail_Keterangan" class="t10_bayardetail_Keterangan">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t10_bayardetail->Keterangan->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t10_bayardetail->Keterangan->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t10_bayardetail->Keterangan->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t10_bayardetail->Keterangan2->Visible) { // Keterangan2 ?>
	<?php if ($t10_bayardetail->SortUrl($t10_bayardetail->Keterangan2) == "") { ?>
		<th data-name="Keterangan2"><div id="elh_t10_bayardetail_Keterangan2" class="t10_bayardetail_Keterangan2"><div class="ewTableHeaderCaption"><?php echo $t10_bayardetail->Keterangan2->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Keterangan2"><div><div id="elh_t10_bayardetail_Keterangan2" class="t10_bayardetail_Keterangan2">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t10_bayardetail->Keterangan2->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t10_bayardetail->Keterangan2->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t10_bayardetail->Keterangan2->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t10_bayardetail->Keterangan3->Visible) { // Keterangan3 ?>
	<?php if ($t10_bayardetail->SortUrl($t10_bayardetail->Keterangan3) == "") { ?>
		<th data-name="Keterangan3"><div id="elh_t10_bayardetail_Keterangan3" class="t10_bayardetail_Keterangan3"><div class="ewTableHeaderCaption"><?php echo $t10_bayardetail->Keterangan3->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Keterangan3"><div><div id="elh_t10_bayardetail_Keterangan3" class="t10_bayardetail_Keterangan3">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t10_bayardetail->Keterangan3->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t10_bayardetail->Keterangan3->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t10_bayardetail->Keterangan3->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t10_bayardetail->Jumlah->Visible) { // Jumlah ?>
	<?php if ($t10_bayardetail->SortUrl($t10_bayardetail->Jumlah) == "") { ?>
		<th data-name="Jumlah"><div id="elh_t10_bayardetail_Jumlah" class="t10_bayardetail_Jumlah"><div class="ewTableHeaderCaption"><?php echo $t10_bayardetail->Jumlah->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Jumlah"><div><div id="elh_t10_bayardetail_Jumlah" class="t10_bayardetail_Jumlah">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t10_bayardetail->Jumlah->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t10_bayardetail->Jumlah->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t10_bayardetail->Jumlah->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$t10_bayardetail_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$t10_bayardetail_grid->StartRec = 1;
$t10_bayardetail_grid->StopRec = $t10_bayardetail_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($t10_bayardetail_grid->FormKeyCountName) && ($t10_bayardetail->CurrentAction == "gridadd" || $t10_bayardetail->CurrentAction == "gridedit" || $t10_bayardetail->CurrentAction == "F")) {
		$t10_bayardetail_grid->KeyCount = $objForm->GetValue($t10_bayardetail_grid->FormKeyCountName);
		$t10_bayardetail_grid->StopRec = $t10_bayardetail_grid->StartRec + $t10_bayardetail_grid->KeyCount - 1;
	}
}
$t10_bayardetail_grid->RecCnt = $t10_bayardetail_grid->StartRec - 1;
if ($t10_bayardetail_grid->Recordset && !$t10_bayardetail_grid->Recordset->EOF) {
	$t10_bayardetail_grid->Recordset->MoveFirst();
	$bSelectLimit = $t10_bayardetail_grid->UseSelectLimit;
	if (!$bSelectLimit && $t10_bayardetail_grid->StartRec > 1)
		$t10_bayardetail_grid->Recordset->Move($t10_bayardetail_grid->StartRec - 1);
} elseif (!$t10_bayardetail->AllowAddDeleteRow && $t10_bayardetail_grid->StopRec == 0) {
	$t10_bayardetail_grid->StopRec = $t10_bayardetail->GridAddRowCount;
}

// Initialize aggregate
$t10_bayardetail->RowType = EW_ROWTYPE_AGGREGATEINIT;
$t10_bayardetail->ResetAttrs();
$t10_bayardetail_grid->RenderRow();
if ($t10_bayardetail->CurrentAction == "gridadd")
	$t10_bayardetail_grid->RowIndex = 0;
if ($t10_bayardetail->CurrentAction == "gridedit")
	$t10_bayardetail_grid->RowIndex = 0;
while ($t10_bayardetail_grid->RecCnt < $t10_bayardetail_grid->StopRec) {
	$t10_bayardetail_grid->RecCnt++;
	if (intval($t10_bayardetail_grid->RecCnt) >= intval($t10_bayardetail_grid->StartRec)) {
		$t10_bayardetail_grid->RowCnt++;
		if ($t10_bayardetail->CurrentAction == "gridadd" || $t10_bayardetail->CurrentAction == "gridedit" || $t10_bayardetail->CurrentAction == "F") {
			$t10_bayardetail_grid->RowIndex++;
			$objForm->Index = $t10_bayardetail_grid->RowIndex;
			if ($objForm->HasValue($t10_bayardetail_grid->FormActionName))
				$t10_bayardetail_grid->RowAction = strval($objForm->GetValue($t10_bayardetail_grid->FormActionName));
			elseif ($t10_bayardetail->CurrentAction == "gridadd")
				$t10_bayardetail_grid->RowAction = "insert";
			else
				$t10_bayardetail_grid->RowAction = "";
		}

		// Set up key count
		$t10_bayardetail_grid->KeyCount = $t10_bayardetail_grid->RowIndex;

		// Init row class and style
		$t10_bayardetail->ResetAttrs();
		$t10_bayardetail->CssClass = "";
		if ($t10_bayardetail->CurrentAction == "gridadd") {
			if ($t10_bayardetail->CurrentMode == "copy") {
				$t10_bayardetail_grid->LoadRowValues($t10_bayardetail_grid->Recordset); // Load row values
				$t10_bayardetail_grid->SetRecordKey($t10_bayardetail_grid->RowOldKey, $t10_bayardetail_grid->Recordset); // Set old record key
			} else {
				$t10_bayardetail_grid->LoadDefaultValues(); // Load default values
				$t10_bayardetail_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$t10_bayardetail_grid->LoadRowValues($t10_bayardetail_grid->Recordset); // Load row values
		}
		$t10_bayardetail->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($t10_bayardetail->CurrentAction == "gridadd") // Grid add
			$t10_bayardetail->RowType = EW_ROWTYPE_ADD; // Render add
		if ($t10_bayardetail->CurrentAction == "gridadd" && $t10_bayardetail->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$t10_bayardetail_grid->RestoreCurrentRowFormValues($t10_bayardetail_grid->RowIndex); // Restore form values
		if ($t10_bayardetail->CurrentAction == "gridedit") { // Grid edit
			if ($t10_bayardetail->EventCancelled) {
				$t10_bayardetail_grid->RestoreCurrentRowFormValues($t10_bayardetail_grid->RowIndex); // Restore form values
			}
			if ($t10_bayardetail_grid->RowAction == "insert")
				$t10_bayardetail->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$t10_bayardetail->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($t10_bayardetail->CurrentAction == "gridedit" && ($t10_bayardetail->RowType == EW_ROWTYPE_EDIT || $t10_bayardetail->RowType == EW_ROWTYPE_ADD) && $t10_bayardetail->EventCancelled) // Update failed
			$t10_bayardetail_grid->RestoreCurrentRowFormValues($t10_bayardetail_grid->RowIndex); // Restore form values
		if ($t10_bayardetail->RowType == EW_ROWTYPE_EDIT) // Edit row
			$t10_bayardetail_grid->EditRowCnt++;
		if ($t10_bayardetail->CurrentAction == "F") // Confirm row
			$t10_bayardetail_grid->RestoreCurrentRowFormValues($t10_bayardetail_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$t10_bayardetail->RowAttrs = array_merge($t10_bayardetail->RowAttrs, array('data-rowindex'=>$t10_bayardetail_grid->RowCnt, 'id'=>'r' . $t10_bayardetail_grid->RowCnt . '_t10_bayardetail', 'data-rowtype'=>$t10_bayardetail->RowType));

		// Render row
		$t10_bayardetail_grid->RenderRow();

		// Render list options
		$t10_bayardetail_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($t10_bayardetail_grid->RowAction <> "delete" && $t10_bayardetail_grid->RowAction <> "insertdelete" && !($t10_bayardetail_grid->RowAction == "insert" && $t10_bayardetail->CurrentAction == "F" && $t10_bayardetail_grid->EmptyRow())) {
?>
	<tr<?php echo $t10_bayardetail->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t10_bayardetail_grid->ListOptions->Render("body", "left", $t10_bayardetail_grid->RowCnt);
?>
	<?php if ($t10_bayardetail->siswaspp_id->Visible) { // siswaspp_id ?>
		<td data-name="siswaspp_id"<?php echo $t10_bayardetail->siswaspp_id->CellAttributes() ?>>
<?php if ($t10_bayardetail->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t10_bayardetail_grid->RowCnt ?>_t10_bayardetail_siswaspp_id" class="form-group t10_bayardetail_siswaspp_id">
<?php
$wrkonchange = trim(" " . @$t10_bayardetail->siswaspp_id->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$t10_bayardetail->siswaspp_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t10_bayardetail_grid->RowIndex ?>_siswaspp_id" style="white-space: nowrap; z-index: <?php echo (9000 - $t10_bayardetail_grid->RowCnt * 10) ?>">
	<input type="text" name="sv_x<?php echo $t10_bayardetail_grid->RowIndex ?>_siswaspp_id" id="sv_x<?php echo $t10_bayardetail_grid->RowIndex ?>_siswaspp_id" value="<?php echo $t10_bayardetail->siswaspp_id->EditValue ?>" size="30" placeholder="<?php echo ew_HtmlEncode($t10_bayardetail->siswaspp_id->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($t10_bayardetail->siswaspp_id->getPlaceHolder()) ?>"<?php echo $t10_bayardetail->siswaspp_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t10_bayardetail" data-field="x_siswaspp_id" data-value-separator="<?php echo $t10_bayardetail->siswaspp_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t10_bayardetail_grid->RowIndex ?>_siswaspp_id" id="x<?php echo $t10_bayardetail_grid->RowIndex ?>_siswaspp_id" value="<?php echo ew_HtmlEncode($t10_bayardetail->siswaspp_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<input type="hidden" name="q_x<?php echo $t10_bayardetail_grid->RowIndex ?>_siswaspp_id" id="q_x<?php echo $t10_bayardetail_grid->RowIndex ?>_siswaspp_id" value="<?php echo $t10_bayardetail->siswaspp_id->LookupFilterQuery(true) ?>">
<script type="text/javascript">
ft10_bayardetailgrid.CreateAutoSuggest({"id":"x<?php echo $t10_bayardetail_grid->RowIndex ?>_siswaspp_id","forceSelect":false});
</script>
</span>
<input type="hidden" data-table="t10_bayardetail" data-field="x_siswaspp_id" name="o<?php echo $t10_bayardetail_grid->RowIndex ?>_siswaspp_id" id="o<?php echo $t10_bayardetail_grid->RowIndex ?>_siswaspp_id" value="<?php echo ew_HtmlEncode($t10_bayardetail->siswaspp_id->OldValue) ?>">
<?php } ?>
<?php if ($t10_bayardetail->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t10_bayardetail_grid->RowCnt ?>_t10_bayardetail_siswaspp_id" class="form-group t10_bayardetail_siswaspp_id">
<?php
$wrkonchange = trim(" " . @$t10_bayardetail->siswaspp_id->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$t10_bayardetail->siswaspp_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t10_bayardetail_grid->RowIndex ?>_siswaspp_id" style="white-space: nowrap; z-index: <?php echo (9000 - $t10_bayardetail_grid->RowCnt * 10) ?>">
	<input type="text" name="sv_x<?php echo $t10_bayardetail_grid->RowIndex ?>_siswaspp_id" id="sv_x<?php echo $t10_bayardetail_grid->RowIndex ?>_siswaspp_id" value="<?php echo $t10_bayardetail->siswaspp_id->EditValue ?>" size="30" placeholder="<?php echo ew_HtmlEncode($t10_bayardetail->siswaspp_id->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($t10_bayardetail->siswaspp_id->getPlaceHolder()) ?>"<?php echo $t10_bayardetail->siswaspp_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t10_bayardetail" data-field="x_siswaspp_id" data-value-separator="<?php echo $t10_bayardetail->siswaspp_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t10_bayardetail_grid->RowIndex ?>_siswaspp_id" id="x<?php echo $t10_bayardetail_grid->RowIndex ?>_siswaspp_id" value="<?php echo ew_HtmlEncode($t10_bayardetail->siswaspp_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<input type="hidden" name="q_x<?php echo $t10_bayardetail_grid->RowIndex ?>_siswaspp_id" id="q_x<?php echo $t10_bayardetail_grid->RowIndex ?>_siswaspp_id" value="<?php echo $t10_bayardetail->siswaspp_id->LookupFilterQuery(true) ?>">
<script type="text/javascript">
ft10_bayardetailgrid.CreateAutoSuggest({"id":"x<?php echo $t10_bayardetail_grid->RowIndex ?>_siswaspp_id","forceSelect":false});
</script>
</span>
<?php } ?>
<?php if ($t10_bayardetail->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t10_bayardetail_grid->RowCnt ?>_t10_bayardetail_siswaspp_id" class="t10_bayardetail_siswaspp_id">
<span<?php echo $t10_bayardetail->siswaspp_id->ViewAttributes() ?>>
<?php echo $t10_bayardetail->siswaspp_id->ListViewValue() ?></span>
</span>
<?php if ($t10_bayardetail->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t10_bayardetail" data-field="x_siswaspp_id" name="x<?php echo $t10_bayardetail_grid->RowIndex ?>_siswaspp_id" id="x<?php echo $t10_bayardetail_grid->RowIndex ?>_siswaspp_id" value="<?php echo ew_HtmlEncode($t10_bayardetail->siswaspp_id->FormValue) ?>">
<input type="hidden" data-table="t10_bayardetail" data-field="x_siswaspp_id" name="o<?php echo $t10_bayardetail_grid->RowIndex ?>_siswaspp_id" id="o<?php echo $t10_bayardetail_grid->RowIndex ?>_siswaspp_id" value="<?php echo ew_HtmlEncode($t10_bayardetail->siswaspp_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t10_bayardetail" data-field="x_siswaspp_id" name="ft10_bayardetailgrid$x<?php echo $t10_bayardetail_grid->RowIndex ?>_siswaspp_id" id="ft10_bayardetailgrid$x<?php echo $t10_bayardetail_grid->RowIndex ?>_siswaspp_id" value="<?php echo ew_HtmlEncode($t10_bayardetail->siswaspp_id->FormValue) ?>">
<input type="hidden" data-table="t10_bayardetail" data-field="x_siswaspp_id" name="ft10_bayardetailgrid$o<?php echo $t10_bayardetail_grid->RowIndex ?>_siswaspp_id" id="ft10_bayardetailgrid$o<?php echo $t10_bayardetail_grid->RowIndex ?>_siswaspp_id" value="<?php echo ew_HtmlEncode($t10_bayardetail->siswaspp_id->OldValue) ?>">
<?php } ?>
<?php } ?>
<a id="<?php echo $t10_bayardetail_grid->PageObjName . "_row_" . $t10_bayardetail_grid->RowCnt ?>"></a></td>
	<?php } ?>
<?php if ($t10_bayardetail->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="t10_bayardetail" data-field="x_id" name="x<?php echo $t10_bayardetail_grid->RowIndex ?>_id" id="x<?php echo $t10_bayardetail_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t10_bayardetail->id->CurrentValue) ?>">
<input type="hidden" data-table="t10_bayardetail" data-field="x_id" name="o<?php echo $t10_bayardetail_grid->RowIndex ?>_id" id="o<?php echo $t10_bayardetail_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t10_bayardetail->id->OldValue) ?>">
<?php } ?>
<?php if ($t10_bayardetail->RowType == EW_ROWTYPE_EDIT || $t10_bayardetail->CurrentMode == "edit") { ?>
<input type="hidden" data-table="t10_bayardetail" data-field="x_id" name="x<?php echo $t10_bayardetail_grid->RowIndex ?>_id" id="x<?php echo $t10_bayardetail_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t10_bayardetail->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($t10_bayardetail->Keterangan->Visible) { // Keterangan ?>
		<td data-name="Keterangan"<?php echo $t10_bayardetail->Keterangan->CellAttributes() ?>>
<?php if ($t10_bayardetail->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t10_bayardetail_grid->RowCnt ?>_t10_bayardetail_Keterangan" class="form-group t10_bayardetail_Keterangan">
<input type="text" data-table="t10_bayardetail" data-field="x_Keterangan" name="x<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan" id="x<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($t10_bayardetail->Keterangan->getPlaceHolder()) ?>" value="<?php echo $t10_bayardetail->Keterangan->EditValue ?>"<?php echo $t10_bayardetail->Keterangan->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t10_bayardetail" data-field="x_Keterangan" name="o<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan" id="o<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan" value="<?php echo ew_HtmlEncode($t10_bayardetail->Keterangan->OldValue) ?>">
<?php } ?>
<?php if ($t10_bayardetail->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t10_bayardetail_grid->RowCnt ?>_t10_bayardetail_Keterangan" class="form-group t10_bayardetail_Keterangan">
<input type="text" data-table="t10_bayardetail" data-field="x_Keterangan" name="x<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan" id="x<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($t10_bayardetail->Keterangan->getPlaceHolder()) ?>" value="<?php echo $t10_bayardetail->Keterangan->EditValue ?>"<?php echo $t10_bayardetail->Keterangan->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t10_bayardetail->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t10_bayardetail_grid->RowCnt ?>_t10_bayardetail_Keterangan" class="t10_bayardetail_Keterangan">
<span<?php echo $t10_bayardetail->Keterangan->ViewAttributes() ?>>
<?php echo $t10_bayardetail->Keterangan->ListViewValue() ?></span>
</span>
<?php if ($t10_bayardetail->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t10_bayardetail" data-field="x_Keterangan" name="x<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan" id="x<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan" value="<?php echo ew_HtmlEncode($t10_bayardetail->Keterangan->FormValue) ?>">
<input type="hidden" data-table="t10_bayardetail" data-field="x_Keterangan" name="o<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan" id="o<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan" value="<?php echo ew_HtmlEncode($t10_bayardetail->Keterangan->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t10_bayardetail" data-field="x_Keterangan" name="ft10_bayardetailgrid$x<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan" id="ft10_bayardetailgrid$x<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan" value="<?php echo ew_HtmlEncode($t10_bayardetail->Keterangan->FormValue) ?>">
<input type="hidden" data-table="t10_bayardetail" data-field="x_Keterangan" name="ft10_bayardetailgrid$o<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan" id="ft10_bayardetailgrid$o<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan" value="<?php echo ew_HtmlEncode($t10_bayardetail->Keterangan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t10_bayardetail->Keterangan2->Visible) { // Keterangan2 ?>
		<td data-name="Keterangan2"<?php echo $t10_bayardetail->Keterangan2->CellAttributes() ?>>
<?php if ($t10_bayardetail->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t10_bayardetail_grid->RowCnt ?>_t10_bayardetail_Keterangan2" class="form-group t10_bayardetail_Keterangan2">
<select data-table="t10_bayardetail" data-field="x_Keterangan2" data-value-separator="<?php echo $t10_bayardetail->Keterangan2->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan2" name="x<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan2"<?php echo $t10_bayardetail->Keterangan2->EditAttributes() ?>>
<?php echo $t10_bayardetail->Keterangan2->SelectOptionListHtml("x<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan2") ?>
</select>
<input type="hidden" name="s_x<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan2" id="s_x<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan2" value="<?php echo $t10_bayardetail->Keterangan2->LookupFilterQuery() ?>">
</span>
<input type="hidden" data-table="t10_bayardetail" data-field="x_Keterangan2" name="o<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan2" id="o<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan2" value="<?php echo ew_HtmlEncode($t10_bayardetail->Keterangan2->OldValue) ?>">
<?php } ?>
<?php if ($t10_bayardetail->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t10_bayardetail_grid->RowCnt ?>_t10_bayardetail_Keterangan2" class="form-group t10_bayardetail_Keterangan2">
<select data-table="t10_bayardetail" data-field="x_Keterangan2" data-value-separator="<?php echo $t10_bayardetail->Keterangan2->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan2" name="x<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan2"<?php echo $t10_bayardetail->Keterangan2->EditAttributes() ?>>
<?php echo $t10_bayardetail->Keterangan2->SelectOptionListHtml("x<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan2") ?>
</select>
<input type="hidden" name="s_x<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan2" id="s_x<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan2" value="<?php echo $t10_bayardetail->Keterangan2->LookupFilterQuery() ?>">
</span>
<?php } ?>
<?php if ($t10_bayardetail->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t10_bayardetail_grid->RowCnt ?>_t10_bayardetail_Keterangan2" class="t10_bayardetail_Keterangan2">
<span<?php echo $t10_bayardetail->Keterangan2->ViewAttributes() ?>>
<?php echo $t10_bayardetail->Keterangan2->ListViewValue() ?></span>
</span>
<?php if ($t10_bayardetail->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t10_bayardetail" data-field="x_Keterangan2" name="x<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan2" id="x<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan2" value="<?php echo ew_HtmlEncode($t10_bayardetail->Keterangan2->FormValue) ?>">
<input type="hidden" data-table="t10_bayardetail" data-field="x_Keterangan2" name="o<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan2" id="o<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan2" value="<?php echo ew_HtmlEncode($t10_bayardetail->Keterangan2->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t10_bayardetail" data-field="x_Keterangan2" name="ft10_bayardetailgrid$x<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan2" id="ft10_bayardetailgrid$x<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan2" value="<?php echo ew_HtmlEncode($t10_bayardetail->Keterangan2->FormValue) ?>">
<input type="hidden" data-table="t10_bayardetail" data-field="x_Keterangan2" name="ft10_bayardetailgrid$o<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan2" id="ft10_bayardetailgrid$o<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan2" value="<?php echo ew_HtmlEncode($t10_bayardetail->Keterangan2->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t10_bayardetail->Keterangan3->Visible) { // Keterangan3 ?>
		<td data-name="Keterangan3"<?php echo $t10_bayardetail->Keterangan3->CellAttributes() ?>>
<?php if ($t10_bayardetail->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t10_bayardetail_grid->RowCnt ?>_t10_bayardetail_Keterangan3" class="form-group t10_bayardetail_Keterangan3">
<input type="text" data-table="t10_bayardetail" data-field="x_Keterangan3" name="x<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan3" id="x<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan3" size="10" maxlength="100" placeholder="<?php echo ew_HtmlEncode($t10_bayardetail->Keterangan3->getPlaceHolder()) ?>" value="<?php echo $t10_bayardetail->Keterangan3->EditValue ?>"<?php echo $t10_bayardetail->Keterangan3->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t10_bayardetail" data-field="x_Keterangan3" name="o<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan3" id="o<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan3" value="<?php echo ew_HtmlEncode($t10_bayardetail->Keterangan3->OldValue) ?>">
<?php } ?>
<?php if ($t10_bayardetail->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t10_bayardetail_grid->RowCnt ?>_t10_bayardetail_Keterangan3" class="form-group t10_bayardetail_Keterangan3">
<input type="text" data-table="t10_bayardetail" data-field="x_Keterangan3" name="x<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan3" id="x<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan3" size="10" maxlength="100" placeholder="<?php echo ew_HtmlEncode($t10_bayardetail->Keterangan3->getPlaceHolder()) ?>" value="<?php echo $t10_bayardetail->Keterangan3->EditValue ?>"<?php echo $t10_bayardetail->Keterangan3->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t10_bayardetail->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t10_bayardetail_grid->RowCnt ?>_t10_bayardetail_Keterangan3" class="t10_bayardetail_Keterangan3">
<span<?php echo $t10_bayardetail->Keterangan3->ViewAttributes() ?>>
<?php echo $t10_bayardetail->Keterangan3->ListViewValue() ?></span>
</span>
<?php if ($t10_bayardetail->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t10_bayardetail" data-field="x_Keterangan3" name="x<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan3" id="x<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan3" value="<?php echo ew_HtmlEncode($t10_bayardetail->Keterangan3->FormValue) ?>">
<input type="hidden" data-table="t10_bayardetail" data-field="x_Keterangan3" name="o<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan3" id="o<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan3" value="<?php echo ew_HtmlEncode($t10_bayardetail->Keterangan3->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t10_bayardetail" data-field="x_Keterangan3" name="ft10_bayardetailgrid$x<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan3" id="ft10_bayardetailgrid$x<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan3" value="<?php echo ew_HtmlEncode($t10_bayardetail->Keterangan3->FormValue) ?>">
<input type="hidden" data-table="t10_bayardetail" data-field="x_Keterangan3" name="ft10_bayardetailgrid$o<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan3" id="ft10_bayardetailgrid$o<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan3" value="<?php echo ew_HtmlEncode($t10_bayardetail->Keterangan3->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t10_bayardetail->Jumlah->Visible) { // Jumlah ?>
		<td data-name="Jumlah"<?php echo $t10_bayardetail->Jumlah->CellAttributes() ?>>
<?php if ($t10_bayardetail->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t10_bayardetail_grid->RowCnt ?>_t10_bayardetail_Jumlah" class="form-group t10_bayardetail_Jumlah">
<input type="text" data-table="t10_bayardetail" data-field="x_Jumlah" name="x<?php echo $t10_bayardetail_grid->RowIndex ?>_Jumlah" id="x<?php echo $t10_bayardetail_grid->RowIndex ?>_Jumlah" size="30" placeholder="<?php echo ew_HtmlEncode($t10_bayardetail->Jumlah->getPlaceHolder()) ?>" value="<?php echo $t10_bayardetail->Jumlah->EditValue ?>"<?php echo $t10_bayardetail->Jumlah->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t10_bayardetail" data-field="x_Jumlah" name="o<?php echo $t10_bayardetail_grid->RowIndex ?>_Jumlah" id="o<?php echo $t10_bayardetail_grid->RowIndex ?>_Jumlah" value="<?php echo ew_HtmlEncode($t10_bayardetail->Jumlah->OldValue) ?>">
<?php } ?>
<?php if ($t10_bayardetail->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t10_bayardetail_grid->RowCnt ?>_t10_bayardetail_Jumlah" class="form-group t10_bayardetail_Jumlah">
<input type="text" data-table="t10_bayardetail" data-field="x_Jumlah" name="x<?php echo $t10_bayardetail_grid->RowIndex ?>_Jumlah" id="x<?php echo $t10_bayardetail_grid->RowIndex ?>_Jumlah" size="30" placeholder="<?php echo ew_HtmlEncode($t10_bayardetail->Jumlah->getPlaceHolder()) ?>" value="<?php echo $t10_bayardetail->Jumlah->EditValue ?>"<?php echo $t10_bayardetail->Jumlah->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t10_bayardetail->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t10_bayardetail_grid->RowCnt ?>_t10_bayardetail_Jumlah" class="t10_bayardetail_Jumlah">
<span<?php echo $t10_bayardetail->Jumlah->ViewAttributes() ?>>
<?php echo $t10_bayardetail->Jumlah->ListViewValue() ?></span>
</span>
<?php if ($t10_bayardetail->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t10_bayardetail" data-field="x_Jumlah" name="x<?php echo $t10_bayardetail_grid->RowIndex ?>_Jumlah" id="x<?php echo $t10_bayardetail_grid->RowIndex ?>_Jumlah" value="<?php echo ew_HtmlEncode($t10_bayardetail->Jumlah->FormValue) ?>">
<input type="hidden" data-table="t10_bayardetail" data-field="x_Jumlah" name="o<?php echo $t10_bayardetail_grid->RowIndex ?>_Jumlah" id="o<?php echo $t10_bayardetail_grid->RowIndex ?>_Jumlah" value="<?php echo ew_HtmlEncode($t10_bayardetail->Jumlah->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t10_bayardetail" data-field="x_Jumlah" name="ft10_bayardetailgrid$x<?php echo $t10_bayardetail_grid->RowIndex ?>_Jumlah" id="ft10_bayardetailgrid$x<?php echo $t10_bayardetail_grid->RowIndex ?>_Jumlah" value="<?php echo ew_HtmlEncode($t10_bayardetail->Jumlah->FormValue) ?>">
<input type="hidden" data-table="t10_bayardetail" data-field="x_Jumlah" name="ft10_bayardetailgrid$o<?php echo $t10_bayardetail_grid->RowIndex ?>_Jumlah" id="ft10_bayardetailgrid$o<?php echo $t10_bayardetail_grid->RowIndex ?>_Jumlah" value="<?php echo ew_HtmlEncode($t10_bayardetail->Jumlah->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t10_bayardetail_grid->ListOptions->Render("body", "right", $t10_bayardetail_grid->RowCnt);
?>
	</tr>
<?php if ($t10_bayardetail->RowType == EW_ROWTYPE_ADD || $t10_bayardetail->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
ft10_bayardetailgrid.UpdateOpts(<?php echo $t10_bayardetail_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($t10_bayardetail->CurrentAction <> "gridadd" || $t10_bayardetail->CurrentMode == "copy")
		if (!$t10_bayardetail_grid->Recordset->EOF) $t10_bayardetail_grid->Recordset->MoveNext();
}
?>
<?php
	if ($t10_bayardetail->CurrentMode == "add" || $t10_bayardetail->CurrentMode == "copy" || $t10_bayardetail->CurrentMode == "edit") {
		$t10_bayardetail_grid->RowIndex = '$rowindex$';
		$t10_bayardetail_grid->LoadDefaultValues();

		// Set row properties
		$t10_bayardetail->ResetAttrs();
		$t10_bayardetail->RowAttrs = array_merge($t10_bayardetail->RowAttrs, array('data-rowindex'=>$t10_bayardetail_grid->RowIndex, 'id'=>'r0_t10_bayardetail', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($t10_bayardetail->RowAttrs["class"], "ewTemplate");
		$t10_bayardetail->RowType = EW_ROWTYPE_ADD;

		// Render row
		$t10_bayardetail_grid->RenderRow();

		// Render list options
		$t10_bayardetail_grid->RenderListOptions();
		$t10_bayardetail_grid->StartRowCnt = 0;
?>
	<tr<?php echo $t10_bayardetail->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t10_bayardetail_grid->ListOptions->Render("body", "left", $t10_bayardetail_grid->RowIndex);
?>
	<?php if ($t10_bayardetail->siswaspp_id->Visible) { // siswaspp_id ?>
		<td data-name="siswaspp_id">
<?php if ($t10_bayardetail->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t10_bayardetail_siswaspp_id" class="form-group t10_bayardetail_siswaspp_id">
<?php
$wrkonchange = trim(" " . @$t10_bayardetail->siswaspp_id->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$t10_bayardetail->siswaspp_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t10_bayardetail_grid->RowIndex ?>_siswaspp_id" style="white-space: nowrap; z-index: <?php echo (9000 - $t10_bayardetail_grid->RowCnt * 10) ?>">
	<input type="text" name="sv_x<?php echo $t10_bayardetail_grid->RowIndex ?>_siswaspp_id" id="sv_x<?php echo $t10_bayardetail_grid->RowIndex ?>_siswaspp_id" value="<?php echo $t10_bayardetail->siswaspp_id->EditValue ?>" size="30" placeholder="<?php echo ew_HtmlEncode($t10_bayardetail->siswaspp_id->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($t10_bayardetail->siswaspp_id->getPlaceHolder()) ?>"<?php echo $t10_bayardetail->siswaspp_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t10_bayardetail" data-field="x_siswaspp_id" data-value-separator="<?php echo $t10_bayardetail->siswaspp_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t10_bayardetail_grid->RowIndex ?>_siswaspp_id" id="x<?php echo $t10_bayardetail_grid->RowIndex ?>_siswaspp_id" value="<?php echo ew_HtmlEncode($t10_bayardetail->siswaspp_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<input type="hidden" name="q_x<?php echo $t10_bayardetail_grid->RowIndex ?>_siswaspp_id" id="q_x<?php echo $t10_bayardetail_grid->RowIndex ?>_siswaspp_id" value="<?php echo $t10_bayardetail->siswaspp_id->LookupFilterQuery(true) ?>">
<script type="text/javascript">
ft10_bayardetailgrid.CreateAutoSuggest({"id":"x<?php echo $t10_bayardetail_grid->RowIndex ?>_siswaspp_id","forceSelect":false});
</script>
</span>
<?php } else { ?>
<span id="el$rowindex$_t10_bayardetail_siswaspp_id" class="form-group t10_bayardetail_siswaspp_id">
<span<?php echo $t10_bayardetail->siswaspp_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t10_bayardetail->siswaspp_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t10_bayardetail" data-field="x_siswaspp_id" name="x<?php echo $t10_bayardetail_grid->RowIndex ?>_siswaspp_id" id="x<?php echo $t10_bayardetail_grid->RowIndex ?>_siswaspp_id" value="<?php echo ew_HtmlEncode($t10_bayardetail->siswaspp_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t10_bayardetail" data-field="x_siswaspp_id" name="o<?php echo $t10_bayardetail_grid->RowIndex ?>_siswaspp_id" id="o<?php echo $t10_bayardetail_grid->RowIndex ?>_siswaspp_id" value="<?php echo ew_HtmlEncode($t10_bayardetail->siswaspp_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t10_bayardetail->Keterangan->Visible) { // Keterangan ?>
		<td data-name="Keterangan">
<?php if ($t10_bayardetail->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t10_bayardetail_Keterangan" class="form-group t10_bayardetail_Keterangan">
<input type="text" data-table="t10_bayardetail" data-field="x_Keterangan" name="x<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan" id="x<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($t10_bayardetail->Keterangan->getPlaceHolder()) ?>" value="<?php echo $t10_bayardetail->Keterangan->EditValue ?>"<?php echo $t10_bayardetail->Keterangan->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t10_bayardetail_Keterangan" class="form-group t10_bayardetail_Keterangan">
<span<?php echo $t10_bayardetail->Keterangan->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t10_bayardetail->Keterangan->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t10_bayardetail" data-field="x_Keterangan" name="x<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan" id="x<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan" value="<?php echo ew_HtmlEncode($t10_bayardetail->Keterangan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t10_bayardetail" data-field="x_Keterangan" name="o<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan" id="o<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan" value="<?php echo ew_HtmlEncode($t10_bayardetail->Keterangan->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t10_bayardetail->Keterangan2->Visible) { // Keterangan2 ?>
		<td data-name="Keterangan2">
<?php if ($t10_bayardetail->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t10_bayardetail_Keterangan2" class="form-group t10_bayardetail_Keterangan2">
<select data-table="t10_bayardetail" data-field="x_Keterangan2" data-value-separator="<?php echo $t10_bayardetail->Keterangan2->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan2" name="x<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan2"<?php echo $t10_bayardetail->Keterangan2->EditAttributes() ?>>
<?php echo $t10_bayardetail->Keterangan2->SelectOptionListHtml("x<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan2") ?>
</select>
<input type="hidden" name="s_x<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan2" id="s_x<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan2" value="<?php echo $t10_bayardetail->Keterangan2->LookupFilterQuery() ?>">
</span>
<?php } else { ?>
<span id="el$rowindex$_t10_bayardetail_Keterangan2" class="form-group t10_bayardetail_Keterangan2">
<span<?php echo $t10_bayardetail->Keterangan2->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t10_bayardetail->Keterangan2->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t10_bayardetail" data-field="x_Keterangan2" name="x<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan2" id="x<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan2" value="<?php echo ew_HtmlEncode($t10_bayardetail->Keterangan2->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t10_bayardetail" data-field="x_Keterangan2" name="o<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan2" id="o<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan2" value="<?php echo ew_HtmlEncode($t10_bayardetail->Keterangan2->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t10_bayardetail->Keterangan3->Visible) { // Keterangan3 ?>
		<td data-name="Keterangan3">
<?php if ($t10_bayardetail->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t10_bayardetail_Keterangan3" class="form-group t10_bayardetail_Keterangan3">
<input type="text" data-table="t10_bayardetail" data-field="x_Keterangan3" name="x<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan3" id="x<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan3" size="10" maxlength="100" placeholder="<?php echo ew_HtmlEncode($t10_bayardetail->Keterangan3->getPlaceHolder()) ?>" value="<?php echo $t10_bayardetail->Keterangan3->EditValue ?>"<?php echo $t10_bayardetail->Keterangan3->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t10_bayardetail_Keterangan3" class="form-group t10_bayardetail_Keterangan3">
<span<?php echo $t10_bayardetail->Keterangan3->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t10_bayardetail->Keterangan3->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t10_bayardetail" data-field="x_Keterangan3" name="x<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan3" id="x<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan3" value="<?php echo ew_HtmlEncode($t10_bayardetail->Keterangan3->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t10_bayardetail" data-field="x_Keterangan3" name="o<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan3" id="o<?php echo $t10_bayardetail_grid->RowIndex ?>_Keterangan3" value="<?php echo ew_HtmlEncode($t10_bayardetail->Keterangan3->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t10_bayardetail->Jumlah->Visible) { // Jumlah ?>
		<td data-name="Jumlah">
<?php if ($t10_bayardetail->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t10_bayardetail_Jumlah" class="form-group t10_bayardetail_Jumlah">
<input type="text" data-table="t10_bayardetail" data-field="x_Jumlah" name="x<?php echo $t10_bayardetail_grid->RowIndex ?>_Jumlah" id="x<?php echo $t10_bayardetail_grid->RowIndex ?>_Jumlah" size="30" placeholder="<?php echo ew_HtmlEncode($t10_bayardetail->Jumlah->getPlaceHolder()) ?>" value="<?php echo $t10_bayardetail->Jumlah->EditValue ?>"<?php echo $t10_bayardetail->Jumlah->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t10_bayardetail_Jumlah" class="form-group t10_bayardetail_Jumlah">
<span<?php echo $t10_bayardetail->Jumlah->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t10_bayardetail->Jumlah->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t10_bayardetail" data-field="x_Jumlah" name="x<?php echo $t10_bayardetail_grid->RowIndex ?>_Jumlah" id="x<?php echo $t10_bayardetail_grid->RowIndex ?>_Jumlah" value="<?php echo ew_HtmlEncode($t10_bayardetail->Jumlah->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t10_bayardetail" data-field="x_Jumlah" name="o<?php echo $t10_bayardetail_grid->RowIndex ?>_Jumlah" id="o<?php echo $t10_bayardetail_grid->RowIndex ?>_Jumlah" value="<?php echo ew_HtmlEncode($t10_bayardetail->Jumlah->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t10_bayardetail_grid->ListOptions->Render("body", "right", $t10_bayardetail_grid->RowCnt);
?>
<script type="text/javascript">
ft10_bayardetailgrid.UpdateOpts(<?php echo $t10_bayardetail_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($t10_bayardetail->CurrentMode == "add" || $t10_bayardetail->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $t10_bayardetail_grid->FormKeyCountName ?>" id="<?php echo $t10_bayardetail_grid->FormKeyCountName ?>" value="<?php echo $t10_bayardetail_grid->KeyCount ?>">
<?php echo $t10_bayardetail_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t10_bayardetail->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $t10_bayardetail_grid->FormKeyCountName ?>" id="<?php echo $t10_bayardetail_grid->FormKeyCountName ?>" value="<?php echo $t10_bayardetail_grid->KeyCount ?>">
<?php echo $t10_bayardetail_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t10_bayardetail->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ft10_bayardetailgrid">
</div>
<?php

// Close recordset
if ($t10_bayardetail_grid->Recordset)
	$t10_bayardetail_grid->Recordset->Close();
?>
<?php if ($t10_bayardetail_grid->ShowOtherOptions) { ?>
<div class="panel-footer ewGridLowerPanel">
<?php
	foreach ($t10_bayardetail_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($t10_bayardetail_grid->TotalRecs == 0 && $t10_bayardetail->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($t10_bayardetail_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($t10_bayardetail->Export == "") { ?>
<script type="text/javascript">
ft10_bayardetailgrid.Init();
</script>
<?php } ?>
<?php
$t10_bayardetail_grid->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php
$t10_bayardetail_grid->Page_Terminate();
?>
