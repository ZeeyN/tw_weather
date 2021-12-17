<?php
declare(strict_types = 1);

namespace TestWork\CurrentWeather\Model;

use Exception;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use TestWork\CurrentWeather\Api\Data\InfoInterface;
use TestWork\CurrentWeather\Api\Data\InfoInterfaceFactory;
use TestWork\CurrentWeather\Model\ResourceModel\InfoResource as ResourceWeather;
use TestWork\CurrentWeather\Api\Data\InfoSearchResultInterface;
use TestWork\CurrentWeather\Api\InfoRepositoryInterface;
use TestWork\CurrentWeather\Model\ResourceModel\Info\CollectionFactory;

class InfoRepository implements InfoRepositoryInterface
{

    /**
     * @var CollectionProcessorInterface
     */
    private CollectionProcessorInterface $collectionProcessor;

    /**
     * @var ResourceWeather
     */
    private ResourceWeather $resource;

    /**
     * @var CollectionFactory
     */
    private CollectionFactory $collectionFactory;

    /**
     * @var InfoInterfaceFactory
     */
    private InfoInterfaceFactory $infoInterfaceFactory;

    /**
     * @var SearchResultsInterface
     */
    private SearchResultsInterface $searchResultsFactory;

    /**
     * @param ResourceWeather $resource
     * @param InfoInterfaceFactory $infoInterfaceFactory
     * @param CollectionFactory $collectionFactory
     * @param SearchResultsInterface $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ResourceWeather $resource,
        InfoInterfaceFactory $infoInterfaceFactory,
        CollectionFactory $collectionFactory,
        SearchResultsInterface $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->infoInterfaceFactory = $infoInterfaceFactory;
        $this->collectionFactory = $collectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @inheritDoc
     */
    public function save(InfoInterface $weather): InfoInterface
    {
        try {
            $this->resource->save($weather);
        } catch (Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the entity: %1',
                $exception->getMessage()
            ));
        }
        return $weather;
    }

    /**
     * @inheritDoc
     */
    public function get(string $entityId): InfoInterface
    {
        $weatherModel = $this->infoInterfaceFactory->create();
        $this->resource->load($weatherModel, $entityId);
        if (!$weatherModel->getEntityId()) {
            throw new NoSuchEntityException(__('entity with id "%1" does not exist.', $entityId));
        }
        return $weatherModel;
    }

    /**
     * @inheritDoc
     */
    public function getList(
        SearchCriteriaInterface $searchCriteria
    ): InfoSearchResultInterface {
        try {
            $collection = $this->collectionFactory->create();
            $this->collectionProcessor->process($searchCriteria, $collection);
            $searchResults = $this->searchResultsFactory->create();
            $searchResults->setSearchCriteria($searchCriteria);

            $items = [];
            foreach ($collection as $model) {
                $items[] = $model;
            }

            $searchResults->setItems($items);
            $searchResults->setTotalCount($collection->getSize());
        } catch (\Exception $exception) {
            throw new NoSuchEntityException(__('Could Not load factory'));
        }

        return $searchResults;
    }

    /**
     * @inheritDoc
     */
    public function delete(InfoInterface $weather): void
    {
        try {
            $weatherModel = $this->infoInterfaceFactory->create();
            $this->resource->load($weatherModel, $weather->getEntityId());
            $this->resource->delete($weatherModel);
        } catch (Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the entity: %1',
                $exception->getMessage()
            ));
        }
    }

    /**
     * @inheritDoc
     */
    public function deleteById(string $entityId): void
    {
        $this->delete($this->get($entityId));
    }

    /**
     * @inheritDoc
     */
    public function saveDataFromApi(array $data): void
    {
        try {
            $collection = $this->collectionFactory->create();
            $info = $collection->getFirstItem();

            if (!$info) {
                $info = $this->infoInterfaceFactory->create();
            }

            $info->setData('temp_c', $data['current']['temp_c']);
            $info->setData('wind_kph', $data['current']['wind_kph']);
            $info->setData('wind_dir', $data['current']['wind_dir']);
            $info->setData('humidity', $data['current']['humidity']);
            $info->setData('updated_at', time());
            $this->save($info);
        } catch (Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the entity: %1',
                $exception->getMessage()
            ));
        }
    }
}
