<!-- Begin Main Menu -->
<?php $RootMenu = new cMenu(EW_MENUBAR_ID) ?>
<?php

// Generate all menu items
$RootMenu->IsRoot = TRUE;
$RootMenu->AddMenuItem(13, "mci_Menu_Utama", $Language->MenuPhrase("13", "MenuText"), "", -1, "", TRUE, TRUE, TRUE);
$RootMenu->AddMenuItem(6, "mi_cf01_home_php", $Language->MenuPhrase("6", "MenuText"), "cf01_home.php", 13, "", AllowListMenu('{699E0CB8-ECC6-4DDA-93F3-012C887E6B12}cf01_home.php'), FALSE, TRUE);
$RootMenu->AddMenuItem(31, "mi_v01_siswarutin", $Language->MenuPhrase("31", "MenuText"), "v01_siswarutinlist.php", 13, "", AllowListMenu('{699E0CB8-ECC6-4DDA-93F3-012C887E6B12}v01_siswarutin'), FALSE, FALSE);
$RootMenu->AddMenuItem(12, "mci_Setup", $Language->MenuPhrase("12", "MenuText"), "", -1, "", IsLoggedIn(), TRUE, TRUE);
$RootMenu->AddMenuItem(16, "mi_t04_siswa", $Language->MenuPhrase("16", "MenuText"), "t04_siswalist.php", 12, "", AllowListMenu('{699E0CB8-ECC6-4DDA-93F3-012C887E6B12}t04_siswa'), FALSE, FALSE);
$RootMenu->AddMenuItem(49, "mci_Sekolah", $Language->MenuPhrase("49", "MenuText"), "", 12, "", IsLoggedIn(), TRUE, TRUE);
$RootMenu->AddMenuItem(1, "mi_t01_tahunajaran", $Language->MenuPhrase("1", "MenuText"), "t01_tahunajaranlist.php", 49, "", AllowListMenu('{699E0CB8-ECC6-4DDA-93F3-012C887E6B12}t01_tahunajaran'), FALSE, FALSE);
$RootMenu->AddMenuItem(14, "mi_t02_sekolah", $Language->MenuPhrase("14", "MenuText"), "t02_sekolahlist.php", 49, "", AllowListMenu('{699E0CB8-ECC6-4DDA-93F3-012C887E6B12}t02_sekolah'), FALSE, FALSE);
$RootMenu->AddMenuItem(15, "mi_t03_kelas", $Language->MenuPhrase("15", "MenuText"), "t03_kelaslist.php", 49, "", AllowListMenu('{699E0CB8-ECC6-4DDA-93F3-012C887E6B12}t03_kelas'), FALSE, FALSE);
$RootMenu->AddMenuItem(25, "mi_t05_daftarsiswamaster", $Language->MenuPhrase("25", "MenuText"), "t05_daftarsiswamasterlist.php", 49, "", AllowListMenu('{699E0CB8-ECC6-4DDA-93F3-012C887E6B12}t05_daftarsiswamaster'), FALSE, FALSE);
$RootMenu->AddMenuItem(50, "mi_t07_spp", $Language->MenuPhrase("50", "MenuText"), "t07_spplist.php", 12, "", AllowListMenu('{699E0CB8-ECC6-4DDA-93F3-012C887E6B12}t07_spp'), FALSE, FALSE);
$RootMenu->AddMenuItem(24, "mci_Aplikasi", $Language->MenuPhrase("24", "MenuText"), "", 12, "", IsLoggedIn(), TRUE, TRUE);
$RootMenu->AddMenuItem(3, "mi_t97_userlevels", $Language->MenuPhrase("3", "MenuText"), "t97_userlevelslist.php", 24, "", (@$_SESSION[EW_SESSION_USER_LEVEL] & EW_ALLOW_ADMIN) == EW_ALLOW_ADMIN, FALSE, FALSE);
$RootMenu->AddMenuItem(5, "mi_t96_employees", $Language->MenuPhrase("5", "MenuText"), "t96_employeeslist.php", 24, "", AllowListMenu('{699E0CB8-ECC6-4DDA-93F3-012C887E6B12}t96_employees'), FALSE, FALSE);
$RootMenu->AddMenuItem(2, "mi_t99_audittrail", $Language->MenuPhrase("2", "MenuText"), "t99_audittraillist.php", 24, "", AllowListMenu('{699E0CB8-ECC6-4DDA-93F3-012C887E6B12}t99_audittrail'), FALSE, FALSE);
$RootMenu->AddMenuItem(-2, "mi_changepwd", $Language->Phrase("ChangePwd"), "changepwd.php", -1, "", IsLoggedIn() && !IsSysAdmin());
$RootMenu->AddMenuItem(-1, "mi_logout", $Language->Phrase("Logout"), "logout.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(-1, "mi_login", $Language->Phrase("Login"), "login.php", -1, "", !IsLoggedIn() && substr(@$_SERVER["URL"], -1 * strlen("login.php")) <> "login.php");
$RootMenu->Render();
?>
<!-- End Main Menu -->
