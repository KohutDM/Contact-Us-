<?php

/**
 * Contact Appeal data provider.
 *
 * @author    Dmytro Kohut <dmkoh@smile.fr>
 * @copyright 2020 Smile
 */

declare(strict_types=1);

namespace Smile\Contact\Model\Appeal;

use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Magento\Store\Model\StoreManagerInterface;
use Smile\Contact\Model\ResourceModel\Appeal\Collection;
use Smile\Contact\Model\ResourceModel\Appeal\CollectionFactory;

/**
 * Class DataProvider
 *
 * @package Smile\Contact\Model\Appeal\DataProvider
 */
class DataProvider extends AbstractDataProvider
{
    /**
     * Appeal collection.
     *
     * @var Collection
     */
    protected $collection;

    /**
     * Data persistor interface.
     *
     * @var DataPersistorInterface
     */
    private $dataPersistor;

    /**
     * Loaded data.
     *
     * @var array
     */
    private $loadedData;

    /**
     * Store manager.
     *
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * DataProvider constructor.
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $appealCollectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param StoreManagerInterface $storeManager
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $appealCollectionFactory,
        DataPersistorInterface $dataPersistor,
        StoreManagerInterface $storeManager,
        array $meta = [],
        array $data = []
    )
    {
        $this->collection = $appealCollectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        $this->storeManager = $storeManager;
        parent::__construct(
            $name,
            $primaryFieldName,
            $requestFieldName,
            $meta,
            $data
        );
    }

    /**
     * Get data.
     *
     * @return array
     *
     * @throws NoSuchEntityException
     */
    public function getData(): array
    {
        if ($this->loadedData === null) {
            $this->loadedData = [];
            $items = $this->collection->getItems();

            foreach ($items as $appeal) {
                $this->loadedData[$appeal->getAppealId()] = $appeal->getData();
            }

            $data = $this->dataPersistor->get('smile_contact_appeal');
            if (!empty($data)) {
                $appeal = $this->collection->getNewEmptyItem();
                $appeal->setData($data);
                $this->loadedData[$appeal->getAppealId()] = $appeal->getData();
                $this->dataPersistor->clear('smile_contact_appeal');
            }
        }

        return $this->loadedData;
    }
}
