<?php

/**
 * Contact appeal index.
 *
 * @author    Dmytro Kohut <dmkoh@smile.fr>
 * @copyright 2020 Smile
 */

declare(strict_types=1);

namespace Smile\Contact\Controller\Adminhtml\Appeal;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Index
 *
 * @package Smile\Contact\Controller\Adminhtml\Appeal
 */
class Index extends Action
{
    /**
     * Authorization level of a basic admin session.
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Smile_Contact::appeal';

    /**
     * Page factory.
     *
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * Index construct.
     *
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Index action.
     *
     * @return Page
     */
    public function execute(): Page
    {
        /** @var Page $resultPage */
        $resultPage = $this->resultPageFactory->create();

        $resultPage->setActiveMenu('Smile_Contact::appeal');
        $resultPage->addBreadcrumb(__('Contact Appeal'), __('Contact Appeal'));
        $resultPage->getConfig()->getTitle()->prepend(__('Contact Appeal'));

        return $resultPage;
    }
}
