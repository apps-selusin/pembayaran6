<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg13.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql13.php") ?>
<?php include_once "phpfn13.php" ?>
<?php include_once "t10_bayardetailinfo.php" ?>
<?php include_once "t09_bayarmasterinfo.php" ?>
<?php include_once "t96_employeesinfo.php" ?>
<?php include_once "userfn13.php" ?>
<?php

//
// Page class
//

$t10_bayardetail_add = NULL; // Initialize page object first

class ct10_bayardetail_add extends ct10_bayardetail {

	// Page ID
	var $PageID = 'add';

	// Project ID
	var $ProjectID = "{699E0CB8-ECC6-4DDA-93F3-012C887E6B12}";

	// Table name
	var $TableName = 't10_bayardetail';

	// Page object name
	var $PageObjName = 't10_bayardetail_add';

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

		// Table object (t10_bayardetail)
		if (!isset($GLOBALS["t10_bayardetail"]) || get_class($GLOBALS["t10_bayardetail"]) == "ct10_bayardetail") {
			$GLOBALS["t10_bayardetail"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t10_bayardetail"];
		}

		// Table object (t09_bayarmaster)
		if (!isset($GLOBALS['t09_bayarmaster'])) $GLOBALS['t09_bayarmaster'] = new ct09_bayarmaster();

		// Table object (t96_employees)
		if (!isset($GLOBALS['t96_employees'])) $GLOBALS['t96_employees'] = new ct96_employees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 't10_bayardetail', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("t10_bayardetaillist.php"));
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
		$this->bayarmaster_id->SetVisibility();
		$this->siswaspp_id->SetVisibility();
		$this->Keterangan->SetVisibility();
		$this->Keterangan2->SetVisibility();
		$this->Keterangan3->SetVisibility();
		$this->Jumlah->SetVisibility();

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
		global $EW_EXPORT, $t10_bayardetail;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($t10_bayardetail);
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
					$this->Page_Terminate("t10_bayardetaillist.php"); // No matching record, return to list
				}
				break;
			case "A": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $this->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "t10_bayardetaillist.php")
						$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to list page with correct master key if necessary
					elseif (ew_GetPageName($sReturnUrl) == "t10_bayardetailview.php")
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
		$this->bayarmaster_id->CurrentValue = NULL;
		$this->bayarmaster_id->OldValue = $this->bayarmaster_id->CurrentValue;
		$this->siswaspp_id->CurrentValue = NULL;
		$this->siswaspp_id->OldValue = $this->siswaspp_id->CurrentValue;
		$this->Keterangan->CurrentValue = NULL;
		$this->Keterangan->OldValue = $this->Keterangan->CurrentValue;
		$this->Keterangan2->CurrentValue = NULL;
		$this->Keterangan2->OldValue = $this->Keterangan2->CurrentValue;
		$this->Keterangan3->CurrentValue = NULL;
		$this->Keterangan3->OldValue = $this->Keterangan3->CurrentValue;
		$this->Jumlah->CurrentValue = 0.00;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->bayarmaster_id->FldIsDetailKey) {
			$this->bayarmaster_id->setFormValue($objForm->GetValue("x_bayarmaster_id"));
		}
		if (!$this->siswaspp_id->FldIsDetailKey) {
			$this->siswaspp_id->setFormValue($objForm->GetValue("x_siswaspp_id"));
		}
		if (!$this->Keterangan->FldIsDetailKey) {
			$this->Keterangan->setFormValue($objForm->GetValue("x_Keterangan"));
		}
		if (!$this->Keterangan2->FldIsDetailKey) {
			$this->Keterangan2->setFormValue($objForm->GetValue("x_Keterangan2"));
		}
		if (!$this->Keterangan3->FldIsDetailKey) {
			$this->Keterangan3->setFormValue($objForm->GetValue("x_Keterangan3"));
		}
		if (!$this->Jumlah->FldIsDetailKey) {
			$this->Jumlah->setFormValue($objForm->GetValue("x_Jumlah"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->LoadOldRecord();
		$this->bayarmaster_id->CurrentValue = $this->bayarmaster_id->FormValue;
		$this->siswaspp_id->CurrentValue = $this->siswaspp_id->FormValue;
		$this->Keterangan->CurrentValue = $this->Keterangan->FormValue;
		$this->Keterangan2->CurrentValue = $this->Keterangan2->FormValue;
		$this->Keterangan3->CurrentValue = $this->Keterangan3->FormValue;
		$this->Jumlah->CurrentValue = $this->Jumlah->FormValue;
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
		$this->bayarmaster_id->setDbValue($rs->fields('bayarmaster_id'));
		$this->siswaspp_id->setDbValue($rs->fields('siswaspp_id'));
		$this->Keterangan->setDbValue($rs->fields('Keterangan'));
		$this->Keterangan2->setDbValue($rs->fields('Keterangan2'));
		$this->Keterangan3->setDbValue($rs->fields('Keterangan3'));
		$this->Jumlah->setDbValue($rs->fields('Jumlah'));
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF) return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->bayarmaster_id->DbValue = $row['bayarmaster_id'];
		$this->siswaspp_id->DbValue = $row['siswaspp_id'];
		$this->Keterangan->DbValue = $row['Keterangan'];
		$this->Keterangan2->DbValue = $row['Keterangan2'];
		$this->Keterangan3->DbValue = $row['Keterangan3'];
		$this->Jumlah->DbValue = $row['Jumlah'];
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

		if ($this->Jumlah->FormValue == $this->Jumlah->CurrentValue && is_numeric(ew_StrToFloat($this->Jumlah->CurrentValue)))
			$this->Jumlah->CurrentValue = ew_StrToFloat($this->Jumlah->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// id
		// bayarmaster_id
		// siswaspp_id
		// Keterangan
		// Keterangan2
		// Keterangan3
		// Jumlah

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// bayarmaster_id
		$this->bayarmaster_id->ViewValue = $this->bayarmaster_id->CurrentValue;
		$this->bayarmaster_id->ViewCustomAttributes = "";

		// siswaspp_id
		$this->siswaspp_id->ViewValue = $this->siswaspp_id->CurrentValue;
		if (strval($this->siswaspp_id->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->siswaspp_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `id`, `SPP` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `v01_siswaspp`";
		$sWhereWrk = "";
		$this->siswaspp_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->siswaspp_id, $sWhereWrk); // Call Lookup selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->siswaspp_id->ViewValue = $this->siswaspp_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->siswaspp_id->ViewValue = $this->siswaspp_id->CurrentValue;
			}
		} else {
			$this->siswaspp_id->ViewValue = NULL;
		}
		$this->siswaspp_id->ViewCustomAttributes = "";

		// Keterangan
		$this->Keterangan->ViewValue = $this->Keterangan->CurrentValue;
		$this->Keterangan->ViewCustomAttributes = "";

		// Keterangan2
		if (strval($this->Keterangan2->CurrentValue) <> "") {
			$sFilterWrk = "`Periode`" . ew_SearchString("=", $this->Keterangan2->CurrentValue, EW_DATATYPE_STRING, "");
		$sSqlWrk = "SELECT `Periode`, `Periode` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `v03_kartuspp`";
		$sWhereWrk = "";
		$this->Keterangan2->LookupFilters = array();
		$lookuptblfilter = (is_null($this->siswaspp_id->CurrentValue)) ? "`Tanggal` is null " : "`Tanggal` is null and siswaspp_id = ".$this->siswaspp_id->CurrentValue."";
		ew_AddFilter($sWhereWrk, $lookuptblfilter);
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->Keterangan2, $sWhereWrk); // Call Lookup selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->Keterangan2->ViewValue = $this->Keterangan2->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->Keterangan2->ViewValue = $this->Keterangan2->CurrentValue;
			}
		} else {
			$this->Keterangan2->ViewValue = NULL;
		}
		$this->Keterangan2->ViewCustomAttributes = "";

		// Keterangan3
		$this->Keterangan3->ViewValue = $this->Keterangan3->CurrentValue;
		$this->Keterangan3->ViewCustomAttributes = "";

		// Jumlah
		$this->Jumlah->ViewValue = $this->Jumlah->CurrentValue;
		$this->Jumlah->ViewValue = ew_FormatNumber($this->Jumlah->ViewValue, 2, -2, -2, -2);
		$this->Jumlah->CellCssStyle .= "text-align: right;";
		$this->Jumlah->ViewCustomAttributes = "";

			// bayarmaster_id
			$this->bayarmaster_id->LinkCustomAttributes = "";
			$this->bayarmaster_id->HrefValue = "";
			$this->bayarmaster_id->TooltipValue = "";

			// siswaspp_id
			$this->siswaspp_id->LinkCustomAttributes = "";
			$this->siswaspp_id->HrefValue = "";
			$this->siswaspp_id->TooltipValue = "";

			// Keterangan
			$this->Keterangan->LinkCustomAttributes = "";
			$this->Keterangan->HrefValue = "";
			$this->Keterangan->TooltipValue = "";

			// Keterangan2
			$this->Keterangan2->LinkCustomAttributes = "";
			$this->Keterangan2->HrefValue = "";
			$this->Keterangan2->TooltipValue = "";

			// Keterangan3
			$this->Keterangan3->LinkCustomAttributes = "";
			$this->Keterangan3->HrefValue = "";
			$this->Keterangan3->TooltipValue = "";

			// Jumlah
			$this->Jumlah->LinkCustomAttributes = "";
			$this->Jumlah->HrefValue = "";
			$this->Jumlah->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// bayarmaster_id
			$this->bayarmaster_id->EditAttrs["class"] = "form-control";
			$this->bayarmaster_id->EditCustomAttributes = "";
			if ($this->bayarmaster_id->getSessionValue() <> "") {
				$this->bayarmaster_id->CurrentValue = $this->bayarmaster_id->getSessionValue();
			$this->bayarmaster_id->ViewValue = $this->bayarmaster_id->CurrentValue;
			$this->bayarmaster_id->ViewCustomAttributes = "";
			} else {
			$this->bayarmaster_id->EditValue = ew_HtmlEncode($this->bayarmaster_id->CurrentValue);
			$this->bayarmaster_id->PlaceHolder = ew_RemoveHtml($this->bayarmaster_id->FldCaption());
			}

			// siswaspp_id
			$this->siswaspp_id->EditAttrs["class"] = "form-control";
			$this->siswaspp_id->EditCustomAttributes = "";
			$this->siswaspp_id->EditValue = ew_HtmlEncode($this->siswaspp_id->CurrentValue);
			if (strval($this->siswaspp_id->CurrentValue) <> "") {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->siswaspp_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			$sSqlWrk = "SELECT `id`, `SPP` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `v01_siswaspp`";
			$sWhereWrk = "";
			$this->siswaspp_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->siswaspp_id, $sWhereWrk); // Call Lookup selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = Conn()->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = array();
					$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
					$this->siswaspp_id->EditValue = $this->siswaspp_id->DisplayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->siswaspp_id->EditValue = ew_HtmlEncode($this->siswaspp_id->CurrentValue);
				}
			} else {
				$this->siswaspp_id->EditValue = NULL;
			}
			$this->siswaspp_id->PlaceHolder = ew_RemoveHtml($this->siswaspp_id->FldCaption());

			// Keterangan
			$this->Keterangan->EditAttrs["class"] = "form-control";
			$this->Keterangan->EditCustomAttributes = "";
			$this->Keterangan->EditValue = ew_HtmlEncode($this->Keterangan->CurrentValue);
			$this->Keterangan->PlaceHolder = ew_RemoveHtml($this->Keterangan->FldCaption());

			// Keterangan2
			$this->Keterangan2->EditAttrs["class"] = "form-control";
			$this->Keterangan2->EditCustomAttributes = "";
			if (trim(strval($this->Keterangan2->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`Periode`" . ew_SearchString("=", $this->Keterangan2->CurrentValue, EW_DATATYPE_STRING, "");
			}
			$sSqlWrk = "SELECT `Periode`, `Periode` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `v03_kartuspp`";
			$sWhereWrk = "";
			$this->Keterangan2->LookupFilters = array();
			$lookuptblfilter = (is_null($this->siswaspp_id->CurrentValue)) ? "`Tanggal` is null " : "`Tanggal` is null and siswaspp_id = ".$this->siswaspp_id->CurrentValue."";
			ew_AddFilter($sWhereWrk, $lookuptblfilter);
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->Keterangan2, $sWhereWrk); // Call Lookup selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->Keterangan2->EditValue = $arwrk;

			// Keterangan3
			$this->Keterangan3->EditAttrs["class"] = "form-control";
			$this->Keterangan3->EditCustomAttributes = "";
			$this->Keterangan3->EditValue = ew_HtmlEncode($this->Keterangan3->CurrentValue);
			$this->Keterangan3->PlaceHolder = ew_RemoveHtml($this->Keterangan3->FldCaption());

			// Jumlah
			$this->Jumlah->EditAttrs["class"] = "form-control";
			$this->Jumlah->EditCustomAttributes = "";
			$this->Jumlah->EditValue = ew_HtmlEncode($this->Jumlah->CurrentValue);
			$this->Jumlah->PlaceHolder = ew_RemoveHtml($this->Jumlah->FldCaption());
			if (strval($this->Jumlah->EditValue) <> "" && is_numeric($this->Jumlah->EditValue)) $this->Jumlah->EditValue = ew_FormatNumber($this->Jumlah->EditValue, -2, -2, -2, -2);

			// Add refer script
			// bayarmaster_id

			$this->bayarmaster_id->LinkCustomAttributes = "";
			$this->bayarmaster_id->HrefValue = "";

			// siswaspp_id
			$this->siswaspp_id->LinkCustomAttributes = "";
			$this->siswaspp_id->HrefValue = "";

			// Keterangan
			$this->Keterangan->LinkCustomAttributes = "";
			$this->Keterangan->HrefValue = "";

			// Keterangan2
			$this->Keterangan2->LinkCustomAttributes = "";
			$this->Keterangan2->HrefValue = "";

			// Keterangan3
			$this->Keterangan3->LinkCustomAttributes = "";
			$this->Keterangan3->HrefValue = "";

			// Jumlah
			$this->Jumlah->LinkCustomAttributes = "";
			$this->Jumlah->HrefValue = "";
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
		if (!$this->bayarmaster_id->FldIsDetailKey && !is_null($this->bayarmaster_id->FormValue) && $this->bayarmaster_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->bayarmaster_id->FldCaption(), $this->bayarmaster_id->ReqErrMsg));
		}
		if (!ew_CheckInteger($this->bayarmaster_id->FormValue)) {
			ew_AddMessage($gsFormError, $this->bayarmaster_id->FldErrMsg());
		}
		if (!$this->siswaspp_id->FldIsDetailKey && !is_null($this->siswaspp_id->FormValue) && $this->siswaspp_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->siswaspp_id->FldCaption(), $this->siswaspp_id->ReqErrMsg));
		}
		if (!ew_CheckInteger($this->siswaspp_id->FormValue)) {
			ew_AddMessage($gsFormError, $this->siswaspp_id->FldErrMsg());
		}
		if (!$this->Jumlah->FldIsDetailKey && !is_null($this->Jumlah->FormValue) && $this->Jumlah->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Jumlah->FldCaption(), $this->Jumlah->ReqErrMsg));
		}
		if (!ew_CheckNumber($this->Jumlah->FormValue)) {
			ew_AddMessage($gsFormError, $this->Jumlah->FldErrMsg());
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

		// bayarmaster_id
		$this->bayarmaster_id->SetDbValueDef($rsnew, $this->bayarmaster_id->CurrentValue, 0, FALSE);

		// siswaspp_id
		$this->siswaspp_id->SetDbValueDef($rsnew, $this->siswaspp_id->CurrentValue, 0, FALSE);

		// Keterangan
		$this->Keterangan->SetDbValueDef($rsnew, $this->Keterangan->CurrentValue, NULL, FALSE);

		// Keterangan2
		$this->Keterangan2->SetDbValueDef($rsnew, $this->Keterangan2->CurrentValue, NULL, FALSE);

		// Keterangan3
		$this->Keterangan3->SetDbValueDef($rsnew, $this->Keterangan3->CurrentValue, NULL, FALSE);

		// Jumlah
		$this->Jumlah->SetDbValueDef($rsnew, $this->Jumlah->CurrentValue, 0, strval($this->Jumlah->CurrentValue) == "");

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
			if ($sMasterTblVar == "t09_bayarmaster") {
				$bValidMaster = TRUE;
				if (@$_GET["fk_id"] <> "") {
					$GLOBALS["t09_bayarmaster"]->id->setQueryStringValue($_GET["fk_id"]);
					$this->bayarmaster_id->setQueryStringValue($GLOBALS["t09_bayarmaster"]->id->QueryStringValue);
					$this->bayarmaster_id->setSessionValue($this->bayarmaster_id->QueryStringValue);
					if (!is_numeric($GLOBALS["t09_bayarmaster"]->id->QueryStringValue)) $bValidMaster = FALSE;
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
			if ($sMasterTblVar == "t09_bayarmaster") {
				$bValidMaster = TRUE;
				if (@$_POST["fk_id"] <> "") {
					$GLOBALS["t09_bayarmaster"]->id->setFormValue($_POST["fk_id"]);
					$this->bayarmaster_id->setFormValue($GLOBALS["t09_bayarmaster"]->id->FormValue);
					$this->bayarmaster_id->setSessionValue($this->bayarmaster_id->FormValue);
					if (!is_numeric($GLOBALS["t09_bayarmaster"]->id->FormValue)) $bValidMaster = FALSE;
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
			if ($sMasterTblVar <> "t09_bayarmaster") {
				if ($this->bayarmaster_id->CurrentValue == "") $this->bayarmaster_id->setSessionValue("");
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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("t10_bayardetaillist.php"), "", $this->TableVar, TRUE);
		$PageId = ($this->CurrentAction == "C") ? "Copy" : "Add";
		$Breadcrumb->Add("add", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_siswaspp_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id` AS `LinkFld`, `SPP` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `v01_siswaspp`";
			$sWhereWrk = "{filter}";
			$this->siswaspp_id->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`id` = {filter_value}', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->siswaspp_id, $sWhereWrk); // Call Lookup selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_Keterangan2":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `Periode` AS `LinkFld`, `Periode` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `v03_kartuspp`";
			$sWhereWrk = "";
			$this->Keterangan2->LookupFilters = array();
			$lookuptblfilter = (is_null($this->siswaspp_id->CurrentValue)) ? "`Tanggal` is null " : "`Tanggal` is null and siswaspp_id = ".$this->siswaspp_id->CurrentValue."";
			ew_AddFilter($sWhereWrk, $lookuptblfilter);
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`Periode` = {filter_value}', "t0" => "200", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->Keterangan2, $sWhereWrk); // Call Lookup selecting
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
		case "x_siswaspp_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id`, `SPP` AS `DispFld` FROM `v01_siswaspp`";
			$sWhereWrk = "`SPP` LIKE '%{query_value}%'";
			$this->siswaspp_id->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->siswaspp_id, $sWhereWrk); // Call Lookup selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " LIMIT " . EW_AUTO_SUGGEST_MAX_ENTRIES;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
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
if (!isset($t10_bayardetail_add)) $t10_bayardetail_add = new ct10_bayardetail_add();

// Page init
$t10_bayardetail_add->Page_Init();

// Page main
$t10_bayardetail_add->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t10_bayardetail_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "add";
var CurrentForm = ft10_bayardetailadd = new ew_Form("ft10_bayardetailadd", "add");

// Validate form
ft10_bayardetailadd.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_bayarmaster_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t10_bayardetail->bayarmaster_id->FldCaption(), $t10_bayardetail->bayarmaster_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_bayarmaster_id");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t10_bayardetail->bayarmaster_id->FldErrMsg()) ?>");
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
ft10_bayardetailadd.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft10_bayardetailadd.ValidateRequired = true;
<?php } else { ?>
ft10_bayardetailadd.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
ft10_bayardetailadd.Lists["x_siswaspp_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_SPP","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"v01_siswaspp"};
ft10_bayardetailadd.Lists["x_Keterangan2"] = {"LinkField":"x_Periode","Ajax":true,"AutoFill":false,"DisplayFields":["x_Periode","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"v03_kartuspp"};

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php if (!$t10_bayardetail_add->IsModal) { ?>
<div class="ewToolbar">
<?php $Breadcrumb->Render(); ?>
<?php echo $Language->SelectionForm(); ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $t10_bayardetail_add->ShowPageHeader(); ?>
<?php
$t10_bayardetail_add->ShowMessage();
?>
<form name="ft10_bayardetailadd" id="ft10_bayardetailadd" class="<?php echo $t10_bayardetail_add->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($t10_bayardetail_add->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $t10_bayardetail_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t10_bayardetail">
<input type="hidden" name="a_add" id="a_add" value="A">
<?php if ($t10_bayardetail_add->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<?php if ($t10_bayardetail->getCurrentMasterTable() == "t09_bayarmaster") { ?>
<input type="hidden" name="<?php echo EW_TABLE_SHOW_MASTER ?>" value="t09_bayarmaster">
<input type="hidden" name="fk_id" value="<?php echo $t10_bayardetail->bayarmaster_id->getSessionValue() ?>">
<?php } ?>
<div>
<?php if ($t10_bayardetail->bayarmaster_id->Visible) { // bayarmaster_id ?>
	<div id="r_bayarmaster_id" class="form-group">
		<label id="elh_t10_bayardetail_bayarmaster_id" for="x_bayarmaster_id" class="col-sm-2 control-label ewLabel"><?php echo $t10_bayardetail->bayarmaster_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t10_bayardetail->bayarmaster_id->CellAttributes() ?>>
<?php if ($t10_bayardetail->bayarmaster_id->getSessionValue() <> "") { ?>
<span id="el_t10_bayardetail_bayarmaster_id">
<span<?php echo $t10_bayardetail->bayarmaster_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t10_bayardetail->bayarmaster_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x_bayarmaster_id" name="x_bayarmaster_id" value="<?php echo ew_HtmlEncode($t10_bayardetail->bayarmaster_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el_t10_bayardetail_bayarmaster_id">
<input type="text" data-table="t10_bayardetail" data-field="x_bayarmaster_id" name="x_bayarmaster_id" id="x_bayarmaster_id" size="30" placeholder="<?php echo ew_HtmlEncode($t10_bayardetail->bayarmaster_id->getPlaceHolder()) ?>" value="<?php echo $t10_bayardetail->bayarmaster_id->EditValue ?>"<?php echo $t10_bayardetail->bayarmaster_id->EditAttributes() ?>>
</span>
<?php } ?>
<?php echo $t10_bayardetail->bayarmaster_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t10_bayardetail->siswaspp_id->Visible) { // siswaspp_id ?>
	<div id="r_siswaspp_id" class="form-group">
		<label id="elh_t10_bayardetail_siswaspp_id" class="col-sm-2 control-label ewLabel"><?php echo $t10_bayardetail->siswaspp_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t10_bayardetail->siswaspp_id->CellAttributes() ?>>
<span id="el_t10_bayardetail_siswaspp_id">
<?php
$wrkonchange = trim(" " . @$t10_bayardetail->siswaspp_id->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$t10_bayardetail->siswaspp_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_siswaspp_id" style="white-space: nowrap; z-index: 8970">
	<input type="text" name="sv_x_siswaspp_id" id="sv_x_siswaspp_id" value="<?php echo $t10_bayardetail->siswaspp_id->EditValue ?>" size="15" placeholder="<?php echo ew_HtmlEncode($t10_bayardetail->siswaspp_id->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($t10_bayardetail->siswaspp_id->getPlaceHolder()) ?>"<?php echo $t10_bayardetail->siswaspp_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t10_bayardetail" data-field="x_siswaspp_id" data-value-separator="<?php echo $t10_bayardetail->siswaspp_id->DisplayValueSeparatorAttribute() ?>" name="x_siswaspp_id" id="x_siswaspp_id" value="<?php echo ew_HtmlEncode($t10_bayardetail->siswaspp_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<input type="hidden" name="q_x_siswaspp_id" id="q_x_siswaspp_id" value="<?php echo $t10_bayardetail->siswaspp_id->LookupFilterQuery(true) ?>">
<script type="text/javascript">
ft10_bayardetailadd.CreateAutoSuggest({"id":"x_siswaspp_id","forceSelect":false});
</script>
</span>
<?php echo $t10_bayardetail->siswaspp_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t10_bayardetail->Keterangan->Visible) { // Keterangan ?>
	<div id="r_Keterangan" class="form-group">
		<label id="elh_t10_bayardetail_Keterangan" for="x_Keterangan" class="col-sm-2 control-label ewLabel"><?php echo $t10_bayardetail->Keterangan->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t10_bayardetail->Keterangan->CellAttributes() ?>>
<span id="el_t10_bayardetail_Keterangan">
<input type="text" data-table="t10_bayardetail" data-field="x_Keterangan" name="x_Keterangan" id="x_Keterangan" size="15" maxlength="100" placeholder="<?php echo ew_HtmlEncode($t10_bayardetail->Keterangan->getPlaceHolder()) ?>" value="<?php echo $t10_bayardetail->Keterangan->EditValue ?>"<?php echo $t10_bayardetail->Keterangan->EditAttributes() ?>>
</span>
<?php echo $t10_bayardetail->Keterangan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t10_bayardetail->Keterangan2->Visible) { // Keterangan2 ?>
	<div id="r_Keterangan2" class="form-group">
		<label id="elh_t10_bayardetail_Keterangan2" for="x_Keterangan2" class="col-sm-2 control-label ewLabel"><?php echo $t10_bayardetail->Keterangan2->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t10_bayardetail->Keterangan2->CellAttributes() ?>>
<span id="el_t10_bayardetail_Keterangan2">
<select data-table="t10_bayardetail" data-field="x_Keterangan2" data-value-separator="<?php echo $t10_bayardetail->Keterangan2->DisplayValueSeparatorAttribute() ?>" id="x_Keterangan2" name="x_Keterangan2"<?php echo $t10_bayardetail->Keterangan2->EditAttributes() ?>>
<?php echo $t10_bayardetail->Keterangan2->SelectOptionListHtml("x_Keterangan2") ?>
</select>
<input type="hidden" name="s_x_Keterangan2" id="s_x_Keterangan2" value="<?php echo $t10_bayardetail->Keterangan2->LookupFilterQuery() ?>">
</span>
<?php echo $t10_bayardetail->Keterangan2->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t10_bayardetail->Keterangan3->Visible) { // Keterangan3 ?>
	<div id="r_Keterangan3" class="form-group">
		<label id="elh_t10_bayardetail_Keterangan3" for="x_Keterangan3" class="col-sm-2 control-label ewLabel"><?php echo $t10_bayardetail->Keterangan3->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t10_bayardetail->Keterangan3->CellAttributes() ?>>
<span id="el_t10_bayardetail_Keterangan3">
<input type="text" data-table="t10_bayardetail" data-field="x_Keterangan3" name="x_Keterangan3" id="x_Keterangan3" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($t10_bayardetail->Keterangan3->getPlaceHolder()) ?>" value="<?php echo $t10_bayardetail->Keterangan3->EditValue ?>"<?php echo $t10_bayardetail->Keterangan3->EditAttributes() ?>>
</span>
<?php echo $t10_bayardetail->Keterangan3->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t10_bayardetail->Jumlah->Visible) { // Jumlah ?>
	<div id="r_Jumlah" class="form-group">
		<label id="elh_t10_bayardetail_Jumlah" for="x_Jumlah" class="col-sm-2 control-label ewLabel"><?php echo $t10_bayardetail->Jumlah->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t10_bayardetail->Jumlah->CellAttributes() ?>>
<span id="el_t10_bayardetail_Jumlah">
<input type="text" data-table="t10_bayardetail" data-field="x_Jumlah" name="x_Jumlah" id="x_Jumlah" size="10" placeholder="<?php echo ew_HtmlEncode($t10_bayardetail->Jumlah->getPlaceHolder()) ?>" value="<?php echo $t10_bayardetail->Jumlah->EditValue ?>"<?php echo $t10_bayardetail->Jumlah->EditAttributes() ?>>
</span>
<?php echo $t10_bayardetail->Jumlah->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div>
<?php if (!$t10_bayardetail_add->IsModal) { ?>
<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $t10_bayardetail_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div>
</div>
<?php } ?>
</form>
<script type="text/javascript">
ft10_bayardetailadd.Init();
</script>
<?php
$t10_bayardetail_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$t10_bayardetail_add->Page_Terminate();
?>
