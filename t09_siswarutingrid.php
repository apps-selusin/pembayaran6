<?php include_once "t96_employeesinfo.php" ?>
<?php

// Create page object
if (!isset($t09_siswarutin_grid)) $t09_siswarutin_grid = new ct09_siswarutin_grid();

// Page init
$t09_siswarutin_grid->Page_Init();

// Page main
$t09_siswarutin_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t09_siswarutin_grid->Page_Render();
?>
<?php if ($t09_siswarutin->Export == "") { ?>
<script type="text/javascript">

// Form object
var ft09_siswarutingrid = new ew_Form("ft09_siswarutingrid", "grid");
ft09_siswarutingrid.FormKeyCountName = '<?php echo $t09_siswarutin_grid->FormKeyCountName ?>';

// Validate form
ft09_siswarutingrid.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_rutin_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t09_siswarutin->rutin_id->FldCaption(), $t09_siswarutin->rutin_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_tahunajaran_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t09_siswarutin->tahunajaran_id->FldCaption(), $t09_siswarutin->tahunajaran_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_nilai");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t09_siswarutin->nilai->FldCaption(), $t09_siswarutin->nilai->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_nilai");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t09_siswarutin->nilai->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_Total");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t09_siswarutin->Total->FldCaption(), $t09_siswarutin->Total->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Total");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t09_siswarutin->Total->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
ft09_siswarutingrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "rutin_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "tahunajaran_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "nilai", false)) return false;
	if (ew_ValueChanged(fobj, infix, "Total", false)) return false;
	return true;
}

