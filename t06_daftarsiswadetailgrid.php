<?php include_once "t96_employeesinfo.php" ?>
<?php

// Create page object
if (!isset($t06_daftarsiswadetail_grid)) $t06_daftarsiswadetail_grid = new ct06_daftarsiswadetail_grid();

// Page init
$t06_daftarsiswadetail_grid->Page_Init();

// Page main
$t06_daftarsiswadetail_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t06_daftarsiswadetail_grid->Page_Render();
?>
<?php if ($t06_daftarsiswadetail->Export == "") { ?>
<script type="text/javascript">

// Form object
var ft06_daftarsiswadetailgrid = new ew_Form("ft06_daftarsiswadetailgrid", "grid");
ft06_daftarsiswadetailgrid.FormKeyCountName = '<?php echo $t06_daftarsiswadetail_grid->FormKeyCountName ?>';

// Validate form
ft06_daftarsiswadetailgrid.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_siswa_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t06_daftarsiswadetail->siswa_id->FldCaption(), $t06_daftarsiswadetail->siswa_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_siswa_id");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t06_daftarsiswadetail->siswa_id->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
ft06_daftarsiswadetailgrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "siswa_id", false)) return false;
	return true;
}

// Form_CustomValidate event
ft06_daftarsiswadetailgrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft06_daftarsiswadetailgrid.ValidateRequired = true;
<?php } else { ?>
ft06_daftarsiswadetailgrid.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
ft06_daftarsiswadetailgrid.Lists["x_siswa_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_NIS","x_Nama","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t04_siswa"};

// Form object for search
</script>
<?php } ?>
<?php
if ($t06_daftarsiswadetail->CurrentAction == "gridadd") {
	if ($t06_daftarsiswadetail->CurrentMode == "copy") {
		$bSelectLimit = $t06_daftarsiswadetail_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$t06_daftarsiswadetail_grid->TotalRecs = $t06_daftarsiswadetail->SelectRecordCount();
			$t06_daftarsiswadetail_grid->Recordset = $t06_daftarsiswadetail_grid->LoadRecordset($t06_daftarsiswadetail_grid->StartRec-1, $t06_daftarsiswadetail_grid->DisplayRecs);
		} else {
			if ($t06_daftarsiswadetail_grid->Recordset = $t06_daftarsiswadetail_grid->LoadRecordset())
				$t06_daftarsiswadetail_grid->TotalRecs = $t06_daftarsiswadetail_grid->Recordset->RecordCount();
		}
		$t06_daftarsiswadetail_grid->StartRec = 1;
		$t06_daftarsiswadetail_grid->DisplayRecs = $t06_daftarsiswadetail_grid->TotalRecs;
	} else {
		$t06_daftarsiswadetail->CurrentFilter = "0=1";
		$t06_daftarsiswadetail_grid->StartRec = 1;
		$t06_daftarsiswadetail_grid->DisplayRecs = $t06_daftarsiswadetail->GridAddRowCount;
	}
	$t06_daftarsiswadetail_grid->TotalRecs = $t06_daftarsiswadetail_grid->DisplayRecs;
	$t06_daftarsiswadetail_grid->StopRec = $t06_daftarsiswadetail_grid->DisplayRecs;
} else {
	$bSelectLimit = $t06_daftarsiswadetail_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($t06_daftarsiswadetail_grid->TotalRecs <= 0)
			$t06_daftarsiswadetail_grid->TotalRecs = $t06_daftarsiswadetail->SelectRecordCount();
	} else {
		if (!$t06_daftarsiswadetail_grid->Recordset && ($t06_daftarsiswadetail_grid->Recordset = $t06_daftarsiswadetail_grid->LoadRecordset()))
			$t06_daftarsiswadetail_grid->TotalRecs = $t06_daftarsiswadetail_grid->Recordset->RecordCount();
	}
	$t06_daftarsiswadetail_grid->StartRec = 1;
	$t06_daftarsiswadetail_grid->DisplayRecs = $t06_daftarsiswadetail_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$t06_daftarsiswadetail_grid->Recordset = $t06_daftarsiswadetail_grid->LoadRecordset($t06_daftarsiswadetail_grid->StartRec-1, $t06_daftarsiswadetail_grid->DisplayRecs);

	// Set no record found message
	if ($t06_daftarsiswadetail->CurrentAction == "" && $t06_daftarsiswadetail_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$t06_daftarsiswadetail_grid->setWarningMessage(ew_DeniedMsg());
		if ($t06_daftarsiswadetail_grid->SearchWhere == "0=101")
			$t06_daftarsiswadetail_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$t06_daftarsiswadetail_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$t06_daftarsiswadetail_grid->RenderOtherOptions();
?>
<?php $t06_daftarsiswadetail_grid->ShowPageHeader(); ?>
<?php
$t06_daftarsiswadetail_grid->ShowMessage();
?>
<?php if ($t06_daftarsiswadetail_grid->TotalRecs > 0 || $t06_daftarsiswadetail->CurrentAction <> "") { ?>
<div class="panel panel-default ewGrid t06_daftarsiswadetail">
<div id="ft06_daftarsiswadetailgrid" class="ewForm form-inline">
<div id="gmp_t06_daftarsiswadetail" class="<?php if (ew_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<table id="tbl_t06_daftarsiswadetailgrid" class="table ewTable">
<?php echo $t06_daftarsiswadetail->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Header row
$t06_daftarsiswadetail_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$t06_daftarsiswadetail_grid->RenderListOptions();

// Render list options (header, left)
$t06_daftarsiswadetail_grid->ListOptions->Render("header", "left");
?>
<?php if ($t06_daftarsiswadetail->siswa_id->Visible) { // siswa_id ?>
	<?php if ($t06_daftarsiswadetail->SortUrl($t06_daftarsiswadetail->siswa_id) == "") { ?>
		<th data-name="siswa_id"><div id="elh_t06_daftarsiswadetail_siswa_id" class="t06_daftarsiswadetail_siswa_id"><div class="ewTableHeaderCaption"><?php echo $t06_daftarsiswadetail->siswa_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="siswa_id"><div><div id="elh_t06_daftarsiswadetail_siswa_id" class="t06_daftarsiswadetail_siswa_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t06_daftarsiswadetail->siswa_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t06_daftarsiswadetail->siswa_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t06_daftarsiswadetail->siswa_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$t06_daftarsiswadetail_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$t06_daftarsiswadetail_grid->StartRec = 1;
$t06_daftarsiswadetail_grid->StopRec = $t06_daftarsiswadetail_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($t06_daftarsiswadetail_grid->FormKeyCountName) && ($t06_daftarsiswadetail->CurrentAction == "gridadd" || $t06_daftarsiswadetail->CurrentAction == "gridedit" || $t06_daftarsiswadetail->CurrentAction == "F")) {
		$t06_daftarsiswadetail_grid->KeyCount = $objForm->GetValue($t06_daftarsiswadetail_grid->FormKeyCountName);
		$t06_daftarsiswadetail_grid->StopRec = $t06_daftarsiswadetail_grid->StartRec + $t06_daftarsiswadetail_grid->KeyCount - 1;
	}
}
$t06_daftarsiswadetail_grid->RecCnt = $t06_daftarsiswadetail_grid->StartRec - 1;
if ($t06_daftarsiswadetail_grid->Recordset && !$t06_daftarsiswadetail_grid->Recordset->EOF) {
	$t06_daftarsiswadetail_grid->Recordset->MoveFirst();
	$bSelectLimit = $t06_daftarsiswadetail_grid->UseSelectLimit;
	if (!$bSelectLimit && $t06_daftarsiswadetail_grid->StartRec > 1)
		$t06_daftarsiswadetail_grid->Recordset->Move($t06_daftarsiswadetail_grid->StartRec - 1);
} elseif (!$t06_daftarsiswadetail->AllowAddDeleteRow && $t06_daftarsiswadetail_grid->StopRec == 0) {
	$t06_daftarsiswadetail_grid->StopRec = $t06_daftarsiswadetail->GridAddRowCount;
}

// Initialize aggregate
$t06_daftarsiswadetail->RowType = EW_ROWTYPE_AGGREGATEINIT;
$t06_daftarsiswadetail->ResetAttrs();
$t06_daftarsiswadetail_grid->RenderRow();
if ($t06_daftarsiswadetail->CurrentAction == "gridadd")
	$t06_daftarsiswadetail_grid->RowIndex = 0;
if ($t06_daftarsiswadetail->CurrentAction == "gridedit")
	$t06_daftarsiswadetail_grid->RowIndex = 0;
while ($t06_daftarsiswadetail_grid->RecCnt < $t06_daftarsiswadetail_grid->StopRec) {
	$t06_daftarsiswadetail_grid->RecCnt++;
	if (intval($t06_daftarsiswadetail_grid->RecCnt) >= intval($t06_daftarsiswadetail_grid->StartRec)) {
		$t06_daftarsiswadetail_grid->RowCnt++;
		if ($t06_daftarsiswadetail->CurrentAction == "gridadd" || $t06_daftarsiswadetail->CurrentAction == "gridedit" || $t06_daftarsiswadetail->CurrentAction == "F") {
			$t06_daftarsiswadetail_grid->RowIndex++;
			$objForm->Index = $t06_daftarsiswadetail_grid->RowIndex;
			if ($objForm->HasValue($t06_daftarsiswadetail_grid->FormActionName))
				$t06_daftarsiswadetail_grid->RowAction = strval($objForm->GetValue($t06_daftarsiswadetail_grid->FormActionName));
			elseif ($t06_daftarsiswadetail->CurrentAction == "gridadd")
				$t06_daftarsiswadetail_grid->RowAction = "insert";
			else
				$t06_daftarsiswadetail_grid->RowAction = "";
		}

		// Set up key count
		$t06_daftarsiswadetail_grid->KeyCount = $t06_daftarsiswadetail_grid->RowIndex;

		// Init row class and style
		$t06_daftarsiswadetail->ResetAttrs();
		$t06_daftarsiswadetail->CssClass = "";
		if ($t06_daftarsiswadetail->CurrentAction == "gridadd") {
			if ($t06_daftarsiswadetail->CurrentMode == "copy") {
				$t06_daftarsiswadetail_grid->LoadRowValues($t06_daftarsiswadetail_grid->Recordset); // Load row values
				$t06_daftarsiswadetail_grid->SetRecordKey($t06_daftarsiswadetail_grid->RowOldKey, $t06_daftarsiswadetail_grid->Recordset); // Set old record key
			} else {
				$t06_daftarsiswadetail_grid->LoadDefaultValues(); // Load default values
				$t06_daftarsiswadetail_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$t06_daftarsiswadetail_grid->LoadRowValues($t06_daftarsiswadetail_grid->Recordset); // Load row values
		}
		$t06_daftarsiswadetail->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($t06_daftarsiswadetail->CurrentAction == "gridadd") // Grid add
			$t06_daftarsiswadetail->RowType = EW_ROWTYPE_ADD; // Render add
		if ($t06_daftarsiswadetail->CurrentAction == "gridadd" && $t06_daftarsiswadetail->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$t06_daftarsiswadetail_grid->RestoreCurrentRowFormValues($t06_daftarsiswadetail_grid->RowIndex); // Restore form values
		if ($t06_daftarsiswadetail->CurrentAction == "gridedit") { // Grid edit
			if ($t06_daftarsiswadetail->EventCancelled) {
				$t06_daftarsiswadetail_grid->RestoreCurrentRowFormValues($t06_daftarsiswadetail_grid->RowIndex); // Restore form values
			}
			if ($t06_daftarsiswadetail_grid->RowAction == "insert")
				$t06_daftarsiswadetail->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$t06_daftarsiswadetail->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($t06_daftarsiswadetail->CurrentAction == "gridedit" && ($t06_daftarsiswadetail->RowType == EW_ROWTYPE_EDIT || $t06_daftarsiswadetail->RowType == EW_ROWTYPE_ADD) && $t06_daftarsiswadetail->EventCancelled) // Update failed
			$t06_daftarsiswadetail_grid->RestoreCurrentRowFormValues($t06_daftarsiswadetail_grid->RowIndex); // Restore form values
		if ($t06_daftarsiswadetail->RowType == EW_ROWTYPE_EDIT) // Edit row
			$t06_daftarsiswadetail_grid->EditRowCnt++;
		if ($t06_daftarsiswadetail->CurrentAction == "F") // Confirm row
			$t06_daftarsiswadetail_grid->RestoreCurrentRowFormValues($t06_daftarsiswadetail_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$t06_daftarsiswadetail->RowAttrs = array_merge($t06_daftarsiswadetail->RowAttrs, array('data-rowindex'=>$t06_daftarsiswadetail_grid->RowCnt, 'id'=>'r' . $t06_daftarsiswadetail_grid->RowCnt . '_t06_daftarsiswadetail', 'data-rowtype'=>$t06_daftarsiswadetail->RowType));

		// Render row
		$t06_daftarsiswadetail_grid->RenderRow();

		// Render list options
		$t06_daftarsiswadetail_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($t06_daftarsiswadetail_grid->RowAction <> "delete" && $t06_daftarsiswadetail_grid->RowAction <> "insertdelete" && !($t06_daftarsiswadetail_grid->RowAction == "insert" && $t06_daftarsiswadetail->CurrentAction == "F" && $t06_daftarsiswadetail_grid->EmptyRow())) {
?>
	<tr<?php echo $t06_daftarsiswadetail->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t06_daftarsiswadetail_grid->ListOptions->Render("body", "left", $t06_daftarsiswadetail_grid->RowCnt);
?>
	<?php if ($t06_daftarsiswadetail->siswa_id->Visible) { // siswa_id ?>
		<td data-name="siswa_id"<?php echo $t06_daftarsiswadetail->siswa_id->CellAttributes() ?>>
<?php if ($t06_daftarsiswadetail->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t06_daftarsiswadetail_grid->RowCnt ?>_t06_daftarsiswadetail_siswa_id" class="form-group t06_daftarsiswadetail_siswa_id">
<?php
$wrkonchange = trim(" " . @$t06_daftarsiswadetail->siswa_id->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$t06_daftarsiswadetail->siswa_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t06_daftarsiswadetail_grid->RowIndex ?>_siswa_id" style="white-space: nowrap; z-index: <?php echo (9000 - $t06_daftarsiswadetail_grid->RowCnt * 10) ?>">
	<input type="text" name="sv_x<?php echo $t06_daftarsiswadetail_grid->RowIndex ?>_siswa_id" id="sv_x<?php echo $t06_daftarsiswadetail_grid->RowIndex ?>_siswa_id" value="<?php echo $t06_daftarsiswadetail->siswa_id->EditValue ?>" size="30" placeholder="<?php echo ew_HtmlEncode($t06_daftarsiswadetail->siswa_id->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($t06_daftarsiswadetail->siswa_id->getPlaceHolder()) ?>"<?php echo $t06_daftarsiswadetail->siswa_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t06_daftarsiswadetail" data-field="x_siswa_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t06_daftarsiswadetail->siswa_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t06_daftarsiswadetail_grid->RowIndex ?>_siswa_id" id="x<?php echo $t06_daftarsiswadetail_grid->RowIndex ?>_siswa_id" value="<?php echo ew_HtmlEncode($t06_daftarsiswadetail->siswa_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<input type="hidden" name="q_x<?php echo $t06_daftarsiswadetail_grid->RowIndex ?>_siswa_id" id="q_x<?php echo $t06_daftarsiswadetail_grid->RowIndex ?>_siswa_id" value="<?php echo $t06_daftarsiswadetail->siswa_id->LookupFilterQuery(true) ?>">
<script type="text/javascript">
ft06_daftarsiswadetailgrid.CreateAutoSuggest({"id":"x<?php echo $t06_daftarsiswadetail_grid->RowIndex ?>_siswa_id","forceSelect":true});
</script>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t06_daftarsiswadetail->siswa_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $t06_daftarsiswadetail_grid->RowIndex ?>_siswa_id',m:0,n:10,srch:false});" class="ewLookupBtn btn btn-default btn-sm"><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" name="s_x<?php echo $t06_daftarsiswadetail_grid->RowIndex ?>_siswa_id" id="s_x<?php echo $t06_daftarsiswadetail_grid->RowIndex ?>_siswa_id" value="<?php echo $t06_daftarsiswadetail->siswa_id->LookupFilterQuery(false) ?>">
</span>
<input type="hidden" data-table="t06_daftarsiswadetail" data-field="x_siswa_id" name="o<?php echo $t06_daftarsiswadetail_grid->RowIndex ?>_siswa_id" id="o<?php echo $t06_daftarsiswadetail_grid->RowIndex ?>_siswa_id" value="<?php echo ew_HtmlEncode($t06_daftarsiswadetail->siswa_id->OldValue) ?>">
<?php } ?>
<?php if ($t06_daftarsiswadetail->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t06_daftarsiswadetail_grid->RowCnt ?>_t06_daftarsiswadetail_siswa_id" class="form-group t06_daftarsiswadetail_siswa_id">
<?php
$wrkonchange = trim(" " . @$t06_daftarsiswadetail->siswa_id->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$t06_daftarsiswadetail->siswa_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t06_daftarsiswadetail_grid->RowIndex ?>_siswa_id" style="white-space: nowrap; z-index: <?php echo (9000 - $t06_daftarsiswadetail_grid->RowCnt * 10) ?>">
	<input type="text" name="sv_x<?php echo $t06_daftarsiswadetail_grid->RowIndex ?>_siswa_id" id="sv_x<?php echo $t06_daftarsiswadetail_grid->RowIndex ?>_siswa_id" value="<?php echo $t06_daftarsiswadetail->siswa_id->EditValue ?>" size="30" placeholder="<?php echo ew_HtmlEncode($t06_daftarsiswadetail->siswa_id->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($t06_daftarsiswadetail->siswa_id->getPlaceHolder()) ?>"<?php echo $t06_daftarsiswadetail->siswa_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t06_daftarsiswadetail" data-field="x_siswa_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t06_daftarsiswadetail->siswa_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t06_daftarsiswadetail_grid->RowIndex ?>_siswa_id" id="x<?php echo $t06_daftarsiswadetail_grid->RowIndex ?>_siswa_id" value="<?php echo ew_HtmlEncode($t06_daftarsiswadetail->siswa_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<input type="hidden" name="q_x<?php echo $t06_daftarsiswadetail_grid->RowIndex ?>_siswa_id" id="q_x<?php echo $t06_daftarsiswadetail_grid->RowIndex ?>_siswa_id" value="<?php echo $t06_daftarsiswadetail->siswa_id->LookupFilterQuery(true) ?>">
<script type="text/javascript">
ft06_daftarsiswadetailgrid.CreateAutoSuggest({"id":"x<?php echo $t06_daftarsiswadetail_grid->RowIndex ?>_siswa_id","forceSelect":true});
</script>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t06_daftarsiswadetail->siswa_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $t06_daftarsiswadetail_grid->RowIndex ?>_siswa_id',m:0,n:10,srch:false});" class="ewLookupBtn btn btn-default btn-sm"><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" name="s_x<?php echo $t06_daftarsiswadetail_grid->RowIndex ?>_siswa_id" id="s_x<?php echo $t06_daftarsiswadetail_grid->RowIndex ?>_siswa_id" value="<?php echo $t06_daftarsiswadetail->siswa_id->LookupFilterQuery(false) ?>">
</span>
<?php } ?>
<?php if ($t06_daftarsiswadetail->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t06_daftarsiswadetail_grid->RowCnt ?>_t06_daftarsiswadetail_siswa_id" class="t06_daftarsiswadetail_siswa_id">
<span<?php echo $t06_daftarsiswadetail->siswa_id->ViewAttributes() ?>>
<?php echo $t06_daftarsiswadetail->siswa_id->ListViewValue() ?></span>
</span>
<?php if ($t06_daftarsiswadetail->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t06_daftarsiswadetail" data-field="x_siswa_id" name="x<?php echo $t06_daftarsiswadetail_grid->RowIndex ?>_siswa_id" id="x<?php echo $t06_daftarsiswadetail_grid->RowIndex ?>_siswa_id" value="<?php echo ew_HtmlEncode($t06_daftarsiswadetail->siswa_id->FormValue) ?>">
<input type="hidden" data-table="t06_daftarsiswadetail" data-field="x_siswa_id" name="o<?php echo $t06_daftarsiswadetail_grid->RowIndex ?>_siswa_id" id="o<?php echo $t06_daftarsiswadetail_grid->RowIndex ?>_siswa_id" value="<?php echo ew_HtmlEncode($t06_daftarsiswadetail->siswa_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t06_daftarsiswadetail" data-field="x_siswa_id" name="ft06_daftarsiswadetailgrid$x<?php echo $t06_daftarsiswadetail_grid->RowIndex ?>_siswa_id" id="ft06_daftarsiswadetailgrid$x<?php echo $t06_daftarsiswadetail_grid->RowIndex ?>_siswa_id" value="<?php echo ew_HtmlEncode($t06_daftarsiswadetail->siswa_id->FormValue) ?>">
<input type="hidden" data-table="t06_daftarsiswadetail" data-field="x_siswa_id" name="ft06_daftarsiswadetailgrid$o<?php echo $t06_daftarsiswadetail_grid->RowIndex ?>_siswa_id" id="ft06_daftarsiswadetailgrid$o<?php echo $t06_daftarsiswadetail_grid->RowIndex ?>_siswa_id" value="<?php echo ew_HtmlEncode($t06_daftarsiswadetail->siswa_id->OldValue) ?>">
<?php } ?>
<?php } ?>
<a id="<?php echo $t06_daftarsiswadetail_grid->PageObjName . "_row_" . $t06_daftarsiswadetail_grid->RowCnt ?>"></a></td>
	<?php } ?>
<?php if ($t06_daftarsiswadetail->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="t06_daftarsiswadetail" data-field="x_id" name="x<?php echo $t06_daftarsiswadetail_grid->RowIndex ?>_id" id="x<?php echo $t06_daftarsiswadetail_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t06_daftarsiswadetail->id->CurrentValue) ?>">
<input type="hidden" data-table="t06_daftarsiswadetail" data-field="x_id" name="o<?php echo $t06_daftarsiswadetail_grid->RowIndex ?>_id" id="o<?php echo $t06_daftarsiswadetail_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t06_daftarsiswadetail->id->OldValue) ?>">
<?php } ?>
<?php if ($t06_daftarsiswadetail->RowType == EW_ROWTYPE_EDIT || $t06_daftarsiswadetail->CurrentMode == "edit") { ?>
<input type="hidden" data-table="t06_daftarsiswadetail" data-field="x_id" name="x<?php echo $t06_daftarsiswadetail_grid->RowIndex ?>_id" id="x<?php echo $t06_daftarsiswadetail_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t06_daftarsiswadetail->id->CurrentValue) ?>">
<?php } ?>
<?php

// Render list options (body, right)
$t06_daftarsiswadetail_grid->ListOptions->Render("body", "right", $t06_daftarsiswadetail_grid->RowCnt);
?>
	</tr>
<?php if ($t06_daftarsiswadetail->RowType == EW_ROWTYPE_ADD || $t06_daftarsiswadetail->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
ft06_daftarsiswadetailgrid.UpdateOpts(<?php echo $t06_daftarsiswadetail_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($t06_daftarsiswadetail->CurrentAction <> "gridadd" || $t06_daftarsiswadetail->CurrentMode == "copy")
		if (!$t06_daftarsiswadetail_grid->Recordset->EOF) $t06_daftarsiswadetail_grid->Recordset->MoveNext();
}
?>
<?php
	if ($t06_daftarsiswadetail->CurrentMode == "add" || $t06_daftarsiswadetail->CurrentMode == "copy" || $t06_daftarsiswadetail->CurrentMode == "edit") {
		$t06_daftarsiswadetail_grid->RowIndex = '$rowindex$';
		$t06_daftarsiswadetail_grid->LoadDefaultValues();

		// Set row properties
		$t06_daftarsiswadetail->ResetAttrs();
		$t06_daftarsiswadetail->RowAttrs = array_merge($t06_daftarsiswadetail->RowAttrs, array('data-rowindex'=>$t06_daftarsiswadetail_grid->RowIndex, 'id'=>'r0_t06_daftarsiswadetail', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($t06_daftarsiswadetail->RowAttrs["class"], "ewTemplate");
		$t06_daftarsiswadetail->RowType = EW_ROWTYPE_ADD;

		// Render row
		$t06_daftarsiswadetail_grid->RenderRow();

		// Render list options
		$t06_daftarsiswadetail_grid->RenderListOptions();
		$t06_daftarsiswadetail_grid->StartRowCnt = 0;
?>
	<tr<?php echo $t06_daftarsiswadetail->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t06_daftarsiswadetail_grid->ListOptions->Render("body", "left", $t06_daftarsiswadetail_grid->RowIndex);
?>
	<?php if ($t06_daftarsiswadetail->siswa_id->Visible) { // siswa_id ?>
		<td data-name="siswa_id">
<?php if ($t06_daftarsiswadetail->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t06_daftarsiswadetail_siswa_id" class="form-group t06_daftarsiswadetail_siswa_id">
<?php
$wrkonchange = trim(" " . @$t06_daftarsiswadetail->siswa_id->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$t06_daftarsiswadetail->siswa_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t06_daftarsiswadetail_grid->RowIndex ?>_siswa_id" style="white-space: nowrap; z-index: <?php echo (9000 - $t06_daftarsiswadetail_grid->RowCnt * 10) ?>">
	<input type="text" name="sv_x<?php echo $t06_daftarsiswadetail_grid->RowIndex ?>_siswa_id" id="sv_x<?php echo $t06_daftarsiswadetail_grid->RowIndex ?>_siswa_id" value="<?php echo $t06_daftarsiswadetail->siswa_id->EditValue ?>" size="30" placeholder="<?php echo ew_HtmlEncode($t06_daftarsiswadetail->siswa_id->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($t06_daftarsiswadetail->siswa_id->getPlaceHolder()) ?>"<?php echo $t06_daftarsiswadetail->siswa_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t06_daftarsiswadetail" data-field="x_siswa_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t06_daftarsiswadetail->siswa_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t06_daftarsiswadetail_grid->RowIndex ?>_siswa_id" id="x<?php echo $t06_daftarsiswadetail_grid->RowIndex ?>_siswa_id" value="<?php echo ew_HtmlEncode($t06_daftarsiswadetail->siswa_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<input type="hidden" name="q_x<?php echo $t06_daftarsiswadetail_grid->RowIndex ?>_siswa_id" id="q_x<?php echo $t06_daftarsiswadetail_grid->RowIndex ?>_siswa_id" value="<?php echo $t06_daftarsiswadetail->siswa_id->LookupFilterQuery(true) ?>">
<script type="text/javascript">
ft06_daftarsiswadetailgrid.CreateAutoSuggest({"id":"x<?php echo $t06_daftarsiswadetail_grid->RowIndex ?>_siswa_id","forceSelect":true});
</script>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t06_daftarsiswadetail->siswa_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $t06_daftarsiswadetail_grid->RowIndex ?>_siswa_id',m:0,n:10,srch:false});" class="ewLookupBtn btn btn-default btn-sm"><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" name="s_x<?php echo $t06_daftarsiswadetail_grid->RowIndex ?>_siswa_id" id="s_x<?php echo $t06_daftarsiswadetail_grid->RowIndex ?>_siswa_id" value="<?php echo $t06_daftarsiswadetail->siswa_id->LookupFilterQuery(false) ?>">
</span>
<?php } else { ?>
<span id="el$rowindex$_t06_daftarsiswadetail_siswa_id" class="form-group t06_daftarsiswadetail_siswa_id">
<span<?php echo $t06_daftarsiswadetail->siswa_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t06_daftarsiswadetail->siswa_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t06_daftarsiswadetail" data-field="x_siswa_id" name="x<?php echo $t06_daftarsiswadetail_grid->RowIndex ?>_siswa_id" id="x<?php echo $t06_daftarsiswadetail_grid->RowIndex ?>_siswa_id" value="<?php echo ew_HtmlEncode($t06_daftarsiswadetail->siswa_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t06_daftarsiswadetail" data-field="x_siswa_id" name="o<?php echo $t06_daftarsiswadetail_grid->RowIndex ?>_siswa_id" id="o<?php echo $t06_daftarsiswadetail_grid->RowIndex ?>_siswa_id" value="<?php echo ew_HtmlEncode($t06_daftarsiswadetail->siswa_id->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t06_daftarsiswadetail_grid->ListOptions->Render("body", "right", $t06_daftarsiswadetail_grid->RowCnt);
?>
<script type="text/javascript">
ft06_daftarsiswadetailgrid.UpdateOpts(<?php echo $t06_daftarsiswadetail_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($t06_daftarsiswadetail->CurrentMode == "add" || $t06_daftarsiswadetail->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $t06_daftarsiswadetail_grid->FormKeyCountName ?>" id="<?php echo $t06_daftarsiswadetail_grid->FormKeyCountName ?>" value="<?php echo $t06_daftarsiswadetail_grid->KeyCount ?>">
<?php echo $t06_daftarsiswadetail_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t06_daftarsiswadetail->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $t06_daftarsiswadetail_grid->FormKeyCountName ?>" id="<?php echo $t06_daftarsiswadetail_grid->FormKeyCountName ?>" value="<?php echo $t06_daftarsiswadetail_grid->KeyCount ?>">
<?php echo $t06_daftarsiswadetail_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t06_daftarsiswadetail->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ft06_daftarsiswadetailgrid">
</div>
<?php

// Close recordset
if ($t06_daftarsiswadetail_grid->Recordset)
	$t06_daftarsiswadetail_grid->Recordset->Close();
?>
<?php if ($t06_daftarsiswadetail_grid->ShowOtherOptions) { ?>
<div class="panel-footer ewGridLowerPanel">
<?php
	foreach ($t06_daftarsiswadetail_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($t06_daftarsiswadetail_grid->TotalRecs == 0 && $t06_daftarsiswadetail->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($t06_daftarsiswadetail_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($t06_daftarsiswadetail->Export == "") { ?>
<script type="text/javascript">
ft06_daftarsiswadetailgrid.Init();
</script>
<?php } ?>
<?php
$t06_daftarsiswadetail_grid->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php
$t06_daftarsiswadetail_grid->Page_Terminate();
?>
