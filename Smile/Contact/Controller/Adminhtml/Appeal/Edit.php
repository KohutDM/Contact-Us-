<?php

/**
 * Contact appeal edit.
 *
 * @author    Dmytro Kohut <dmkoh@smile.fr>
 * @copyright 2020 Smile
 */

declare(strict_types=1);

namespace Smile\Contact\Controller\Adminhtml\Appeal;

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Page;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Result\PageFactory;
use Smile\Contact\Api\AppealRepositoryInterface;

/**
 * Class Edit.
 *
 * @package Smile\Contact\Controller\Adminhtml\Appeal
 */
class Edit extends Action
{
    /**
     * Authorization level of a basic admin session.
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Smile_Contact::appeal_save';

    /**
     * Page factory.
     *
     * @var PageFactory
     */
    private $resultPageFactory;

    /**
     * Appeal repository interface.
     *
     * @var AppealRepositoryInterface
     */
    private $appealRepository;

    /**
     * Edit constructor.
     *
     * @param Action\Context $context
     * @param PageFactory $resultPageFactory
     * @param AppealRepositoryInterface $appealRepository
     */
    public function __construct(
        Action\Context $context,
        PageFactory $resultPageFactory,
        AppealRepositoryInterface $appealRepository
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->appealRepository = $appealRepository;
        parent::__construct($context);
    }

    /**
     * Init actions.
     *
     * @return Page
     */
    private function _initAction(): Page
    {
        /** @var Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Smile_Contact::appeal')
            ->addBreadcrumb(__('Smile'), __('Smile'))
            ->addBreadcrumb(__('Manage Appeal'), __('Manage Appeal'));

        return $resultPage;
    }

    /**
     * Edit Appeal page
     *
     * @return Page|Redirect
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $id = $this->getRequest()->getParam('id');
        $resultPage->getConfig()->getTitle()->prepend(__('Appeal Information'));

        if ($id) {
            try {
                $model = $this->appealRepository->getById((int)$id);
                $resultPage->getConfig()->getTitle()->prepend(__('Edit Appeal - %1', $model->getTitle()));

            } catch (NoSuchEntityException $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while editing the appeal.'));
                /** @var Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();

                return $resultRedirect->setPath('*/*/');
            }
        }

        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->_initAction();
        $resultPage->addBreadcrumb(
            $id ? __('Edit Appeal') : __('New Appeal'),
            $id ? __('Edit Appeal') : __('New Appeal')
        );

        return $resultPage;
    }
}
