<?php
if (\Bitrix\Main\ModuleManager::isModuleInstalled('iblock'))
{
	$updater->CopyFiles("install/js", "js");
	$updater->CopyFiles("install/components", "components");
}