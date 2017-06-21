<?php
if (\Bitrix\Main\ModuleManager::isModuleInstalled('catalog'))
{
	$updater->CopyFiles("install/components", "components");
}
if ($updater->CanUpdateDatabase())
{
	if ($updater->TableExists('b_catalog_price'))
	{
		$updater->Query(array(
			'MYSQL'  => "update b_catalog_price set TIMESTAMP_X = NOW() where TIMESTAMP_X is null",
		));
		$updater->Query(array(
			'MYSQL'  => "alter table b_catalog_price modify TIMESTAMP_X timestamp not null default NOW() on update NOW()",
		));
	}

	if ($updater->TableExists('b_catalog_product'))
	{
		$updater->Query(array(
			'MYSQL'  => "update b_catalog_product set TIMESTAMP_X = NOW() where TIMESTAMP_X is null",
		));
		$updater->Query(array(
			'MYSQL'  => "alter table b_catalog_product modify TIMESTAMP_X timestamp not null default NOW() on update NOW()",
		));
	}

	if ($updater->TableExists('b_catalog_discount'))
	{
		$updater->Query(array(
			'MYSQL'  => "update b_catalog_discount set TIMESTAMP_X = NOW() where TIMESTAMP_X is null",
		));
		$updater->Query(array(
			'MYSQL'  => "alter table b_catalog_discount modify TIMESTAMP_X timestamp not null default NOW() on update NOW()",
		));
	}

	if ($updater->TableExists('b_catalog_vat'))
	{
		$updater->Query(array(
			'MYSQL'  => "update b_catalog_vat set TIMESTAMP_X = NOW() where TIMESTAMP_X is null",
		));
		$updater->Query(array(
			'MYSQL'  => "alter table b_catalog_vat modify TIMESTAMP_X timestamp not null default NOW() on update NOW()",
		));
	}
}