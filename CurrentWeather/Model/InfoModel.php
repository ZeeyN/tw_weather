<?php

namespace TestWork\CurrentWeather\Model;

use Magento\Framework\Model\AbstractModel;
use TestWork\CurrentWeather\Api\Data\InfoInterface;
use TestWork\CurrentWeather\Model\ResourceModel\InfoResource as Resource;

class InfoModel extends AbstractModel implements InfoInterface
{
    /**
     * @inheritDoc
     */
    public function _construct()
    {
        $this->_init(Resource::class);
    }

    /**
     * @inheritDoc
     */
    public function getEntityId(): ?string
    {
        return $this->getData(self::ENTITY_ID);
    }

    /**
     * @inheritDoc
     */
    public function setEntityId($entityId): InfoInterface
    {
        return $this->setData(self::ENTITY_ID, $entityId);
    }

    /**
     * @inheritDoc
     */
    public function getHumidity(): ?string
    {
        return $this->getData(self::HUMIDITY);
    }

    /**
     * @inheritDoc
     */
    public function setHumidity(string $humidity): InfoInterface
    {
        return $this->setData(self::HUMIDITY, $humidity);
    }

    /**
     * @inheritDoc
     */
    public function getTemp(): ?string
    {
        return $this->getData(self::TEMP);
    }

    /**
     * @inheritDoc
     */
    public function setTemp(string $temp): InfoInterface
    {
        return $this->setData(self::TEMP, $temp);
    }

    /**
     * @inheritDoc
     */
    public function getWindDir(): ?string
    {
        return $this->getData(self::WIND_DIRECTION);
    }

    /**
     * @inheritDoc
     */
    public function setWindDir(string $windDir): InfoInterface
    {
        return $this->setData(self::WIND_DIRECTION, $windDir);
    }

    /**
     * @inheritDoc
     */
    public function getWindSpeed(): ?string
    {
        return $this->getData(self::WIND_SPEED);
    }

    /**
     * @inheritDoc
     */
    public function setWindSpeed(string $windSpeed): InfoInterface
    {
        return $this->setData(self::WIND_SPEED, $windSpeed);
    }

    /**
     * @inheritDoc
     */
    public function getUpdatedAt(): ?string
    {
        return $this->getData(self::UPDATED_AT);
    }

    /**
     * @inheritDoc
     */
    public function setUpdatedAt(string $updatedAt): InfoInterface
    {
        return $this->setData(self::UPDATED_AT, $updatedAt);
    }
}
