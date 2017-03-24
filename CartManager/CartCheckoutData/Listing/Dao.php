<?php
/**
 * Pimcore
 *
 * This source file is available under two different licenses:
 * - GNU General Public License version 3 (GPLv3)
 * - Pimcore Enterprise License (PEL)
 * Full copyright and license information is available in
 * LICENSE.md which is distributed with this source code.
 *
 * @copyright  Copyright (c) Pimcore GmbH (http://www.pimcore.org)
 * @license    http://www.pimcore.org/license     GPLv3 and PEL
 */


namespace Pimcore\Bundle\PimcoreEcommerceFrameworkBundle\CartManager\CartCheckoutData\Listing;

class Dao extends \Pimcore\Model\Listing\Dao\AbstractDao {

    /**
     * @return array
     */
    public function load() {
        $items = array();

        $cartCheckoutDataItems = $this->db->fetchAll("SELECT cartid, `key` FROM " . \Pimcore\Bundle\PimcoreEcommerceFrameworkBundle\CartManager\CartCheckoutData\Dao::TABLE_NAME .
                                                 $this->getCondition() . $this->getOrder() . $this->getOffsetLimit());

        foreach ($cartCheckoutDataItems as $item) {
            $items[] = \Pimcore\Bundle\PimcoreEcommerceFrameworkBundle\CartManager\CartCheckoutData::getByKeyCartId($item['key'], $item['cartid']);
        }
        $this->model->setCartCheckoutDataItems($items);

        return $items;
    }

    public function getTotalCount() {
        $amount = $this->db->fetchRow("SELECT COUNT(*) as amount FROM `" . \Pimcore\Bundle\PimcoreEcommerceFrameworkBundle\CartManager\CartCheckoutData\Dao::TABLE_NAME . "`" . $this->getCondition());
        return $amount["amount"];
    }

}