// Form_CustomValidate event
ft09_siswarutingrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft09_siswarutingrid.ValidateRequired = true;
<?php } else { ?>
ft09_siswarutingrid.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
ft09_siswarutingrid.Lists["x_rutin_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Jenis","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t07_rutin"};
ft09_siswarutingrid.Lists["x_tahunajaran_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_TahunAjaran","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t01_tahunajaran"};

// Form object for search
</script>
<?php } ?>
<?php
if ($t09_siswarutin->CurrentAction == "gridadd") {
	if ($t09_siswarutin->CurrentMode == "copy") {
		$bSelectLimit = $t09_siswarutin_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$t09_siswarutin_grid->TotalRecs = $t09_siswarutin->SelectRecordCount();
			$t09_siswarutin_grid->Recordset = $t09_siswarutin_grid->LoadRecordset($t09_siswarutin_grid->StartRec-1, $t09_siswarutin_grid->DisplayRecs);
		} else {
			if ($t09_siswarutin_grid->Recordset = $t09_siswarutin_grid->LoadRecordset())
				$t09_siswarutin_grid->TotalRecs = $t09_siswarutin_grid->Recordset->RecordCount();
		}
		$t09_siswarutin_grid->StartRec = 1;
		$t09_siswarutin_grid->DisplayRecs = $t09_siswarutin_grid->TotalRecs;
	} else {
		$t09_siswarutin->CurrentFilter = "0=1";
		$t09_siswarutin_grid->StartRec = 1;
		$t09_siswarutin_grid->DisplayRecs = $t09_siswarutin->GridAddRowCount;
	}
	$t09_siswarutin_grid->TotalRecs = $t09_siswarutin_grid->DisplayRecs;
	$t09_siswarutin_grid->StopRec = $t09_siswarutin_grid->DisplayRecs;
} else {
	$bSelectLimit = $t09_siswarutin_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($t09_siswarutin_grid->TotalRecs <= 0)
			$t09_siswarutin_grid->TotalRecs = $t09_siswarutin->SelectRecordCount();
	} else {
		if (!$t09_siswarutin_grid->Recordset && ($t09_siswarutin_grid->Recordset = $t09_siswarutin_grid->LoadRecordset()))
			$t09_siswarutin_grid->TotalRecs = $t09_siswarutin_grid->Recordset->RecordCount();
	}
	$t09_siswarutin_grid->StartRec = 1;
	$t09_siswarutin_grid->DisplayRecs = $t09_siswarutin_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$t09_siswarutin_grid->Recordset = $t09_siswarutin_grid->LoadRecordset($t09_siswarutin_grid->StartRec-1, $t09_siswarutin_grid->DisplayRecs);

	// Set no record found message
	if ($t09_siswarutin->CurrentAction == "" && $t09_siswarutin_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$t09_siswarutin_grid->setWarningMessage(ew_DeniedMsg());
		if ($t09_siswarutin_grid->SearchWhere == "0=101")
			$t09_siswarutin_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$t09_siswarutin_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$t09_siswarutin_grid->RenderOtherOptions();
?>
<?php $t09_siswarutin_grid->ShowPageHeader(); ?>
<?php
$t09_siswarutin_grid->ShowMessage();
?>
<?php if ($t09_siswarutin_grid->TotalRecs > 0 || $t09_siswarutin->CurrentAction <> "") { ?>
<div class="panel panel-default ewGrid t09_siswarutin">
<div id="ft09_siswarutingrid" class="ewForm form-inline">
<div id="gmp_t09_siswarutin" class="<?php if (ew_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<table id="tbl_t09_siswarutingrid" class="table ewTable">
<?php echo $t09_siswarutin->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Header row
$t09_siswarutin_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$t09_siswarutin_grid->RenderListOptions();

// Render list options (header, left)
$t09_siswarutin_grid->ListOptions->Render("header", "left");
?>
<?php if ($t09_siswarutin->rutin_id->Visible) { // rutin_id ?>
	<?php if ($t09_siswarutin->SortUrl($t09_siswarutin->rutin_id) == "") { ?>
		<th data-name="rutin_id"><div id="elh_t09_siswarutin_rutin_id" class="t09_siswarutin_rutin_id"><div class="ewTableHeaderCaption"><?php echo $t09_siswarutin->rutin_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="rutin_id"><div><div id="elh_t09_siswarutin_rutin_id" class="t09_siswarutin_rutin_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t09_siswarutin->rutin_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t09_siswarutin->rutin_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t09_siswarutin->rutin_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t09_siswarutin->tahunajaran_id->Visible) { // tahunajaran_id ?>
	<?php if ($t09_siswarutin->SortUrl($t09_siswarutin->tahunajaran_id) == "") { ?>
		<th data-name="tahunajaran_id"><div id="elh_t09_siswarutin_tahunajaran_id" class="t09_siswarutin_tahunajaran_id"><div class="ewTableHeaderCaption"><?php echo $t09_siswarutin->tahunajaran_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tahunajaran_id"><div><div id="elh_t09_siswarutin_tahunajaran_id" class="t09_siswarutin_tahunajaran_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t09_siswarutin->tahunajaran_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t09_siswarutin->tahunajaran_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t09_siswarutin->tahunajaran_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t09_siswarutin->nilai->Visible) { // nilai ?>
	<?php if ($t09_siswarutin->SortUrl($t09_siswarutin->nilai) == "") { ?>
		<th data-name="nilai"><div id="elh_t09_siswarutin_nilai" class="t09_siswarutin_nilai"><div class="ewTableHeaderCaption"><?php echo $t09_siswarutin->nilai->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nilai"><div><div id="elh_t09_siswarutin_nilai" class="t09_siswarutin_nilai">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t09_siswarutin->nilai->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t09_siswarutin->nilai->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t09_siswarutin->nilai->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t09_siswarutin->Total->Visible) { // Total ?>
	<?php if ($t09_siswarutin->SortUrl($t09_siswarutin->Total) == "") { ?>
		<th data-name="Total"><div id="elh_t09_siswarutin_Total" class="t09_siswarutin_Total"><div class="ewTableHeaderCaption"><?php echo $t09_siswarutin->Total->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Total"><div><div id="elh_t09_siswarutin_Total" class="t09_siswarutin_Total">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t09_siswarutin->Total->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t09_siswarutin->Total->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t09_siswarutin->Total->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$t09_siswarutin_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$t09_siswarutin_grid->StartRec = 1;
$t09_siswarutin_grid->StopRec = $t09_siswarutin_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($t09_siswarutin_grid->FormKeyCountName) && ($t09_siswarutin->CurrentAction == "gridadd" || $t09_siswarutin->CurrentAction == "gridedit" || $t09_siswarutin->CurrentAction == "F")) {
		$t09_siswarutin_grid->KeyCount = $objForm->GetValue($t09_siswarutin_grid->FormKeyCountName);
		$t09_siswarutin_grid->StopRec = $t09_siswarutin_grid->StartRec + $t09_siswarutin_grid->KeyCount - 1;
	}
}
$t09_siswarutin_grid->RecCnt = $t09_siswarutin_grid->StartRec - 1;
if ($t09_siswarutin_grid->Recordset && !$t09_siswarutin_grid->Recordset->EOF) {
	$t09_siswarutin_grid->Recordset->MoveFirst();
	$bSelectLimit = $t09_siswarutin_grid->UseSelectLimit;
	if (!$bSelectLimit && $t09_siswarutin_grid->StartRec > 1)
		$t09_siswarutin_grid->Recordset->Move($t09_siswarutin_grid->StartRec - 1);
} elseif (!$t09_siswarutin->AllowAddDeleteRow && $t09_siswarutin_grid->StopRec == 0) {
	$t09_siswarutin_grid->StopRec = $t09_siswarutin->GridAddRowCount;
}

// Initialize aggregate
$t09_siswarutin->RowType = EW_ROWTYPE_AGGREGATEINIT;
$t09_siswarutin->ResetAttrs();
$t09_siswarutin_grid->RenderRow();
if ($t09_siswarutin->CurrentAction == "gridadd")
	$t09_siswarutin_grid->RowIndex = 0;
if ($t09_siswarutin->CurrentAction == "gridedit")
	$t09_siswarutin_grid->RowIndex = 0;
while ($t09_siswarutin_grid->RecCnt < $t09_siswarutin_grid->StopRec) {
	$t09_siswarutin_grid->RecCnt++;
	if (intval($t09_siswarutin_grid->RecCnt) >= intval($t09_siswarutin_grid->StartRec)) {
		$t09_siswarutin_grid->RowCnt++;
		if ($t09_siswarutin->CurrentAction == "gridadd" || $t09_siswarutin->CurrentAction == "gridedit" || $t09_siswarutin->CurrentAction == "F") {
			$t09_siswarutin_grid->RowIndex++;
			$objForm->Index = $t09_siswarutin_grid->RowIndex;
			if ($objForm->HasValue($t09_siswarutin_grid->FormActionName))
				$t09_siswarutin_grid->RowAction = strval($objForm->GetValue($t09_siswarutin_grid->FormActionName));
			elseif ($t09_siswarutin->CurrentAction == "gridadd")
				$t09_siswarutin_grid->RowAction = "insert";
			else
				$t09_siswarutin_grid->RowAction = "";
		}

		// Set up key count
		$t09_siswarutin_grid->KeyCount = $t09_siswarutin_grid->RowIndex;

		// Init row class and style
		$t09_siswarutin->ResetAttrs();
		$t09_siswarutin->CssClass = "";
		if ($t09_siswarutin->CurrentAction == "gridadd") {
			if ($t09_siswarutin->CurrentMode == "copy") {
				$t09_siswarutin_grid->LoadRowValues($t09_siswarutin_grid->Recordset); // Load row values
				$t09_siswarutin_grid->SetRecordKey($t09_siswarutin_grid->RowOldKey, $t09_siswarutin_grid->Recordset); // Set old record key
			} else {
				$t09_siswarutin_grid->LoadDefaultValues(); // Load default values
				$t09_siswarutin_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$t09_siswarutin_grid->LoadRowValues($t09_siswarutin_grid->Recordset); // Load row values
		}
		$t09_siswarutin->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($t09_siswarutin->CurrentAction == "gridadd") // Grid add
			$t09_siswarutin->RowType = EW_ROWTYPE_ADD; // Render add
		if ($t09_siswarutin->CurrentAction == "gridadd" && $t09_siswarutin->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$t09_siswarutin_grid->RestoreCurrentRowFormValues($t09_siswarutin_grid->RowIndex); // Restore form values
		if ($t09_siswarutin->CurrentAction == "gridedit") { // Grid edit
			if ($t09_siswarutin->EventCancelled) {
				$t09_siswarutin_grid->RestoreCurrentRowFormValues($t09_siswarutin_grid->RowIndex); // Restore form values
			}
			if ($t09_siswarutin_grid->RowAction == "insert")
				$t09_siswarutin->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$t09_siswarutin->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($t09_siswarutin->CurrentAction == "gridedit" && ($t09_siswarutin->RowType == EW_ROWTYPE_EDIT || $t09_siswarutin->RowType == EW_ROWTYPE_ADD) && $t09_siswarutin->EventCancelled) // Update failed
			$t09_siswarutin_grid->RestoreCurrentRowFormValues($t09_siswarutin_grid->RowIndex); // Restore form values
		if ($t09_siswarutin->RowType == EW_ROWTYPE_EDIT) // Edit row
			$t09_siswarutin_grid->EditRowCnt++;
		if ($t09_siswarutin->CurrentAction == "F") // Confirm row
			$t09_siswarutin_grid->RestoreCurrentRowFormValues($t09_siswarutin_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$t09_siswarutin->RowAttrs = array_merge($t09_siswarutin->RowAttrs, array('data-rowindex'=>$t09_siswarutin_grid->RowCnt, 'id'=>'r' . $t09_siswarutin_grid->RowCnt . '_t09_siswarutin', 'data-rowtype'=>$t09_siswarutin->RowType));

		// Render row
		$t09_siswarutin_grid->RenderRow();

		// Render list options
		$t09_siswarutin_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($t09_siswarutin_grid->RowAction <> "delete" && $t09_siswarutin_grid->RowAction <> "insertdelete" && !($t09_siswarutin_grid->RowAction == "insert" && $t09_siswarutin->CurrentAction == "F" && $t09_siswarutin_grid->EmptyRow())) {
?>
	<tr<?php echo $t09_siswarutin->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t09_siswarutin_grid->ListOptions->Render("body", "left", $t09_siswarutin_grid->RowCnt);
?>
	<?php if ($t09_siswarutin->rutin_id->Visible) { // rutin_id ?>
		<td data-name="rutin_id"<?php echo $t09_siswarutin->rutin_id->CellAttributes() ?>>
<?php if ($t09_siswarutin->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t09_siswarutin_grid->RowCnt ?>_t09_siswarutin_rutin_id" class="form-group t09_siswarutin_rutin_id">
<select data-table="t09_siswarutin" data-field="x_rutin_id" data-value-separator="<?php echo $t09_siswarutin->rutin_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $t09_siswarutin_grid->RowIndex ?>_rutin_id" name="x<?php echo $t09_siswarutin_grid->RowIndex ?>_rutin_id"<?php echo $t09_siswarutin->rutin_id->EditAttributes() ?>>
<?php echo $t09_siswarutin->rutin_id->SelectOptionListHtml("x<?php echo $t09_siswarutin_grid->RowIndex ?>_rutin_id") ?>
</select>
<input type="hidden" name="s_x<?php echo $t09_siswarutin_grid->RowIndex ?>_rutin_id" id="s_x<?php echo $t09_siswarutin_grid->RowIndex ?>_rutin_id" value="<?php echo $t09_siswarutin->rutin_id->LookupFilterQuery() ?>">
</span>
<input type="hidden" data-table="t09_siswarutin" data-field="x_rutin_id" name="o<?php echo $t09_siswarutin_grid->RowIndex ?>_rutin_id" id="o<?php echo $t09_siswarutin_grid->RowIndex ?>_rutin_id" value="<?php echo ew_HtmlEncode($t09_siswarutin->rutin_id->OldValue) ?>">
<?php } ?>
<?php if ($t09_siswarutin->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t09_siswarutin_grid->RowCnt ?>_t09_siswarutin_rutin_id" class="form-group t09_siswarutin_rutin_id">
<select data-table="t09_siswarutin" data-field="x_rutin_id" data-value-separator="<?php echo $t09_siswarutin->rutin_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $t09_siswarutin_grid->RowIndex ?>_rutin_id" name="x<?php echo $t09_siswarutin_grid->RowIndex ?>_rutin_id"<?php echo $t09_siswarutin->rutin_id->EditAttributes() ?>>
<?php echo $t09_siswarutin->rutin_id->SelectOptionListHtml("x<?php echo $t09_siswarutin_grid->RowIndex ?>_rutin_id") ?>
</select>
<input type="hidden" name="s_x<?php echo $t09_siswarutin_grid->RowIndex ?>_rutin_id" id="s_x<?php echo $t09_siswarutin_grid->RowIndex ?>_rutin_id" value="<?php echo $t09_siswarutin->rutin_id->LookupFilterQuery() ?>">
</span>
<?php } ?>
<?php if ($t09_siswarutin->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t09_siswarutin_grid->RowCnt ?>_t09_siswarutin_rutin_id" class="t09_siswarutin_rutin_id">
<span<?php echo $t09_siswarutin->rutin_id->ViewAttributes() ?>>
<?php echo $t09_siswarutin->rutin_id->ListViewValue() ?></span>
</span>
<?php if ($t09_siswarutin->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t09_siswarutin" data-field="x_rutin_id" name="x<?php echo $t09_siswarutin_grid->RowIndex ?>_rutin_id" id="x<?php echo $t09_siswarutin_grid->RowIndex ?>_rutin_id" value="<?php echo ew_HtmlEncode($t09_siswarutin->rutin_id->FormValue) ?>">
<input type="hidden" data-table="t09_siswarutin" data-field="x_rutin_id" name="o<?php echo $t09_siswarutin_grid->RowIndex ?>_rutin_id" id="o<?php echo $t09_siswarutin_grid->RowIndex ?>_rutin_id" value="<?php echo ew_HtmlEncode($t09_siswarutin->rutin_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t09_siswarutin" data-field="x_rutin_id" name="ft09_siswarutingrid$x<?php echo $t09_siswarutin_grid->RowIndex ?>_rutin_id" id="ft09_siswarutingrid$x<?php echo $t09_siswarutin_grid->RowIndex ?>_rutin_id" value="<?php echo ew_HtmlEncode($t09_siswarutin->rutin_id->FormValue) ?>">
<input type="hidden" data-table="t09_siswarutin" data-field="x_rutin_id" name="ft09_siswarutingrid$o<?php echo $t09_siswarutin_grid->RowIndex ?>_rutin_id" id="ft09_siswarutingrid$o<?php echo $t09_siswarutin_grid->RowIndex ?>_rutin_id" value="<?php echo ew_HtmlEncode($t09_siswarutin->rutin_id->OldValue) ?>">
<?php } ?>
<?php } ?>
<a id="<?php echo $t09_siswarutin_grid->PageObjName . "_row_" . $t09_siswarutin_grid->RowCnt ?>"></a></td>
	<?php } ?>
<?php if ($t09_siswarutin->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="t09_siswarutin" data-field="x_id" name="x<?php echo $t09_siswarutin_grid->RowIndex ?>_id" id="x<?php echo $t09_siswarutin_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t09_siswarutin->id->CurrentValue) ?>">
<input type="hidden" data-table="t09_siswarutin" data-field="x_id" name="o<?php echo $t09_siswarutin_grid->RowIndex ?>_id" id="o<?php echo $t09_siswarutin_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t09_siswarutin->id->OldValue) ?>">
<?php } ?>
<?php if ($t09_siswarutin->RowType == EW_ROWTYPE_EDIT || $t09_siswarutin->CurrentMode == "edit") { ?>
<input type="hidden" data-table="t09_siswarutin" data-field="x_id" name="x<?php echo $t09_siswarutin_grid->RowIndex ?>_id" id="x<?php echo $t09_siswarutin_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t09_siswarutin->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($t09_siswarutin->tahunajaran_id->Visible) { // tahunajaran_id ?>
		<td data-name="tahunajaran_id"<?php echo $t09_siswarutin->tahunajaran_id->CellAttributes() ?>>
<?php if ($t09_siswarutin->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t09_siswarutin_grid->RowCnt ?>_t09_siswarutin_tahunajaran_id" class="form-group t09_siswarutin_tahunajaran_id">
<select data-table="t09_siswarutin" data-field="x_tahunajaran_id" data-value-separator="<?php echo $t09_siswarutin->tahunajaran_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $t09_siswarutin_grid->RowIndex ?>_tahunajaran_id" name="x<?php echo $t09_siswarutin_grid->RowIndex ?>_tahunajaran_id"<?php echo $t09_siswarutin->tahunajaran_id->EditAttributes() ?>>
<?php echo $t09_siswarutin->tahunajaran_id->SelectOptionListHtml("x<?php echo $t09_siswarutin_grid->RowIndex ?>_tahunajaran_id") ?>
</select>
<input type="hidden" name="s_x<?php echo $t09_siswarutin_grid->RowIndex ?>_tahunajaran_id" id="s_x<?php echo $t09_siswarutin_grid->RowIndex ?>_tahunajaran_id" value="<?php echo $t09_siswarutin->tahunajaran_id->LookupFilterQuery() ?>">
</span>
<input type="hidden" data-table="t09_siswarutin" data-field="x_tahunajaran_id" name="o<?php echo $t09_siswarutin_grid->RowIndex ?>_tahunajaran_id" id="o<?php echo $t09_siswarutin_grid->RowIndex ?>_tahunajaran_id" value="<?php echo ew_HtmlEncode($t09_siswarutin->tahunajaran_id->OldValue) ?>">
<?php } ?>
<?php if ($t09_siswarutin->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t09_siswarutin_grid->RowCnt ?>_t09_siswarutin_tahunajaran_id" class="form-group t09_siswarutin_tahunajaran_id">
<select data-table="t09_siswarutin" data-field="x_tahunajaran_id" data-value-separator="<?php echo $t09_siswarutin->tahunajaran_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $t09_siswarutin_grid->RowIndex ?>_tahunajaran_id" name="x<?php echo $t09_siswarutin_grid->RowIndex ?>_tahunajaran_id"<?php echo $t09_siswarutin->tahunajaran_id->EditAttributes() ?>>
<?php echo $t09_siswarutin->tahunajaran_id->SelectOptionListHtml("x<?php echo $t09_siswarutin_grid->RowIndex ?>_tahunajaran_id") ?>
</select>
<input type="hidden" name="s_x<?php echo $t09_siswarutin_grid->RowIndex ?>_tahunajaran_id" id="s_x<?php echo $t09_siswarutin_grid->RowIndex ?>_tahunajaran_id" value="<?php echo $t09_siswarutin->tahunajaran_id->LookupFilterQuery() ?>">
</span>
<?php } ?>
<?php if ($t09_siswarutin->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t09_siswarutin_grid->RowCnt ?>_t09_siswarutin_tahunajaran_id" class="t09_siswarutin_tahunajaran_id">
<span<?php echo $t09_siswarutin->tahunajaran_id->ViewAttributes() ?>>
<?php echo $t09_siswarutin->tahunajaran_id->ListViewValue() ?></span>
</span>
<?php if ($t09_siswarutin->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t09_siswarutin" data-field="x_tahunajaran_id" name="x<?php echo $t09_siswarutin_grid->RowIndex ?>_tahunajaran_id" id="x<?php echo $t09_siswarutin_grid->RowIndex ?>_tahunajaran_id" value="<?php echo ew_HtmlEncode($t09_siswarutin->tahunajaran_id->FormValue) ?>">
<input type="hidden" data-table="t09_siswarutin" data-field="x_tahunajaran_id" name="o<?php echo $t09_siswarutin_grid->RowIndex ?>_tahunajaran_id" id="o<?php echo $t09_siswarutin_grid->RowIndex ?>_tahunajaran_id" value="<?php echo ew_HtmlEncode($t09_siswarutin->tahunajaran_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t09_siswarutin" data-field="x_tahunajaran_id" name="ft09_siswarutingrid$x<?php echo $t09_siswarutin_grid->RowIndex ?>_tahunajaran_id" id="ft09_siswarutingrid$x<?php echo $t09_siswarutin_grid->RowIndex ?>_tahunajaran_id" value="<?php echo ew_HtmlEncode($t09_siswarutin->tahunajaran_id->FormValue) ?>">
<input type="hidden" data-table="t09_siswarutin" data-field="x_tahunajaran_id" name="ft09_siswarutingrid$o<?php echo $t09_siswarutin_grid->RowIndex ?>_tahunajaran_id" id="ft09_siswarutingrid$o<?php echo $t09_siswarutin_grid->RowIndex ?>_tahunajaran_id" value="<?php echo ew_HtmlEncode($t09_siswarutin->tahunajaran_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t09_siswarutin->nilai->Visible) { // nilai ?>
		<td data-name="nilai"<?php echo $t09_siswarutin->nilai->CellAttributes() ?>>
<?php if ($t09_siswarutin->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t09_siswarutin_grid->RowCnt ?>_t09_siswarutin_nilai" class="form-group t09_siswarutin_nilai">
<input type="text" data-table="t09_siswarutin" data-field="x_nilai" name="x<?php echo $t09_siswarutin_grid->RowIndex ?>_nilai" id="x<?php echo $t09_siswarutin_grid->RowIndex ?>_nilai" size="10" placeholder="<?php echo ew_HtmlEncode($t09_siswarutin->nilai->getPlaceHolder()) ?>" value="<?php echo $t09_siswarutin->nilai->EditValue ?>"<?php echo $t09_siswarutin->nilai->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t09_siswarutin" data-field="x_nilai" name="o<?php echo $t09_siswarutin_grid->RowIndex ?>_nilai" id="o<?php echo $t09_siswarutin_grid->RowIndex ?>_nilai" value="<?php echo ew_HtmlEncode($t09_siswarutin->nilai->OldValue) ?>">
<?php } ?>
<?php if ($t09_siswarutin->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t09_siswarutin_grid->RowCnt ?>_t09_siswarutin_nilai" class="form-group t09_siswarutin_nilai">
<input type="text" data-table="t09_siswarutin" data-field="x_nilai" name="x<?php echo $t09_siswarutin_grid->RowIndex ?>_nilai" id="x<?php echo $t09_siswarutin_grid->RowIndex ?>_nilai" size="10" placeholder="<?php echo ew_HtmlEncode($t09_siswarutin->nilai->getPlaceHolder()) ?>" value="<?php echo $t09_siswarutin->nilai->EditValue ?>"<?php echo $t09_siswarutin->nilai->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t09_siswarutin->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t09_siswarutin_grid->RowCnt ?>_t09_siswarutin_nilai" class="t09_siswarutin_nilai">
<span<?php echo $t09_siswarutin->nilai->ViewAttributes() ?>>
<?php echo $t09_siswarutin->nilai->ListViewValue() ?></span>
</span>
<?php if ($t09_siswarutin->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t09_siswarutin" data-field="x_nilai" name="x<?php echo $t09_siswarutin_grid->RowIndex ?>_nilai" id="x<?php echo $t09_siswarutin_grid->RowIndex ?>_nilai" value="<?php echo ew_HtmlEncode($t09_siswarutin->nilai->FormValue) ?>">
<input type="hidden" data-table="t09_siswarutin" data-field="x_nilai" name="o<?php echo $t09_siswarutin_grid->RowIndex ?>_nilai" id="o<?php echo $t09_siswarutin_grid->RowIndex ?>_nilai" value="<?php echo ew_HtmlEncode($t09_siswarutin->nilai->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t09_siswarutin" data-field="x_nilai" name="ft09_siswarutingrid$x<?php echo $t09_siswarutin_grid->RowIndex ?>_nilai" id="ft09_siswarutingrid$x<?php echo $t09_siswarutin_grid->RowIndex ?>_nilai" value="<?php echo ew_HtmlEncode($t09_siswarutin->nilai->FormValue) ?>">
<input type="hidden" data-table="t09_siswarutin" data-field="x_nilai" name="ft09_siswarutingrid$o<?php echo $t09_siswarutin_grid->RowIndex ?>_nilai" id="ft09_siswarutingrid$o<?php echo $t09_siswarutin_grid->RowIndex ?>_nilai" value="<?php echo ew_HtmlEncode($t09_siswarutin->nilai->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t09_siswarutin->Total->Visible) { // Total ?>
		<td data-name="Total"<?php echo $t09_siswarutin->Total->CellAttributes() ?>>
<?php if ($t09_siswarutin->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t09_siswarutin_grid->RowCnt ?>_t09_siswarutin_Total" class="form-group t09_siswarutin_Total">
<input type="text" data-table="t09_siswarutin" data-field="x_Total" name="x<?php echo $t09_siswarutin_grid->RowIndex ?>_Total" id="x<?php echo $t09_siswarutin_grid->RowIndex ?>_Total" size="30" placeholder="<?php echo ew_HtmlEncode($t09_siswarutin->Total->getPlaceHolder()) ?>" value="<?php echo $t09_siswarutin->Total->EditValue ?>"<?php echo $t09_siswarutin->Total->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t09_siswarutin" data-field="x_Total" name="o<?php echo $t09_siswarutin_grid->RowIndex ?>_Total" id="o<?php echo $t09_siswarutin_grid->RowIndex ?>_Total" value="<?php echo ew_HtmlEncode($t09_siswarutin->Total->OldValue) ?>">
<?php } ?>
<?php if ($t09_siswarutin->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t09_siswarutin_grid->RowCnt ?>_t09_siswarutin_Total" class="form-group t09_siswarutin_Total">
<input type="text" data-table="t09_siswarutin" data-field="x_Total" name="x<?php echo $t09_siswarutin_grid->RowIndex ?>_Total" id="x<?php echo $t09_siswarutin_grid->RowIndex ?>_Total" size="30" placeholder="<?php echo ew_HtmlEncode($t09_siswarutin->Total->getPlaceHolder()) ?>" value="<?php echo $t09_siswarutin->Total->EditValue ?>"<?php echo $t09_siswarutin->Total->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t09_siswarutin->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t09_siswarutin_grid->RowCnt ?>_t09_siswarutin_Total" class="t09_siswarutin_Total">
<span<?php echo $t09_siswarutin->Total->ViewAttributes() ?>>
<?php echo $t09_siswarutin->Total->ListViewValue() ?></span>
</span>
<?php if ($t09_siswarutin->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t09_siswarutin" data-field="x_Total" name="x<?php echo $t09_siswarutin_grid->RowIndex ?>_Total" id="x<?php echo $t09_siswarutin_grid->RowIndex ?>_Total" value="<?php echo ew_HtmlEncode($t09_siswarutin->Total->FormValue) ?>">
<input type="hidden" data-table="t09_siswarutin" data-field="x_Total" name="o<?php echo $t09_siswarutin_grid->RowIndex ?>_Total" id="o<?php echo $t09_siswarutin_grid->RowIndex ?>_Total" value="<?php echo ew_HtmlEncode($t09_siswarutin->Total->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t09_siswarutin" data-field="x_Total" name="ft09_siswarutingrid$x<?php echo $t09_siswarutin_grid->RowIndex ?>_Total" id="ft09_siswarutingrid$x<?php echo $t09_siswarutin_grid->RowIndex ?>_Total" value="<?php echo ew_HtmlEncode($t09_siswarutin->Total->FormValue) ?>">
<input type="hidden" data-table="t09_siswarutin" data-field="x_Total" name="ft09_siswarutingrid$o<?php echo $t09_siswarutin_grid->RowIndex ?>_Total" id="ft09_siswarutingrid$o<?php echo $t09_siswarutin_grid->RowIndex ?>_Total" value="<?php echo ew_HtmlEncode($t09_siswarutin->Total->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t09_siswarutin_grid->ListOptions->Render("body", "right", $t09_siswarutin_grid->RowCnt);
?>
	</tr>
<?php if ($t09_siswarutin->RowType == EW_ROWTYPE_ADD || $t09_siswarutin->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
ft09_siswarutingrid.UpdateOpts(<?php echo $t09_siswarutin_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($t09_siswarutin->CurrentAction <> "gridadd" || $t09_siswarutin->CurrentMode == "copy")
		if (!$t09_siswarutin_grid->Recordset->EOF) $t09_siswarutin_grid->Recordset->MoveNext();
}
?>
<?php
	if ($t09_siswarutin->CurrentMode == "add" || $t09_siswarutin->CurrentMode == "copy" || $t09_siswarutin->CurrentMode == "edit") {
		$t09_siswarutin_grid->RowIndex = '$rowindex$';
		$t09_siswarutin_grid->LoadDefaultValues();

		// Set row properties
		$t09_siswarutin->ResetAttrs();
		$t09_siswarutin->RowAttrs = array_merge($t09_siswarutin->RowAttrs, array('data-rowindex'=>$t09_siswarutin_grid->RowIndex, 'id'=>'r0_t09_siswarutin', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($t09_siswarutin->RowAttrs["class"], "ewTemplate");
		$t09_siswarutin->RowType = EW_ROWTYPE_ADD;

		// Render row
		$t09_siswarutin_grid->RenderRow();

		// Render list options
		$t09_siswarutin_grid->RenderListOptions();
		$t09_siswarutin_grid->StartRowCnt = 0;
?>
	<tr<?php echo $t09_siswarutin->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t09_siswarutin_grid->ListOptions->Render("body", "left", $t09_siswarutin_grid->RowIndex);
?>
	<?php if ($t09_siswarutin->rutin_id->Visible) { // rutin_id ?>
		<td data-name="rutin_id">
<?php if ($t09_siswarutin->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t09_siswarutin_rutin_id" class="form-group t09_siswarutin_rutin_id">
<select data-table="t09_siswarutin" data-field="x_rutin_id" data-value-separator="<?php echo $t09_siswarutin->rutin_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $t09_siswarutin_grid->RowIndex ?>_rutin_id" name="x<?php echo $t09_siswarutin_grid->RowIndex ?>_rutin_id"<?php echo $t09_siswarutin->rutin_id->EditAttributes() ?>>
<?php echo $t09_siswarutin->rutin_id->SelectOptionListHtml("x<?php echo $t09_siswarutin_grid->RowIndex ?>_rutin_id") ?>
</select>
<input type="hidden" name="s_x<?php echo $t09_siswarutin_grid->RowIndex ?>_rutin_id" id="s_x<?php echo $t09_siswarutin_grid->RowIndex ?>_rutin_id" value="<?php echo $t09_siswarutin->rutin_id->LookupFilterQuery() ?>">
</span>
<?php } else { ?>
<span id="el$rowindex$_t09_siswarutin_rutin_id" class="form-group t09_siswarutin_rutin_id">
<span<?php echo $t09_siswarutin->rutin_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t09_siswarutin->rutin_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t09_siswarutin" data-field="x_rutin_id" name="x<?php echo $t09_siswarutin_grid->RowIndex ?>_rutin_id" id="x<?php echo $t09_siswarutin_grid->RowIndex ?>_rutin_id" value="<?php echo ew_HtmlEncode($t09_siswarutin->rutin_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t09_siswarutin" data-field="x_rutin_id" name="o<?php echo $t09_siswarutin_grid->RowIndex ?>_rutin_id" id="o<?php echo $t09_siswarutin_grid->RowIndex ?>_rutin_id" value="<?php echo ew_HtmlEncode($t09_siswarutin->rutin_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t09_siswarutin->tahunajaran_id->Visible) { // tahunajaran_id ?>
		<td data-name="tahunajaran_id">
<?php if ($t09_siswarutin->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t09_siswarutin_tahunajaran_id" class="form-group t09_siswarutin_tahunajaran_id">
<select data-table="t09_siswarutin" data-field="x_tahunajaran_id" data-value-separator="<?php echo $t09_siswarutin->tahunajaran_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $t09_siswarutin_grid->RowIndex ?>_tahunajaran_id" name="x<?php echo $t09_siswarutin_grid->RowIndex ?>_tahunajaran_id"<?php echo $t09_siswarutin->tahunajaran_id->EditAttributes() ?>>
<?php echo $t09_siswarutin->tahunajaran_id->SelectOptionListHtml("x<?php echo $t09_siswarutin_grid->RowIndex ?>_tahunajaran_id") ?>
</select>
<input type="hidden" name="s_x<?php echo $t09_siswarutin_grid->RowIndex ?>_tahunajaran_id" id="s_x<?php echo $t09_siswarutin_grid->RowIndex ?>_tahunajaran_id" value="<?php echo $t09_siswarutin->tahunajaran_id->LookupFilterQuery() ?>">
</span>
<?php } else { ?>
<span id="el$rowindex$_t09_siswarutin_tahunajaran_id" class="form-group t09_siswarutin_tahunajaran_id">
<span<?php echo $t09_siswarutin->tahunajaran_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t09_siswarutin->tahunajaran_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t09_siswarutin" data-field="x_tahunajaran_id" name="x<?php echo $t09_siswarutin_grid->RowIndex ?>_tahunajaran_id" id="x<?php echo $t09_siswarutin_grid->RowIndex ?>_tahunajaran_id" value="<?php echo ew_HtmlEncode($t09_siswarutin->tahunajaran_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t09_siswarutin" data-field="x_tahunajaran_id" name="o<?php echo $t09_siswarutin_grid->RowIndex ?>_tahunajaran_id" id="o<?php echo $t09_siswarutin_grid->RowIndex ?>_tahunajaran_id" value="<?php echo ew_HtmlEncode($t09_siswarutin->tahunajaran_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t09_siswarutin->nilai->Visible) { // nilai ?>
		<td data-name="nilai">
<?php if ($t09_siswarutin->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t09_siswarutin_nilai" class="form-group t09_siswarutin_nilai">
<input type="text" data-table="t09_siswarutin" data-field="x_nilai" name="x<?php echo $t09_siswarutin_grid->RowIndex ?>_nilai" id="x<?php echo $t09_siswarutin_grid->RowIndex ?>_nilai" size="10" placeholder="<?php echo ew_HtmlEncode($t09_siswarutin->nilai->getPlaceHolder()) ?>" value="<?php echo $t09_siswarutin->nilai->EditValue ?>"<?php echo $t09_siswarutin->nilai->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t09_siswarutin_nilai" class="form-group t09_siswarutin_nilai">
<span<?php echo $t09_siswarutin->nilai->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t09_siswarutin->nilai->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t09_siswarutin" data-field="x_nilai" name="x<?php echo $t09_siswarutin_grid->RowIndex ?>_nilai" id="x<?php echo $t09_siswarutin_grid->RowIndex ?>_nilai" value="<?php echo ew_HtmlEncode($t09_siswarutin->nilai->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t09_siswarutin" data-field="x_nilai" name="o<?php echo $t09_siswarutin_grid->RowIndex ?>_nilai" id="o<?php echo $t09_siswarutin_grid->RowIndex ?>_nilai" value="<?php echo ew_HtmlEncode($t09_siswarutin->nilai->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t09_siswarutin->Total->Visible) { // Total ?>
		<td data-name="Total">
<?php if ($t09_siswarutin->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t09_siswarutin_Total" class="form-group t09_siswarutin_Total">
<input type="text" data-table="t09_siswarutin" data-field="x_Total" name="x<?php echo $t09_siswarutin_grid->RowIndex ?>_Total" id="x<?php echo $t09_siswarutin_grid->RowIndex ?>_Total" size="30" placeholder="<?php echo ew_HtmlEncode($t09_siswarutin->Total->getPlaceHolder()) ?>" value="<?php echo $t09_siswarutin->Total->EditValue ?>"<?php echo $t09_siswarutin->Total->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t09_siswarutin_Total" class="form-group t09_siswarutin_Total">
<span<?php echo $t09_siswarutin->Total->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t09_siswarutin->Total->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t09_siswarutin" data-field="x_Total" name="x<?php echo $t09_siswarutin_grid->RowIndex ?>_Total" id="x<?php echo $t09_siswarutin_grid->RowIndex ?>_Total" value="<?php echo ew_HtmlEncode($t09_siswarutin->Total->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t09_siswarutin" data-field="x_Total" name="o<?php echo $t09_siswarutin_grid->RowIndex ?>_Total" id="o<?php echo $t09_siswarutin_grid->RowIndex ?>_Total" value="<?php echo ew_HtmlEncode($t09_siswarutin->Total->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t09_siswarutin_grid->ListOptions->Render("body", "right", $t09_siswarutin_grid->RowCnt);
?>
<script type="text/javascript">
ft09_siswarutingrid.UpdateOpts(<?php echo $t09_siswarutin_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($t09_siswarutin->CurrentMode == "add" || $t09_siswarutin->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $t09_siswarutin_grid->FormKeyCountName ?>" id="<?php echo $t09_siswarutin_grid->FormKeyCountName ?>" value="<?php echo $t09_siswarutin_grid->KeyCount ?>">
<?php echo $t09_siswarutin_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t09_siswarutin->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $t09_siswarutin_grid->FormKeyCountName ?>" id="<?php echo $t09_siswarutin_grid->FormKeyCountName ?>" value="<?php echo $t09_siswarutin_grid->KeyCount ?>">
<?php echo $t09_siswarutin_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t09_siswarutin->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ft09_siswarutingrid">
</div>
<?php

// Close recordset
if ($t09_siswarutin_grid->Recordset)
	$t09_siswarutin_grid->Recordset->Close();
?>
<?php if ($t09_siswarutin_grid->ShowOtherOptions) { ?>
<div class="panel-footer ewGridLowerPanel">
<?php
	foreach ($t09_siswarutin_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($t09_siswarutin_grid->TotalRecs == 0 && $t09_siswarutin->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($t09_siswarutin_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($t09_siswarutin->Export == "") { ?>
<script type="text/javascript">
ft09_siswarutingrid.Init();
</script>
<?php } ?>
<?php
$t09_siswarutin_grid->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php
$t09_siswarutin_grid->Page_Terminate();
?>
