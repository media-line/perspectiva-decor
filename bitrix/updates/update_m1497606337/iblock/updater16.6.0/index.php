<?php
if (\Bitrix\Main\ModuleManager::isModuleInstalled('iblock'))
{
	$updater->CopyFiles("install/components", "components");
}
if($updater->CanUpdateKernel())
{
	$arToDelete = array(
		"modules/iblock/install/components/bitrix/iblock.element.add.form/lang/de/help/.tooltips.php",
		"components/bitrix/iblock.element.add.form/lang/de/help/.tooltips.php",
		"modules/iblock/install/components/bitrix/iblock.element.add.form/lang/en/help/.tooltips.php",
		"components/bitrix/iblock.element.add.form/lang/en/help/.tooltips.php",
		"modules/iblock/install/components/bitrix/iblock.element.add.form/lang/ru/help/.tooltips.php",
		"components/bitrix/iblock.element.add.form/lang/ru/help/.tooltips.php",
		"modules/iblock/install/components/bitrix/iblock.element.add.form/lang/ua/help/.tooltips.php",
		"components/bitrix/iblock.element.add.form/lang/ua/help/.tooltips.php",
	);
	foreach($arToDelete as $file)
		CUpdateSystem::DeleteDirFilesEx($_SERVER["DOCUMENT_ROOT"].$updater->kernelPath."/".$file);
}