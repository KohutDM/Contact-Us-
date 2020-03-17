<?php

/**
 * Smile appeal.
 *
 * @author    Dmytro Kohut <dmkoh@smile.fr>
 * @copyright 2020 Smile
 */

declare(strict_types=1);

namespace Smile\Contact\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class Appeal
 *
 * @package Smile\Contact\Model\ResourceModel
 */
class Appeal extends AbstractDb
{
    /**
     * Initialize resource model.
     *
     * @return void
     */
    public function _construct(): void
    {
        $this->_init('smile_contactus_appeal', 'id');
    }
}
