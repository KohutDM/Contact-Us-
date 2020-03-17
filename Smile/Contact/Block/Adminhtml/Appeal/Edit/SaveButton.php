<?php

/**
 * Contact appeal save button
 *
 * @author    Dmytro Kohut <dmkoh@smile.fr>
 * @copyright 2020 Smile
 */

declare(strict_types=1);

namespace Smile\Contact\Block\Adminhtml\Appeal\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class SaveButton
 *
 * @package Smile\Contact\Block\Adminhtml\Appeal\Edit
 */
class SaveButton implements ButtonProviderInterface
{
    /**
     * Get save button data.
     *
     * @return array
     */
    public function getButtonData(): array
    {
        return [
            'label' => __('Save Appeal & Send to Customer'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => ['button' => ['event' => 'save']],
                'form-role' => 'save',
            ],
            'sort_order' => 90,
        ];
    }
}
