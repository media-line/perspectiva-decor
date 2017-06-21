<?
namespace Bitrix\Sale\Location;

use Bitrix\Main\Service\GeoIp\DataResult,
	Bitrix\Main\Service\GeoIp\Manager;

class GeoIp
{
	/**
	 * @param string $ip Ip address.
	 * @param string $lang Language identifier.
	 * @return int Location id.
	 */
	public static function getLocationId($ip = '', $lang = LANGUAGE_ID)
	{
		$fields = array();
		$geoData = self::getData($ip, $lang);

		if($geoData)
			$fields = self::getLocationFields($geoData);

		return intval($fields['ID']) > 0  ? intval($fields['ID']) : 0;
	}

	/**
	 * @param string $ip Ip address.
	 * @param string $lang Language identifier.
	 * @return string Location code.
	 */
	public static function getLocationCode($ip = '', $lang = LANGUAGE_ID)
	{
		$fields = array();
		$geoData = self::getData($ip, $lang);

		if($geoData)
			$fields = self::getLocationFields($geoData);

		return strlen($fields['CODE']) > 0 ? $fields['CODE'] : '';
	}

	/**
	 * @param string $ip Ip address.
	 * @return string Zip (postal) code.
	 */
	public static function getZipCode($ip, $lang = LANGUAGE_ID)
	{
		$data = self::getData($ip, $lang);
		return strlen($data->zipCode) > 0 ? $data->zipCode : '';
	}

	/**
	 * @param string $ip Ip address.
	 * @param string $lang Language identifier.
	 * @return DataResult.
	 */
	protected static function getData($ip, $lang)
	{
		Manager::useCookieToStoreInfo(true);
		return Manager::getData($ip, $lang, array('cityName'));
	}

	/**
	 * @param DataResult $geoIpData.
	 * @return array Location fields.
	 */
	protected static function getLocationFields(DataResult $geoIpData)
	{
		$cityName = $geoIpData->cityName;
		$result = array();

		$res = LocationTable::getList(array(
			'filter' => array(
				'=NAME.NAME_UPPER' => ToUpper($cityName),
				'=NAME.LANGUAGE_ID' => $geoIpData->lang
			),
			'select' => array('ID', 'CODE')
		));

		if($loc = $res->fetch())
			$result = $loc;

		return $result;
	}
}
