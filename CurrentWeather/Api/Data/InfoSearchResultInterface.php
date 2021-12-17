<?php
declare(strict_types=1);

namespace TestWork\CurrentWeather\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface InfoSearchResultInterface extends SearchResultsInterface
{

    /**
     * Get items
     *
     * @return array
     */
    public function getItems(): array;

    /**
     * Set items
     *
     * @param array $items
     * @return InfoSearchResultInterface
     */
    public function setItems(array $items): InfoSearchResultInterface;
}
