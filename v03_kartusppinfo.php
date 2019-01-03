<?php

// Global variable for table object
$v03_kartuspp = NULL;

//
// Table class for v03_kartuspp
//
class cv03_kartuspp extends cTable {
	var $tahunajaran_id;
	var $siswa_id;
	var $siswaspp_id;
	var $spp_id;
	var $periode_id;
	var $Bulan;
	var $Periode;
	var $Tanggal;
	var $bayardetail_Jumlah;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'v03_kartuspp';
		$this->TableName = 'v03_kartuspp';
		$this->TableType = 'VIEW';

		// Update Table
		$this->UpdateTable = "`v03_kartuspp`";
		$this->DBID = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PHPExcel only)
		$this->ExportExcelPageSize = ""; // Page size (PHPExcel only)
		$this->DetailAdd = FALSE; // Allow detail add
		$this->DetailEdit = FALSE; // Allow detail edit
		$this->DetailView = FALSE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 1;
		$this->AllowAddDeleteRow = ew_AllowAddDeleteRow(); // Allow add/delete row
		$this->UserIDAllowSecurity = 0; // User ID Allow
		$this->BasicSearch = new cBasicSearch($this->TableVar);

		// tahunajaran_id
		$this->tahunajaran_id = new cField('v03_kartuspp', 'v03_kartuspp', 'x_tahunajaran_id', 'tahunajaran_id', '`tahunajaran_id`', '`tahunajaran_id`', 3, -1, FALSE, '`tahunajaran_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->tahunajaran_id->Sortable = TRUE; // Allow sort
		$this->tahunajaran_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->tahunajaran_id->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->tahunajaran_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['tahunajaran_id'] = &$this->tahunajaran_id;

		// siswa_id
		$this->siswa_id = new cField('v03_kartuspp', 'v03_kartuspp', 'x_siswa_id', 'siswa_id', '`siswa_id`', '`siswa_id`', 3, -1, FALSE, '`siswa_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->siswa_id->Sortable = TRUE; // Allow sort
		$this->siswa_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['siswa_id'] = &$this->siswa_id;

		// siswaspp_id
		$this->siswaspp_id = new cField('v03_kartuspp', 'v03_kartuspp', 'x_siswaspp_id', 'siswaspp_id', '`siswaspp_id`', '`siswaspp_id`', 3, -1, FALSE, '`siswaspp_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->siswaspp_id->Sortable = TRUE; // Allow sort
		$this->siswaspp_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->siswaspp_id->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->siswaspp_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['siswaspp_id'] = &$this->siswaspp_id;

		// spp_id
		$this->spp_id = new cField('v03_kartuspp', 'v03_kartuspp', 'x_spp_id', 'spp_id', '`spp_id`', '`spp_id`', 3, -1, FALSE, '`spp_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->spp_id->Sortable = TRUE; // Allow sort
		$this->spp_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['spp_id'] = &$this->spp_id;

		// periode_id
		$this->periode_id = new cField('v03_kartuspp', 'v03_kartuspp', 'x_periode_id', 'periode_id', '`periode_id`', '`periode_id`', 3, -1, FALSE, '`periode_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->periode_id->Sortable = TRUE; // Allow sort
		$this->periode_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['periode_id'] = &$this->periode_id;

		// Bulan
		$this->Bulan = new cField('v03_kartuspp', 'v03_kartuspp', 'x_Bulan', 'Bulan', '`Bulan`', '`Bulan`', 16, -1, FALSE, '`Bulan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Bulan->Sortable = TRUE; // Allow sort
		$this->Bulan->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['Bulan'] = &$this->Bulan;

		// Periode
		$this->Periode = new cField('v03_kartuspp', 'v03_kartuspp', 'x_Periode', 'Periode', '`Periode`', '`Periode`', 200, -1, FALSE, '`Periode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Periode->Sortable = TRUE; // Allow sort
		$this->fields['Periode'] = &$this->Periode;

		// Tanggal
		$this->Tanggal = new cField('v03_kartuspp', 'v03_kartuspp', 'x_Tanggal', 'Tanggal', '`Tanggal`', ew_CastDateFieldForLike('`Tanggal`', 7, "DB"), 133, 7, FALSE, '`Tanggal`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Tanggal->Sortable = TRUE; // Allow sort
		$this->Tanggal->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_SEPARATOR"], $Language->Phrase("IncorrectDateDMY"));
		$this->fields['Tanggal'] = &$this->Tanggal;

		// bayardetail_Jumlah
		$this->bayardetail_Jumlah = new cField('v03_kartuspp', 'v03_kartuspp', 'x_bayardetail_Jumlah', 'bayardetail_Jumlah', '`bayardetail_Jumlah`', '`bayardetail_Jumlah`', 4, -1, FALSE, '`bayardetail_Jumlah`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->bayardetail_Jumlah->Sortable = TRUE; // Allow sort
		$this->bayardetail_Jumlah->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['bayardetail_Jumlah'] = &$this->bayardetail_Jumlah;
	}

	// Set Field Visibility
	function SetFieldVisibility($fldparm) {
		global $Security;
		return $this->$fldparm->Visible; // Returns original value
	}

	// Multiple column sort
	function UpdateSort(&$ofld, $ctrl) {
		if ($this->CurrentOrder == $ofld->FldName) {
			$sSortField = $ofld->FldExpression;
			$sLastSort = $ofld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$sThisSort = $this->CurrentOrderType;
			} else {
				$sThisSort = ($sLastSort == "ASC") ? "DESC" : "ASC";
			}
			$ofld->setSort($sThisSort);
			if ($ctrl) {
				$sOrderBy = $this->getSessionOrderBy();
				if (strpos($sOrderBy, $sSortField . " " . $sLastSort) !== FALSE) {
					$sOrderBy = str_replace($sSortField . " " . $sLastSort, $sSortField . " " . $sThisSort, $sOrderBy);
				} else {
					if ($sOrderBy <> "") $sOrderBy .= ", ";
					$sOrderBy .= $sSortField . " " . $sThisSort;
				}
				$this->setSessionOrderBy($sOrderBy); // Save to Session
			} else {
				$this->setSessionOrderBy($sSortField . " " . $sThisSort); // Save to Session
			}
		} else {
			if (!$ctrl) $ofld->setSort("");
		}
	}

	// Table level SQL
	var $_SqlFrom = "";

	function getSqlFrom() { // From
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`v03_kartuspp`";
	}

	function SqlFrom() { // For backward compatibility
		return $this->getSqlFrom();
	}

	function setSqlFrom($v) {
		$this->_SqlFrom = $v;
	}
	var $_SqlSelect = "";

	function getSqlSelect() { // Select
		return ($this->_SqlSelect <> "") ? $this->_SqlSelect : "SELECT * FROM " . $this->getSqlFrom();
	}

	function SqlSelect() { // For backward compatibility
		return $this->getSqlSelect();
	}

	function setSqlSelect($v) {
		$this->_SqlSelect = $v;
	}
	var $_SqlWhere = "";

	function getSqlWhere() { // Where
		$sWhere = ($this->_SqlWhere <> "") ? $this->_SqlWhere : "";
		$this->TableFilter = "";
		ew_AddFilter($sWhere, $this->TableFilter);
		return $sWhere;
	}

	function SqlWhere() { // For backward compatibility
		return $this->getSqlWhere();
	}

	function setSqlWhere($v) {
		$this->_SqlWhere = $v;
	}
	var $_SqlGroupBy = "";

	function getSqlGroupBy() { // Group By
		return ($this->_SqlGroupBy <> "") ? $this->_SqlGroupBy : "";
	}

	function SqlGroupBy() { // For backward compatibility
		return $this->getSqlGroupBy();
	}

	function setSqlGroupBy($v) {
		$this->_SqlGroupBy = $v;
	}
	var $_SqlHaving = "";

	function getSqlHaving() { // Having
		return ($this->_SqlHaving <> "") ? $this->_SqlHaving : "";
	}

	function SqlHaving() { // For backward compatibility
		return $this->getSqlHaving();
	}

	function setSqlHaving($v) {
		$this->_SqlHaving = $v;
	}
	var $_SqlOrderBy = "";

	function getSqlOrderBy() { // Order By
		return ($this->_SqlOrderBy <> "") ? $this->_SqlOrderBy : "`spp_id` ASC,`periode_id` ASC";
	}

	function SqlOrderBy() { // For backward compatibility
		return $this->getSqlOrderBy();
	}

	function setSqlOrderBy($v) {
		$this->_SqlOrderBy = $v;
	}

	// Apply User ID filters
	function ApplyUserIDFilters($sFilter) {
		return $sFilter;
	}

	// Check if User ID security allows view all
	function UserIDAllow($id = "") {
		$allow = EW_USER_ID_ALLOW;
		switch ($id) {
			case "add":
			case "copy":
			case "gridadd":
			case "register":
			case "addopt":
				return (($allow & 1) == 1);
			case "edit":
			case "gridedit":
			case "update":
			case "changepwd":
			case "forgotpwd":
				return (($allow & 4) == 4);
			case "delete":
				return (($allow & 2) == 2);
			case "view":
				return (($allow & 32) == 32);
			case "search":
				return (($allow & 64) == 64);
			default:
				return (($allow & 8) == 8);
		}
	}

	// Get SQL
	function GetSQL($where, $orderby) {
		return ew_BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$where, $orderby);
	}

	// Table SQL
	function SQL() {
		$sFilter = $this->CurrentFilter;
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$sFilter, $sSort);
	}

	// Table SQL with List page filter
	function SelectSQL() {
		$sFilter = $this->getSessionWhere();
		ew_AddFilter($sFilter, $this->CurrentFilter);
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$this->Recordset_Selecting($sFilter);
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $sFilter, $sSort);
	}

	// Get ORDER BY clause
	function GetOrderBy() {
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sSort);
	}

	// Try to get record count
	function TryGetRecordCount($sSql) {
		$cnt = -1;
		if (($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') && preg_match("/^SELECT \* FROM/i", $sSql)) {
			$sSql = "SELECT COUNT(*) FROM" . preg_replace('/^SELECT\s([\s\S]+)?\*\sFROM/i', "", $sSql);
			$sOrderBy = $this->GetOrderBy();
			if (substr($sSql, strlen($sOrderBy) * -1) == $sOrderBy)
				$sSql = substr($sSql, 0, strlen($sSql) - strlen($sOrderBy)); // Remove ORDER BY clause
		} else {
			$sSql = "SELECT COUNT(*) FROM (" . $sSql . ") EW_COUNT_TABLE";
		}
		$conn = &$this->Connection();
		if ($rs = $conn->Execute($sSql)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->Close();
			}
		}
		return intval($cnt);
	}

	// Get record count based on filter (for detail record count in master table pages)
	function LoadRecordCount($sFilter) {
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $sFilter;
		$this->Recordset_Selecting($this->CurrentFilter);

		//$sSql = $this->SQL();
		$sSql = $this->GetSQL($this->CurrentFilter, "");
		$cnt = $this->TryGetRecordCount($sSql);
		if ($cnt == -1) {
			if ($rs = $this->LoadRs($this->CurrentFilter)) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		$this->CurrentFilter = $origFilter;
		return intval($cnt);
	}

	// Get record count (for current List page)
	function SelectRecordCount() {
		$sSql = $this->SelectSQL();
		$cnt = $this->TryGetRecordCount($sSql);
		if ($cnt == -1) {
			$conn = &$this->Connection();
			if ($rs = $conn->Execute($sSql)) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		return intval($cnt);
	}

	// INSERT statement
	function InsertSQL(&$rs) {
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->FldIsCustom)
				continue;
			$names .= $this->fields[$name]->FldExpression . ",";
			$values .= ew_QuotedValue($value, $this->fields[$name]->FldDataType, $this->DBID) . ",";
		}
		while (substr($names, -1) == ",")
			$names = substr($names, 0, -1);
		while (substr($values, -1) == ",")
			$values = substr($values, 0, -1);
		return "INSERT INTO " . $this->UpdateTable . " ($names) VALUES ($values)";
	}

	// Insert
	function Insert(&$rs) {
		$conn = &$this->Connection();
		$bInsert = $conn->Execute($this->InsertSQL($rs));
		if ($bInsert) {

			// Get insert id if necessary
			$this->tahunajaran_id->setDbValue($conn->Insert_ID());
			$rs['tahunajaran_id'] = $this->tahunajaran_id->DbValue;

			// Get insert id if necessary
			$this->siswaspp_id->setDbValue($conn->Insert_ID());
			$rs['siswaspp_id'] = $this->siswaspp_id->DbValue;

			// Get insert id if necessary
			$this->periode_id->setDbValue($conn->Insert_ID());
			$rs['periode_id'] = $this->periode_id->DbValue;
		}
		return $bInsert;
	}

	// UPDATE statement
	function UpdateSQL(&$rs, $where = "", $curfilter = TRUE) {
		$sql = "UPDATE " . $this->UpdateTable . " SET ";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->FldIsCustom)
				continue;
			$sql .= $this->fields[$name]->FldExpression . "=";
			$sql .= ew_QuotedValue($value, $this->fields[$name]->FldDataType, $this->DBID) . ",";
		}
		while (substr($sql, -1) == ",")
			$sql = substr($sql, 0, -1);
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		if (is_array($where))
			$where = $this->ArrayToFilter($where);
		ew_AddFilter($filter, $where);
		if ($filter <> "")	$sql .= " WHERE " . $filter;
		return $sql;
	}

	// Update
	function Update(&$rs, $where = "", $rsold = NULL, $curfilter = TRUE) {
		$conn = &$this->Connection();
		$bUpdate = $conn->Execute($this->UpdateSQL($rs, $where, $curfilter));
		return $bUpdate;
	}

	// DELETE statement
	function DeleteSQL(&$rs, $where = "", $curfilter = TRUE) {
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->ArrayToFilter($where);
		if ($rs) {
			if (array_key_exists('tahunajaran_id', $rs))
				ew_AddFilter($where, ew_QuotedName('tahunajaran_id', $this->DBID) . '=' . ew_QuotedValue($rs['tahunajaran_id'], $this->tahunajaran_id->FldDataType, $this->DBID));
			if (array_key_exists('siswaspp_id', $rs))
				ew_AddFilter($where, ew_QuotedName('siswaspp_id', $this->DBID) . '=' . ew_QuotedValue($rs['siswaspp_id'], $this->siswaspp_id->FldDataType, $this->DBID));
			if (array_key_exists('periode_id', $rs))
				ew_AddFilter($where, ew_QuotedName('periode_id', $this->DBID) . '=' . ew_QuotedValue($rs['periode_id'], $this->periode_id->FldDataType, $this->DBID));
		}
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		ew_AddFilter($filter, $where);
		if ($filter <> "")
			$sql .= $filter;
		else
			$sql .= "0=1"; // Avoid delete
		return $sql;
	}

	// Delete
	function Delete(&$rs, $where = "", $curfilter = TRUE) {
		$conn = &$this->Connection();
		$bDelete = $conn->Execute($this->DeleteSQL($rs, $where, $curfilter));
		return $bDelete;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "`tahunajaran_id` = @tahunajaran_id@ AND `siswaspp_id` = @siswaspp_id@ AND `periode_id` = @periode_id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->tahunajaran_id->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@tahunajaran_id@", ew_AdjustSql($this->tahunajaran_id->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
		if (!is_numeric($this->siswaspp_id->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@siswaspp_id@", ew_AdjustSql($this->siswaspp_id->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
		if (!is_numeric($this->periode_id->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@periode_id@", ew_AdjustSql($this->periode_id->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
		return $sKeyFilter;
	}

	// Return page URL
	function getReturnUrl() {
		$name = EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL;

		// Get referer URL automatically
		if (ew_ServerVar("HTTP_REFERER") <> "" && ew_ReferPage() <> ew_CurrentPage() && ew_ReferPage() <> "login.php") // Referer not same page or login page
			$_SESSION[$name] = ew_ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] <> "") {
			return $_SESSION[$name];
		} else {
			return "v03_kartuspplist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function GetListUrl() {
		return "v03_kartuspplist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("v03_kartusppview.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("v03_kartusppview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			$url = "v03_kartusppadd.php?" . $this->UrlParm($parm);
		else
			$url = "v03_kartusppadd.php";
		return $this->AddMasterUrl($url);
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		$url = $this->KeyUrl("v03_kartusppedit.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
		return $this->AddMasterUrl($url);
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		$url = $this->KeyUrl("v03_kartusppadd.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
		return $this->AddMasterUrl($url);
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("v03_kartusppdelete.php", $this->UrlParm());
	}

	// Add master url
	function AddMasterUrl($url) {
		return $url;
	}

	function KeyToJson() {
		$json = "";
		$json .= "tahunajaran_id:" . ew_VarToJson($this->tahunajaran_id->CurrentValue, "number", "'");
		$json .= ",siswaspp_id:" . ew_VarToJson($this->siswaspp_id->CurrentValue, "number", "'");
		$json .= ",periode_id:" . ew_VarToJson($this->periode_id->CurrentValue, "number", "'");
		return "{" . $json . "}";
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->tahunajaran_id->CurrentValue)) {
			$sUrl .= "tahunajaran_id=" . urlencode($this->tahunajaran_id->CurrentValue);
		} else {
			return "javascript:ew_Alert(ewLanguage.Phrase('InvalidRecord'));";
		}
		if (!is_null($this->siswaspp_id->CurrentValue)) {
			$sUrl .= "&siswaspp_id=" . urlencode($this->siswaspp_id->CurrentValue);
		} else {
			return "javascript:ew_Alert(ewLanguage.Phrase('InvalidRecord'));";
		}
		if (!is_null($this->periode_id->CurrentValue)) {
			$sUrl .= "&periode_id=" . urlencode($this->periode_id->CurrentValue);
		} else {
			return "javascript:ew_Alert(ewLanguage.Phrase('InvalidRecord'));";
		}
		return $sUrl;
	}

	// Sort URL
	function SortUrl(&$fld) {
		if ($this->CurrentAction <> "" || $this->Export <> "" ||
			in_array($fld->FldType, array(128, 204, 205))) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$sUrlParm = $this->UrlParm("order=" . urlencode($fld->FldName) . "&amp;ordertype=" . $fld->ReverseSort());
			return $this->AddMasterUrl(ew_CurrentPage() . "?" . $sUrlParm);
		} else {
			return "";
		}
	}

	// Get record keys from $_POST/$_GET/$_SESSION
	function GetRecordKeys() {
		global $EW_COMPOSITE_KEY_SEPARATOR;
		$arKeys = array();
		$arKey = array();
		if (isset($_POST["key_m"])) {
			$arKeys = ew_StripSlashes($_POST["key_m"]);
			$cnt = count($arKeys);
			for ($i = 0; $i < $cnt; $i++)
				$arKeys[$i] = explode($EW_COMPOSITE_KEY_SEPARATOR, $arKeys[$i]);
		} elseif (isset($_GET["key_m"])) {
			$arKeys = ew_StripSlashes($_GET["key_m"]);
			$cnt = count($arKeys);
			for ($i = 0; $i < $cnt; $i++)
				$arKeys[$i] = explode($EW_COMPOSITE_KEY_SEPARATOR, $arKeys[$i]);
		} elseif (!empty($_GET) || !empty($_POST)) {
			$isPost = ew_IsHttpPost();
			if ($isPost && isset($_POST["tahunajaran_id"]))
				$arKey[] = ew_StripSlashes($_POST["tahunajaran_id"]);
			elseif (isset($_GET["tahunajaran_id"]))
				$arKey[] = ew_StripSlashes($_GET["tahunajaran_id"]);
			else
				$arKeys = NULL; // Do not setup
			if ($isPost && isset($_POST["siswaspp_id"]))
				$arKey[] = ew_StripSlashes($_POST["siswaspp_id"]);
			elseif (isset($_GET["siswaspp_id"]))
				$arKey[] = ew_StripSlashes($_GET["siswaspp_id"]);
			else
				$arKeys = NULL; // Do not setup
			if ($isPost && isset($_POST["periode_id"]))
				$arKey[] = ew_StripSlashes($_POST["periode_id"]);
			elseif (isset($_GET["periode_id"]))
				$arKey[] = ew_StripSlashes($_GET["periode_id"]);
			else
				$arKeys = NULL; // Do not setup
			if (is_array($arKeys)) $arKeys[] = $arKey;

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = array();
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_array($key) || count($key) <> 3)
					continue; // Just skip so other keys will still work
				if (!is_numeric($key[0])) // tahunajaran_id
					continue;
				if (!is_numeric($key[1])) // siswaspp_id
					continue;
				if (!is_numeric($key[2])) // periode_id
					continue;
				$ar[] = $key;
			}
		}
		return $ar;
	}

	// Get key filter
	function GetKeyFilter() {
		$arKeys = $this->GetRecordKeys();
		$sKeyFilter = "";
		foreach ($arKeys as $key) {
			if ($sKeyFilter <> "") $sKeyFilter .= " OR ";
			$this->tahunajaran_id->CurrentValue = $key[0];
			$this->siswaspp_id->CurrentValue = $key[1];
			$this->periode_id->CurrentValue = $key[2];
			$sKeyFilter .= "(" . $this->KeyFilter() . ")";
		}
		return $sKeyFilter;
	}

	// Load rows based on filter
	function &LoadRs($sFilter) {

		// Set up filter (SQL WHERE clause) and get return SQL
		//$this->CurrentFilter = $sFilter;
		//$sSql = $this->SQL();

		$sSql = $this->GetSQL($sFilter, "");
		$conn = &$this->Connection();
		$rs = $conn->Execute($sSql);
		return $rs;
	}

	// Load row values from recordset
	function LoadListRowValues(&$rs) {
		$this->tahunajaran_id->setDbValue($rs->fields('tahunajaran_id'));
		$this->siswa_id->setDbValue($rs->fields('siswa_id'));
		$this->siswaspp_id->setDbValue($rs->fields('siswaspp_id'));
		$this->spp_id->setDbValue($rs->fields('spp_id'));
		$this->periode_id->setDbValue($rs->fields('periode_id'));
		$this->Bulan->setDbValue($rs->fields('Bulan'));
		$this->Periode->setDbValue($rs->fields('Periode'));
		$this->Tanggal->setDbValue($rs->fields('Tanggal'));
		$this->bayardetail_Jumlah->setDbValue($rs->fields('bayardetail_Jumlah'));
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// tahunajaran_id
		// siswa_id
		// siswaspp_id
		// spp_id
		// periode_id
		// Bulan
		// Periode
		// Tanggal
		// bayardetail_Jumlah
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

		// siswa_id
		$this->siswa_id->ViewValue = $this->siswa_id->CurrentValue;
		if (strval($this->siswa_id->CurrentValue) <> "") {
			$sFilterWrk = "`siswa_id`" . ew_SearchString("=", $this->siswa_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `siswa_id`, `NIS` AS `DispFld`, `Nama` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `v04_daftarsiswa`";
		$sWhereWrk = "";
		$this->siswa_id->LookupFilters = array("dx1" => '`NIS`', "dx2" => '`Nama`');
		$lookuptblfilter = "`siswa_id` is not null";
		ew_AddFilter($sWhereWrk, $lookuptblfilter);
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->siswa_id, $sWhereWrk); // Call Lookup selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$arwrk[2] = $rswrk->fields('Disp2Fld');
				$this->siswa_id->ViewValue = $this->siswa_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->siswa_id->ViewValue = $this->siswa_id->CurrentValue;
			}
		} else {
			$this->siswa_id->ViewValue = NULL;
		}
		$this->siswa_id->ViewCustomAttributes = "";

		// siswaspp_id
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

		// spp_id
		$this->spp_id->ViewValue = $this->spp_id->CurrentValue;
		$this->spp_id->ViewCustomAttributes = "";

		// periode_id
		$this->periode_id->ViewValue = $this->periode_id->CurrentValue;
		$this->periode_id->ViewCustomAttributes = "";

		// Bulan
		$this->Bulan->ViewValue = $this->Bulan->CurrentValue;
		$this->Bulan->ViewCustomAttributes = "";

		// Periode
		$this->Periode->ViewValue = $this->Periode->CurrentValue;
		$this->Periode->ViewCustomAttributes = "";

		// Tanggal
		$this->Tanggal->ViewValue = $this->Tanggal->CurrentValue;
		$this->Tanggal->ViewValue = ew_FormatDateTime($this->Tanggal->ViewValue, 7);
		$this->Tanggal->ViewCustomAttributes = "";

		// bayardetail_Jumlah
		$this->bayardetail_Jumlah->ViewValue = $this->bayardetail_Jumlah->CurrentValue;
		$this->bayardetail_Jumlah->ViewValue = ew_FormatNumber($this->bayardetail_Jumlah->ViewValue, 2, -2, -2, -2);
		$this->bayardetail_Jumlah->CellCssStyle .= "text-align: right;";
		$this->bayardetail_Jumlah->ViewCustomAttributes = "";

		// tahunajaran_id
		$this->tahunajaran_id->LinkCustomAttributes = "";
		$this->tahunajaran_id->HrefValue = "";
		$this->tahunajaran_id->TooltipValue = "";

		// siswa_id
		$this->siswa_id->LinkCustomAttributes = "";
		$this->siswa_id->HrefValue = "";
		$this->siswa_id->TooltipValue = "";

		// siswaspp_id
		$this->siswaspp_id->LinkCustomAttributes = "";
		$this->siswaspp_id->HrefValue = "";
		$this->siswaspp_id->TooltipValue = "";

		// spp_id
		$this->spp_id->LinkCustomAttributes = "";
		$this->spp_id->HrefValue = "";
		$this->spp_id->TooltipValue = "";

		// periode_id
		$this->periode_id->LinkCustomAttributes = "";
		$this->periode_id->HrefValue = "";
		$this->periode_id->TooltipValue = "";

		// Bulan
		$this->Bulan->LinkCustomAttributes = "";
		$this->Bulan->HrefValue = "";
		$this->Bulan->TooltipValue = "";

		// Periode
		$this->Periode->LinkCustomAttributes = "";
		$this->Periode->HrefValue = "";
		$this->Periode->TooltipValue = "";

		// Tanggal
		$this->Tanggal->LinkCustomAttributes = "";
		$this->Tanggal->HrefValue = "";
		$this->Tanggal->TooltipValue = "";

		// bayardetail_Jumlah
		$this->bayardetail_Jumlah->LinkCustomAttributes = "";
		$this->bayardetail_Jumlah->HrefValue = "";
		$this->bayardetail_Jumlah->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Render edit row values
	function RenderEditRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// tahunajaran_id
		$this->tahunajaran_id->EditAttrs["class"] = "form-control";
		$this->tahunajaran_id->EditCustomAttributes = "";
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
				$this->tahunajaran_id->EditValue = $this->tahunajaran_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->tahunajaran_id->EditValue = $this->tahunajaran_id->CurrentValue;
			}
		} else {
			$this->tahunajaran_id->EditValue = NULL;
		}
		$this->tahunajaran_id->ViewCustomAttributes = "";

		// siswa_id
		$this->siswa_id->EditAttrs["class"] = "form-control";
		$this->siswa_id->EditCustomAttributes = "";
		$this->siswa_id->EditValue = $this->siswa_id->CurrentValue;
		$this->siswa_id->PlaceHolder = ew_RemoveHtml($this->siswa_id->FldCaption());

		// siswaspp_id
		$this->siswaspp_id->EditAttrs["class"] = "form-control";
		$this->siswaspp_id->EditCustomAttributes = "";
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
				$this->siswaspp_id->EditValue = $this->siswaspp_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->siswaspp_id->EditValue = $this->siswaspp_id->CurrentValue;
			}
		} else {
			$this->siswaspp_id->EditValue = NULL;
		}
		$this->siswaspp_id->ViewCustomAttributes = "";

		// spp_id
		$this->spp_id->EditAttrs["class"] = "form-control";
		$this->spp_id->EditCustomAttributes = "";
		$this->spp_id->EditValue = $this->spp_id->CurrentValue;
		$this->spp_id->PlaceHolder = ew_RemoveHtml($this->spp_id->FldCaption());

		// periode_id
		$this->periode_id->EditAttrs["class"] = "form-control";
		$this->periode_id->EditCustomAttributes = "";
		$this->periode_id->EditValue = $this->periode_id->CurrentValue;
		$this->periode_id->ViewCustomAttributes = "";

		// Bulan
		$this->Bulan->EditAttrs["class"] = "form-control";
		$this->Bulan->EditCustomAttributes = "";
		$this->Bulan->EditValue = $this->Bulan->CurrentValue;
		$this->Bulan->PlaceHolder = ew_RemoveHtml($this->Bulan->FldCaption());

		// Periode
		$this->Periode->EditAttrs["class"] = "form-control";
		$this->Periode->EditCustomAttributes = "";
		$this->Periode->EditValue = $this->Periode->CurrentValue;
		$this->Periode->PlaceHolder = ew_RemoveHtml($this->Periode->FldCaption());

		// Tanggal
		$this->Tanggal->EditAttrs["class"] = "form-control";
		$this->Tanggal->EditCustomAttributes = "";
		$this->Tanggal->EditValue = ew_FormatDateTime($this->Tanggal->CurrentValue, 7);
		$this->Tanggal->PlaceHolder = ew_RemoveHtml($this->Tanggal->FldCaption());

		// bayardetail_Jumlah
		$this->bayardetail_Jumlah->EditAttrs["class"] = "form-control";
		$this->bayardetail_Jumlah->EditCustomAttributes = "";
		$this->bayardetail_Jumlah->EditValue = $this->bayardetail_Jumlah->CurrentValue;
		$this->bayardetail_Jumlah->PlaceHolder = ew_RemoveHtml($this->bayardetail_Jumlah->FldCaption());
		if (strval($this->bayardetail_Jumlah->EditValue) <> "" && is_numeric($this->bayardetail_Jumlah->EditValue)) $this->bayardetail_Jumlah->EditValue = ew_FormatNumber($this->bayardetail_Jumlah->EditValue, -2, -2, -2, -2);

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	function AggregateListRowValues() {
	}

	// Aggregate list row (for rendering)
	function AggregateListRow() {

		// Call Row Rendered event
		$this->Row_Rendered();
	}
	var $ExportDoc;

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	function ExportDocument(&$Doc, &$Recordset, $StartRec, $StopRec, $ExportPageType = "") {
		if (!$Recordset || !$Doc)
			return;
		if (!$Doc->ExportCustom) {

			// Write header
			$Doc->ExportTableHeader();
			if ($Doc->Horizontal) { // Horizontal format, write header
				$Doc->BeginExportRow();
				if ($ExportPageType == "view") {
					if ($this->tahunajaran_id->Exportable) $Doc->ExportCaption($this->tahunajaran_id);
					if ($this->siswa_id->Exportable) $Doc->ExportCaption($this->siswa_id);
					if ($this->siswaspp_id->Exportable) $Doc->ExportCaption($this->siswaspp_id);
					if ($this->spp_id->Exportable) $Doc->ExportCaption($this->spp_id);
					if ($this->periode_id->Exportable) $Doc->ExportCaption($this->periode_id);
					if ($this->Bulan->Exportable) $Doc->ExportCaption($this->Bulan);
					if ($this->Periode->Exportable) $Doc->ExportCaption($this->Periode);
					if ($this->Tanggal->Exportable) $Doc->ExportCaption($this->Tanggal);
					if ($this->bayardetail_Jumlah->Exportable) $Doc->ExportCaption($this->bayardetail_Jumlah);
				} else {
					if ($this->tahunajaran_id->Exportable) $Doc->ExportCaption($this->tahunajaran_id);
					if ($this->siswa_id->Exportable) $Doc->ExportCaption($this->siswa_id);
					if ($this->siswaspp_id->Exportable) $Doc->ExportCaption($this->siswaspp_id);
					if ($this->spp_id->Exportable) $Doc->ExportCaption($this->spp_id);
					if ($this->periode_id->Exportable) $Doc->ExportCaption($this->periode_id);
					if ($this->Bulan->Exportable) $Doc->ExportCaption($this->Bulan);
					if ($this->Periode->Exportable) $Doc->ExportCaption($this->Periode);
					if ($this->Tanggal->Exportable) $Doc->ExportCaption($this->Tanggal);
					if ($this->bayardetail_Jumlah->Exportable) $Doc->ExportCaption($this->bayardetail_Jumlah);
				}
				$Doc->EndExportRow();
			}
		}

		// Move to first record
		$RecCnt = $StartRec - 1;
		if (!$Recordset->EOF) {
			$Recordset->MoveFirst();
			if ($StartRec > 1)
				$Recordset->Move($StartRec - 1);
		}
		while (!$Recordset->EOF && $RecCnt < $StopRec) {
			$RecCnt++;
			if (intval($RecCnt) >= intval($StartRec)) {
				$RowCnt = intval($RecCnt) - intval($StartRec) + 1;

				// Page break
				if ($this->ExportPageBreakCount > 0) {
					if ($RowCnt > 1 && ($RowCnt - 1) % $this->ExportPageBreakCount == 0)
						$Doc->ExportPageBreak();
				}
				$this->LoadListRowValues($Recordset);

				// Render row
				$this->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->ResetAttrs();
				$this->RenderListRow();
				if (!$Doc->ExportCustom) {
					$Doc->BeginExportRow($RowCnt); // Allow CSS styles if enabled
					if ($ExportPageType == "view") {
						if ($this->tahunajaran_id->Exportable) $Doc->ExportField($this->tahunajaran_id);
						if ($this->siswa_id->Exportable) $Doc->ExportField($this->siswa_id);
						if ($this->siswaspp_id->Exportable) $Doc->ExportField($this->siswaspp_id);
						if ($this->spp_id->Exportable) $Doc->ExportField($this->spp_id);
						if ($this->periode_id->Exportable) $Doc->ExportField($this->periode_id);
						if ($this->Bulan->Exportable) $Doc->ExportField($this->Bulan);
						if ($this->Periode->Exportable) $Doc->ExportField($this->Periode);
						if ($this->Tanggal->Exportable) $Doc->ExportField($this->Tanggal);
						if ($this->bayardetail_Jumlah->Exportable) $Doc->ExportField($this->bayardetail_Jumlah);
					} else {
						if ($this->tahunajaran_id->Exportable) $Doc->ExportField($this->tahunajaran_id);
						if ($this->siswa_id->Exportable) $Doc->ExportField($this->siswa_id);
						if ($this->siswaspp_id->Exportable) $Doc->ExportField($this->siswaspp_id);
						if ($this->spp_id->Exportable) $Doc->ExportField($this->spp_id);
						if ($this->periode_id->Exportable) $Doc->ExportField($this->periode_id);
						if ($this->Bulan->Exportable) $Doc->ExportField($this->Bulan);
						if ($this->Periode->Exportable) $Doc->ExportField($this->Periode);
						if ($this->Tanggal->Exportable) $Doc->ExportField($this->Tanggal);
						if ($this->bayardetail_Jumlah->Exportable) $Doc->ExportField($this->bayardetail_Jumlah);
					}
					$Doc->EndExportRow();
				}
			}

			// Call Row Export server event
			if ($Doc->ExportCustom)
				$this->Row_Export($Recordset->fields);
			$Recordset->MoveNext();
		}
		if (!$Doc->ExportCustom) {
			$Doc->ExportTableFooter();
		}
	}

	// Get auto fill value
	function GetAutoFill($id, $val) {
		$rsarr = array();
		$rowcnt = 0;

		// Output
		if (is_array($rsarr) && $rowcnt > 0) {
			$fldcnt = count($rsarr[0]);
			for ($i = 0; $i < $rowcnt; $i++) {
				for ($j = 0; $j < $fldcnt; $j++) {
					$str = strval($rsarr[$i][$j]);
					$str = ew_ConvertToUtf8($str);
					if (isset($post["keepCRLF"])) {
						$str = str_replace(array("\r", "\n"), array("\\r", "\\n"), $str);
					} else {
						$str = str_replace(array("\r", "\n"), array(" ", " "), $str);
					}
					$rsarr[$i][$j] = $str;
				}
			}
			return ew_ArrayToJson($rsarr);
		} else {
			return FALSE;
		}
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here	
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here	
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here	
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Inserting event
	function Row_Inserting($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Grid Inserting event
	function Grid_Inserting() {

		// Enter your code here
		// To reject grid insert, set return value to FALSE

		return TRUE;
	}

	// Grid Inserted event
	function Grid_Inserted($rsnew) {

		//echo "Grid Inserted";
	}

	// Grid Updating event
	function Grid_Updating($rsold) {

		// Enter your code here
		// To reject grid update, set return value to FALSE

		return TRUE;
	}

	// Grid Updated event
	function Grid_Updated($rsold, $rsnew) {

		//echo "Grid Updated";
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending(&$Email, &$Args) {

		//var_dump($Email); var_dump($Args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		//var_dump($fld->FldName, $fld->LookupFilters, $filter); // Uncomment to view the filter
		// Enter your code here

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here	
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>); 

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>
