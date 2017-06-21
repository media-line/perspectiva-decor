<?
if(IsModuleInstalled('sale'))
{
	$updater->CopyFiles("install/admin", "admin");
	$updater->CopyFiles("install/components", "components");
	$updater->CopyFiles("install/images", "images/sale");
	$updater->CopyFiles("install/js", "js");
	$updater->CopyFiles("install/themes", "themes");
	$updater->CopyFiles("install/panel", "panel");
}
if ($updater->CanUpdateDatabase() && $updater->TableExists('B_SALE_AUXILIARY'))
{
	$languages = \Bitrix\Main\Localization\LanguageTable::getList(array(
		'select' => array('ID', 'DEF'),
		'filter' => array('=ACTIVE' => 'Y'),
	));
	$defaultLang = null;
	$messages = array();
	while($row = $languages->fetch())
	{
		if($row['DEF'] == 'Y')
		{
			$defaultLang = $row['ID'];
		}
		$languageId = $row['ID'];
		\Bitrix\Main\Localization\Loc::loadLanguageFile(__FILE__, $languageId);
		$messages[$languageId] = \Bitrix\Main\Localization\Loc::getMessage('SALE_UPDATER_16036_MIGRATE_NOTIFY', array(
			"#LINK#" => "/bitrix/admin/sale_discount_catalog_migrator.php?lang={$languageId}",
		));
	}

	if($messages[$defaultLang] && \Bitrix\Main\Config\Option::get('sale', 'use_sale_discount_only', false) !== 'Y' && IsModuleInstalled('sale'))
	{
		\CAdminNotify::add(array(
			"MESSAGE" => $messages[$defaultLang],
			"TAG" => "sale_discount_catalog_migrator",
			"MODULE_ID" => "sale",
			"ENABLE_CLOSE" => "N",
		));
	}

	if ($DB->type == "MSSQL")
	{
		if ($updater->TableExists("B_SALE_DISCOUNT"))
		{
			if (!$DB->Query("SELECT PREDICTION_TEXT FROM b_sale_discount WHERE 1=0", true))
			{
				$DB->Query("ALTER TABLE B_SALE_DISCOUNT ADD PREDICTION_TEXT text NULL");
			}
			if (!$DB->Query("SELECT PREDICTIONS FROM b_sale_discount WHERE 1=0", true))
			{
				$DB->Query("ALTER TABLE B_SALE_DISCOUNT ADD PREDICTIONS text NULL");
			}
			if (!$DB->Query("SELECT PREDICTIONS_APP FROM b_sale_discount WHERE 1=0", true))
			{
				$DB->Query("ALTER TABLE B_SALE_DISCOUNT ADD PREDICTIONS_APP text null");
			}
			if (!$DB->Query("SELECT HAS_INDEX FROM b_sale_discount WHERE 1=0", true))
			{
				$DB->Query("ALTER TABLE B_SALE_DISCOUNT ADD HAS_INDEX char(1)");
			}
			if (!$DB->Query("SELECT PRESET_ID FROM b_sale_discount WHERE 1=0", true))
			{
				$DB->Query("ALTER TABLE B_SALE_DISCOUNT ADD PRESET_ID varchar(255) NULL");
			}
			if (!$DB->Query("SELECT SHORT_DESCRIPTION FROM b_sale_discount WHERE 1=0", true))
			{
				$DB->Query("ALTER TABLE B_SALE_DISCOUNT ADD SHORT_DESCRIPTION text NULL");
			}
			$DB->Query("ALTER TABLE B_SALE_DISCOUNT ADD CONSTRAINT DF_B_SALE_DISCOUNT_HAS_INDEX DEFAULT 'N' FOR HAS_INDEX", true);
		}
		if ($updater->TableExists("B_SALE_DISCOUNT_COUPON"))
		{
			if (!$DB->IndexExists("B_SALE_DISCOUNT_COUPON", array("COUPON", )))
			{
				$DB->Query("CREATE INDEX IX_S_D_COUPON ON B_SALE_DISCOUNT_COUPON(COUPON)");
			}
		}
		if (!$updater->TableExists("B_SALE_D_IX_ELEMENT"))
		{
			$DB->Query("
				CREATE TABLE B_SALE_D_IX_ELEMENT(
					ID int NOT NULL IDENTITY (1, 1),
					DISCOUNT_ID int NOT NULL,
					ELEMENT_ID int NOT NULL
				)
			");
			$DB->Query("
				ALTER TABLE B_SALE_D_IX_ELEMENT ADD CONSTRAINT PK_B_SALE_D_IX_ELEMENT PRIMARY KEY (ID)
			");
		}
		if ($updater->TableExists("B_SALE_D_IX_ELEMENT"))
		{
			if (!$DB->IndexExists("B_SALE_D_IX_ELEMENT", array("ELEMENT_ID", "DISCOUNT_ID", )))
			{
				$DB->Query("CREATE INDEX IX_S_DIXE_O_1 ON B_SALE_D_IX_ELEMENT(ELEMENT_ID, DISCOUNT_ID)");
			}
		}
		if (!$updater->TableExists("B_SALE_D_IX_SECTION"))
		{
			$DB->Query("
				CREATE TABLE B_SALE_D_IX_SECTION(
					ID int NOT NULL IDENTITY (1, 1),
					DISCOUNT_ID int NOT NULL,
					SECTION_ID int NOT NULL
				)
			");
			$DB->Query("
				ALTER TABLE B_SALE_D_IX_SECTION ADD CONSTRAINT PK_B_SALE_D_IX_SECTION PRIMARY KEY (ID)
			");
		}
		if ($updater->TableExists("B_SALE_D_IX_SECTION"))
		{
			if (!$DB->IndexExists("B_SALE_D_IX_SECTION", array("SECTION_ID", "DISCOUNT_ID", )))
			{
				$DB->Query("CREATE INDEX IX_S_DIXS_O_1 ON B_SALE_D_IX_SECTION(SECTION_ID, DISCOUNT_ID)");
			}
		}
	}
}

if ($updater->CanUpdateDatabase() && $updater->TableExists('b_sale_auxiliary'))
{
	if ($DB->type == "MYSQL")
	{
		if ($updater->TableExists("b_sale_discount"))
		{
			if (!$DB->Query("SELECT PREDICTION_TEXT FROM b_sale_discount WHERE 1=0", true))
			{
				$DB->Query("ALTER TABLE b_sale_discount ADD PREDICTION_TEXT text null");
			}
			if (!$DB->Query("SELECT PREDICTIONS FROM b_sale_discount WHERE 1=0", true))
			{
				$DB->Query("ALTER TABLE b_sale_discount ADD PREDICTIONS mediumtext null");
			}
			if (!$DB->Query("SELECT PREDICTIONS_APP FROM b_sale_discount WHERE 1=0", true))
			{
				$DB->Query("ALTER TABLE b_sale_discount ADD PREDICTIONS_APP mediumtext null");
			}
			if (!$DB->Query("SELECT HAS_INDEX FROM b_sale_discount WHERE 1=0", true))
			{
				$DB->Query("ALTER TABLE b_sale_discount ADD HAS_INDEX char(1) default 'N'");
			}
			if (!$DB->Query("SELECT PRESET_ID FROM b_sale_discount WHERE 1=0", true))
			{
				$DB->Query("ALTER TABLE b_sale_discount ADD PRESET_ID varchar(255) null");
			}
			if (!$DB->Query("SELECT SHORT_DESCRIPTION FROM b_sale_discount WHERE 1=0", true))
			{
				$DB->Query("ALTER TABLE b_sale_discount ADD SHORT_DESCRIPTION text null");
			}
		}
		if ($updater->TableExists("b_sale_discount_coupon"))
		{
			if (!$DB->IndexExists("b_sale_discount_coupon", array("COUPON", )))
			{
				$DB->Query("CREATE INDEX IX_S_D_COUPON ON b_sale_discount_coupon(COUPON)");
			}
		}
		if (!$updater->TableExists("b_sale_d_ix_element"))
		{
			$DB->Query("
				CREATE TABLE b_sale_d_ix_element(
					ID int not null auto_increment,
					DISCOUNT_ID int not null,
					ELEMENT_ID int not null,
					primary key (ID)
				)
			");
		}
		if ($updater->TableExists("b_sale_d_ix_element"))
		{
			if (!$DB->IndexExists("b_sale_d_ix_element", array("ELEMENT_ID", "DISCOUNT_ID", )))
			{
				$DB->Query("CREATE INDEX IX_S_DIXE_O_1 ON b_sale_d_ix_element(ELEMENT_ID, DISCOUNT_ID)");
			}
		}
		if (!$updater->TableExists("b_sale_d_ix_section"))
		{
			$DB->Query("
				CREATE TABLE b_sale_d_ix_section(
					ID int not null auto_increment,
					DISCOUNT_ID int not null,
					SECTION_ID int not null,
					primary key (ID)
				)
			");
		}
		if ($updater->TableExists("b_sale_d_ix_section"))
		{
			if (!$DB->IndexExists("b_sale_d_ix_section", array("SECTION_ID", "DISCOUNT_ID", )))
			{
				$DB->Query("CREATE INDEX IX_S_DIXS_O_1 ON b_sale_d_ix_section(SECTION_ID, DISCOUNT_ID)");
			}
		}
	}
}

if ($updater->CanUpdateDatabase() && $updater->TableExists('B_SALE_AUXILIARY'))
{
	if ($DB->type == "ORACLE")
	{
		$DB->Query("CREATE SEQUENCE SQ_SALE_D_IX_ELEMENT INCREMENT BY 1 NOMAXVALUE NOCYCLE NOCACHE NOORDER", true);
		$DB->Query("CREATE SEQUENCE SQ_SALE_D_IX_SECTION INCREMENT BY 1 NOMAXVALUE NOCYCLE NOCACHE NOORDER", true);
		if ($updater->TableExists("B_SALE_DISCOUNT"))
		{
			if (!$DB->Query("SELECT PREDICTION_TEXT FROM b_sale_discount WHERE 1=0", true))
			{
				$DB->Query("ALTER TABLE B_SALE_DISCOUNT ADD (PREDICTION_TEXT CLOB null)");
			}
			if (!$DB->Query("SELECT PREDICTIONS FROM b_sale_discount WHERE 1=0", true))
			{
				$DB->Query("ALTER TABLE B_SALE_DISCOUNT ADD (PREDICTIONS CLOB null)");
			}
			if (!$DB->Query("SELECT PREDICTIONS_APP FROM b_sale_discount WHERE 1=0", true))
			{
				$DB->Query("ALTER TABLE B_SALE_DISCOUNT ADD (PREDICTIONS_APP CLOB null)");
			}
			if (!$DB->Query("SELECT HAS_INDEX FROM b_sale_discount WHERE 1=0", true))
			{
				$DB->Query("ALTER TABLE B_SALE_DISCOUNT ADD (HAS_INDEX CHAR(1 CHAR) DEFAULT 'N' NOT NULL)");
			}
			if (!$DB->Query("SELECT PRESET_ID FROM b_sale_discount WHERE 1=0", true))
			{
				$DB->Query("ALTER TABLE B_SALE_DISCOUNT ADD (PRESET_ID VARCHAR2(255 CHAR) NULL)");
			}
			if (!$DB->Query("SELECT SHORT_DESCRIPTION FROM b_sale_discount WHERE 1=0", true))
			{
				$DB->Query("ALTER TABLE B_SALE_DISCOUNT ADD (SHORT_DESCRIPTION CLOB null)");
			}
		}
		if ($updater->TableExists("B_SALE_DISCOUNT_COUPON"))
		{
			if (!$DB->IndexExists("B_SALE_DISCOUNT_COUPON", array("COUPON", )))
			{
				$DB->Query("CREATE INDEX IX_S_D_COUPON ON B_SALE_DISCOUNT_COUPON(COUPON)");
			}
		}
		if (!$updater->TableExists("B_SALE_D_IX_ELEMENT"))
		{
			$DB->Query("
				CREATE TABLE B_SALE_D_IX_ELEMENT(
					ID NUMBER(18) NOT NULL,
					DISCOUNT_ID NUMBER(18) NOT NULL,
					ELEMENT_ID NUMBER(18) NOT NULL,
					PRIMARY KEY (ID)
				)
			");
		}
		if ($updater->TableExists("B_SALE_D_IX_ELEMENT"))
		{
			if (!$DB->IndexExists("B_SALE_D_IX_ELEMENT", array("ELEMENT_ID", "DISCOUNT_ID", )))
			{
				$DB->Query("CREATE INDEX IX_S_DIXE_O_1 ON B_SALE_D_IX_ELEMENT(ELEMENT_ID, DISCOUNT_ID)");
			}
			$DB->Query("CREATE OR REPLACE TRIGGER B_SALE_D_IX_ELEMENT_INSERT
BEFORE INSERT
ON B_SALE_D_IX_ELEMENT
FOR EACH ROW
BEGIN
	IF :NEW.ID IS NULL THEN
		SELECT SQ_SALE_D_IX_ELEMENT.NEXTVAL INTO :NEW.ID FROM dual;
	END IF;
END;", true);
		}
		if (!$updater->TableExists("B_SALE_D_IX_SECTION"))
		{
			$DB->Query("
				CREATE TABLE B_SALE_D_IX_SECTION(
					ID NUMBER(18) NOT NULL,
					DISCOUNT_ID NUMBER(18) NOT NULL,
					SECTION_ID NUMBER(18) NOT NULL,
					PRIMARY KEY (ID)
				)
			");
		}
		if ($updater->TableExists("B_SALE_D_IX_SECTION"))
		{
			if (!$DB->IndexExists("B_SALE_D_IX_SECTION", array("SECTION_ID", "DISCOUNT_ID", )))
			{
				$DB->Query("CREATE INDEX IX_S_DIXS_O_1 ON B_SALE_D_IX_SECTION(SECTION_ID, DISCOUNT_ID)");
			}
			$DB->Query("CREATE OR REPLACE TRIGGER B_SALE_D_IX_SECTION_INSERT
BEFORE INSERT
ON B_SALE_D_IX_SECTION
FOR EACH ROW
BEGIN
	IF :NEW.ID IS NULL THEN
		SELECT SQ_SALE_D_IX_SECTION.NEXTVAL INTO :NEW.ID FROM dual;
	END IF;
END;", true);
		}
	}
}

if ($updater->CanUpdateDatabase() && $updater->TableExists('B_SALE_AUXILIARY'))
{
	if ($DB->type == "MSSQL")
	{
		if ($updater->TableExists("B_SALE_DISCOUNT"))
		{
			if (!$DB->Query("SELECT LAST_LEVEL_DISCOUNT FROM b_sale_discount WHERE 1=0", true))
			{
				$DB->Query("ALTER TABLE B_SALE_DISCOUNT ADD LAST_LEVEL_DISCOUNT char(1)");
			}
			$DB->Query("ALTER TABLE B_SALE_DISCOUNT ADD CONSTRAINT DF_B_SALE_DISCOUNT_LAST_LEVEL_DISCOUNT DEFAULT 'N' FOR LAST_LEVEL_DISCOUNT", true);
		}
	}
}

if ($updater->CanUpdateDatabase() && $updater->TableExists('b_sale_auxiliary'))
{
	if ($DB->type == "MYSQL")
	{
		if ($updater->TableExists("b_sale_discount"))
		{
			if (!$DB->Query("SELECT LAST_LEVEL_DISCOUNT FROM b_sale_discount WHERE 1=0", true))
			{
				$DB->Query("ALTER TABLE b_sale_discount ADD LAST_LEVEL_DISCOUNT char(1) default 'N'");
			}
		}
	}
}

if ($updater->CanUpdateDatabase() && $updater->TableExists('B_SALE_AUXILIARY'))
{
	if ($DB->type == "ORACLE")
	{
		if ($updater->TableExists("B_SALE_DISCOUNT"))
		{
			if (!$DB->Query("SELECT LAST_LEVEL_DISCOUNT FROM b_sale_discount WHERE 1=0", true))
			{
				$DB->Query("ALTER TABLE B_SALE_DISCOUNT ADD (LAST_LEVEL_DISCOUNT CHAR(1 CHAR) DEFAULT 'N')");
			}
		}
	}
}

?>
