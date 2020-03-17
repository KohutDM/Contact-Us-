<?php

/**
 * Contact grid appeal collection
 *
 * @author    Dmytro Kohut <dmkoh@smile.fr>
 * @copyright 2020 Smile
 */

declare(strict_types=1);

namespace Smile\Contact\Model\ResourceModel\Appeal\Grid;

use Magento\Framework\Api\Search\AggregationInterface;
use Magento\Framework\Api\Search\SearchResultInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\View\Element\UiComponent\DataProvider\Document;
use Smile\Contact\Model\ResourceModel\Appeal;
use Smile\Contact\Model\ResourceModel\Appeal\Collection as AppealCollection;

/**
 * Class Collection
 *
 * @package Smile\Contact\Model\ResourceModel\Appeal\Grid\Collection
 */
class Collection extends AppealCollection implements SearchResultInterface
{
    /**
     * Aggregations.
     *
     * @var AggregationInterface
     */
    private $aggregations;

    /**
     * Collection constructor.
     *
     * @return void
     */
    public function _construct(): void
    {
        $this->_init(Document::class, Appeal::class);
    }

    /**
     * Get aggregations.
     *
     * @return AggregationInterface
     */
    public function getAggregations(): AggregationInterface
    {
        return $this->aggregations;
    }

    /**
     * Set aggregations.
     *
     * @param AggregationInterface $aggregations
     *
     * @return void
     */
    public function setAggregations($aggregations): void
    {
        $this->aggregations = $aggregations;
    }

    /**
     * Get search criteria.
     *
     * @return SearchCriteriaInterface|null
     */
    public function getSearchCriteria()
    {
        return null;
    }

    /**
     * Set search criteria.
     *
     * @param SearchCriteriaInterface $searchCriteria
     *
     * @return $this
     */
    public function setSearchCriteria(SearchCriteriaInterface $searchCriteria = null): Collection
    {
        return $this;
    }

    /**
     * Get total count.
     *
     * @return int
     */
    public function getTotalCount(): int
    {
        return $this->getSize();
    }

    /**
     * Set total count.
     *
     * @param int $totalCount
     *
     * @return $this
     */
    public function setTotalCount($totalCount): Collection
    {
        return $this;
    }

    /**
     * Set items list.
     *
     * @param \Magento\Framework\Api\ExtensibleDataInterface[] $items
     *
     * @return $this
     */
    public function setItems(array $items = null): Collection
    {
        return $this;
    }
}
