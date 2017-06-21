<?php
if (\Bitrix\Main\ModuleManager::isModuleInstalled('iblock'))
{
	$updater->CopyFiles("install/components", "components");
}