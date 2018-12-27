<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg13.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql13.php") ?>
<?php include_once "phpfn13.php" ?>
<?php include_once "t08_siswasppinfo.php" ?>
<?php include_once "t04_siswainfo.php" ?>
<?php include_once "t96_employeesinfo.php" ?>
<?php include_once "userfn13.php" ?>
<?php

//
// Page class
//

$t08_siswaspp_add = NULL; // Initialize page object first

class ct08_siswaspp_add extends ct08_siswaspp {

	// Page ID
	var $PageID = 'add';

	// Project ID
	var $ProjectID = "{699E0CB8-ECC6-4DDA-93F3-012C887E6B12}";

	// Table name
	var $TableName = 't08_siswaspp';

	// Page object name
	var $PageObjName = 't08_siswaspp_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		if ($this->UseTokenInUrl) $PageUrl .= "t=" . $this->TableVar . "&"; // Add page token
		return $PageUrl;
	}

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_MESSAGE], $v);
	}

	function getFailureMessage() {
		return @$_SESSION[EW_SESSION_FAILURE_MESSAGE];
	}

	function setFailureMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_FAILURE_MESSAGE], $v);
	}

	function getSuccessMessage() {
		return @$_SESSION[EW_SESSION_SUCCESS_MESSAGE];
	}

	function setSuccessMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_SUCCESS_MESSAGE], $v);
	}

	function getWarningMessage() {
		return @$_SESSION[EW_SESSION_WARNING_MESSAGE];
	}

	function setWarningMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_WARNING_MESSAGE], $v);
	}

	// Methods to clear message
	function ClearMessage() {
		$_SESSION[EW_SESSION_MESSAGE] = "";
	}

	function ClearFailureMessage() {
		$_SESSION[EW_SESSION_FAILURE_MESSAGE] = "";
	}

	function ClearSuccessMessage() {
		$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = "";
	}

	function ClearWarningMessage() {
		$_SESSION[EW_SESSION_WARNING_MESSAGE] = "";
	}

	function ClearMessages() {
		$_SESSION[EW_SESSION_MESSAGE] = "";
		$_SESSION[EW_SESSION_FAILURE_MESSAGE] = "";
		$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = "";
		$_SESSION[EW_SESSION_WARNING_MESSAGE] = "";
	}

	// Show message
	function ShowMessage() {
		$hidden = FALSE;
		$html = "";

		// Message
		$sMessage = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sMessage, "");
		if ($sMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sMessage;
			$html .= "<div class=\"alert alert-info ewInfo\">" . $sMessage . "</div>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$sWarningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sWarningMessage, "warning");
		if ($sWarningMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sWarningMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sWarningMessage;
			$html .= "<div class=\"alert alert-warning ewWarning\">" . $sWarningMessage . "</div>";
			$_SESSION[EW_SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$sSuccessMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sSuccessMessage, "success");
		if ($sSuccessMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sSuccessMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sSuccessMessage;
			$html .= "<div class=\"alert alert-success ewSuccess\">" . $sSuccessMessage . "</div>";
			$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$sErrorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sErrorMessage, "failure");
		if ($sErrorMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sErrorMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sErrorMessage;
			$html .= "<div class=\"alert alert-danger ewError\">" . $sErrorMessage . "</div>";
			$_SESSION[EW_SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo "<div class=\"ewMessageDialog\"" . (($hidden) ? " style=\"display: none;\"" : "") . ">" . $html . "</div>";
	}
	var $PageHeader;
	var $PageFooter;

	// Show Page Header
	function ShowPageHeader() {
		$sHeader = $this->PageHeader;
		$this->Page_DataRendering($sHeader);
		if ($sHeader <> "") { // Header exists, display
			echo "<p>" . $sHeader . "</p>";
		}
	}

	// Show Page Footer
	function ShowPageFooter() {
		$sFooter = $this->PageFooter;
		$this->Page_DataRendered($sFooter);
		if ($sFooter <> "") { // Footer exists, display
			echo "<p>" . $sFooter . "</p>";
		}
	}

	// Validate page request
	function IsPageRequest() {
		global $objForm;
		if ($this->UseTokenInUrl) {
			if ($objForm)
				return ($this->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($this->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}
	var $Token = "";
	var $TokenTimeout = 0;
	var $CheckToken = EW_CHECK_TOKEN;
	var $CheckTokenFn = "ew_CheckToken";
	var $CreateTokenFn = "ew_CreateToken";

	// Valid Post
	function ValidPost() {
		if (!$this->CheckToken || !ew_IsHttpPost())
			return TRUE;
		if (!isset($_POST[EW_TOKEN_NAME]))
			return FALSE;
		$fn = $this->CheckTokenFn;
		if (is_callable($fn))
			return $fn($_POST[EW_TOKEN_NAME], $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	function CreateToken() {
		global $gsToken;
		if ($this->CheckToken) {
			$fn = $this->CreateTokenFn;
			if ($this->Token == "" && is_callable($fn)) // Create token
				$this->Token = $fn();
			$gsToken = $this->Token; // Save to global variable
		}
	}

	//
	// Page class constructor
	//
	function __construct() {
		global $conn, $Language;
		global $UserTable, $UserTableConn;
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = ew_SessionTimeoutTime();

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Parent constuctor
		parent::__construct();

		// Table object (t08_siswaspp)
		if (!isset($GLOBALS["t08_siswaspp"]) || get_class($GLOBALS["t08_siswaspp"]) == "ct08_siswaspp") {
			$GLOBALS["t08_siswaspp"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t08_siswaspp"];
		}

		// Table object (t04_siswa)
		if (!isset($GLOBALS['t04_siswa'])) $GLOBALS['t04_siswa'] = new ct04_siswa();

		// Table object (t96_employees)
		if (!isset($GLOBALS['t96_employees'])) $GLOBALS['t96_employees'] = new ct96_employees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 't08_siswaspp', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"])) $GLOBALS["gTimer"] = new cTimer();

		// Open connection
		if (!isset($conn)) $conn = ew_Connect($this->DBID);

		// User table object (t96_employees)
		if (!isset($UserTable)) {
			$UserTable = new ct96_employees();
			$UserTableConn = Conn($UserTable->DBID);
		}
	}

	//
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsCustomExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if ($Security->IsLoggedIn()) $Security->TablePermission_Loading();
		$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName);
		if ($Security->IsLoggedIn()) $Security->TablePermission_Loaded();
		if (!$Security->CanAdd()) {
			$Security->SaveLastUrl();
			$this->setFailureMessage(ew_DeniedMsg()); // Set no permission
			if ($Security->CanList())
				$this->Page_Terminate(ew_GetUrl("t08_siswaspplist.php"));
			else
				$this->Page_Terminate(ew_GetUrl("login.php"));
		}
		if ($Security->IsLoggedIn()) {
			$Security->UserID_Loading();
			$Security->LoadUserID();
			$Security->UserID_Loaded();
		}

		// Create form object
		$objForm = new cFormObj();
		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action
		$this->tahunajaran_id->SetVisibility();
		$this->spp_id->SetVisibility();
		$this->Nilai->SetVisibility();
		$this->Terbayar->SetVisibility();
		$this->Potensi->SetVisibility();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->ValidPost()) {
			echo $Language->Phrase("InvalidPostRequest");
			$this->Page_Terminate();
			exit();
		}

		// Process auto fill
		if (@$_POST["ajax"] == "autofill") {
			$results = $this->GetAutoFill(@$_POST["name"], @$_POST["q"]);
			if ($results) {

				// Clean output buffer
				if (!EW_DEBUG_ENABLED && ob_get_length())
					ob_end_clean();
				echo $results;
				$this->Page_Terminate();
				exit();
			}
		}

		// Create Token
		$this->CreateToken();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $gsExportFile, $gTmpImages;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $EW_EXPORT, $t08_siswaspp;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($t08_siswaspp);
				$doc->Text = $sContent;
				if ($this->Export == "email")
					echo $this->ExportEmail($doc->Text);
				else
					$doc->Export();
				ew_DeleteTmpImages(); // Delete temp images
				exit();
			}
		}
		$this->Page_Redirecting($url);

		 // Close connection
		ew_CloseConn();

		// Go to URL if specified
		if ($url <> "") {
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();

			// Handle modal response
			if ($this->IsModal) {
				$row = array();
				$row["url"] = $url;
				echo ew_ArrayToJson(array($row));
			} else {
				header("Location: " . $url);
			}
		}
		exit();
	}
	var $FormClassName = "form-horizontal ewForm ewAddForm";
	var $IsModal = FALSE;
	var $DbMasterFilter = "";
	var $DbDetailFilter = "";
	var $StartRec;
	var $Priv = 0;
	var $OldRecordset;
	var $CopyRecord;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError;
		global $gbSkipHeaderFooter;

		// Check modal
		$this->IsModal = (@$_GET["modal"] == "1" || @$_POST["modal"] == "1");
		if ($this->IsModal)
			$gbSkipHeaderFooter = TRUE;

		// Set up master/detail parameters
		$this->SetUpMasterParms();

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$this->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["id"] != "") {
				$this->id->setQueryStringValue($_GET["id"]);
				$this->setKey("id", $this->id->CurrentValue); // Set up key
			} else {
				$this->setKey("id", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$this->CurrentAction = "C"; // Copy record
			} else {
				$this->CurrentAction = "I"; // Display blank record
			}
		}

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Validate form if post back
		if (@$_POST["a_add"] <> "") {
			if (!$this->ValidateForm()) {
				$this->CurrentAction = "I"; // Form error, reset action
				$this->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else {
			if ($this->CurrentAction == "I") // Load default values for blank record
				$this->LoadDefaultValues();
		}

		// Perform action based on action code
		switch ($this->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					if ($this->getFailureMessage() == "") $this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("t08_siswaspplist.php"); // No matching record, return to list
				}
				break;
			case "A": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $this->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "t08_siswaspplist.php")
						$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to list page with correct master key if necessary
					elseif (ew_GetPageName($sReturnUrl) == "t08_siswasppview.php")
						$sReturnUrl = $this->GetViewUrl(); // View page, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$this->RowType = EW_ROWTYPE_ADD; // Render add type

		// Render row
		$this->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $Language;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		$this->tahunajaran_id->CurrentValue = NULL;
		$this->tahunajaran_id->OldValue = $this->tahunajaran_id->CurrentValue;
		$this->spp_id->CurrentValue = NULL;
		$this->spp_id->OldValue = $this->spp_id->CurrentValue;
		$this->Nilai->CurrentValue = 0.00;
		$this->Terbayar->CurrentValue = 0.00;
		$this->Potensi->CurrentValue = 0.00;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->tahunajaran_id->FldIsDetailKey) {
			$this->tahunajaran_id->setFormValue($objForm->GetValue("x_tahunajaran_id"));
		}
		if (!$this->spp_id->FldIsDetailKey) {
			$this->spp_id->setFormValue($objForm->GetValue("x_spp_id"));
		}
		if (!$this->Nilai->FldIsDetailKey) {
			$this->Nilai->setFormValue($objForm->GetValue("x_Nilai"));
		}
		if (!$this->Terbayar->FldIsDetailKey) {
			$this->Terbayar->setFormValue($objForm->GetValue("x_Terbayar"));
		}
		if (!$this->Potensi->FldIsDetailKey) {
			$this->Potensi->setFormValue($objForm->GetValue("x_Potensi"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->LoadOldRecord();
		$this->tahunajaran_id->CurrentValue = $this->tahunajaran_id->FormValue;
		$this->spp_id->CurrentValue = $this->spp_id->FormValue;
		$this->Nilai->CurrentValue = $this->Nilai->FormValue;
		$this->Terbayar->CurrentValue = $this->Terbayar->FormValue;
		$this->Potensi->CurrentValue = $this->Potensi->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $Security, $Language;
		$sFilter = $this->KeyFilter();

		// Call Row Selecting event
		$this->Row_Selecting($sFilter);

		// Load SQL based on filter
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		$conn = &$this->Connection();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row = &$rs->fields;
		$this->Row_Selected($row);
		$this->id->setDbValue($rs->fields('id'));
		$this->siswa_id->setDbValue($rs->fields('siswa_id'));
		$this->tahunajaran_id->setDbValue($rs->fields('tahunajaran_id'));
		$this->spp_id->setDbValue($rs->fields('spp_id'));
		$this->Nilai->setDbValue($rs->fields('Nilai'));
		$this->Terbayar->setDbValue($rs->fields('Terbayar'));
		$this->Potensi->setDbValue($rs->fields('Potensi'));
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF) return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->siswa_id->DbValue = $row['siswa_id'];
		$this->tahunajaran_id->DbValue = $row['tahunajaran_id'];
		$this->spp_id->DbValue = $row['spp_id'];
		$this->Nilai->DbValue = $row['Nilai'];
		$this->Terbayar->DbValue = $row['Terbayar'];
		$this->Potensi->DbValue = $row['Potensi'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("id")) <> "")
			$this->id->CurrentValue = $this->getKey("id"); // id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$this->CurrentFilter = $this->KeyFilter();
			$sSql = $this->SQL();
			$conn = &$this->Connection();
			$this->OldRecordset = ew_LoadRecordset($sSql, $conn);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Convert decimal values if posted back

		if ($this->Nilai->FormValue == $this->Nilai->CurrentValue && is_numeric(ew_StrToFloat($this->Nilai->CurrentValue)))
			$this->Nilai->CurrentValue = ew_StrToFloat($this->Nilai->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Terbayar->FormValue == $this->Terbayar->CurrentValue && is_numeric(ew_StrToFloat($this->Terbayar->CurrentValue)))
			$this->Terbayar->CurrentValue = ew_StrToFloat($this->Terbayar->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Potensi->FormValue == $this->Potensi->CurrentValue && is_numeric(ew_StrToFloat($this->Potensi->CurrentValue)))
			$this->Potensi->CurrentValue = ew_StrToFloat($this->Potensi->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// id
		// siswa_id
		// tahunajaran_id
		// spp_id
		// Nilai
		// Terbayar
		// Potensi

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// siswa_id
		$this->siswa_id->ViewValue = $this->siswa_id->CurrentValue;
		$this->siswa_id->ViewCustomAttributes = "";

		// tahunajaran_id
		if (strval($this->tahunajaran_id->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->tahunajaran_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `id`, `TahunAjaran` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t01_tahunajaran`";
		$sWhereWrk = "";
		$this->tahunajaran_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->tahunajaran_id, $sWhereWrk); // Call Lookup selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->tahunajaran_id->ViewValue = $this->tahunajaran_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->tahunajaran_id->ViewValue = $this->tahunajaran_id->CurrentValue;
			}
		} else {
			$this->tahunajaran_id->ViewValue = NULL;
		}
		$this->tahunajaran_id->ViewCustomAttributes = "";

		// spp_id
		if (strval($this->spp_id->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->spp_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `id`, `SPP` AS `DispFld`, `Jenis` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t07_spp`";
		$sWhereWrk = "";
		$this->spp_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->spp_id, $sWhereWrk); // Call Lookup selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$arwrk[2] = $rswrk->fields('Disp2Fld');
				$this->spp_id->ViewValue = $this->spp_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->spp_id->ViewValue = $this->spp_id->CurrentValue;
			}
		} else {
			$this->spp_id->ViewValue = NULL;
		}
		$this->spp_id->ViewCustomAttributes = "";

		// Nilai
		$this->Nilai->ViewValue = $this->Nilai->CurrentValue;
		$this->Nilai->ViewValue = ew_FormatNumber($this->Nilai->ViewValue, 2, -2, -2, -2);
		$this->Nilai->CellCssStyle .= "text-align: right;";
		$this->Nilai->ViewCustomAttributes = "";

		// Terbayar
		$this->Terbayar->ViewValue = $this->Terbayar->CurrentValue;
		$this->Terbayar->ViewValue = ew_FormatNumber($this->Terbayar->ViewValue, 2, -2, -2, -2);
		$this->Terbayar->CellCssStyle .= "text-align: right;";
		$this->Terbayar->ViewCustomAttributes = "";

		// Potensi
		$this->Potensi->ViewValue = $this->Potensi->CurrentValue;
		$this->Potensi->ViewValue = ew_FormatNumber($this->Potensi->ViewValue, 2, -2, -2, -2);
		$this->Potensi->CellCssStyle .= "text-align: right;";
		$this->Potensi->ViewCustomAttributes = "";

			// tahunajaran_id
			$this->tahunajaran_id->LinkCustomAttributes = "";
			$this->tahunajaran_id->HrefValue = "";
			$this->tahunajaran_id->TooltipValue = "";

			// spp_id
			$this->spp_id->LinkCustomAttributes = "";
			$this->spp_id->HrefValue = "";
			$this->spp_id->TooltipValue = "";

			// Nilai
			$this->Nilai->LinkCustomAttributes = "";
			$this->Nilai->HrefValue = "";
			$this->Nilai->TooltipValue = "";

			// Terbayar
			$this->Terbayar->LinkCustomAttributes = "";
			$this->Terbayar->HrefValue = "";
			$this->Terbayar->TooltipValue = "";

			// Potensi
			$this->Potensi->LinkCustomAttributes = "";
			$this->Potensi->HrefValue = "";
			$this->Potensi->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// tahunajaran_id
			$this->tahunajaran_id->EditAttrs["class"] = "form-control";
			$this->tahunajaran_id->EditCustomAttributes = "";
			if (trim(strval($this->tahunajaran_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->tahunajaran_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `id`, `TahunAjaran` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `t01_tahunajaran`";
			$sWhereWrk = "";
			$this->tahunajaran_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->tahunajaran_id, $sWhereWrk); // Call Lookup selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->tahunajaran_id->EditValue = $arwrk;

			// spp_id
			$this->spp_id->EditAttrs["class"] = "form-control";
			$this->spp_id->EditCustomAttributes = "";
			if (trim(strval($this->spp_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->spp_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `id`, `SPP` AS `DispFld`, `Jenis` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `t07_spp`";
			$sWhereWrk = "";
			$this->spp_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->spp_id, $sWhereWrk); // Call Lookup selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->spp_id->EditValue = $arwrk;

			// Nilai
			$this->Nilai->EditAttrs["class"] = "form-control";
			$this->Nilai->EditCustomAttributes = "";
			$this->Nilai->EditValue = ew_HtmlEncode($this->Nilai->CurrentValue);
			$this->Nilai->PlaceHolder = ew_RemoveHtml($this->Nilai->FldCaption());
			if (strval($this->Nilai->EditValue) <> "" && is_numeric($this->Nilai->EditValue)) $this->Nilai->EditValue = ew_FormatNumber($this->Nilai->EditValue, -2, -2, -2, -2);

			// Terbayar
			$this->Terbayar->EditAttrs["class"] = "form-control";
			$this->Terbayar->EditCustomAttributes = "";
			$this->Terbayar->EditValue = ew_HtmlEncode($this->Terbayar->CurrentValue);
			$this->Terbayar->PlaceHolder = ew_RemoveHtml($this->Terbayar->FldCaption());
			if (strval($this->Terbayar->EditValue) <> "" && is_numeric($this->Terbayar->EditValue)) $this->Terbayar->EditValue = ew_FormatNumber($this->Terbayar->EditValue, -2, -2, -2, -2);

			// Potensi
			$this->Potensi->EditAttrs["class"] = "form-control";
			$this->Potensi->EditCustomAttributes = "";
			$this->Potensi->EditValue = ew_HtmlEncode($this->Potensi->CurrentValue);
			$this->Potensi->PlaceHolder = ew_RemoveHtml($this->Potensi->FldCaption());
			if (strval($this->Potensi->EditValue) <> "" && is_numeric($this->Potensi->EditValue)) $this->Potensi->EditValue = ew_FormatNumber($this->Potensi->EditValue, -2, -2, -2, -2);

			// Add refer script
			// tahunajaran_id

			$this->tahunajaran_id->LinkCustomAttributes = "";
			$this->tahunajaran_id->HrefValue = "";

			// spp_id
			$this->spp_id->LinkCustomAttributes = "";
			$this->spp_id->HrefValue = "";

			// Nilai
			$this->Nilai->LinkCustomAttributes = "";
			$this->Nilai->HrefValue = "";

			// Terbayar
			$this->Terbayar->LinkCustomAttributes = "";
			$this->Terbayar->HrefValue = "";

			// Potensi
			$this->Potensi->LinkCustomAttributes = "";
			$this->Potensi->HrefValue = "";
		}
		if ($this->RowType == EW_ROWTYPE_ADD ||
			$this->RowType == EW_ROWTYPE_EDIT ||
			$this->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$this->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!$this->tahunajaran_id->FldIsDetailKey && !is_null($this->tahunajaran_id->FormValue) && $this->tahunajaran_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->tahunajaran_id->FldCaption(), $this->tahunajaran_id->ReqErrMsg));
		}
		if (!$this->spp_id->FldIsDetailKey && !is_null($this->spp_id->FormValue) && $this->spp_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->spp_id->FldCaption(), $this->spp_id->ReqErrMsg));
		}
		if (!$this->Nilai->FldIsDetailKey && !is_null($this->Nilai->FormValue) && $this->Nilai->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Nilai->FldCaption(), $this->Nilai->ReqErrMsg));
		}
		if (!ew_CheckNumber($this->Nilai->FormValue)) {
			ew_AddMessage($gsFormError, $this->Nilai->FldErrMsg());
		}
		if (!$this->Terbayar->FldIsDetailKey && !is_null($this->Terbayar->FormValue) && $this->Terbayar->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Terbayar->FldCaption(), $this->Terbayar->ReqErrMsg));
		}
		if (!ew_CheckNumber($this->Terbayar->FormValue)) {
			ew_AddMessage($gsFormError, $this->Terbayar->FldErrMsg());
		}
		if (!$this->Potensi->FldIsDetailKey && !is_null($this->Potensi->FormValue) && $this->Potensi->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Potensi->FldCaption(), $this->Potensi->ReqErrMsg));
		}
		if (!ew_CheckNumber($this->Potensi->FormValue)) {
			ew_AddMessage($gsFormError, $this->Potensi->FldErrMsg());
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			ew_AddMessage($gsFormError, $sFormCustomError);
		}
		return $ValidateForm;
	}

	// Add record
	function AddRow($rsold = NULL) {
		global $Language, $Security;
		$conn = &$this->Connection();

		// Load db values from rsold
		if ($rsold) {
			$this->LoadDbValues($rsold);
		}
		$rsnew = array();

		// tahunajaran_id
		$this->tahunajaran_id->SetDbValueDef($rsnew, $this->tahunajaran_id->CurrentValue, 0, FALSE);

		// spp_id
		$this->spp_id->SetDbValueDef($rsnew, $this->spp_id->CurrentValue, 0, FALSE);

		// Nilai
		$this->Nilai->SetDbValueDef($rsnew, $this->Nilai->CurrentValue, 0, strval($this->Nilai->CurrentValue) == "");

		// Terbayar
		$this->Terbayar->SetDbValueDef($rsnew, $this->Terbayar->CurrentValue, 0, strval($this->Terbayar->CurrentValue) == "");

		// Potensi
		$this->Potensi->SetDbValueDef($rsnew, $this->Potensi->CurrentValue, 0, strval($this->Potensi->CurrentValue) == "");

		// siswa_id
		if ($this->siswa_id->getSessionValue() <> "") {
			$rsnew['siswa_id'] = $this->siswa_id->getSessionValue();
		}

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $this->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			$AddRow = $this->Insert($rsnew);
			$conn->raiseErrorFn = '';
			if ($AddRow) {
			}
		} else {
			if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage <> "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$this->Row_Inserted($rs, $rsnew);
		}
		return $AddRow;
	}

	// Set up master/detail based on QueryString
	function SetUpMasterParms() {
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (isset($_GET[EW_TABLE_SHOW_MASTER])) {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($sMasterTblVar == "t04_siswa") {
				$bValidMaster = TRUE;
				if (@$_GET["fk_id"] <> "") {
					$GLOBALS["t04_siswa"]->id->setQueryStringValue($_GET["fk_id"]);
					$this->siswa_id->setQueryStringValue($GLOBALS["t04_siswa"]->id->QueryStringValue);
					$this->siswa_id->setSessionValue($this->siswa_id->QueryStringValue);
					if (!is_numeric($GLOBALS["t04_siswa"]->id->QueryStringValue)) $bValidMaster = FALSE;
				} else {
					$bValidMaster = FALSE;
				}
			}
		} elseif (isset($_POST[EW_TABLE_SHOW_MASTER])) {
			$sMasterTblVar = $_POST[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($sMasterTblVar == "t04_siswa") {
				$bValidMaster = TRUE;
				if (@$_POST["fk_id"] <> "") {
					$GLOBALS["t04_siswa"]->id->setFormValue($_POST["fk_id"]);
					$this->siswa_id->setFormValue($GLOBALS["t04_siswa"]->id->FormValue);
					$this->siswa_id->setSessionValue($this->siswa_id->FormValue);
					if (!is_numeric($GLOBALS["t04_siswa"]->id->FormValue)) $bValidMaster = FALSE;
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$this->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->StartRec = 1;
			$this->setStartRecordNumber($this->StartRec);

			// Clear previous master key from Session
			if ($sMasterTblVar <> "t04_siswa") {
				if ($this->siswa_id->CurrentValue == "") $this->siswa_id->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $this->GetMasterFilter(); // Get master filter
		$this->DbDetailFilter = $this->GetDetailFilter(); // Get detail filter
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("t08_siswaspplist.php"), "", $this->TableVar, TRUE);
		$PageId = ($this->CurrentAction == "C") ? "Copy" : "Add";
		$Breadcrumb->Add("add", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_tahunajaran_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id` AS `LinkFld`, `TahunAjaran` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t01_tahunajaran`";
			$sWhereWrk = "";
			$this->tahunajaran_id->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`id` = {filter_value}', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->tahunajaran_id, $sWhereWrk); // Call Lookup selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_spp_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id` AS `LinkFld`, `SPP` AS `DispFld`, `Jenis` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t07_spp`";
			$sWhereWrk = "";
			$this->spp_id->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`id` = {filter_value}', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->spp_id, $sWhereWrk); // Call Lookup selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		}
	}

	// Setup AutoSuggest filters of a field
	function SetupAutoSuggestFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($t08_siswaspp_add)) $t08_siswaspp_add = new ct08_siswaspp_add();

// Page init
$t08_siswaspp_add->Page_Init();

// Page main
$t08_siswaspp_add->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t08_siswaspp_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "add";
var CurrentForm = ft08_siswasppadd = new ew_Form("ft08_siswasppadd", "add");

// Validate form
ft08_siswasppadd.Validate = function() {
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
	}

	// Process detail forms
	var dfs = $fobj.find("input[name='detailpage']").get();
	for (var i = 0; i < dfs.length; i++) {
		var df = dfs[i], val = df.value;
		if (val && ewForms[val])
			if (!ewForms[val].Validate())
				return false;
	}
	return true;
}

// Form_CustomValidate event
ft08_siswasppadd.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft08_siswasppadd.ValidateRequired = true;
<?php } else { ?>
ft08_siswasppadd.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
ft08_siswasppadd.Lists["x_tahunajaran_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_TahunAjaran","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t01_tahunajaran"};
ft08_siswasppadd.Lists["x_spp_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_SPP","x_Jenis","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t07_spp"};

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php if (!$t08_siswaspp_add->IsModal) { ?>
<div class="ewToolbar">
<?php $Breadcrumb->Render(); ?>
<?php echo $Language->SelectionForm(); ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $t08_siswaspp_add->ShowPageHeader(); ?>
<?php
$t08_siswaspp_add->ShowMessage();
?>
<form name="ft08_siswasppadd" id="ft08_siswasppadd" class="<?php echo $t08_siswaspp_add->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($t08_siswaspp_add->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $t08_siswaspp_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t08_siswaspp">
<input type="hidden" name="a_add" id="a_add" value="A">
<?php if ($t08_siswaspp_add->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<?php if ($t08_siswaspp->getCurrentMasterTable() == "t04_siswa") { ?>
<input type="hidden" name="<?php echo EW_TABLE_SHOW_MASTER ?>" value="t04_siswa">
<input type="hidden" name="fk_id" value="<?php echo $t08_siswaspp->siswa_id->getSessionValue() ?>">
<?php } ?>
<div>
<?php if ($t08_siswaspp->tahunajaran_id->Visible) { // tahunajaran_id ?>
	<div id="r_tahunajaran_id" class="form-group">
		<label id="elh_t08_siswaspp_tahunajaran_id" for="x_tahunajaran_id" class="col-sm-2 control-label ewLabel"><?php echo $t08_siswaspp->tahunajaran_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t08_siswaspp->tahunajaran_id->CellAttributes() ?>>
<span id="el_t08_siswaspp_tahunajaran_id">
<select data-table="t08_siswaspp" data-field="x_tahunajaran_id" data-value-separator="<?php echo $t08_siswaspp->tahunajaran_id->DisplayValueSeparatorAttribute() ?>" id="x_tahunajaran_id" name="x_tahunajaran_id"<?php echo $t08_siswaspp->tahunajaran_id->EditAttributes() ?>>
<?php echo $t08_siswaspp->tahunajaran_id->SelectOptionListHtml("x_tahunajaran_id") ?>
</select>
<input type="hidden" name="s_x_tahunajaran_id" id="s_x_tahunajaran_id" value="<?php echo $t08_siswaspp->tahunajaran_id->LookupFilterQuery() ?>">
</span>
<?php echo $t08_siswaspp->tahunajaran_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t08_siswaspp->spp_id->Visible) { // spp_id ?>
	<div id="r_spp_id" class="form-group">
		<label id="elh_t08_siswaspp_spp_id" for="x_spp_id" class="col-sm-2 control-label ewLabel"><?php echo $t08_siswaspp->spp_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t08_siswaspp->spp_id->CellAttributes() ?>>
<span id="el_t08_siswaspp_spp_id">
<select data-table="t08_siswaspp" data-field="x_spp_id" data-value-separator="<?php echo $t08_siswaspp->spp_id->DisplayValueSeparatorAttribute() ?>" id="x_spp_id" name="x_spp_id"<?php echo $t08_siswaspp->spp_id->EditAttributes() ?>>
<?php echo $t08_siswaspp->spp_id->SelectOptionListHtml("x_spp_id") ?>
</select>
<input type="hidden" name="s_x_spp_id" id="s_x_spp_id" value="<?php echo $t08_siswaspp->spp_id->LookupFilterQuery() ?>">
</span>
<?php echo $t08_siswaspp->spp_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t08_siswaspp->Nilai->Visible) { // Nilai ?>
	<div id="r_Nilai" class="form-group">
		<label id="elh_t08_siswaspp_Nilai" for="x_Nilai" class="col-sm-2 control-label ewLabel"><?php echo $t08_siswaspp->Nilai->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t08_siswaspp->Nilai->CellAttributes() ?>>
<span id="el_t08_siswaspp_Nilai">
<input type="text" data-table="t08_siswaspp" data-field="x_Nilai" name="x_Nilai" id="x_Nilai" size="10" placeholder="<?php echo ew_HtmlEncode($t08_siswaspp->Nilai->getPlaceHolder()) ?>" value="<?php echo $t08_siswaspp->Nilai->EditValue ?>"<?php echo $t08_siswaspp->Nilai->EditAttributes() ?>>
</span>
<?php echo $t08_siswaspp->Nilai->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t08_siswaspp->Terbayar->Visible) { // Terbayar ?>
	<div id="r_Terbayar" class="form-group">
		<label id="elh_t08_siswaspp_Terbayar" for="x_Terbayar" class="col-sm-2 control-label ewLabel"><?php echo $t08_siswaspp->Terbayar->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t08_siswaspp->Terbayar->CellAttributes() ?>>
<span id="el_t08_siswaspp_Terbayar">
<input type="text" data-table="t08_siswaspp" data-field="x_Terbayar" name="x_Terbayar" id="x_Terbayar" size="10" placeholder="<?php echo ew_HtmlEncode($t08_siswaspp->Terbayar->getPlaceHolder()) ?>" value="<?php echo $t08_siswaspp->Terbayar->EditValue ?>"<?php echo $t08_siswaspp->Terbayar->EditAttributes() ?>>
</span>
<?php echo $t08_siswaspp->Terbayar->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t08_siswaspp->Potensi->Visible) { // Potensi ?>
	<div id="r_Potensi" class="form-group">
		<label id="elh_t08_siswaspp_Potensi" for="x_Potensi" class="col-sm-2 control-label ewLabel"><?php echo $t08_siswaspp->Potensi->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t08_siswaspp->Potensi->CellAttributes() ?>>
<span id="el_t08_siswaspp_Potensi">
<input type="text" data-table="t08_siswaspp" data-field="x_Potensi" name="x_Potensi" id="x_Potensi" size="10" placeholder="<?php echo ew_HtmlEncode($t08_siswaspp->Potensi->getPlaceHolder()) ?>" value="<?php echo $t08_siswaspp->Potensi->EditValue ?>"<?php echo $t08_siswaspp->Potensi->EditAttributes() ?>>
</span>
<?php echo $t08_siswaspp->Potensi->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div>
<?php if (strval($t08_siswaspp->siswa_id->getSessionValue()) <> "") { ?>
<input type="hidden" name="x_siswa_id" id="x_siswa_id" value="<?php echo ew_HtmlEncode(strval($t08_siswaspp->siswa_id->getSessionValue())) ?>">
<?php } ?>
<?php if (!$t08_siswaspp_add->IsModal) { ?>
<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $t08_siswaspp_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div>
</div>
<?php } ?>
</form>
<script type="text/javascript">
ft08_siswasppadd.Init();
</script>
<?php
$t08_siswaspp_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$t08_siswaspp_add->Page_Terminate();
?>
