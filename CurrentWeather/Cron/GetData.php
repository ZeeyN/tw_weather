<?php
declare(strict_types=1);

namespace TestWork\CurrentWeather\Cron;

use TestWork\CurrentWeather\Api\Data\InfoInterfaceFactory;
use TestWork\CurrentWeather\Api\InfoRepositoryInterface;
use TestWork\CurrentWeather\Model\ResourceModel\Info\CollectionFactory;
use TestWork\CurrentWeather\Helper\Curl;
use Magento\Framework\App\Config\ScopeConfigInterface;


class GetData
{
    public const IS_ENABLED = 'weather_config/settings/enabled';

    /**
     * @var InfoInterfaceFactory
     */
    private InfoInterfaceFactory $infoFactory;

    /**
     * @var InfoRepositoryInterface
     */
    private InfoRepositoryInterface $infoRepository;

    /**
     * @var CollectionFactory
     */
    private CollectionFactory $collectionFactory;

    /**
     * @var Curl
     */
    private Curl $curlHelper;

    /**
     * @var ScopeConfigInterface
     */
    private ScopeConfigInterface $scopeConfig;

    /**
     * @param InfoInterfaceFactory $infoFactory
     * @param InfoRepositoryInterface $infoRepository
     * @param CollectionFactory $collectionFactory
     * @param Curl $curlHelper
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        InfoInterfaceFactory    $infoFactory,
        InfoRepositoryInterface $infoRepository,
        CollectionFactory       $collectionFactory,
        Curl $curlHelper,
        ScopeConfigInterface $scopeConfig

    ) {
        $this->infoFactory = $infoFactory;
        $this->infoRepository = $infoRepository;
        $this->collectionFactory = $collectionFactory;
        $this->curlHelper = $curlHelper;
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Get data from api
     *
     */
    public function execute():void
    {
        if ($this->scopeConfig->getValue(self::IS_ENABLED)) {
            $data = $this->curlHelper->apiCall();
            $this->infoRepository->saveDataFromApi($data);
        }
    }
}
