<?php
declare(strict_types = 1);

namespace TestWork\CurrentWeather\CustomerData;

use Magento\Customer\CustomerData\SectionSourceInterface;
use Magento\Framework\DataObject;
use TestWork\CurrentWeather\Model\ResourceModel\Info\CollectionFactory;
use Magento\Framework\App\Config\ScopeConfigInterface;

class CurrentData extends DataObject implements SectionSourceInterface
{
    public const IS_ENABLED = 'weather_config/settings/enabled';
    /**
     * @var CollectionFactory
     */
    private CollectionFactory $collectionFactory;

    /**
     * @var ScopeConfigInterface
     */
    private ScopeConfigInterface $scopeConfig;

    /**
     * Data constructor.
     *
     * @param CollectionFactory $collectionFactory
     * @param ScopeConfigInterface $scopeConfig
     * @param array $data
     */
    public function __construct(
        CollectionFactory $collectionFactory,
        ScopeConfigInterface $scopeConfig,
        array $data = []
    ) {
        parent::__construct($data);
        $this->collectionFactory = $collectionFactory;
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getSectionData(): array
    {
        if (!$this->scopeConfig->getValue(self::IS_ENABLED)) {
            return [];
        };
        $collection = $this->collectionFactory->create();
        $data = $collection->getFirstItem()->getData();
        return [
            'temp_c' => "Temperature: {$data['temp_c']} deg C",
            'humidity' => "Humidity: {$data['humidity']} %",
            'wind_dir' => "Wind direction: {$data['wind_dir']}",
            'wind_kph' => "Wind speed: {$data['wind_kph']} km/h"
        ];
    }
}
