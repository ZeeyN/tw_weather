<?php

namespace TestWork\CurrentWeather\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\HTTP\Client\Curl as CurlClient;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Serialize\Serializer\Json;


class Curl extends AbstractHelper
{
    public const URL = 'weather_config/settings/url';
    public const KEY = 'weather_config/settings/key';
    public const CITY_NAME = 'weather_config/settings/city_name';

    /**
     * @var CurlClient
     */
    private CurlClient $curl;

    /**
     * @var Json
     */
    private Json $serializer;

    /**
     * @param Context $context
     * @param CurlClient $curl
     * @param ScopeConfigInterface $scopeConfig
     * @param Json $serializer
     */
    public function __construct(
        Context $context,
        CurlClient $curl,
        ScopeConfigInterface $scopeConfig,
        Json $serializer
    ) {
        parent::__construct($context);
        $this->curl = $curl;
        $this->scopeConfig = $scopeConfig;
        $this->serializer = $serializer;
    }

    /**
     * Api Call
     *
     * @param string $cityName
     * @return array|bool|float|int|mixed|string|null
     */
    public function apiCall($cityName='')
    {
        if (!$cityName) {
            $cityName = $this->scopeConfig->getValue(self::CITY_NAME);
        }
        $url = $this->scopeConfig->getValue(self::URL) . "key=".$this->scopeConfig->getValue(self::KEY)."&q=".$cityName;
        $this->curl->get($url);
        $response = $this->curl->getBody();

        return $this->serializer->unserialize($response);
    }
}
