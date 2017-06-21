<?php
if (\Bitrix\Main\ModuleManager::isModuleInstalled('iblock'))
{
	$updater->CopyFiles("install/components", "components");
}

if ($updater->CanUpdateKernel())
{
	$arToDelete = array(
		"modules/iblock/install/components/bitrix/catalog/templates/.default/bitrix/catalog.element",
		"modules/iblock/install/components/bitrix/catalog/templates/.default/bitrix/catalog.section",
		"modules/iblock/install/components/bitrix/catalog/templates/.default/bitrix/catalog.top",
	);
	foreach($arToDelete as $file)
		CUpdateSystem::DeleteDirFilesEx($_SERVER["DOCUMENT_ROOT"].$updater->kernelPath."/".$file);
}
