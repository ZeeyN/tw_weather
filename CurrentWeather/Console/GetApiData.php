<?php
declare(strict_types=1);

namespace TestWork\CurrentWeather\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use TestWork\CurrentWeather\Api\InfoRepositoryInterface;
use TestWork\CurrentWeather\Helper\Curl;

class GetApiData extends Command
{
    public const NAME = 'city';

    /**
     * @var Curl
     */
    private Curl $helper;

    /**
     * @var InfoRepositoryInterface
     */
    private InfoRepositoryInterface $infoRepository;

    /**
     * @param InfoRepositoryInterface $infoRepository
     * @param Curl $helper
     * @param string|null $name
     */
    public function __construct(
        InfoRepositoryInterface $infoRepository,
        Curl $helper,
        string $name = null
    ) {
        parent::__construct($name);
        $this->helper = $helper;
        $this->infoRepository = $infoRepository;
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $options = [
            new InputOption(
                self::NAME,
                null,
                InputOption::VALUE_REQUIRED,
                'City'
            )
        ];

        $this->setName('get:weather')
            ->setDescription('Download weather api data')
            ->setDefinition($options);

        parent::configure();
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if ($name = $input->getOption(self::NAME)) {
            $data = $this->helper->apiCall($name);
            $this->infoRepository->saveDataFromApi($data);
        }
        return $this;
    }
}
