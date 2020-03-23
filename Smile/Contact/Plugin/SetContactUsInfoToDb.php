<?php

/**
 * Smile Set Contact Us Info to Db plugin.
 *
 * @author    Dmytro Kohut <dmkoh@smile.fr>
 * @copyright 2020 Smile
 */

declare(strict_types=1);

namespace Smile\Contact\Plugin;

use Magento\Framework\Message\Manager;
use Smile\Contact\Api\AppealRepositoryInterface;
use Smile\Contact\Model\AppealFactory;

/**
 * Class SetContactUsInfoToDb
 *
 * @package Smile\Contact\Plugin
 */
class SetContactUsInfoToDb
{
    /**
     * Message manager.
     *
     * @var Manager
     */
    protected $messageManager;

    /**
     * Appeal repository interface.
     *
     * @var AppealRepositoryInterface
     */
    protected $appealRepository;

    /**
     * Appeal factory.
     *
     * @var AppealFactory
     */
    protected $appealFactory;

    /**
     * SetContactUsInfoToDb constructor.
     *
     * @param  Manager $messageManager
     * @param  AppealFactory $appealFactory
     * @param  AppealRepositoryInterface $appealRepository
     */
    public function __construct(
        Manager $messageManager,
        AppealFactory $appealFactory,
        AppealRepositoryInterface $appealRepository
    ) {
        $this->messageManager = $messageManager;
        $this->appealFactory = $appealFactory;
        $this->appealRepository = $appealRepository;
    }

    public function afterExecute(\Magento\Contact\Controller\Index\Post $subject, $result)
    {
        $data = $subject->getRequest()->getParams();
        if ($data) {
            $data['id'] = null;
            $data['answer'] = false;

            try {
                $model = $this->appealFactory->create();
                $data['status'] = $model::STATUS_NEW;
                $model->setData($data);
                $this->appealRepository->save($model);
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while save your appeal.'));
            }
        }
        return $result;
    }
}
