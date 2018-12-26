<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg13.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql13.php") ?>
<?php include_once "phpfn13.php" ?>
<?php include_once "t01_tahunajaraninfo.php" ?>
<?php include_once "t96_employeesinfo.php" ?>
<?php include_once "userfn13.php" ?>
<?php

//
// Page class
//

$t01_tahunajaran_edit = NULL; // Initialize page object first

class ct01_tahunajaran_edit extends ct01_tahunajaran {

	// Page ID
	var $PageID = 'edit';

	// Project ID
	var $ProjectID = "{699E0CB8-ECC6-4DDA-93F3-012C887E6B12}";

	// Table name
	var $TableName = 't01_tahunajaran';

	// Page object name
	var $PageObjName = 't01_tahunajaran_edit';

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

		// Table object (t01_tahunajaran)
		if (!isset($GLOBALS["t01_tahunajaran"]) || get_class($GLOBALS["t01_tahunajaran"]) == "ct01_tahunajaran") {
			$GLOBALS["t01_tahunajaran"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t01_tahunajaran"];
		}

		// Table object (t96_employees)
		if (!isset($GLOBALS['t96_employees'])) $GLOBALS['t96_employees'] = new ct96_employees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 't01_tahunajaran', TRUE);

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
		if (!$Security->CanEdit()) {
			$Security->SaveLastUrl();
			$this->setFailureMessage(ew_DeniedMsg()); // Set no permission
			if ($Security->CanList())
				$this->Page_Terminate(ew_GetUrl("t01_tahunajaranlist.php"));
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
		$this->AwalBulan->SetVisibility();
		$this->AwalTahun->SetVisibility();
		$this->AkhirBulan->SetVisibility();
		$this->AkhirTahun->SetVisibility();
		$this->TahunAjaran->SetVisibility();
		$this->Aktif->SetVisibility();

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
		global $EW_EXPORT, $t01_tahunajaran;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($t01_tahunajaran);
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
	var $FormClassName = "form-horizontal ewForm ewEditForm";
	var $IsModal = FALSE;
	var $DbMasterFilter;
	var $DbDetailFilter;
	var $DisplayRecs = 1;
	var $StartRec;
	var $StopRec;
	var $TotalRecs = 0;
	var $RecRange = 10;
	var $Pager;
	var $RecCnt;
	var $RecKey = array();
	var $Recordset;

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

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;

		// Load key from QueryString
		if (@$_GET["id"] <> "") {
			$this->id->setQueryStringValue($_GET["id"]);
			$this->RecKey["id"] = $this->id->QueryStringValue;
		} else {
			$bLoadCurrentRecord = TRUE;
		}

		// Load recordset
		$this->StartRec = 1; // Initialize start position
		if ($this->Recordset = $this->LoadRecordset()) // Load records
			$this->TotalRecs = $this->Recordset->RecordCount(); // Get record count
		if ($this->TotalRecs <= 0) { // No record found
			if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
				$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
			$this->Page_Terminate("t01_tahunajaranlist.php"); // Return to list page
		} elseif ($bLoadCurrentRecord) { // Load current record position
			$this->SetUpStartRec(); // Set up start record position

			// Point to current record
			if (intval($this->StartRec) <= intval($this->TotalRecs)) {
				$bMatchRecord = TRUE;
				$this->Recordset->Move($this->StartRec-1);
			}
		} else { // Match key values
			while (!$this->Recordset->EOF) {
				if (strval($this->id->CurrentValue) == strval($this->Recordset->fields('id'))) {
					$this->setStartRecordNumber($this->StartRec); // Save record position
					$bMatchRecord = TRUE;
					break;
				} else {
					$this->StartRec++;
					$this->Recordset->MoveNext();
				}
			}
		}

		// Process form if post back
		if (@$_POST["a_edit"] <> "") {
			$this->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values
		} else {
			$this->CurrentAction = "I"; // Default action is display
		}

		// Validate form if post back
		if (@$_POST["a_edit"] <> "") {
			if (!$this->ValidateForm()) {
				$this->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$this->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		}
		switch ($this->CurrentAction) {
			case "I": // Get a record to display
				if (!$bMatchRecord) {
					if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
						$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
					$this->Page_Terminate("t01_tahunajaranlist.php"); // Return to list page
				} else {
					$this->LoadRowValues($this->Recordset); // Load row values
				}
				break;
			Case "U": // Update
				$sReturnUrl = $this->getReturnUrl();
				if (ew_GetPageName($sReturnUrl) == "t01_tahunajaranlist.php")
					$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to list page with correct master key if necessary
				$this->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} elseif ($this->getFailureMessage() == $Language->Phrase("NoRecord")) {
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Render the record
		$this->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$this->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$this->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $this->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$this->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$this->setStartRecordNumber($this->StartRec);
		}
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $Language;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->AwalBulan->FldIsDetailKey) {
			$this->AwalBulan->setFormValue($objForm->GetValue("x_AwalBulan"));
		}
		if (!$this->AwalTahun->FldIsDetailKey) {
			$this->AwalTahun->setFormValue($objForm->GetValue("x_AwalTahun"));
		}
		if (!$this->AkhirBulan->FldIsDetailKey) {
			$this->AkhirBulan->setFormValue($objForm->GetValue("x_AkhirBulan"));
		}
		if (!$this->AkhirTahun->FldIsDetailKey) {
			$this->AkhirTahun->setFormValue($objForm->GetValue("x_AkhirTahun"));
		}
		if (!$this->TahunAjaran->FldIsDetailKey) {
			$this->TahunAjaran->setFormValue($objForm->GetValue("x_TahunAjaran"));
		}
		if (!$this->Aktif->FldIsDetailKey) {
			$this->Aktif->setFormValue($objForm->GetValue("x_Aktif"));
		}
		if (!$this->id->FldIsDetailKey)
			$this->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->LoadRow();
		$this->id->CurrentValue = $this->id->FormValue;
		$this->AwalBulan->CurrentValue = $this->AwalBulan->FormValue;
		$this->AwalTahun->CurrentValue = $this->AwalTahun->FormValue;
		$this->AkhirBulan->CurrentValue = $this->AkhirBulan->FormValue;
		$this->AkhirTahun->CurrentValue = $this->AkhirTahun->FormValue;
		$this->TahunAjaran->CurrentValue = $this->TahunAjaran->FormValue;
		$this->Aktif->CurrentValue = $this->Aktif->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {

		// Load List page SQL
		$sSql = $this->SelectSQL();
		$conn = &$this->Connection();

		// Load recordset
		$dbtype = ew_GetConnectionType($this->DBID);
		if ($this->UseSelectLimit) {
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			if ($dbtype == "MSSQL") {
				$rs = $conn->SelectLimit($sSql, $rowcnt, $offset, array("_hasOrderBy" => trim($this->getOrderBy()) || trim($this->getSessionOrderBy())));
			} else {
				$rs = $conn->SelectLimit($sSql, $rowcnt, $offset);
			}
			$conn->raiseErrorFn = '';
		} else {
			$rs = ew_LoadRecordset($sSql, $conn);
		}

		// Call Recordset Selected event
		$this->Recordset_Selected($rs);
		return $rs;
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
		$this->AwalBulan->setDbValue($rs->fields('AwalBulan'));
		$this->AwalTahun->setDbValue($rs->fields('AwalTahun'));
		$this->AkhirBulan->setDbValue($rs->fields('AkhirBulan'));
		$this->AkhirTahun->setDbValue($rs->fields('AkhirTahun'));
		$this->TahunAjaran->setDbValue($rs->fields('TahunAjaran'));
		$this->Aktif->setDbValue($rs->fields('Aktif'));
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF) return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->AwalBulan->DbValue = $row['AwalBulan'];
		$this->AwalTahun->DbValue = $row['AwalTahun'];
		$this->AkhirBulan->DbValue = $row['AkhirBulan'];
		$this->AkhirTahun->DbValue = $row['AkhirTahun'];
		$this->TahunAjaran->DbValue = $row['TahunAjaran'];
		$this->Aktif->DbValue = $row['Aktif'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// id
		// AwalBulan
		// AwalTahun
		// AkhirBulan
		// AkhirTahun
		// TahunAjaran
		// Aktif

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// AwalBulan
		if (strval($this->AwalBulan->CurrentValue) <> "") {
			$this->AwalBulan->ViewValue = $this->AwalBulan->OptionCaption($this->AwalBulan->CurrentValue);
		} else {
			$this->AwalBulan->ViewValue = NULL;
		}
		$this->AwalBulan->ViewCustomAttributes = "";

		// AwalTahun
		$this->AwalTahun->ViewValue = $this->AwalTahun->CurrentValue;
		$this->AwalTahun->ViewCustomAttributes = "";

		// AkhirBulan
		if (strval($this->AkhirBulan->CurrentValue) <> "") {
			$this->AkhirBulan->ViewValue = $this->AkhirBulan->OptionCaption($this->AkhirBulan->CurrentValue);
		} else {
			$this->AkhirBulan->ViewValue = NULL;
		}
		$this->AkhirBulan->ViewCustomAttributes = "";

		// AkhirTahun
		$this->AkhirTahun->ViewValue = $this->AkhirTahun->CurrentValue;
		$this->AkhirTahun->ViewCustomAttributes = "";

		// TahunAjaran
		$this->TahunAjaran->ViewValue = $this->TahunAjaran->CurrentValue;
		$this->TahunAjaran->ViewCustomAttributes = "";

		// Aktif
		if (strval($this->Aktif->CurrentValue) <> "") {
			$this->Aktif->ViewValue = $this->Aktif->OptionCaption($this->Aktif->CurrentValue);
		} else {
			$this->Aktif->ViewValue = NULL;
		}
		$this->Aktif->ViewCustomAttributes = "";

			// AwalBulan
			$this->AwalBulan->LinkCustomAttributes = "";
			$this->AwalBulan->HrefValue = "";
			$this->AwalBulan->TooltipValue = "";

			// AwalTahun
			$this->AwalTahun->LinkCustomAttributes = "";
			$this->AwalTahun->HrefValue = "";
			$this->AwalTahun->TooltipValue = "";

			// AkhirBulan
			$this->AkhirBulan->LinkCustomAttributes = "";
			$this->AkhirBulan->HrefValue = "";
			$this->AkhirBulan->TooltipValue = "";

			// AkhirTahun
			$this->AkhirTahun->LinkCustomAttributes = "";
			$this->AkhirTahun->HrefValue = "";
			$this->AkhirTahun->TooltipValue = "";

			// TahunAjaran
			$this->TahunAjaran->LinkCustomAttributes = "";
			$this->TahunAjaran->HrefValue = "";
			$this->TahunAjaran->TooltipValue = "";

			// Aktif
			$this->Aktif->LinkCustomAttributes = "";
			$this->Aktif->HrefValue = "";
			$this->Aktif->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// AwalBulan
			$this->AwalBulan->EditAttrs["class"] = "form-control";
			$this->AwalBulan->EditCustomAttributes = "";
			$this->AwalBulan->EditValue = $this->AwalBulan->Options(TRUE);

			// AwalTahun
			$this->AwalTahun->EditAttrs["class"] = "form-control";
			$this->AwalTahun->EditCustomAttributes = "";
			$this->AwalTahun->EditValue = ew_HtmlEncode($this->AwalTahun->CurrentValue);
			$this->AwalTahun->PlaceHolder = ew_RemoveHtml($this->AwalTahun->FldCaption());

			// AkhirBulan
			$this->AkhirBulan->EditAttrs["class"] = "form-control";
			$this->AkhirBulan->EditCustomAttributes = "";
			$this->AkhirBulan->EditValue = $this->AkhirBulan->Options(TRUE);

			// AkhirTahun
			$this->AkhirTahun->EditAttrs["class"] = "form-control";
			$this->AkhirTahun->EditCustomAttributes = "";
			$this->AkhirTahun->EditValue = ew_HtmlEncode($this->AkhirTahun->CurrentValue);
			$this->AkhirTahun->PlaceHolder = ew_RemoveHtml($this->AkhirTahun->FldCaption());

			// TahunAjaran
			$this->TahunAjaran->EditAttrs["class"] = "form-control";
			$this->TahunAjaran->EditCustomAttributes = "";
			$this->TahunAjaran->EditValue = ew_HtmlEncode($this->TahunAjaran->CurrentValue);
			$this->TahunAjaran->PlaceHolder = ew_RemoveHtml($this->TahunAjaran->FldCaption());

			// Aktif
			$this->Aktif->EditCustomAttributes = "";
			$this->Aktif->EditValue = $this->Aktif->Options(FALSE);

			// Edit refer script
			// AwalBulan

			$this->AwalBulan->LinkCustomAttributes = "";
			$this->AwalBulan->HrefValue = "";

			// AwalTahun
			$this->AwalTahun->LinkCustomAttributes = "";
			$this->AwalTahun->HrefValue = "";

			// AkhirBulan
			$this->AkhirBulan->LinkCustomAttributes = "";
			$this->AkhirBulan->HrefValue = "";

			// AkhirTahun
			$this->AkhirTahun->LinkCustomAttributes = "";
			$this->AkhirTahun->HrefValue = "";

			// TahunAjaran
			$this->TahunAjaran->LinkCustomAttributes = "";
			$this->TahunAjaran->HrefValue = "";

			// Aktif
			$this->Aktif->LinkCustomAttributes = "";
			$this->Aktif->HrefValue = "";
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
		if (!$this->AwalBulan->FldIsDetailKey && !is_null($this->AwalBulan->FormValue) && $this->AwalBulan->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->AwalBulan->FldCaption(), $this->AwalBulan->ReqErrMsg));
		}
		if (!$this->AwalTahun->FldIsDetailKey && !is_null($this->AwalTahun->FormValue) && $this->AwalTahun->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->AwalTahun->FldCaption(), $this->AwalTahun->ReqErrMsg));
		}
		if (!ew_CheckInteger($this->AwalTahun->FormValue)) {
			ew_AddMessage($gsFormError, $this->AwalTahun->FldErrMsg());
		}
		if (!$this->AkhirBulan->FldIsDetailKey && !is_null($this->AkhirBulan->FormValue) && $this->AkhirBulan->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->AkhirBulan->FldCaption(), $this->AkhirBulan->ReqErrMsg));
		}
		if (!$this->AkhirTahun->FldIsDetailKey && !is_null($this->AkhirTahun->FormValue) && $this->AkhirTahun->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->AkhirTahun->FldCaption(), $this->AkhirTahun->ReqErrMsg));
		}
		if (!ew_CheckInteger($this->AkhirTahun->FormValue)) {
			ew_AddMessage($gsFormError, $this->AkhirTahun->FldErrMsg());
		}
		if (!$this->TahunAjaran->FldIsDetailKey && !is_null($this->TahunAjaran->FormValue) && $this->TahunAjaran->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->TahunAjaran->FldCaption(), $this->TahunAjaran->ReqErrMsg));
		}
		if ($this->Aktif->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Aktif->FldCaption(), $this->Aktif->ReqErrMsg));
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

	// Update record based on key values
	function EditRow() {
		global $Security, $Language;
		$sFilter = $this->KeyFilter();
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$conn = &$this->Connection();
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
			$EditRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold = &$rs->fields;
			$this->LoadDbValues($rsold);
			$rsnew = array();

			// AwalBulan
			$this->AwalBulan->SetDbValueDef($rsnew, $this->AwalBulan->CurrentValue, 0, $this->AwalBulan->ReadOnly);

			// AwalTahun
			$this->AwalTahun->SetDbValueDef($rsnew, $this->AwalTahun->CurrentValue, 0, $this->AwalTahun->ReadOnly);

			// AkhirBulan
			$this->AkhirBulan->SetDbValueDef($rsnew, $this->AkhirBulan->CurrentValue, 0, $this->AkhirBulan->ReadOnly);

			// AkhirTahun
			$this->AkhirTahun->SetDbValueDef($rsnew, $this->AkhirTahun->CurrentValue, 0, $this->AkhirTahun->ReadOnly);

			// TahunAjaran
			$this->TahunAjaran->SetDbValueDef($rsnew, $this->TahunAjaran->CurrentValue, "", $this->TahunAjaran->ReadOnly);

			// Aktif
			$this->Aktif->SetDbValueDef($rsnew, $this->Aktif->CurrentValue, "", $this->Aktif->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $this->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
				if (count($rsnew) > 0)
					$EditRow = $this->Update($rsnew, "", $rsold);
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
				if ($EditRow) {
				}
			} else {
				if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

					// Use the message, do nothing
				} elseif ($this->CancelMessage <> "") {
					$this->setFailureMessage($this->CancelMessage);
					$this->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$this->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("t01_tahunajaranlist.php"), "", $this->TableVar, TRUE);
		$PageId = "edit";
		$Breadcrumb->Add("edit", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
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
if (!isset($t01_tahunajaran_edit)) $t01_tahunajaran_edit = new ct01_tahunajaran_edit();

// Page init
$t01_tahunajaran_edit->Page_Init();

// Page main
$t01_tahunajaran_edit->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t01_tahunajaran_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "edit";
var CurrentForm = ft01_tahunajaranedit = new ew_Form("ft01_tahunajaranedit", "edit");

// Validate form
ft01_tahunajaranedit.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_AwalBulan");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t01_tahunajaran->AwalBulan->FldCaption(), $t01_tahunajaran->AwalBulan->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_AwalTahun");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t01_tahunajaran->AwalTahun->FldCaption(), $t01_tahunajaran->AwalTahun->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_AwalTahun");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t01_tahunajaran->AwalTahun->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_AkhirBulan");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t01_tahunajaran->AkhirBulan->FldCaption(), $t01_tahunajaran->AkhirBulan->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_AkhirTahun");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t01_tahunajaran->AkhirTahun->FldCaption(), $t01_tahunajaran->AkhirTahun->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_AkhirTahun");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t01_tahunajaran->AkhirTahun->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_TahunAjaran");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t01_tahunajaran->TahunAjaran->FldCaption(), $t01_tahunajaran->TahunAjaran->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Aktif");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t01_tahunajaran->Aktif->FldCaption(), $t01_tahunajaran->Aktif->ReqErrMsg)) ?>");

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
ft01_tahunajaranedit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft01_tahunajaranedit.ValidateRequired = true;
<?php } else { ?>
ft01_tahunajaranedit.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
ft01_tahunajaranedit.Lists["x_AwalBulan"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
ft01_tahunajaranedit.Lists["x_AwalBulan"].Options = <?php echo json_encode($t01_tahunajaran->AwalBulan->Options()) ?>;
ft01_tahunajaranedit.Lists["x_AkhirBulan"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
ft01_tahunajaranedit.Lists["x_AkhirBulan"].Options = <?php echo json_encode($t01_tahunajaran->AkhirBulan->Options()) ?>;
ft01_tahunajaranedit.Lists["x_Aktif"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
ft01_tahunajaranedit.Lists["x_Aktif"].Options = <?php echo json_encode($t01_tahunajaran->Aktif->Options()) ?>;

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php if (!$t01_tahunajaran_edit->IsModal) { ?>
<div class="ewToolbar">
<?php $Breadcrumb->Render(); ?>
<?php echo $Language->SelectionForm(); ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $t01_tahunajaran_edit->ShowPageHeader(); ?>
<?php
$t01_tahunajaran_edit->ShowMessage();
?>
<form name="ft01_tahunajaranedit" id="ft01_tahunajaranedit" class="<?php echo $t01_tahunajaran_edit->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($t01_tahunajaran_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $t01_tahunajaran_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t01_tahunajaran">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<?php if ($t01_tahunajaran_edit->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<div>
<?php if ($t01_tahunajaran->AwalBulan->Visible) { // AwalBulan ?>
	<div id="r_AwalBulan" class="form-group">
		<label id="elh_t01_tahunajaran_AwalBulan" for="x_AwalBulan" class="col-sm-2 control-label ewLabel"><?php echo $t01_tahunajaran->AwalBulan->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t01_tahunajaran->AwalBulan->CellAttributes() ?>>
<span id="el_t01_tahunajaran_AwalBulan">
<select data-table="t01_tahunajaran" data-field="x_AwalBulan" data-value-separator="<?php echo $t01_tahunajaran->AwalBulan->DisplayValueSeparatorAttribute() ?>" id="x_AwalBulan" name="x_AwalBulan"<?php echo $t01_tahunajaran->AwalBulan->EditAttributes() ?>>
<?php echo $t01_tahunajaran->AwalBulan->SelectOptionListHtml("x_AwalBulan") ?>
</select>
</span>
<?php echo $t01_tahunajaran->AwalBulan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t01_tahunajaran->AwalTahun->Visible) { // AwalTahun ?>
	<div id="r_AwalTahun" class="form-group">
		<label id="elh_t01_tahunajaran_AwalTahun" for="x_AwalTahun" class="col-sm-2 control-label ewLabel"><?php echo $t01_tahunajaran->AwalTahun->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t01_tahunajaran->AwalTahun->CellAttributes() ?>>
<span id="el_t01_tahunajaran_AwalTahun">
<input type="text" data-table="t01_tahunajaran" data-field="x_AwalTahun" name="x_AwalTahun" id="x_AwalTahun" size="30" placeholder="<?php echo ew_HtmlEncode($t01_tahunajaran->AwalTahun->getPlaceHolder()) ?>" value="<?php echo $t01_tahunajaran->AwalTahun->EditValue ?>"<?php echo $t01_tahunajaran->AwalTahun->EditAttributes() ?>>
</span>
<?php echo $t01_tahunajaran->AwalTahun->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t01_tahunajaran->AkhirBulan->Visible) { // AkhirBulan ?>
	<div id="r_AkhirBulan" class="form-group">
		<label id="elh_t01_tahunajaran_AkhirBulan" for="x_AkhirBulan" class="col-sm-2 control-label ewLabel"><?php echo $t01_tahunajaran->AkhirBulan->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t01_tahunajaran->AkhirBulan->CellAttributes() ?>>
<span id="el_t01_tahunajaran_AkhirBulan">
<select data-table="t01_tahunajaran" data-field="x_AkhirBulan" data-value-separator="<?php echo $t01_tahunajaran->AkhirBulan->DisplayValueSeparatorAttribute() ?>" id="x_AkhirBulan" name="x_AkhirBulan"<?php echo $t01_tahunajaran->AkhirBulan->EditAttributes() ?>>
<?php echo $t01_tahunajaran->AkhirBulan->SelectOptionListHtml("x_AkhirBulan") ?>
</select>
</span>
<?php echo $t01_tahunajaran->AkhirBulan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t01_tahunajaran->AkhirTahun->Visible) { // AkhirTahun ?>
	<div id="r_AkhirTahun" class="form-group">
		<label id="elh_t01_tahunajaran_AkhirTahun" for="x_AkhirTahun" class="col-sm-2 control-label ewLabel"><?php echo $t01_tahunajaran->AkhirTahun->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t01_tahunajaran->AkhirTahun->CellAttributes() ?>>
<span id="el_t01_tahunajaran_AkhirTahun">
<input type="text" data-table="t01_tahunajaran" data-field="x_AkhirTahun" name="x_AkhirTahun" id="x_AkhirTahun" size="30" placeholder="<?php echo ew_HtmlEncode($t01_tahunajaran->AkhirTahun->getPlaceHolder()) ?>" value="<?php echo $t01_tahunajaran->AkhirTahun->EditValue ?>"<?php echo $t01_tahunajaran->AkhirTahun->EditAttributes() ?>>
</span>
<?php echo $t01_tahunajaran->AkhirTahun->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t01_tahunajaran->TahunAjaran->Visible) { // TahunAjaran ?>
	<div id="r_TahunAjaran" class="form-group">
		<label id="elh_t01_tahunajaran_TahunAjaran" for="x_TahunAjaran" class="col-sm-2 control-label ewLabel"><?php echo $t01_tahunajaran->TahunAjaran->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t01_tahunajaran->TahunAjaran->CellAttributes() ?>>
<span id="el_t01_tahunajaran_TahunAjaran">
<input type="text" data-table="t01_tahunajaran" data-field="x_TahunAjaran" name="x_TahunAjaran" id="x_TahunAjaran" size="30" maxlength="11" placeholder="<?php echo ew_HtmlEncode($t01_tahunajaran->TahunAjaran->getPlaceHolder()) ?>" value="<?php echo $t01_tahunajaran->TahunAjaran->EditValue ?>"<?php echo $t01_tahunajaran->TahunAjaran->EditAttributes() ?>>
</span>
<?php echo $t01_tahunajaran->TahunAjaran->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t01_tahunajaran->Aktif->Visible) { // Aktif ?>
	<div id="r_Aktif" class="form-group">
		<label id="elh_t01_tahunajaran_Aktif" class="col-sm-2 control-label ewLabel"><?php echo $t01_tahunajaran->Aktif->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t01_tahunajaran->Aktif->CellAttributes() ?>>
<span id="el_t01_tahunajaran_Aktif">
<div id="tp_x_Aktif" class="ewTemplate"><input type="radio" data-table="t01_tahunajaran" data-field="x_Aktif" data-value-separator="<?php echo $t01_tahunajaran->Aktif->DisplayValueSeparatorAttribute() ?>" name="x_Aktif" id="x_Aktif" value="{value}"<?php echo $t01_tahunajaran->Aktif->EditAttributes() ?>></div>
<div id="dsl_x_Aktif" data-repeatcolumn="5" class="ewItemList" style="display: none;"><div>
<?php echo $t01_tahunajaran->Aktif->RadioButtonListHtml(FALSE, "x_Aktif") ?>
</div></div>
</span>
<?php echo $t01_tahunajaran->Aktif->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div>
<input type="hidden" data-table="t01_tahunajaran" data-field="x_id" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($t01_tahunajaran->id->CurrentValue) ?>">
<?php if (!$t01_tahunajaran_edit->IsModal) { ?>
<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("SaveBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $t01_tahunajaran_edit->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div>
</div>
<?php if (!isset($t01_tahunajaran_edit->Pager)) $t01_tahunajaran_edit->Pager = new cPrevNextPager($t01_tahunajaran_edit->StartRec, $t01_tahunajaran_edit->DisplayRecs, $t01_tahunajaran_edit->TotalRecs) ?>
<?php if ($t01_tahunajaran_edit->Pager->RecordCount > 0 && $t01_tahunajaran_edit->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($t01_tahunajaran_edit->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $t01_tahunajaran_edit->PageUrl() ?>start=<?php echo $t01_tahunajaran_edit->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($t01_tahunajaran_edit->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $t01_tahunajaran_edit->PageUrl() ?>start=<?php echo $t01_tahunajaran_edit->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $t01_tahunajaran_edit->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($t01_tahunajaran_edit->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $t01_tahunajaran_edit->PageUrl() ?>start=<?php echo $t01_tahunajaran_edit->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($t01_tahunajaran_edit->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $t01_tahunajaran_edit->PageUrl() ?>start=<?php echo $t01_tahunajaran_edit->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $t01_tahunajaran_edit->Pager->PageCount ?></span>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<script type="text/javascript">
ft01_tahunajaranedit.Init();
</script>
<?php
$t01_tahunajaran_edit->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$t01_tahunajaran_edit->Page_Terminate();
?>
