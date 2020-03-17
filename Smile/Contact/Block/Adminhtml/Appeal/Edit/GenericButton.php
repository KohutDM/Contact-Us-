<?php

/**
 * Contact appeal generic button
 *
 * @author    Dmytro Kohut <dmkoh@smile.fr>
 * @copyright 2020 Smile
 */

declare(strict_types=1);

namespace Smile\Contact\Block\Adminhtml\Appeal\Edit;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Exception\NoSuchEntityException;
use Smile\Contact\Api\AppealRepositoryInterface;

/**
 * Class GenericButton
 *
 * @package Smile\Contact\Block\Adminhtml\Appeal\Edit
 */
class GenericButton
{
    /**
     * Context.
     *
     * @var Context
     */
    private $context;

    /**
     * Appeal repository interface.
     *
     * @var AppealRepositoryInterface
     */
    private $appealRepository;

    /**
     * GenericButton constructor.
     *
     * @param Context                   $context
     * @param AppealRepositoryInterface $appealRepository
     */
    public function __construct(
        Context $context,
        AppealRepositoryInterface $appealRepository
    ) {
        $this->context = $context;
        $this->appealRepository = $appealRepository;
    }

    /**
     * Get Appeal ID.
     *
     * @return int
     */
    public function getAppealId(): int
    {
        try {
            $modelId = $this->context->getRequest()->getParam('id');

            $appealId = $this->appealRepository->getById((int) $modelId)->getAppealId();
        } catch (NoSuchEntityException $e) {
            $this->context->getLogger()->error($e->getMessage());
            $appealId = 0;
        }

        return $appealId;
    }

    /**
     * Generate url by route and parameters.
     *
     * @param   string $route
     * @param   array  $params
     *
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
