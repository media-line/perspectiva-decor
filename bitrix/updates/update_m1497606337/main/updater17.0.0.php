<?
$updater->CopyFiles("install/admin", "admin");
$updater->CopyFiles("install/components", "components");
$updater->CopyFiles("install/js", "js");
$updater->CopyFiles("install/panel", "panel");
$updater->CopyFiles("install/themes", "themes");
$updater->CopyFiles("install/css", "css");

if($updater->CanUpdateKernel())
{
	$arToDelete = array(
		"modules/main/install/js/main/core/images/template_sprite.png",
		"js/main/core/images/template_sprite.png",
		"modules/main/install/components/bitrix/main.file.input/templates/with_editor/lang/de/template.php",
		"components/bitrix/main.file.input/templates/with_editor/lang/de/template.php",
		"modules/main/install/components/bitrix/main.file.input/templates/with_editor/lang/en/template.php",
		"components/bitrix/main.file.input/templates/with_editor/lang/en/template.php",
		"modules/main/install/components/bitrix/main.file.input/templates/with_editor/lang/ru/template.php",
		"components/bitrix/main.file.input/templates/with_editor/lang/ru/template.php",
		"modules/main/install/components/bitrix/main.file.input/templates/with_editor/lang/ua/template.php",
		"components/bitrix/main.file.input/templates/with_editor/lang/ua/template.php",
		"modules/main/install/components/bitrix/main.file.input/templates/with_editor/script.js",
		"components/bitrix/main.file.input/templates/with_editor/script.js",
		"modules/main/install/components/bitrix/main.file.input/templates/with_editor/style.css",
		"components/bitrix/main.file.input/templates/with_editor/style.css",
		"modules/main/install/components/bitrix/main.file.input/templates/with_editor/template.php",
		"components/bitrix/main.file.input/templates/with_editor/template.php",
		"modules/main/install/components/bitrix/main.ui.grid/templates/.default/fonts/OpenSans-Bold.eot",
		"components/bitrix/main.ui.grid/templates/.default/fonts/OpenSans-Bold.eot",
		"modules/main/install/components/bitrix/main.ui.grid/templates/.default/fonts/OpenSans-Bold.ttf",
		"components/bitrix/main.ui.grid/templates/.default/fonts/OpenSans-Bold.ttf",
		"modules/main/install/components/bitrix/main.ui.grid/templates/.default/fonts/OpenSans-Bold.woff",
		"components/bitrix/main.ui.grid/templates/.default/fonts/OpenSans-Bold.woff",
		"modules/main/install/components/bitrix/main.ui.grid/templates/.default/fonts/OpenSans-Light.eot",
		"components/bitrix/main.ui.grid/templates/.default/fonts/OpenSans-Light.eot",
		"modules/main/install/components/bitrix/main.ui.grid/templates/.default/fonts/OpenSans-Light.ttf",
		"components/bitrix/main.ui.grid/templates/.default/fonts/OpenSans-Light.ttf",
		"modules/main/install/components/bitrix/main.ui.grid/templates/.default/fonts/OpenSans-Light.woff",
		"components/bitrix/main.ui.grid/templates/.default/fonts/OpenSans-Light.woff",
		"modules/main/install/components/bitrix/main.ui.grid/templates/.default/fonts/OpenSans-Regular.eot",
		"components/bitrix/main.ui.grid/templates/.default/fonts/OpenSans-Regular.eot",
		"modules/main/install/components/bitrix/main.ui.grid/templates/.default/fonts/OpenSans-Regular.ttf",
		"components/bitrix/main.ui.grid/templates/.default/fonts/OpenSans-Regular.ttf",
		"modules/main/install/components/bitrix/main.ui.grid/templates/.default/fonts/OpenSans-Regular.woff",
		"components/bitrix/main.ui.grid/templates/.default/fonts/OpenSans-Regular.woff",
		"modules/main/install/components/bitrix/main.ui.grid/templates/.default/fonts/OpenSans-Semibold.eot",
		"components/bitrix/main.ui.grid/templates/.default/fonts/OpenSans-Semibold.eot",
		"modules/main/install/components/bitrix/main.ui.grid/templates/.default/fonts/OpenSans-Semibold.ttf",
		"components/bitrix/main.ui.grid/templates/.default/fonts/OpenSans-Semibold.ttf",
		"modules/main/install/components/bitrix/main.ui.grid/templates/.default/fonts/OpenSans-Semibold.woff",
		"components/bitrix/main.ui.grid/templates/.default/fonts/OpenSans-Semibold.woff",
		"modules/main/install/components/bitrix/main.ui.grid/settings.php",
		"components/bitrix/main.ui.grid/settings.php",
		"modules/main/install/components/bitrix/main.ui.grid/templates/.default/_grid_prolog.php",
		"components/bitrix/main.ui.grid/templates/.default/_grid_prolog.php",
		"modules/main/install/components/bitrix/main.ui.grid/templates/.default/_grid_settings.php",
		"components/bitrix/main.ui.grid/templates/.default/_grid_settings.php",
		"modules/main/install/components/bitrix/main.ui.grid/templates/.default/js/oldgrid.js",
		"components/bitrix/main.ui.grid/templates/.default/js/oldgrid.js",
		"modules/main/install/components/bitrix/main.ui.grid/templates/.default/js/submenu.js",
		"components/bitrix/main.ui.grid/templates/.default/js/submenu.js",
		"modules/main/install/components/bitrix/main.ui.grid/templates/.default/lang/style.css",
		"components/bitrix/main.ui.grid/templates/.default/lang/style.css",
		"modules/main/install/components/bitrix/main.ui.filter/templates/.default/fonts/OpenSans-Bold.eot",
		"components/bitrix/main.ui.filter/templates/.default/fonts/OpenSans-Bold.eot",
		"modules/main/install/components/bitrix/main.ui.filter/templates/.default/fonts/OpenSans-Bold.ttf",
		"components/bitrix/main.ui.filter/templates/.default/fonts/OpenSans-Bold.ttf",
		"modules/main/install/components/bitrix/main.ui.filter/templates/.default/fonts/OpenSans-Bold.woff",
		"components/bitrix/main.ui.filter/templates/.default/fonts/OpenSans-Bold.woff",
		"modules/main/install/components/bitrix/main.ui.filter/templates/.default/fonts/OpenSans-Light.eot",
		"components/bitrix/main.ui.filter/templates/.default/fonts/OpenSans-Light.eot",
		"modules/main/install/components/bitrix/main.ui.filter/templates/.default/fonts/OpenSans-Light.ttf",
		"components/bitrix/main.ui.filter/templates/.default/fonts/OpenSans-Light.ttf",
		"modules/main/install/components/bitrix/main.ui.filter/templates/.default/fonts/OpenSans-Light.woff",
		"components/bitrix/main.ui.filter/templates/.default/fonts/OpenSans-Light.woff",
		"modules/main/install/components/bitrix/main.ui.filter/templates/.default/fonts/OpenSans-Regular.eot",
		"components/bitrix/main.ui.filter/templates/.default/fonts/OpenSans-Regular.eot",
		"modules/main/install/components/bitrix/main.ui.filter/templates/.default/fonts/OpenSans-Regular.ttf",
		"components/bitrix/main.ui.filter/templates/.default/fonts/OpenSans-Regular.ttf",
		"modules/main/install/components/bitrix/main.ui.filter/templates/.default/fonts/OpenSans-Regular.woff",
		"components/bitrix/main.ui.filter/templates/.default/fonts/OpenSans-Regular.woff",
		"modules/main/install/components/bitrix/main.ui.filter/templates/.default/fonts/OpenSans-Semibold.eot",
		"components/bitrix/main.ui.filter/templates/.default/fonts/OpenSans-Semibold.eot",
		"modules/main/install/components/bitrix/main.ui.filter/templates/.default/fonts/OpenSans-Semibold.ttf",
		"components/bitrix/main.ui.filter/templates/.default/fonts/OpenSans-Semibold.ttf",
		"modules/main/install/components/bitrix/main.ui.filter/templates/.default/fonts/OpenSans-Semibold.woff",
		"components/bitrix/main.ui.filter/templates/.default/fonts/OpenSans-Semibold.woff",
		"modules/main/install/components/bitrix/main.ui.grid/templates/.default/component_epilog.php",
		"components/bitrix/main.ui.grid/templates/.default/component_epilog.php",
		"modules/main/lib/ui/filter/quartertype.php",
		"modules/main/install/components/bitrix/main.interface.grid/settings.ajax.php",
		"components/bitrix/main.interface.grid/settings.ajax.php",
		"modules/main/install/components/bitrix/main.pagenavigation/templates/grid/style.css",
		"components/bitrix/main.pagenavigation/templates/grid/style.css",
		"modules/main/install/components/bitrix/system.pagenavigation/templates/grid/style.css",
		"components/bitrix/system.pagenavigation/templates/grid/style.css",
		"modules/main/lib/security/authentication.php",
		"modules/main/lib/security/currentuser.php",
	);
	foreach($arToDelete as $file)
		CUpdateSystem::DeleteDirFilesEx($_SERVER["DOCUMENT_ROOT"].$updater->kernelPath."/".$file);
}

