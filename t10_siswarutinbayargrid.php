<?php include_once "t96_employeesinfo.php" ?>
<?php

// Create page object
if (!isset($t10_siswarutinbayar_grid)) $t10_siswarutinbayar_grid = new ct10_siswarutinbayar_grid();

// Page init
$t10_siswarutinbayar_grid->Page_Init();

// Page main
$t10_siswarutinbayar_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t10_siswarutinbayar_grid->Page_Render();
?>
<?php if ($t10_siswarutinbayar->Export == "") { ?>
<script type="text/javascript">

// Form object
var ft10_siswarutinbayargrid = new ew_Form("ft10_siswarutinbayargrid", "grid");
ft10_siswarutinbayargrid.FormKeyCountName = '<?php echo $t10_siswarutinbayar_grid->FormKeyCountName ?>';

// Validate form
ft10_siswarutinbayargrid.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_Periode");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t10_siswarutinbayar->Periode->FldCaption(), $t10_siswarutinbayar->Periode->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Periode");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t10_siswarutinbayar->Periode->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_TanggalBayar");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t10_siswarutinbayar->TanggalBayar->FldCaption(), $t10_siswarutinbayar->TanggalBayar->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_TanggalBayar");
			if (elm && !ew_CheckDateDef(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t10_siswarutinbayar->TanggalBayar->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_JumlahBayar");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t10_siswarutinbayar->JumlahBayar->FldCaption(), $t10_siswarutinbayar->JumlahBayar->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_JumlahBayar");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t10_siswarutinbayar->JumlahBayar->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
ft10_siswarutinbayargrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "Periode", false)) return false;
	if (ew_ValueChanged(fobj, infix, "TanggalBayar", false)) return false;
	if (ew_ValueChanged(fobj, infix, "JumlahBayar", false)) return false;
	return true;
}

