<?
if ($updater->CanUpdateDatabase() && $updater->TableExists('B_CATALOG_IBLOCK'))
{
	if ($DB->type == "MSSQL")
	{
		if ($updater->TableExists("B_CATALOG_DISCOUNT"))
		{
			if (!$DB->Query("SELECT SALE_ID FROM b_catalog_discount WHERE 1=0", true))
			{
				$DB->Query("ALTER TABLE B_CATALOG_DISCOUNT ADD SALE_ID int NULL");
			}
		}
	}
}

if ($updater->CanUpdateDatabase() && $updater->TableExists('b_catalog_iblock'))
{
	if ($DB->type == "MYSQL")
	{
		if ($updater->TableExists("b_catalog_discount"))
		{
			if (!$DB->Query("SELECT SALE_ID FROM b_catalog_discount WHERE 1=0", true))
			{
				$DB->Query("ALTER TABLE b_catalog_discount ADD SALE_ID int null");
			}
		}
	}
}

if ($updater->CanUpdateDatabase() && $updater->TableExists('B_CATALOG_IBLOCK'))
{
	if ($DB->type == "ORACLE")
	{
		if ($updater->TableExists("B_CATALOG_DISCOUNT"))
		{
			if (!$DB->Query("SELECT SALE_ID FROM b_catalog_discount WHERE 1=0", true))
			{
				$DB->Query("ALTER TABLE B_CATALOG_DISCOUNT ADD (SALE_ID NUMBER(18) NULL)");
			}
		}
	}
}

if (\Bitrix\Main\ModuleManager::isModuleInstalled('catalog'))
{
	$updater->CopyFiles("install/components", "components");
}
if($updater->CanUpdateKernel())
{
	$arToDelete = array(
		"modules/catalog/install/public/catalog_import/cron_frame.php",
	);
	foreach($arToDelete as $file)
		CUpdateSystem::DeleteDirFilesEx($_SERVER["DOCUMENT_ROOT"].$updater->kernelPath."/".$file);
}