<?
require $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php";

use Bitrix\Main\Loader;

Loader::includeModule('sale');
Loader::includeModule('catalog');

if($_POST["ID"] && $_POST["PRICE"]) {
    $siteId = Bitrix\Main\Context::getCurrent()->getSite();
    $basket = Bitrix\Sale\Basket::loadItemsForFUser(Bitrix\Sale\Fuser::getId(), $siteId);
    
    $productId = $_POST["ID"];
    $currency = Bitrix\Currency\CurrencyManager::getBaseCurrency();
    $item = $basket->createItem('catalog', $productId);
    $item->setFields(array(
        'NAME' => $_POST["NAME"],
        'QUANTITY' => 1,
        'CURRENCY' => $currency,
        'LID' => $siteId,
        'PRICE' => $_POST["PRICE"],
        'CUSTOM_PRICE' => 'Y',
    ));
    $basket->save();
}
