<?php

/**
 * Smile Set Contact Us Info to Db plugin.
 *
 * @author    Dmytro Kohut <dmkoh@smile.fr>
 * @copyright 2020 Smile
 */

declare(strict_types=1);

namespace Smile\Contact\Plugin;

use Smile\Contact\Controller\Adminhtml\Appeal\Save;

/**
 * Class SetContactUsInfoToDb
 *
 * @package Smile\Contact\Plugin
 */
class SetContactUsInfoToDb
{
    /**
     * Save controller.
     *
     * @var Save
     */
    protected $saveController;

    /**
     * SetContactUsInfoToDb constructor.
     *
     * @param Save $saveController
     */
    public function __construct(
        Save $saveController
    ) {
        $this->saveController = $saveController;
    }

    public function afterExecute(\Magento\Contact\Controller\Index\Post $subject, $result)
    {
        $this->saveController->execute();

        return $result;
    }
}
