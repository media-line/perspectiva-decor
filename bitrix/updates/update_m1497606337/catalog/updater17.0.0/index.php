<?php
if (\Bitrix\Main\ModuleManager::isModuleInstalled('catalog'))
{
	$updater->CopyFiles("install/components", "components");
	$updater->CopyFiles("install/js", "js");
	$updater->CopyFiles("install/panel", "panel");
}
if ($updater->CanUpdateDatabase())
{
	if ($updater->TableExists("b_catalog_measure_ratio"))
	{
		if (!$DB->Query("select IS_DEFAULT from b_catalog_measure_ratio where 1=0", true))
		{
			$updater->Query(array(
				'MYSQL' => "alter table b_catalog_measure_ratio add IS_DEFAULT CHAR(1) NOT NULL DEFAULT 'N'",
				'MSSQL' => "alter table B_CATALOG_MEASURE_RATIO add IS_DEFAULT CHAR(1) NOT NULL CONSTRAINT DF_B_CATALOG_MEASURE_RATIO_DEF DEFAULT 'N'",
				'ORACLE' => "alter table B_CATALOG_MEASURE_RATIO add IS_DEFAULT CHAR(1 CHAR) DEFAULT 'N' NOT NULL"
			));

			$updater->Query(array(
				'MYSQL' => "update b_catalog_measure_ratio set IS_DEFAULT = 'Y' where 1 = 1",
				'MSSQL' => "update B_CATALOG_MEASURE_RATIO set IS_DEFAULT = 'Y' where 1 = 1",
				'ORACLE' => "update B_CATALOG_MEASURE_RATIO set IS_DEFAULT = 'Y' where 1 = 1"
			));
		}
	}
}