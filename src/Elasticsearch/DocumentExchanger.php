<?php

namespace App\Elasticsearch;

use App\Model\Anime;
use App\Repository\AnimeRepository;
use Elastica\Document;
use JoliCode\Elastically\Messenger\DocumentExchangerInterface;

class DocumentExchanger implements DocumentExchangerInterface
{
    private $animeRepository;

    public function __construct(AnimeRepository $animeRepository)
    {
        $this->animeRepository = $animeRepository;
    }

    public function fetchDocument(string $className, string $id): ?Document
    {
        if ($className === Anime::class) {
            $anime = $this->animeRepository->find($id);

            if ($anime) {
                return new Document($id, $anime->toModel());
            }
        }

        return null;
    }
}