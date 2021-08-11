<?php
/*
* 2019 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2015 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/
class egdynamictitleajaxModuleFrontController extends ModuleFrontController
{

    public function initContent()
    {
        return parent::initContent();
    }

    public function displayAjaxGetAttribute()
    {
        $result = array();
        $result['status'] = "success";
        $id_lang = (int)$this->context->language->id;
        
        try{
            $id_product    = Tools::getValue('id_product');
            $id_product_attribute   = Tools::getValue('id_product_attribute');

            $product = new Product($id_product, $id_lang);
            // dump($product);
            // die;
            $result['attribute_combination'] = $product->getAttributeCombinationsById($id_product_attribute, $id_lang);

       } catch (Exception $e) {
            $result['status'] = 'error';
            $result['attribute_combination'] = array();
            \PrestaShopLogger::addLog($this->trans('An error occured while getting attribute of product in stores :', [], 'Modules.Egdynamictitle.Ajax'). $e->getMessage(), 2);


        }
        header('Content-Type: application/json');
        die(json_encode($result));

    }
}