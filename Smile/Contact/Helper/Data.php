<?php

/**
 * Contact helper data.
 *
 * @author    Dmytro Kohut <dmkoh@smile.fr>
 * @copyright 2020 Smile
 */

declare(strict_types=1);

namespace Smile\Contact\Helper;

use Magento\Framework\App\Area;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\MailException;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\StoreManagerInterface;
use Psr\Log\LoggerInterface;

/**
 * Class Data
 *
 * @package Smile\Contact\Helper
 */
class Data extends AbstractHelper
{
    /**
     * Inline Translation.
     *
     * @var StateInterface
     */
    protected $inlineTranslation;

    /**
     * Transport builder.
     *
     * @var TransportBuilder
     */
    protected $transportBuilder;

    /**
     * Store manager interface.
     *
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * Logger.
     *
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * Data constructor.
     * @param Context                $context
     * @param StoreManagerInterface  $storeManager
     * @param TransportBuilder       $transportBuilder
     * @param StateInterface         $inlineTranslation
     * @param LoggerInterface        $logger
     */
    public function __construct(
        Context                 $context,
        StoreManagerInterface   $storeManager,
        TransportBuilder        $transportBuilder,
        StateInterface          $inlineTranslation,
        LoggerInterface         $logger
    ) {
        $this->storeManager = $storeManager;
        $this->transportBuilder = $transportBuilder;
        $this->inlineTranslation = $inlineTranslation;
        $this->logger = $logger;
        parent::__construct($context);
    }

    /**
     * Send Mail.
     *
     * @return bool
     *
     * @throws LocalizedException
     * @throws MailException
     */
    public function sendMail($receiverEmail, $message): bool
    {
        $this->inlineTranslation->suspend();
        $storeId = $this->storeManager->getStore()->getId();

        $vars = [
            'message' => $message,
            'store' => $this->storeManager->getStore()
        ];

        $sender = $this->scopeConfig->getValue(
            'email_section/sendmail/sender',
            ScopeInterface::SCOPE_STORE,
            $storeId
        );

        $transport = $this->transportBuilder->setTemplateIdentifier(
            'email_section_sendmail_email_template'
        )->setTemplateOptions(
            [
                'area' => Area::AREA_FRONTEND,
                'store' => $storeId
            ]
        )->setTemplateVars(
            $vars
        )->setFromByScope(
            $sender
        )->addTo(
            $receiverEmail
        )->getTransport();

        try {
            $transport->sendMessage();
        } catch (\Exception $exception) {
            $this->logger->critical($exception->getMessage());
        }
        $this->inlineTranslation->resume();

        return true;
    }
}