// Form_CustomValidate event
ft10_siswarutinbayargrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft10_siswarutinbayargrid.ValidateRequired = true;
<?php } else { ?>
ft10_siswarutinbayargrid.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
// Form object for search

</script>
<?php } ?>
<?php
if ($t10_siswarutinbayar->CurrentAction == "gridadd") {
	if ($t10_siswarutinbayar->CurrentMode == "copy") {
		$bSelectLimit = $t10_siswarutinbayar_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$t10_siswarutinbayar_grid->TotalRecs = $t10_siswarutinbayar->SelectRecordCount();
			$t10_siswarutinbayar_grid->Recordset = $t10_siswarutinbayar_grid->LoadRecordset($t10_siswarutinbayar_grid->StartRec-1, $t10_siswarutinbayar_grid->DisplayRecs);
		} else {
			if ($t10_siswarutinbayar_grid->Recordset = $t10_siswarutinbayar_grid->LoadRecordset())
				$t10_siswarutinbayar_grid->TotalRecs = $t10_siswarutinbayar_grid->Recordset->RecordCount();
		}
		$t10_siswarutinbayar_grid->StartRec = 1;
		$t10_siswarutinbayar_grid->DisplayRecs = $t10_siswarutinbayar_grid->TotalRecs;
	} else {
		$t10_siswarutinbayar->CurrentFilter = "0=1";
		$t10_siswarutinbayar_grid->StartRec = 1;
		$t10_siswarutinbayar_grid->DisplayRecs = $t10_siswarutinbayar->GridAddRowCount;
	}
	$t10_siswarutinbayar_grid->TotalRecs = $t10_siswarutinbayar_grid->DisplayRecs;
	$t10_siswarutinbayar_grid->StopRec = $t10_siswarutinbayar_grid->DisplayRecs;
} else {
	$bSelectLimit = $t10_siswarutinbayar_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($t10_siswarutinbayar_grid->TotalRecs <= 0)
			$t10_siswarutinbayar_grid->TotalRecs = $t10_siswarutinbayar->SelectRecordCount();
	} else {
		if (!$t10_siswarutinbayar_grid->Recordset && ($t10_siswarutinbayar_grid->Recordset = $t10_siswarutinbayar_grid->LoadRecordset()))
			$t10_siswarutinbayar_grid->TotalRecs = $t10_siswarutinbayar_grid->Recordset->RecordCount();
	}
	$t10_siswarutinbayar_grid->StartRec = 1;
	$t10_siswarutinbayar_grid->DisplayRecs = $t10_siswarutinbayar_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$t10_siswarutinbayar_grid->Recordset = $t10_siswarutinbayar_grid->LoadRecordset($t10_siswarutinbayar_grid->StartRec-1, $t10_siswarutinbayar_grid->DisplayRecs);

	// Set no record found message
	if ($t10_siswarutinbayar->CurrentAction == "" && $t10_siswarutinbayar_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$t10_siswarutinbayar_grid->setWarningMessage(ew_DeniedMsg());
		if ($t10_siswarutinbayar_grid->SearchWhere == "0=101")
			$t10_siswarutinbayar_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$t10_siswarutinbayar_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$t10_siswarutinbayar_grid->RenderOtherOptions();
?>
<?php $t10_siswarutinbayar_grid->ShowPageHeader(); ?>
<?php
$t10_siswarutinbayar_grid->ShowMessage();
?>
<?php if ($t10_siswarutinbayar_grid->TotalRecs > 0 || $t10_siswarutinbayar->CurrentAction <> "") { ?>
<div class="panel panel-default ewGrid t10_siswarutinbayar">
<div id="ft10_siswarutinbayargrid" class="ewForm form-inline">
<div id="gmp_t10_siswarutinbayar" class="<?php if (ew_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<table id="tbl_t10_siswarutinbayargrid" class="table ewTable">
<?php echo $t10_siswarutinbayar->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Header row
$t10_siswarutinbayar_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$t10_siswarutinbayar_grid->RenderListOptions();

// Render list options (header, left)
$t10_siswarutinbayar_grid->ListOptions->Render("header", "left");
?>
<?php if ($t10_siswarutinbayar->Periode->Visible) { // Periode ?>
	<?php if ($t10_siswarutinbayar->SortUrl($t10_siswarutinbayar->Periode) == "") { ?>
		<th data-name="Periode"><div id="elh_t10_siswarutinbayar_Periode" class="t10_siswarutinbayar_Periode"><div class="ewTableHeaderCaption"><?php echo $t10_siswarutinbayar->Periode->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Periode"><div><div id="elh_t10_siswarutinbayar_Periode" class="t10_siswarutinbayar_Periode">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t10_siswarutinbayar->Periode->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t10_siswarutinbayar->Periode->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t10_siswarutinbayar->Periode->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t10_siswarutinbayar->TanggalBayar->Visible) { // TanggalBayar ?>
	<?php if ($t10_siswarutinbayar->SortUrl($t10_siswarutinbayar->TanggalBayar) == "") { ?>
		<th data-name="TanggalBayar"><div id="elh_t10_siswarutinbayar_TanggalBayar" class="t10_siswarutinbayar_TanggalBayar"><div class="ewTableHeaderCaption"><?php echo $t10_siswarutinbayar->TanggalBayar->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TanggalBayar"><div><div id="elh_t10_siswarutinbayar_TanggalBayar" class="t10_siswarutinbayar_TanggalBayar">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t10_siswarutinbayar->TanggalBayar->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t10_siswarutinbayar->TanggalBayar->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t10_siswarutinbayar->TanggalBayar->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t10_siswarutinbayar->JumlahBayar->Visible) { // JumlahBayar ?>
	<?php if ($t10_siswarutinbayar->SortUrl($t10_siswarutinbayar->JumlahBayar) == "") { ?>
		<th data-name="JumlahBayar"><div id="elh_t10_siswarutinbayar_JumlahBayar" class="t10_siswarutinbayar_JumlahBayar"><div class="ewTableHeaderCaption"><?php echo $t10_siswarutinbayar->JumlahBayar->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="JumlahBayar"><div><div id="elh_t10_siswarutinbayar_JumlahBayar" class="t10_siswarutinbayar_JumlahBayar">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t10_siswarutinbayar->JumlahBayar->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t10_siswarutinbayar->JumlahBayar->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t10_siswarutinbayar->JumlahBayar->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$t10_siswarutinbayar_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$t10_siswarutinbayar_grid->StartRec = 1;
$t10_siswarutinbayar_grid->StopRec = $t10_siswarutinbayar_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($t10_siswarutinbayar_grid->FormKeyCountName) && ($t10_siswarutinbayar->CurrentAction == "gridadd" || $t10_siswarutinbayar->CurrentAction == "gridedit" || $t10_siswarutinbayar->CurrentAction == "F")) {
		$t10_siswarutinbayar_grid->KeyCount = $objForm->GetValue($t10_siswarutinbayar_grid->FormKeyCountName);
		$t10_siswarutinbayar_grid->StopRec = $t10_siswarutinbayar_grid->StartRec + $t10_siswarutinbayar_grid->KeyCount - 1;
	}
}
$t10_siswarutinbayar_grid->RecCnt = $t10_siswarutinbayar_grid->StartRec - 1;
if ($t10_siswarutinbayar_grid->Recordset && !$t10_siswarutinbayar_grid->Recordset->EOF) {
	$t10_siswarutinbayar_grid->Recordset->MoveFirst();
	$bSelectLimit = $t10_siswarutinbayar_grid->UseSelectLimit;
	if (!$bSelectLimit && $t10_siswarutinbayar_grid->StartRec > 1)
		$t10_siswarutinbayar_grid->Recordset->Move($t10_siswarutinbayar_grid->StartRec - 1);
} elseif (!$t10_siswarutinbayar->AllowAddDeleteRow && $t10_siswarutinbayar_grid->StopRec == 0) {
	$t10_siswarutinbayar_grid->StopRec = $t10_siswarutinbayar->GridAddRowCount;
}

// Initialize aggregate
$t10_siswarutinbayar->RowType = EW_ROWTYPE_AGGREGATEINIT;
$t10_siswarutinbayar->ResetAttrs();
$t10_siswarutinbayar_grid->RenderRow();
if ($t10_siswarutinbayar->CurrentAction == "gridadd")
	$t10_siswarutinbayar_grid->RowIndex = 0;
if ($t10_siswarutinbayar->CurrentAction == "gridedit")
	$t10_siswarutinbayar_grid->RowIndex = 0;
while ($t10_siswarutinbayar_grid->RecCnt < $t10_siswarutinbayar_grid->StopRec) {
	$t10_siswarutinbayar_grid->RecCnt++;
	if (intval($t10_siswarutinbayar_grid->RecCnt) >= intval($t10_siswarutinbayar_grid->StartRec)) {
		$t10_siswarutinbayar_grid->RowCnt++;
		if ($t10_siswarutinbayar->CurrentAction == "gridadd" || $t10_siswarutinbayar->CurrentAction == "gridedit" || $t10_siswarutinbayar->CurrentAction == "F") {
			$t10_siswarutinbayar_grid->RowIndex++;
			$objForm->Index = $t10_siswarutinbayar_grid->RowIndex;
			if ($objForm->HasValue($t10_siswarutinbayar_grid->FormActionName))
				$t10_siswarutinbayar_grid->RowAction = strval($objForm->GetValue($t10_siswarutinbayar_grid->FormActionName));
			elseif ($t10_siswarutinbayar->CurrentAction == "gridadd")
				$t10_siswarutinbayar_grid->RowAction = "insert";
			else
				$t10_siswarutinbayar_grid->RowAction = "";
		}

		// Set up key count
		$t10_siswarutinbayar_grid->KeyCount = $t10_siswarutinbayar_grid->RowIndex;

		// Init row class and style
		$t10_siswarutinbayar->ResetAttrs();
		$t10_siswarutinbayar->CssClass = "";
		if ($t10_siswarutinbayar->CurrentAction == "gridadd") {
			if ($t10_siswarutinbayar->CurrentMode == "copy") {
				$t10_siswarutinbayar_grid->LoadRowValues($t10_siswarutinbayar_grid->Recordset); // Load row values
				$t10_siswarutinbayar_grid->SetRecordKey($t10_siswarutinbayar_grid->RowOldKey, $t10_siswarutinbayar_grid->Recordset); // Set old record key
			} else {
				$t10_siswarutinbayar_grid->LoadDefaultValues(); // Load default values
				$t10_siswarutinbayar_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$t10_siswarutinbayar_grid->LoadRowValues($t10_siswarutinbayar_grid->Recordset); // Load row values
		}
		$t10_siswarutinbayar->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($t10_siswarutinbayar->CurrentAction == "gridadd") // Grid add
			$t10_siswarutinbayar->RowType = EW_ROWTYPE_ADD; // Render add
		if ($t10_siswarutinbayar->CurrentAction == "gridadd" && $t10_siswarutinbayar->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$t10_siswarutinbayar_grid->RestoreCurrentRowFormValues($t10_siswarutinbayar_grid->RowIndex); // Restore form values
		if ($t10_siswarutinbayar->CurrentAction == "gridedit") { // Grid edit
			if ($t10_siswarutinbayar->EventCancelled) {
				$t10_siswarutinbayar_grid->RestoreCurrentRowFormValues($t10_siswarutinbayar_grid->RowIndex); // Restore form values
			}
			if ($t10_siswarutinbayar_grid->RowAction == "insert")
				$t10_siswarutinbayar->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$t10_siswarutinbayar->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($t10_siswarutinbayar->CurrentAction == "gridedit" && ($t10_siswarutinbayar->RowType == EW_ROWTYPE_EDIT || $t10_siswarutinbayar->RowType == EW_ROWTYPE_ADD) && $t10_siswarutinbayar->EventCancelled) // Update failed
			$t10_siswarutinbayar_grid->RestoreCurrentRowFormValues($t10_siswarutinbayar_grid->RowIndex); // Restore form values
		if ($t10_siswarutinbayar->RowType == EW_ROWTYPE_EDIT) // Edit row
			$t10_siswarutinbayar_grid->EditRowCnt++;
		if ($t10_siswarutinbayar->CurrentAction == "F") // Confirm row
			$t10_siswarutinbayar_grid->RestoreCurrentRowFormValues($t10_siswarutinbayar_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$t10_siswarutinbayar->RowAttrs = array_merge($t10_siswarutinbayar->RowAttrs, array('data-rowindex'=>$t10_siswarutinbayar_grid->RowCnt, 'id'=>'r' . $t10_siswarutinbayar_grid->RowCnt . '_t10_siswarutinbayar', 'data-rowtype'=>$t10_siswarutinbayar->RowType));

		// Render row
		$t10_siswarutinbayar_grid->RenderRow();

		// Render list options
		$t10_siswarutinbayar_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($t10_siswarutinbayar_grid->RowAction <> "delete" && $t10_siswarutinbayar_grid->RowAction <> "insertdelete" && !($t10_siswarutinbayar_grid->RowAction == "insert" && $t10_siswarutinbayar->CurrentAction == "F" && $t10_siswarutinbayar_grid->EmptyRow())) {
?>
	<tr<?php echo $t10_siswarutinbayar->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t10_siswarutinbayar_grid->ListOptions->Render("body", "left", $t10_siswarutinbayar_grid->RowCnt);
?>
	<?php if ($t10_siswarutinbayar->Periode->Visible) { // Periode ?>
		<td data-name="Periode"<?php echo $t10_siswarutinbayar->Periode->CellAttributes() ?>>
<?php if ($t10_siswarutinbayar->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t10_siswarutinbayar_grid->RowCnt ?>_t10_siswarutinbayar_Periode" class="form-group t10_siswarutinbayar_Periode">
<input type="text" data-table="t10_siswarutinbayar" data-field="x_Periode" name="x<?php echo $t10_siswarutinbayar_grid->RowIndex ?>_Periode" id="x<?php echo $t10_siswarutinbayar_grid->RowIndex ?>_Periode" size="30" placeholder="<?php echo ew_HtmlEncode($t10_siswarutinbayar->Periode->getPlaceHolder()) ?>" value="<?php echo $t10_siswarutinbayar->Periode->EditValue ?>"<?php echo $t10_siswarutinbayar->Periode->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t10_siswarutinbayar" data-field="x_Periode" name="o<?php echo $t10_siswarutinbayar_grid->RowIndex ?>_Periode" id="o<?php echo $t10_siswarutinbayar_grid->RowIndex ?>_Periode" value="<?php echo ew_HtmlEncode($t10_siswarutinbayar->Periode->OldValue) ?>">
<?php } ?>
<?php if ($t10_siswarutinbayar->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t10_siswarutinbayar_grid->RowCnt ?>_t10_siswarutinbayar_Periode" class="form-group t10_siswarutinbayar_Periode">
<input type="text" data-table="t10_siswarutinbayar" data-field="x_Periode" name="x<?php echo $t10_siswarutinbayar_grid->RowIndex ?>_Periode" id="x<?php echo $t10_siswarutinbayar_grid->RowIndex ?>_Periode" size="30" placeholder="<?php echo ew_HtmlEncode($t10_siswarutinbayar->Periode->getPlaceHolder()) ?>" value="<?php echo $t10_siswarutinbayar->Periode->EditValue ?>"<?php echo $t10_siswarutinbayar->Periode->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t10_siswarutinbayar->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t10_siswarutinbayar_grid->RowCnt ?>_t10_siswarutinbayar_Periode" class="t10_siswarutinbayar_Periode">
<span<?php echo $t10_siswarutinbayar->Periode->ViewAttributes() ?>>
<?php echo $t10_siswarutinbayar->Periode->ListViewValue() ?></span>
</span>
<?php if ($t10_siswarutinbayar->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t10_siswarutinbayar" data-field="x_Periode" name="x<?php echo $t10_siswarutinbayar_grid->RowIndex ?>_Periode" id="x<?php echo $t10_siswarutinbayar_grid->RowIndex ?>_Periode" value="<?php echo ew_HtmlEncode($t10_siswarutinbayar->Periode->FormValue) ?>">
<input type="hidden" data-table="t10_siswarutinbayar" data-field="x_Periode" name="o<?php echo $t10_siswarutinbayar_grid->RowIndex ?>_Periode" id="o<?php echo $t10_siswarutinbayar_grid->RowIndex ?>_Periode" value="<?php echo ew_HtmlEncode($t10_siswarutinbayar->Periode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t10_siswarutinbayar" data-field="x_Periode" name="ft10_siswarutinbayargrid$x<?php echo $t10_siswarutinbayar_grid->RowIndex ?>_Periode" id="ft10_siswarutinbayargrid$x<?php echo $t10_siswarutinbayar_grid->RowIndex ?>_Periode" value="<?php echo ew_HtmlEncode($t10_siswarutinbayar->Periode->FormValue) ?>">
<input type="hidden" data-table="t10_siswarutinbayar" data-field="x_Periode" name="ft10_siswarutinbayargrid$o<?php echo $t10_siswarutinbayar_grid->RowIndex ?>_Periode" id="ft10_siswarutinbayargrid$o<?php echo $t10_siswarutinbayar_grid->RowIndex ?>_Periode" value="<?php echo ew_HtmlEncode($t10_siswarutinbayar->Periode->OldValue) ?>">
<?php } ?>
<?php } ?>
<a id="<?php echo $t10_siswarutinbayar_grid->PageObjName . "_row_" . $t10_siswarutinbayar_grid->RowCnt ?>"></a></td>
	<?php } ?>
<?php if ($t10_siswarutinbayar->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="t10_siswarutinbayar" data-field="x_id" name="x<?php echo $t10_siswarutinbayar_grid->RowIndex ?>_id" id="x<?php echo $t10_siswarutinbayar_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t10_siswarutinbayar->id->CurrentValue) ?>">
<input type="hidden" data-table="t10_siswarutinbayar" data-field="x_id" name="o<?php echo $t10_siswarutinbayar_grid->RowIndex ?>_id" id="o<?php echo $t10_siswarutinbayar_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t10_siswarutinbayar->id->OldValue) ?>">
<?php } ?>
<?php if ($t10_siswarutinbayar->RowType == EW_ROWTYPE_EDIT || $t10_siswarutinbayar->CurrentMode == "edit") { ?>
<input type="hidden" data-table="t10_siswarutinbayar" data-field="x_id" name="x<?php echo $t10_siswarutinbayar_grid->RowIndex ?>_id" id="x<?php echo $t10_siswarutinbayar_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t10_siswarutinbayar->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($t10_siswarutinbayar->TanggalBayar->Visible) { // TanggalBayar ?>
		<td data-name="TanggalBayar"<?php echo $t10_siswarutinbayar->TanggalBayar->CellAttributes() ?>>
<?php if ($t10_siswarutinbayar->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t10_siswarutinbayar_grid->RowCnt ?>_t10_siswarutinbayar_TanggalBayar" class="form-group t10_siswarutinbayar_TanggalBayar">
<input type="text" data-table="t10_siswarutinbayar" data-field="x_TanggalBayar" name="x<?php echo $t10_siswarutinbayar_grid->RowIndex ?>_TanggalBayar" id="x<?php echo $t10_siswarutinbayar_grid->RowIndex ?>_TanggalBayar" placeholder="<?php echo ew_HtmlEncode($t10_siswarutinbayar->TanggalBayar->getPlaceHolder()) ?>" value="<?php echo $t10_siswarutinbayar->TanggalBayar->EditValue ?>"<?php echo $t10_siswarutinbayar->TanggalBayar->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t10_siswarutinbayar" data-field="x_TanggalBayar" name="o<?php echo $t10_siswarutinbayar_grid->RowIndex ?>_TanggalBayar" id="o<?php echo $t10_siswarutinbayar_grid->RowIndex ?>_TanggalBayar" value="<?php echo ew_HtmlEncode($t10_siswarutinbayar->TanggalBayar->OldValue) ?>">
<?php } ?>
<?php if ($t10_siswarutinbayar->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t10_siswarutinbayar_grid->RowCnt ?>_t10_siswarutinbayar_TanggalBayar" class="form-group t10_siswarutinbayar_TanggalBayar">
<input type="text" data-table="t10_siswarutinbayar" data-field="x_TanggalBayar" name="x<?php echo $t10_siswarutinbayar_grid->RowIndex ?>_TanggalBayar" id="x<?php echo $t10_siswarutinbayar_grid->RowIndex ?>_TanggalBayar" placeholder="<?php echo ew_HtmlEncode($t10_siswarutinbayar->TanggalBayar->getPlaceHolder()) ?>" value="<?php echo $t10_siswarutinbayar->TanggalBayar->EditValue ?>"<?php echo $t10_siswarutinbayar->TanggalBayar->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t10_siswarutinbayar->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t10_siswarutinbayar_grid->RowCnt ?>_t10_siswarutinbayar_TanggalBayar" class="t10_siswarutinbayar_TanggalBayar">
<span<?php echo $t10_siswarutinbayar->TanggalBayar->ViewAttributes() ?>>
<?php echo $t10_siswarutinbayar->TanggalBayar->ListViewValue() ?></span>
</span>
<?php if ($t10_siswarutinbayar->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t10_siswarutinbayar" data-field="x_TanggalBayar" name="x<?php echo $t10_siswarutinbayar_grid->RowIndex ?>_TanggalBayar" id="x<?php echo $t10_siswarutinbayar_grid->RowIndex ?>_TanggalBayar" value="<?php echo ew_HtmlEncode($t10_siswarutinbayar->TanggalBayar->FormValue) ?>">
<input type="hidden" data-table="t10_siswarutinbayar" data-field="x_TanggalBayar" name="o<?php echo $t10_siswarutinbayar_grid->RowIndex ?>_TanggalBayar" id="o<?php echo $t10_siswarutinbayar_grid->RowIndex ?>_TanggalBayar" value="<?php echo ew_HtmlEncode($t10_siswarutinbayar->TanggalBayar->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t10_siswarutinbayar" data-field="x_TanggalBayar" name="ft10_siswarutinbayargrid$x<?php echo $t10_siswarutinbayar_grid->RowIndex ?>_TanggalBayar" id="ft10_siswarutinbayargrid$x<?php echo $t10_siswarutinbayar_grid->RowIndex ?>_TanggalBayar" value="<?php echo ew_HtmlEncode($t10_siswarutinbayar->TanggalBayar->FormValue) ?>">
<input type="hidden" data-table="t10_siswarutinbayar" data-field="x_TanggalBayar" name="ft10_siswarutinbayargrid$o<?php echo $t10_siswarutinbayar_grid->RowIndex ?>_TanggalBayar" id="ft10_siswarutinbayargrid$o<?php echo $t10_siswarutinbayar_grid->RowIndex ?>_TanggalBayar" value="<?php echo ew_HtmlEncode($t10_siswarutinbayar->TanggalBayar->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t10_siswarutinbayar->JumlahBayar->Visible) { // JumlahBayar ?>
		<td data-name="JumlahBayar"<?php echo $t10_siswarutinbayar->JumlahBayar->CellAttributes() ?>>
<?php if ($t10_siswarutinbayar->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t10_siswarutinbayar_grid->RowCnt ?>_t10_siswarutinbayar_JumlahBayar" class="form-group t10_siswarutinbayar_JumlahBayar">
<input type="text" data-table="t10_siswarutinbayar" data-field="x_JumlahBayar" name="x<?php echo $t10_siswarutinbayar_grid->RowIndex ?>_JumlahBayar" id="x<?php echo $t10_siswarutinbayar_grid->RowIndex ?>_JumlahBayar" size="30" placeholder="<?php echo ew_HtmlEncode($t10_siswarutinbayar->JumlahBayar->getPlaceHolder()) ?>" value="<?php echo $t10_siswarutinbayar->JumlahBayar->EditValue ?>"<?php echo $t10_siswarutinbayar->JumlahBayar->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t10_siswarutinbayar" data-field="x_JumlahBayar" name="o<?php echo $t10_siswarutinbayar_grid->RowIndex ?>_JumlahBayar" id="o<?php echo $t10_siswarutinbayar_grid->RowIndex ?>_JumlahBayar" value="<?php echo ew_HtmlEncode($t10_siswarutinbayar->JumlahBayar->OldValue) ?>">
<?php } ?>
<?php if ($t10_siswarutinbayar->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t10_siswarutinbayar_grid->RowCnt ?>_t10_siswarutinbayar_JumlahBayar" class="form-group t10_siswarutinbayar_JumlahBayar">
<input type="text" data-table="t10_siswarutinbayar" data-field="x_JumlahBayar" name="x<?php echo $t10_siswarutinbayar_grid->RowIndex ?>_JumlahBayar" id="x<?php echo $t10_siswarutinbayar_grid->RowIndex ?>_JumlahBayar" size="30" placeholder="<?php echo ew_HtmlEncode($t10_siswarutinbayar->JumlahBayar->getPlaceHolder()) ?>" value="<?php echo $t10_siswarutinbayar->JumlahBayar->EditValue ?>"<?php echo $t10_siswarutinbayar->JumlahBayar->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t10_siswarutinbayar->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t10_siswarutinbayar_grid->RowCnt ?>_t10_siswarutinbayar_JumlahBayar" class="t10_siswarutinbayar_JumlahBayar">
<span<?php echo $t10_siswarutinbayar->JumlahBayar->ViewAttributes() ?>>
<?php echo $t10_siswarutinbayar->JumlahBayar->ListViewValue() ?></span>
</span>
<?php if ($t10_siswarutinbayar->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t10_siswarutinbayar" data-field="x_JumlahBayar" name="x<?php echo $t10_siswarutinbayar_grid->RowIndex ?>_JumlahBayar" id="x<?php echo $t10_siswarutinbayar_grid->RowIndex ?>_JumlahBayar" value="<?php echo ew_HtmlEncode($t10_siswarutinbayar->JumlahBayar->FormValue) ?>">
<input type="hidden" data-table="t10_siswarutinbayar" data-field="x_JumlahBayar" name="o<?php echo $t10_siswarutinbayar_grid->RowIndex ?>_JumlahBayar" id="o<?php echo $t10_siswarutinbayar_grid->RowIndex ?>_JumlahBayar" value="<?php echo ew_HtmlEncode($t10_siswarutinbayar->JumlahBayar->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t10_siswarutinbayar" data-field="x_JumlahBayar" name="ft10_siswarutinbayargrid$x<?php echo $t10_siswarutinbayar_grid->RowIndex ?>_JumlahBayar" id="ft10_siswarutinbayargrid$x<?php echo $t10_siswarutinbayar_grid->RowIndex ?>_JumlahBayar" value="<?php echo ew_HtmlEncode($t10_siswarutinbayar->JumlahBayar->FormValue) ?>">
<input type="hidden" data-table="t10_siswarutinbayar" data-field="x_JumlahBayar" name="ft10_siswarutinbayargrid$o<?php echo $t10_siswarutinbayar_grid->RowIndex ?>_JumlahBayar" id="ft10_siswarutinbayargrid$o<?php echo $t10_siswarutinbayar_grid->RowIndex ?>_JumlahBayar" value="<?php echo ew_HtmlEncode($t10_siswarutinbayar->JumlahBayar->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t10_siswarutinbayar_grid->ListOptions->Render("body", "right", $t10_siswarutinbayar_grid->RowCnt);
?>
	</tr>
<?php if ($t10_siswarutinbayar->RowType == EW_ROWTYPE_ADD || $t10_siswarutinbayar->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
ft10_siswarutinbayargrid.UpdateOpts(<?php echo $t10_siswarutinbayar_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($t10_siswarutinbayar->CurrentAction <> "gridadd" || $t10_siswarutinbayar->CurrentMode == "copy")
		if (!$t10_siswarutinbayar_grid->Recordset->EOF) $t10_siswarutinbayar_grid->Recordset->MoveNext();
}
?>
<?php
	if ($t10_siswarutinbayar->CurrentMode == "add" || $t10_siswarutinbayar->CurrentMode == "copy" || $t10_siswarutinbayar->CurrentMode == "edit") {
		$t10_siswarutinbayar_grid->RowIndex = '$rowindex$';
		$t10_siswarutinbayar_grid->LoadDefaultValues();

		// Set row properties
		$t10_siswarutinbayar->ResetAttrs();
		$t10_siswarutinbayar->RowAttrs = array_merge($t10_siswarutinbayar->RowAttrs, array('data-rowindex'=>$t10_siswarutinbayar_grid->RowIndex, 'id'=>'r0_t10_siswarutinbayar', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($t10_siswarutinbayar->RowAttrs["class"], "ewTemplate");
		$t10_siswarutinbayar->RowType = EW_ROWTYPE_ADD;

		// Render row
		$t10_siswarutinbayar_grid->RenderRow();

		// Render list options
		$t10_siswarutinbayar_grid->RenderListOptions();
		$t10_siswarutinbayar_grid->StartRowCnt = 0;
?>
	<tr<?php echo $t10_siswarutinbayar->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t10_siswarutinbayar_grid->ListOptions->Render("body", "left", $t10_siswarutinbayar_grid->RowIndex);
?>
	<?php if ($t10_siswarutinbayar->Periode->Visible) { // Periode ?>
		<td data-name="Periode">
<?php if ($t10_siswarutinbayar->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t10_siswarutinbayar_Periode" class="form-group t10_siswarutinbayar_Periode">
<input type="text" data-table="t10_siswarutinbayar" data-field="x_Periode" name="x<?php echo $t10_siswarutinbayar_grid->RowIndex ?>_Periode" id="x<?php echo $t10_siswarutinbayar_grid->RowIndex ?>_Periode" size="30" placeholder="<?php echo ew_HtmlEncode($t10_siswarutinbayar->Periode->getPlaceHolder()) ?>" value="<?php echo $t10_siswarutinbayar->Periode->EditValue ?>"<?php echo $t10_siswarutinbayar->Periode->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t10_siswarutinbayar_Periode" class="form-group t10_siswarutinbayar_Periode">
<span<?php echo $t10_siswarutinbayar->Periode->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t10_siswarutinbayar->Periode->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t10_siswarutinbayar" data-field="x_Periode" name="x<?php echo $t10_siswarutinbayar_grid->RowIndex ?>_Periode" id="x<?php echo $t10_siswarutinbayar_grid->RowIndex ?>_Periode" value="<?php echo ew_HtmlEncode($t10_siswarutinbayar->Periode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t10_siswarutinbayar" data-field="x_Periode" name="o<?php echo $t10_siswarutinbayar_grid->RowIndex ?>_Periode" id="o<?php echo $t10_siswarutinbayar_grid->RowIndex ?>_Periode" value="<?php echo ew_HtmlEncode($t10_siswarutinbayar->Periode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t10_siswarutinbayar->TanggalBayar->Visible) { // TanggalBayar ?>
		<td data-name="TanggalBayar">
<?php if ($t10_siswarutinbayar->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t10_siswarutinbayar_TanggalBayar" class="form-group t10_siswarutinbayar_TanggalBayar">
<input type="text" data-table="t10_siswarutinbayar" data-field="x_TanggalBayar" name="x<?php echo $t10_siswarutinbayar_grid->RowIndex ?>_TanggalBayar" id="x<?php echo $t10_siswarutinbayar_grid->RowIndex ?>_TanggalBayar" placeholder="<?php echo ew_HtmlEncode($t10_siswarutinbayar->TanggalBayar->getPlaceHolder()) ?>" value="<?php echo $t10_siswarutinbayar->TanggalBayar->EditValue ?>"<?php echo $t10_siswarutinbayar->TanggalBayar->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t10_siswarutinbayar_TanggalBayar" class="form-group t10_siswarutinbayar_TanggalBayar">
<span<?php echo $t10_siswarutinbayar->TanggalBayar->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t10_siswarutinbayar->TanggalBayar->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t10_siswarutinbayar" data-field="x_TanggalBayar" name="x<?php echo $t10_siswarutinbayar_grid->RowIndex ?>_TanggalBayar" id="x<?php echo $t10_siswarutinbayar_grid->RowIndex ?>_TanggalBayar" value="<?php echo ew_HtmlEncode($t10_siswarutinbayar->TanggalBayar->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t10_siswarutinbayar" data-field="x_TanggalBayar" name="o<?php echo $t10_siswarutinbayar_grid->RowIndex ?>_TanggalBayar" id="o<?php echo $t10_siswarutinbayar_grid->RowIndex ?>_TanggalBayar" value="<?php echo ew_HtmlEncode($t10_siswarutinbayar->TanggalBayar->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t10_siswarutinbayar->JumlahBayar->Visible) { // JumlahBayar ?>
		<td data-name="JumlahBayar">
<?php if ($t10_siswarutinbayar->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t10_siswarutinbayar_JumlahBayar" class="form-group t10_siswarutinbayar_JumlahBayar">
<input type="text" data-table="t10_siswarutinbayar" data-field="x_JumlahBayar" name="x<?php echo $t10_siswarutinbayar_grid->RowIndex ?>_JumlahBayar" id="x<?php echo $t10_siswarutinbayar_grid->RowIndex ?>_JumlahBayar" size="30" placeholder="<?php echo ew_HtmlEncode($t10_siswarutinbayar->JumlahBayar->getPlaceHolder()) ?>" value="<?php echo $t10_siswarutinbayar->JumlahBayar->EditValue ?>"<?php echo $t10_siswarutinbayar->JumlahBayar->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t10_siswarutinbayar_JumlahBayar" class="form-group t10_siswarutinbayar_JumlahBayar">
<span<?php echo $t10_siswarutinbayar->JumlahBayar->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t10_siswarutinbayar->JumlahBayar->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t10_siswarutinbayar" data-field="x_JumlahBayar" name="x<?php echo $t10_siswarutinbayar_grid->RowIndex ?>_JumlahBayar" id="x<?php echo $t10_siswarutinbayar_grid->RowIndex ?>_JumlahBayar" value="<?php echo ew_HtmlEncode($t10_siswarutinbayar->JumlahBayar->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t10_siswarutinbayar" data-field="x_JumlahBayar" name="o<?php echo $t10_siswarutinbayar_grid->RowIndex ?>_JumlahBayar" id="o<?php echo $t10_siswarutinbayar_grid->RowIndex ?>_JumlahBayar" value="<?php echo ew_HtmlEncode($t10_siswarutinbayar->JumlahBayar->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t10_siswarutinbayar_grid->ListOptions->Render("body", "right", $t10_siswarutinbayar_grid->RowCnt);
?>
<script type="text/javascript">
ft10_siswarutinbayargrid.UpdateOpts(<?php echo $t10_siswarutinbayar_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($t10_siswarutinbayar->CurrentMode == "add" || $t10_siswarutinbayar->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $t10_siswarutinbayar_grid->FormKeyCountName ?>" id="<?php echo $t10_siswarutinbayar_grid->FormKeyCountName ?>" value="<?php echo $t10_siswarutinbayar_grid->KeyCount ?>">
<?php echo $t10_siswarutinbayar_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t10_siswarutinbayar->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $t10_siswarutinbayar_grid->FormKeyCountName ?>" id="<?php echo $t10_siswarutinbayar_grid->FormKeyCountName ?>" value="<?php echo $t10_siswarutinbayar_grid->KeyCount ?>">
<?php echo $t10_siswarutinbayar_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t10_siswarutinbayar->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ft10_siswarutinbayargrid">
</div>
<?php

// Close recordset
if ($t10_siswarutinbayar_grid->Recordset)
	$t10_siswarutinbayar_grid->Recordset->Close();
?>
<?php if ($t10_siswarutinbayar_grid->ShowOtherOptions) { ?>
<div class="panel-footer ewGridLowerPanel">
<?php
	foreach ($t10_siswarutinbayar_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($t10_siswarutinbayar_grid->TotalRecs == 0 && $t10_siswarutinbayar->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($t10_siswarutinbayar_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($t10_siswarutinbayar->Export == "") { ?>
<script type="text/javascript">
ft10_siswarutinbayargrid.Init();
</script>
<?php } ?>
<?php
$t10_siswarutinbayar_grid->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php
$t10_siswarutinbayar_grid->Page_Terminate();
?>
