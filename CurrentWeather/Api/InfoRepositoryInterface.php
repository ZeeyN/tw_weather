<?php
declare(strict_types = 1);

namespace TestWork\CurrentWeather\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use TestWork\CurrentWeather\Api\Data\InfoSearchResultInterface;
use TestWork\CurrentWeather\Api\Data\InfoInterface;
use Magento\Framework\Exception\LocalizedException;

interface InfoRepositoryInterface
{

    /**
     * Save entity
     *
     * @param InfoInterface $weather
     * @return InfoInterface
     * @throws LocalizedException
     */
    public function save(InfoInterface $weather): InfoInterface;

    /**
     * Retrieve entity
     *
     * @param string $entityId
     * @return InfoInterface
     * @throws LocalizedException
     */
    public function get(string $entityId): InfoInterface;

    /**
     * Retrieve entity matching the specified criteria.
     *
     * @param SearchCriteriaInterface $searchSearchCriteria
     * @return InfoSearchResultInterface
     * @throws LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchSearchCriteria): InfoSearchResultInterface;

    /**
     * Delete entity
     *
     * @param InfoInterface $weather
     * @return void
     * @throws LocalizedException
     */
    public function delete(InfoInterface $weather): void;

    /**
     * Delete entity by ID
     *
     * @param string $entityId
     * @return void
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteById(string $entityId): void;

    /**
     * @param array $data
     */
    public function saveDataFromApi(array $data): void;
}
