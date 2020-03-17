<?php

/**
 * Contact appeal repository.
 *
 * @author    Dmytro Kohut <dmkoh@smile.fr>
 * @copyright 2020 Smile
 */

declare(strict_types=1);

namespace Smile\Contact\Model;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Smile\Contact\Api\Data;
use Smile\Contact\Api\Data\AppealInterface;
use Smile\Contact\Api\Data\AppealSearchResultsInterface;
use Smile\Contact\Api\AppealRepositoryInterface;
use Smile\Contact\Model\ResourceModel\Appeal as ResourceAppeal;
use Smile\Contact\Model\ResourceModel\Appeal\CollectionFactory as AppealCollectionFactory;

/**
 * Class AppealRepository
 *
 * @package Smile\Contact\Model
 */
class AppealRepository implements AppealRepositoryInterface
{
    /**
     * Resource appeal.
     *
     * @var ResourceAppeal
     */
    private $resource;

    /**
     * Appeal factory.
     *
     * @var AppealFactory
     */
    private $appealFactory;

    /**
     * Appeal collection factory.
     *
     * @var AppealCollectionFactory
     */
    private $appealCollectionFactory;

    /**
     * Appeal search results interface factory.
     *
     * @var AppealSearchResultsInterfaceFactory
     */
    private $searchResultsFactory;

    /**
     * AppealRepository constructor.
     *
     * @param ResourceAppeal $resource
     * @param AppealFactory $appealFactory
     * @param AppealCollectionFactory $appealCollectionFactory
     * @param Data\AppealSearchResultsInterfaceFactory $searchResultsFactory
     */
    public function __construct(
        ResourceAppeal $resource,
        AppealFactory $appealFactory,
        AppealCollectionFactory $appealCollectionFactory,
        Data\AppealSearchResultsInterfaceFactory $searchResultsFactory
    )
    {
        $this->resource = $resource;
        $this->appealFactory = $appealFactory;
        $this->appealCollectionFactory = $appealCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
    }

    /**
     * Save Appeal data.
     *
     * @param AppealInterface $appeal
     *
     * @return AppealInterface
     *
     * @throws CouldNotSaveException
     */
    public function save(AppealInterface $appeal): AppealInterface
    {
        try {
            $this->resource->save($appeal);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }

        return $appeal;
    }

    /**
     * Load Appeal data by given Appeal Identity.
     *
     * @param int $appealId
     *
     * @return AppealInterface
     *
     * @throws NoSuchEntityException
     */
    public function getById(int $appealId): AppealInterface
    {
        $appeal = $this->appealFactory->create();
        $this->resource->load($appeal, $appealId);
        if (!$appeal->getAppealId()) {
            throw new NoSuchEntityException(__('Appeal with id "%1" does not exist.', $appealId));
        }

        return $appeal;
    }

    /**
     * Load Appeal data collection by given search criteria.
     *
     * @param SearchCriteriaInterface $criteria
     *
     * @return AppealSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $criteria = null): AppealSearchResultsInterface
    {
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);

        $collection = $this->appealCollectionFactory->create();
        foreach ($criteria->getFilterGroups() as $filterGroup) {
            foreach ($filterGroup->getFilters() as $filter) {
                $condition = $filter->getConditionType() ?: 'eq';
                $collection->addFieldToFilter($filter->getField(), [$condition => $filter->getValue()]);
            }
        }
        $searchResults->setTotalCount($collection->getSize());
        $collection->setCurPage($criteria->getCurrentPage());
        $collection->setPageSize($criteria->getPageSize());
        $appeal = [];
        /** @var AppealInterface $appealModel */
        foreach ($collection as $appealModel) {
            $appeal[] = $appealModel;
        }
        $searchResults->setItems($appeal);

        return $searchResults;
    }

    /**
     * Delete Appeal.
     *
     * @param AppealInterface $appeal
     *
     * @return bool
     *
     * @throws CouldNotDeleteException
     */
    public function delete(AppealInterface $appeal): bool
    {
        try {
            $this->resource->delete($appeal);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }

        return true;
    }

    /**
     * Delete Appeal by given Appeal Identity.
     *
     * @param int $appealId
     *
     * @return bool
     *
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById(int $appealId): bool
    {
        return $this->delete($this->getById($appealId));
    }
}
