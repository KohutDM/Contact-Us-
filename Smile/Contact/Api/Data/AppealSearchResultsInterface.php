<?php

/**
 * Smile appeal search results interface.
 *
 * @author    Dmytro Kohut <dmkoh@smile.fr>
 * @copyright 2020 Smile
 */

declare(strict_types=1);

namespace Smile\Contact\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface AppealSearchResultsInterface
 *
 * @package Smile\Contact\Api\Data
 */
interface AppealSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get appeals list.
     *
     * @return Smile\Contact\Api\Data\AppealInterface[]
     */
    public function getItems(): array;

    /**
     * Set appeals list.
     *
     * @param Smile\Contact\Api\Data\AppealInterface[] $items
     *
     * @return AppealSearchResultsInterface
     */
    public function setItems(array $items): AppealSearchResultsInterface;
}
