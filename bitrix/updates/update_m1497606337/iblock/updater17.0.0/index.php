<?
if ($updater->CanUpdateKernel())
{
	if (!is_dir($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/components/bitrix/catalog.section/templates/old_version_16"))
	{
		rename($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/components/bitrix/catalog.section/templates/.default",
			$_SERVER["DOCUMENT_ROOT"].BX_ROOT."/components/bitrix/catalog.section/templates/old_version_16");
	}

	if (!is_dir($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/components/bitrix/catalog.top/templates/old_version_16"))
	{
		rename($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/components/bitrix/catalog.top/templates/.default",
			$_SERVER["DOCUMENT_ROOT"].BX_ROOT."/components/bitrix/catalog.top/templates/old_version_16");
	}

	if (!is_dir($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/components/bitrix/catalog.element/templates/old_version_16"))
	{
		rename($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/components/bitrix/catalog.element/templates/.default",
			$_SERVER["DOCUMENT_ROOT"].BX_ROOT."/components/bitrix/catalog.element/templates/old_version_16");
	}

	if (!is_dir($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/components/bitrix/catalog/templates/old_version_16"))
	{
		rename($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/components/bitrix/catalog/templates/.default",
			$_SERVER["DOCUMENT_ROOT"].BX_ROOT."/components/bitrix/catalog/templates/old_version_16");
	}
}

if (\Bitrix\Main\ModuleManager::isModuleInstalled('iblock'))
{
	$updater->CopyFiles("install/components", "components");
}

if ($updater->CanUpdateKernel())
{
	$arToDelete = array(
		"modules/iblock/install/components/bitrix/catalog.element/component.php",
		"components/bitrix/catalog.element/component.php",
		"modules/iblock/install/components/bitrix/catalog.element/lang/de/component.php",
		"components/bitrix/catalog.element/lang/de/component.php",
		"modules/iblock/install/components/bitrix/catalog.element/lang/en/component.php",
		"components/bitrix/catalog.element/lang/en/component.php",
		"modules/iblock/install/components/bitrix/catalog.element/lang/ru/component.php",
		"components/bitrix/catalog.element/lang/ru/component.php",
		"modules/iblock/install/components/bitrix/catalog.element/lang/ua/component.php",
		"components/bitrix/catalog.element/lang/ua/component.php",
		"modules/iblock/install/components/bitrix/catalog.section/component.php",
		"components/bitrix/catalog.section/component.php",
		"modules/iblock/install/components/bitrix/catalog.section/lang/de/component.php",
		"components/bitrix/catalog.section/lang/de/component.php",
		"modules/iblock/install/components/bitrix/catalog.section/lang/en/component.php",
		"components/bitrix/catalog.section/lang/en/component.php",
		"modules/iblock/install/components/bitrix/catalog.section/lang/ru/component.php",
		"components/bitrix/catalog.section/lang/ru/component.php",
		"modules/iblock/install/components/bitrix/catalog.section/lang/ua/component.php",
		"components/bitrix/catalog.section/lang/ua/component.php",
		"modules/iblock/install/components/bitrix/catalog.top/component.php",
		"components/bitrix/catalog.top/component.php",
		"modules/iblock/install/components/bitrix/catalog.top/lang/de/component.php",
		"components/bitrix/catalog.top/lang/de/component.php",
		"modules/iblock/install/components/bitrix/catalog.top/lang/en/component.php",
		"components/bitrix/catalog.top/lang/en/component.php",
		"modules/iblock/install/components/bitrix/catalog.top/lang/ru/component.php",
		"components/bitrix/catalog.top/lang/ru/component.php",
		"modules/iblock/install/components/bitrix/catalog.top/lang/ua/component.php",
		"components/bitrix/catalog.top/lang/ua/component.php",
	);
	foreach($arToDelete as $file)
		CUpdateSystem::DeleteDirFilesEx($_SERVER["DOCUMENT_ROOT"].$updater->kernelPath."/".$file);
}
