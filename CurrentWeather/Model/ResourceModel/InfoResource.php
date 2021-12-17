<?php
declare(strict_types=1);
namespace TestWork\CurrentWeather\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class InfoResource extends AbstractDb
{
    public const TABLE = 'current_weather';

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(self::TABLE, 'entity_id');
    }
}
