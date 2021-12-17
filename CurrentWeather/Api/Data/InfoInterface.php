<?php
declare(strict_types = 1);

namespace TestWork\CurrentWeather\Api\Data;

interface InfoInterface
{
    public const ENTITY_ID = 'entity_id';
    public const TEMP = 'temp_c';
    public const HUMIDITY = 'humidity';
    public const WIND_DIRECTION = 'wind_dir';
    public const WIND_SPEED = 'wind_kph';
    public const UPDATED_AT = 'updated_at';

    /**
     * Get entity_id
     *
     * @return string|null
     */
    public function getEntityId(): ?string;

    /**
     * Set entity_id
     *
     * @param string|null $entityId
     * @return InfoInterface
     */
    public function setEntityId(?string $entityId): self;

    /**
     * Get temperature
     *
     * @return string|null
     */
    public function getTemp(): ?string;

    /**
     * Set air temperature
     *
     * @param string $temp
     * @return InfoInterface
     */
    public function setTemp(string $temp): self;

    /**
     * Get humidity
     *
     * @return string|null
     */
    public function getHumidity(): ?string;

    /**
     * Set humidity
     *
     * @param string $humidity
     * @return InfoInterface
     */
    public function setHumidity(string $humidity): self;

    /**
     * Get wind direction
     *
     * @return string|null
     */
    public function getWindDir(): ?string;

    /**
     * Set wind direction
     *
     * @param string $windDir
     * @return InfoInterface
     */
    public function setWindDir(string $windDir): self;

    /**
     * Get wind speed
     *
     * @return string|null
     */
    public function getWindSpeed(): ?string;

    /**
     * Set wind speed
     *
     * @param string $windSpeed
     * @return InfoInterface
     */
    public function setWindSpeed(string $windSpeed): self;

    /**
     * Get Updated time
     *
     * @return string|null
     */
    public function getUpdatedAt(): ?string;

    /**
     * Set Updated time
     *
     * @param string $updatedAt
     * @return InfoInterface
     */
    public function setUpdatedAt(string $updatedAt): self;
}
