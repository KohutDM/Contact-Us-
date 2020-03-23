<?php

/**
 * Contact appeal save.
 *
 * @author    Dmytro <dmkoh@smile.fr>
 * @copyright 2020 Smile
 */

declare(strict_types=1);

namespace Smile\Contact\Controller\Adminhtml\Appeal;

use Magento\Backend\App\Action;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Smile\Contact\Api\AppealRepositoryInterface;
use Smile\Contact\Model\AppealFactory;
use Smile\Contact\Helper\Data;

/**
 * Class Index
 *
 * @package Smile\Contact\Controller\Adminhtml\Appeal
 */
class Save extends Action
{
    /**
     * Authorization level of a basic admin session.
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Smile_Contact::appeal_save';

    /**
     * Data persistor interface.
     *
     * @var DataPersistorInterface
     */
    private $dataPersistor;

    /**
     * Appeal repository interface.
     *
     * @var AppealRepositoryInterface
     */
    private $appealRepository;

    /**
     * Appeal factory.
     *
     * @var AppealFactory
     */
    private $appealFactory;

    /**
     * Contact helper.
     *
     * @var Data
     */
    private $contactHelper;

    /**
     * Save constructor.
     *
     * @param Action\Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param AppealRepositoryInterface $appealRepository
     * @param AppealFactory $appealFactory
     * @param Data $contactHelper;
     */
    public function __construct(
        Action\Context $context,
        DataPersistorInterface $dataPersistor,
        AppealRepositoryInterface $appealRepository,
        AppealFactory $appealFactory,
        Data $contactHelper
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->appealRepository = $appealRepository;
        $this->appealFactory = $appealFactory;
        $this->contactHelper = $contactHelper;
        parent::__construct($context);
    }

    /**
     * Save action.
     *
     * @return ResultInterface
     */
    public function execute(): ResultInterface
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            $id = $this->getRequest()->getParam('id');

            try {
                $model = $this->appealRepository->getById((int)$id);
                $data['status'] = $model::STATUS_NEW;
                if ($data['answer']) {
                    try {
                        $this->contactHelper->sendMail($data['email'], $data['answer']);
                        $this->messageManager->addSuccessMessage(__('You have send email to customer.'));
                        $data['status'] = $model::STATUS_ANSWERED;
                    } catch (\Exception $e) {
                        $this->messageManager->addExceptionMessage($e, __('Something went wrong while sending email.'));
                    }
                }

                $model->setData($data);

                $this->appealRepository->save($model);
                $this->messageManager->addSuccessMessage(__('You have saved the appeal.'));

                $this->dataPersistor->clear('smile_contact_appeal');

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $model->getAppealId()]);
                }

                return $resultRedirect->setPath('*/*/');
            } catch (NoSuchEntityException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while save the appeal.'));
            }

            $this->dataPersistor->set('smile_contact_appeal', $data);

            return $resultRedirect->setPath(
                '*/*/edit',
                ['id' => $this->getRequest()->getParam('id')]
            );
        }

        return $resultRedirect->setPath('*/*/');
    }
}
