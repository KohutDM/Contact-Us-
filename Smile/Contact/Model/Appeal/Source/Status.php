<?php

/**
 * Contact appeal  status.
 *
 * @author    Dmytro Kohut <dmkoh@smile.fr>
 * @copyright 2020 Smile
 */

declare(strict_types=1);

namespace Smile\Contact\Model\Appeal\Source;

use Magento\Framework\Data\OptionSourceInterface;
use Smile\Contact\Model\Appeal;

/**
 * Class Status
 *
 * @package Smile\Contact\Model\Appeal\Source\Status
 */
class Status implements OptionSourceInterface
{
    /**
     * Appeal.
     *
     * @var Appeal
     */
    private $appeal;

    /**
     * Status constructor.
     *
     * @param Appeal $appeal
     */
    public function __construct(Appeal $appeal)
    {
        $this->appeal = $appeal;
    }

    /**
     * Get options.
     *
     * @return array
     */
    public function toOptionArray(): array
    {
        $availableOptions = $this->appeal->getAvailableStatuses();
        $options = [];
        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }

        return $options;
    }
}
