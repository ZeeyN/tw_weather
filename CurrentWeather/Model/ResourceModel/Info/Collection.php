<?php
declare(strict_types=1);

namespace TestWork\CurrentWeather\Model\ResourceModel\Info;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'entity_id';

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(
            \TestWork\CurrentWeather\Model\InfoModel::class,
            \TestWork\CurrentWeather\Model\ResourceModel\InfoResource::class
        );
    }
}
