<?php

/**
 * Contact appeal repository interface.
 *
 * @author    Dmytro Kohut <dmkoh@smile.fr>
 * @copyright 2020 Smile
 */

declare(strict_types=1);

namespace Smile\Contact\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Smile\Contact\Api\Data\AppealInterface;
use Smile\Contact\Api\Data\AppealSearchResultsInterface;

/**
 * Interface AppealRepositoryInterface.
 *
 * @package Smile\Contact\Api
 */
interface AppealRepositoryInterface
{
    /**
     * Retrieve a appeal by it's id.
     *
     * @param $objectId
     *
     * @return AppealInterface
     */
    public function getById(int $objectId): AppealInterface;

    /**
     * Retrieve appeal which match a specified criteria.
     *
     * @param SearchCriteriaInterface|null $searchCriteria
     *
     * @return AppealSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria = null): AppealSearchResultsInterface;

    /**
     * Save appeal.
     *
     * @param AppealInterface $object
     *
     * @return AppealInterface
     */
    public function save(AppealInterface $object): AppealInterface;

    /**
     * Delete a appeal by its id.
     *
     * @param int $objectId
     *
     * @return bool
     *
     * @throws NoSuchEntityException
     */
    public function deleteById(int $objectId): bool;
}
