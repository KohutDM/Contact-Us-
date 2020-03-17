<?php

/**
 * Contact appeal delete.
 *
 * @author    Dmytro Kohut <dmkoh@smile.fr>
 * @copyright 2020 Smile
 */

declare(strict_types=1);

namespace Smile\Contact\Controller\Adminhtml\Appeal;

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Redirect;
use Smile\Contact\Api\AppealRepositoryInterface;

/**
 * Class Delete
 *
 * @package Smile\Contact\Controller\Adminhtml\Appeal
 */
class Delete extends Action
{
    /**
     * Authorization level of a basic admin session.
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Smile_Contact::appeal_delete';

    /**
     * Appeal repository interface.
     *
     * @var AppealRepositoryInterface
     */
    private $appealRepository;

    /**
     * Delete constructor.
     *
     * @param Action\Context              $context
     * @param AppealRepositoryInterface $appealRepository
     */
    public function __construct(
        Action\Context              $context,
        AppealRepositoryInterface   $appealRepository
    ) {
        $this->appealRepository = $appealRepository;
        parent::__construct($context);
    }

    /**
     * Delete action.
     *
     * @return Redirect
     */
    public function execute(): Redirect
    {
        $id = $this->getRequest()->getParam('id');
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $result = $resultRedirect->setPath('*/*/');
        if ($id) {
            try {
                $appealRepository = $this->appealRepository;
                $appealRepository->deleteById((int) $id);
                $this->messageManager->addSuccessMessage(__('The appeal has been deleted.'));
                $result = $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('We can\'t find a appeal to delete.'));
                $result = $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        }

        return $result;
    }
}
