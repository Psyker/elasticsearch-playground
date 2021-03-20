<?php

namespace App\Command;

use App\Entity\Anime;
use App\Repository\AnimeRepository;
use Elastica\Document;
use JoliCode\Elastically\Client;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateIndexCommand extends Command
{
    protected static $defaultName = 'app:elasticsearch:create-index';
    private $client;
    private $postRepository;

    protected function configure(): void
    {
        $this
            ->setDescription('Build new index from scratch and populate.')
        ;
    }

    public function __construct(Client $client, AnimeRepository $animeRepository, string $name = null)
    {
        parent::__construct($name);
        $this->client = $client;
        $this->postRepository = $animeRepository;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $indexBuilder = $this->client->getIndexBuilder();
        $newIndex = $indexBuilder->createIndex('anime');
        $indexer = $this->client->getIndexer();

        $allAnime = $this->postRepository->createQueryBuilder('anime')->getQuery()->iterate();
        /** @var Anime $anime */
        foreach ($allAnime as $anime) {
            $anime = $anime[0];
            $indexer->scheduleIndex($newIndex, new Document($anime->getId(), $anime->toModel()));
        }

        $indexer->flush();

        $indexBuilder->markAsLive($newIndex, 'anime');
        $indexBuilder->speedUpRefresh($newIndex);
        $indexBuilder->purgeOldIndices('anime');

        return Command::SUCCESS;
    }
}