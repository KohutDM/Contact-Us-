<?php

/**
 * Contact appeal collection.
 *
 * @author    Dmytro Kohut <dmkoh@smile.fr>
 * @copyright 2020 Smile
 */

declare(strict_types=1);

namespace Smile\Contact\Model\ResourceModel\Appeal;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Smile\Contact\Model\Appeal as AppealModel;
use Smile\Contact\Model\ResourceModel\Appeal as AppealResourceModel;

/**
 * Class Collection
 *
 * @package Smile\Contact\Model\ResourceModel\Appeal
 */
class Collection extends AbstractCollection
{
    /**
     * Define resource model.
     *
     * @return void
     */
    public function _construct(): void
    {
        $this->_init(AppealModel::class, AppealResourceModel::class);
    }
}