if ($updater->CanUpdateDatabase())
{
	if (!function_exists("convertFilterDateTypes"))
	{
		function convertMainUiFilterDateType($field)
		{
			switch ($field)
			{
				case "yesterday":
					$field = "YESTERDAY";
					break;
				case "today":
					$field = "CURRENT_DAY";
					break;
				case "week":
					$field = "CURRENT_WEEK";
					break;
				case "week_ago":
					$field = "LAST_WEEK";
					break;
				case "month":
					$field = "CURRENT_MONTH";
					break;
				case "month_ago":
					$field = "LAST_MONTH";
					break;
				case "exact":
					$field = "EXACT";
					break;
				case "interval":
					$field = "RANGE";
					break;
				default:
					$field = "NONE";
					break;
			}

			return $field;
		}
	}

	if (!function_exists("isGridFilterUserPreset"))
	{
		function isGridFilterUserPreset($presetId = "")
		{
			$result = false;

			if (!empty($presetId) && is_string($presetId))
			{
				$fragments = explode("_", $presetId);
				$result = (
					count($fragments) == 2 &&
					$fragments[0] == "filter" &&
					is_numeric($fragments[1])
				);
			}

			return $result;
		}
	}

	if (!function_exists("convertGridFilterFilters"))
	{
		function convertGridFilterFilters($filters)
		{
			$resultFilters = array();

			if (!empty($filters) && is_array($filters))
			{
				foreach ($filters as $key => $filter)
				{
					if (isGridFilterUserPreset($key))
					{
						$resultFilters[$key] = $filter;

						if (isset($filter["fields"]) && is_array($filter["fields"]))
						{
							foreach ($filter["fields"] as $fieldKey => $fieldValue)
							{
								if (stripos($fieldKey, "_datesel") !== false)
								{
									$resultFilters[$key]["fields"][$fieldKey] = convertMainUiFilterDateType($fieldValue);
								}
							}
						}
					}
				}
			}

			return $resultFilters;
		}
	}

	if ($updater->TableExists("b_user_option"))
	{
		$gridOptionsRes = $updater->query("SELECT * FROM `b_user_option` WHERE `CATEGORY` = 'main.interface.grid'");

		while ($gridOption = $gridOptionsRes->fetch())
		{
			$gridOptionValue = unserialize($gridOption["VALUE"]);

			if (!empty($gridOptionValue) && is_array($gridOptionValue) &&
				isset($gridOptionValue["filters"]) && !empty($gridOptionValue["filters"]))
			{
				$gridOptionValue["filters"] = convertGridFilterFilters($gridOptionValue["filters"]);

				$filterOption = $updater->query(
					"SELECT * FROM `b_user_option` WHERE 
					`CATEGORY` = 'main.ui.filter' AND 
					`USER_ID` = '".$DB->ForSql($gridOption["USER_ID"])."' AND 
					`NAME` = '".$DB->ForSql($gridOption["NAME"])."' AND
					`COMMON` = '".$DB->ForSql($gridOption["COMMON"])."'"
				);

				if ($filterOption = $filterOption->fetch())
				{
					$filterOptionValue = unserialize($filterOption["VALUE"]);

					if (isset($filterOptionValue["filters"]) && is_array($filterOptionValue["filters"]))
					{
						$filterOptionValue["deleted_presets"] = is_array($filterOptionValue["deleted_presets"]) ? $filterOptionValue["deleted_presets"] : array();

						foreach ($gridOptionValue["filters"] as $gridFilterKey => $gridFilter)
						{
							if (!array_key_exists($gridFilterKey, $filterOptionValue["deleted_presets"]))
							{
								$filterOptionValue["filters"][$gridFilterKey] = $gridFilter;
							}
						}
					}
					else
					{
						$filterOptionValue["filters"] = $gridOptionValue["filters"];
					}

					$filterOptionValue["update_default_presets"] = true;

					$updater->query(
						"UPDATE `b_user_option` SET 
						`VALUE` = '".$DB->ForSql(serialize($filterOptionValue))."' WHERE 
						`ID` = '".$DB->ForSql($filterOption["ID"])."'"
					);
				}
				else
				{
					$filterOption = array();
					$filterOption["filters"] = $gridOptionValue["filters"];
					$filterOption["update_default_presets"] = true;

					$updater->query(
						"INSERT INTO `b_user_option` 
						(`ID`, `USER_ID`, `CATEGORY`, `NAME`, `VALUE`, `COMMON`) VALUES 
						(NULL, '".$DB->ForSql($gridOption["USER_ID"])."', 'main.ui.filter', '".$DB->ForSql($gridOption["NAME"])."', '".$DB->ForSql(serialize($filterOption))."', '".$DB->ForSql($gridOption["COMMON"])."')"
					);
				}
			}
		}
	}
}
?>
