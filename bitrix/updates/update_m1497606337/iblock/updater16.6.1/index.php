<?php
$iblockInstalled = \Bitrix\Main\ModuleManager::isModuleInstalled('iblock');
if ($iblockInstalled)
{
	$updater->CopyFiles("install/components", "components");
	$updater->CopyFiles("install/js", "js");
}
if ($updater->CanUpdateDatabase())
{
	$currentValue = (string)\Bitrix\Main\Config\Option::get('iblock', 'custom_edit_form_use_property_id', '-');
	if ($currentValue === '-')
		\Bitrix\Main\Config\Option::set('iblock', 'custom_edit_form_use_property_id', 'N');
	unset($currentValue);
	if ($iblockInstalled)
		CBitrixComponent::clearComponentCache('bitrix:catalog.element');
}
if($updater->CanUpdateKernel())
{
	$arToDelete = array(
		"modules/iblock/install/components/bitrix/catalog/templates/.default/bitrix/iblock.vote/stars/component_epilog.php",
		"components/bitrix/catalog/templates/.default/bitrix/iblock.vote/stars/component_epilog.php",
		"modules/iblock/install/components/bitrix/iblock.vote/templates/stars/component_epilog.php",
		"components/bitrix/iblock.vote/templates/stars/component_epilog.php",
	);
	foreach($arToDelete as $file)
		CUpdateSystem::DeleteDirFilesEx($_SERVER["DOCUMENT_ROOT"].$updater->kernelPath."/".$file);
}
unset($iblockInstalled);