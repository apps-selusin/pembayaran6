<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg13.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql13.php") ?>
<?php include_once "phpfn13.php" ?>
<?php include_once "t10_siswarutinbayarinfo.php" ?>
<?php include_once "t96_employeesinfo.php" ?>
<?php include_once "v01_siswarutininfo.php" ?>
<?php include_once "userfn13.php" ?>
<?php

//
// Page class
//

$t10_siswarutinbayar_add = NULL; // Initialize page object first

class ct10_siswarutinbayar_add extends ct10_siswarutinbayar {

	// Page ID
	var $PageID = 'add';

	// Project ID
	var $ProjectID = "{699E0CB8-ECC6-4DDA-93F3-012C887E6B12}";

	// Table name
	var $TableName = 't10_siswarutinbayar';

	// Page object name
	var $PageObjName = 't10_siswarutinbayar_add';

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

		// Table object (t10_siswarutinbayar)
		if (!isset($GLOBALS["t10_siswarutinbayar"]) || get_class($GLOBALS["t10_siswarutinbayar"]) == "ct10_siswarutinbayar") {
			$GLOBALS["t10_siswarutinbayar"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t10_siswarutinbayar"];
		}

		// Table object (t96_employees)
		if (!isset($GLOBALS['t96_employees'])) $GLOBALS['t96_employees'] = new ct96_employees();

		// Table object (v01_siswarutin)
		if (!isset($GLOBALS['v01_siswarutin'])) $GLOBALS['v01_siswarutin'] = new cv01_siswarutin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 't10_siswarutinbayar', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("t10_siswarutinbayarlist.php"));
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
		$this->Periode->SetVisibility();
		$this->TanggalBayar->SetVisibility();
		$this->JumlahBayar->SetVisibility();

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
		global $EW_EXPORT, $t10_siswarutinbayar;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($t10_siswarutinbayar);
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
					$this->Page_Terminate("t10_siswarutinbayarlist.php"); // No matching record, return to list
				}
				break;
			case "A": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $this->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "t10_siswarutinbayarlist.php")
						$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to list page with correct master key if necessary
					elseif (ew_GetPageName($sReturnUrl) == "t10_siswarutinbayarview.php")
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
		$this->Periode->CurrentValue = NULL;
		$this->Periode->OldValue = $this->Periode->CurrentValue;
		$this->TanggalBayar->CurrentValue = NULL;
		$this->TanggalBayar->OldValue = $this->TanggalBayar->CurrentValue;
		$this->JumlahBayar->CurrentValue = 0.00;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->Periode->FldIsDetailKey) {
			$this->Periode->setFormValue($objForm->GetValue("x_Periode"));
		}
		if (!$this->TanggalBayar->FldIsDetailKey) {
			$this->TanggalBayar->setFormValue($objForm->GetValue("x_TanggalBayar"));
			$this->TanggalBayar->CurrentValue = ew_UnFormatDateTime($this->TanggalBayar->CurrentValue, 0);
		}
		if (!$this->JumlahBayar->FldIsDetailKey) {
			$this->JumlahBayar->setFormValue($objForm->GetValue("x_JumlahBayar"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->LoadOldRecord();
		$this->Periode->CurrentValue = $this->Periode->FormValue;
		$this->TanggalBayar->CurrentValue = $this->TanggalBayar->FormValue;
		$this->TanggalBayar->CurrentValue = ew_UnFormatDateTime($this->TanggalBayar->CurrentValue, 0);
		$this->JumlahBayar->CurrentValue = $this->JumlahBayar->FormValue;
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
		$this->siswarutin_id->setDbValue($rs->fields('siswarutin_id'));
		$this->Periode->setDbValue($rs->fields('Periode'));
		$this->TanggalBayar->setDbValue($rs->fields('TanggalBayar'));
		$this->JumlahBayar->setDbValue($rs->fields('JumlahBayar'));
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF) return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->siswarutin_id->DbValue = $row['siswarutin_id'];
		$this->Periode->DbValue = $row['Periode'];
		$this->TanggalBayar->DbValue = $row['TanggalBayar'];
		$this->JumlahBayar->DbValue = $row['JumlahBayar'];
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

		if ($this->JumlahBayar->FormValue == $this->JumlahBayar->CurrentValue && is_numeric(ew_StrToFloat($this->JumlahBayar->CurrentValue)))
			$this->JumlahBayar->CurrentValue = ew_StrToFloat($this->JumlahBayar->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// id
		// siswarutin_id
		// Periode
		// TanggalBayar
		// JumlahBayar

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// siswarutin_id
		$this->siswarutin_id->ViewValue = $this->siswarutin_id->CurrentValue;
		$this->siswarutin_id->ViewCustomAttributes = "";

		// Periode
		$this->Periode->ViewValue = $this->Periode->CurrentValue;
		$this->Periode->ViewCustomAttributes = "";

		// TanggalBayar
		$this->TanggalBayar->ViewValue = $this->TanggalBayar->CurrentValue;
		$this->TanggalBayar->ViewValue = ew_FormatDateTime($this->TanggalBayar->ViewValue, 0);
		$this->TanggalBayar->ViewCustomAttributes = "";

		// JumlahBayar
		$this->JumlahBayar->ViewValue = $this->JumlahBayar->CurrentValue;
		$this->JumlahBayar->ViewCustomAttributes = "";

			// Periode
			$this->Periode->LinkCustomAttributes = "";
			$this->Periode->HrefValue = "";
			$this->Periode->TooltipValue = "";

			// TanggalBayar
			$this->TanggalBayar->LinkCustomAttributes = "";
			$this->TanggalBayar->HrefValue = "";
			$this->TanggalBayar->TooltipValue = "";

			// JumlahBayar
			$this->JumlahBayar->LinkCustomAttributes = "";
			$this->JumlahBayar->HrefValue = "";
			$this->JumlahBayar->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// Periode
			$this->Periode->EditAttrs["class"] = "form-control";
			$this->Periode->EditCustomAttributes = "";
			$this->Periode->EditValue = ew_HtmlEncode($this->Periode->CurrentValue);
			$this->Periode->PlaceHolder = ew_RemoveHtml($this->Periode->FldCaption());

			// TanggalBayar
			$this->TanggalBayar->EditAttrs["class"] = "form-control";
			$this->TanggalBayar->EditCustomAttributes = "";
			$this->TanggalBayar->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->TanggalBayar->CurrentValue, 8));
			$this->TanggalBayar->PlaceHolder = ew_RemoveHtml($this->TanggalBayar->FldCaption());

			// JumlahBayar
			$this->JumlahBayar->EditAttrs["class"] = "form-control";
			$this->JumlahBayar->EditCustomAttributes = "";
			$this->JumlahBayar->EditValue = ew_HtmlEncode($this->JumlahBayar->CurrentValue);
			$this->JumlahBayar->PlaceHolder = ew_RemoveHtml($this->JumlahBayar->FldCaption());
			if (strval($this->JumlahBayar->EditValue) <> "" && is_numeric($this->JumlahBayar->EditValue)) $this->JumlahBayar->EditValue = ew_FormatNumber($this->JumlahBayar->EditValue, -2, -1, -2, 0);

			// Add refer script
			// Periode

			$this->Periode->LinkCustomAttributes = "";
			$this->Periode->HrefValue = "";

			// TanggalBayar
			$this->TanggalBayar->LinkCustomAttributes = "";
			$this->TanggalBayar->HrefValue = "";

			// JumlahBayar
			$this->JumlahBayar->LinkCustomAttributes = "";
			$this->JumlahBayar->HrefValue = "";
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
		if (!$this->Periode->FldIsDetailKey && !is_null($this->Periode->FormValue) && $this->Periode->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Periode->FldCaption(), $this->Periode->ReqErrMsg));
		}
		if (!ew_CheckInteger($this->Periode->FormValue)) {
			ew_AddMessage($gsFormError, $this->Periode->FldErrMsg());
		}
		if (!$this->TanggalBayar->FldIsDetailKey && !is_null($this->TanggalBayar->FormValue) && $this->TanggalBayar->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->TanggalBayar->FldCaption(), $this->TanggalBayar->ReqErrMsg));
		}
		if (!ew_CheckDateDef($this->TanggalBayar->FormValue)) {
			ew_AddMessage($gsFormError, $this->TanggalBayar->FldErrMsg());
		}
		if (!$this->JumlahBayar->FldIsDetailKey && !is_null($this->JumlahBayar->FormValue) && $this->JumlahBayar->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->JumlahBayar->FldCaption(), $this->JumlahBayar->ReqErrMsg));
		}
		if (!ew_CheckNumber($this->JumlahBayar->FormValue)) {
			ew_AddMessage($gsFormError, $this->JumlahBayar->FldErrMsg());
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

		// Periode
		$this->Periode->SetDbValueDef($rsnew, $this->Periode->CurrentValue, 0, FALSE);

		// TanggalBayar
		$this->TanggalBayar->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->TanggalBayar->CurrentValue, 0), ew_CurrentDate(), FALSE);

		// JumlahBayar
		$this->JumlahBayar->SetDbValueDef($rsnew, $this->JumlahBayar->CurrentValue, 0, strval($this->JumlahBayar->CurrentValue) == "");

		// siswarutin_id
		if ($this->siswarutin_id->getSessionValue() <> "") {
			$rsnew['siswarutin_id'] = $this->siswarutin_id->getSessionValue();
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
			if ($sMasterTblVar == "v01_siswarutin") {
				$bValidMaster = TRUE;
				if (@$_GET["fk_id"] <> "") {
					$GLOBALS["v01_siswarutin"]->id->setQueryStringValue($_GET["fk_id"]);
					$this->siswarutin_id->setQueryStringValue($GLOBALS["v01_siswarutin"]->id->QueryStringValue);
					$this->siswarutin_id->setSessionValue($this->siswarutin_id->QueryStringValue);
					if (!is_numeric($GLOBALS["v01_siswarutin"]->id->QueryStringValue)) $bValidMaster = FALSE;
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
			if ($sMasterTblVar == "v01_siswarutin") {
				$bValidMaster = TRUE;
				if (@$_POST["fk_id"] <> "") {
					$GLOBALS["v01_siswarutin"]->id->setFormValue($_POST["fk_id"]);
					$this->siswarutin_id->setFormValue($GLOBALS["v01_siswarutin"]->id->FormValue);
					$this->siswarutin_id->setSessionValue($this->siswarutin_id->FormValue);
					if (!is_numeric($GLOBALS["v01_siswarutin"]->id->FormValue)) $bValidMaster = FALSE;
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
			if ($sMasterTblVar <> "v01_siswarutin") {
				if ($this->siswarutin_id->CurrentValue == "") $this->siswarutin_id->setSessionValue("");
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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("t10_siswarutinbayarlist.php"), "", $this->TableVar, TRUE);
		$PageId = ($this->CurrentAction == "C") ? "Copy" : "Add";
		$Breadcrumb->Add("add", $PageId, $url);
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
if (!isset($t10_siswarutinbayar_add)) $t10_siswarutinbayar_add = new ct10_siswarutinbayar_add();

// Page init
$t10_siswarutinbayar_add->Page_Init();

// Page main
$t10_siswarutinbayar_add->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t10_siswarutinbayar_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "add";
var CurrentForm = ft10_siswarutinbayaradd = new ew_Form("ft10_siswarutinbayaradd", "add");

// Validate form
ft10_siswarutinbayaradd.Validate = function() {
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
ft10_siswarutinbayaradd.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft10_siswarutinbayaradd.ValidateRequired = true;
<?php } else { ?>
ft10_siswarutinbayaradd.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
// Form object for search

</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php if (!$t10_siswarutinbayar_add->IsModal) { ?>
<div class="ewToolbar">
<?php $Breadcrumb->Render(); ?>
<?php echo $Language->SelectionForm(); ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $t10_siswarutinbayar_add->ShowPageHeader(); ?>
<?php
$t10_siswarutinbayar_add->ShowMessage();
?>
<form name="ft10_siswarutinbayaradd" id="ft10_siswarutinbayaradd" class="<?php echo $t10_siswarutinbayar_add->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($t10_siswarutinbayar_add->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $t10_siswarutinbayar_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t10_siswarutinbayar">
<input type="hidden" name="a_add" id="a_add" value="A">
<?php if ($t10_siswarutinbayar_add->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<?php if ($t10_siswarutinbayar->getCurrentMasterTable() == "v01_siswarutin") { ?>
<input type="hidden" name="<?php echo EW_TABLE_SHOW_MASTER ?>" value="v01_siswarutin">
<input type="hidden" name="fk_id" value="<?php echo $t10_siswarutinbayar->siswarutin_id->getSessionValue() ?>">
<?php } ?>
<div>
<?php if ($t10_siswarutinbayar->Periode->Visible) { // Periode ?>
	<div id="r_Periode" class="form-group">
		<label id="elh_t10_siswarutinbayar_Periode" for="x_Periode" class="col-sm-2 control-label ewLabel"><?php echo $t10_siswarutinbayar->Periode->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t10_siswarutinbayar->Periode->CellAttributes() ?>>
<span id="el_t10_siswarutinbayar_Periode">
<input type="text" data-table="t10_siswarutinbayar" data-field="x_Periode" name="x_Periode" id="x_Periode" size="30" placeholder="<?php echo ew_HtmlEncode($t10_siswarutinbayar->Periode->getPlaceHolder()) ?>" value="<?php echo $t10_siswarutinbayar->Periode->EditValue ?>"<?php echo $t10_siswarutinbayar->Periode->EditAttributes() ?>>
</span>
<?php echo $t10_siswarutinbayar->Periode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t10_siswarutinbayar->TanggalBayar->Visible) { // TanggalBayar ?>
	<div id="r_TanggalBayar" class="form-group">
		<label id="elh_t10_siswarutinbayar_TanggalBayar" for="x_TanggalBayar" class="col-sm-2 control-label ewLabel"><?php echo $t10_siswarutinbayar->TanggalBayar->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t10_siswarutinbayar->TanggalBayar->CellAttributes() ?>>
<span id="el_t10_siswarutinbayar_TanggalBayar">
<input type="text" data-table="t10_siswarutinbayar" data-field="x_TanggalBayar" name="x_TanggalBayar" id="x_TanggalBayar" placeholder="<?php echo ew_HtmlEncode($t10_siswarutinbayar->TanggalBayar->getPlaceHolder()) ?>" value="<?php echo $t10_siswarutinbayar->TanggalBayar->EditValue ?>"<?php echo $t10_siswarutinbayar->TanggalBayar->EditAttributes() ?>>
</span>
<?php echo $t10_siswarutinbayar->TanggalBayar->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t10_siswarutinbayar->JumlahBayar->Visible) { // JumlahBayar ?>
	<div id="r_JumlahBayar" class="form-group">
		<label id="elh_t10_siswarutinbayar_JumlahBayar" for="x_JumlahBayar" class="col-sm-2 control-label ewLabel"><?php echo $t10_siswarutinbayar->JumlahBayar->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t10_siswarutinbayar->JumlahBayar->CellAttributes() ?>>
<span id="el_t10_siswarutinbayar_JumlahBayar">
<input type="text" data-table="t10_siswarutinbayar" data-field="x_JumlahBayar" name="x_JumlahBayar" id="x_JumlahBayar" size="30" placeholder="<?php echo ew_HtmlEncode($t10_siswarutinbayar->JumlahBayar->getPlaceHolder()) ?>" value="<?php echo $t10_siswarutinbayar->JumlahBayar->EditValue ?>"<?php echo $t10_siswarutinbayar->JumlahBayar->EditAttributes() ?>>
</span>
<?php echo $t10_siswarutinbayar->JumlahBayar->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div>
<?php if (strval($t10_siswarutinbayar->siswarutin_id->getSessionValue()) <> "") { ?>
<input type="hidden" name="x_siswarutin_id" id="x_siswarutin_id" value="<?php echo ew_HtmlEncode(strval($t10_siswarutinbayar->siswarutin_id->getSessionValue())) ?>">
<?php } ?>
<?php if (!$t10_siswarutinbayar_add->IsModal) { ?>
<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $t10_siswarutinbayar_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div>
</div>
<?php } ?>
</form>
<script type="text/javascript">
ft10_siswarutinbayaradd.Init();
</script>
<?php
$t10_siswarutinbayar_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$t10_siswarutinbayar_add->Page_Terminate();
?>
