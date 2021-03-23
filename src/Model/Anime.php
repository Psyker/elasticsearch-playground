<?php

namespace App\Model;

use Doctrine\Common\Collections\Collection;

class Anime
{
    public string $title;

    public string $description;

    public int $episodes_count;

    public bool $airing;

    public float $score;

    public string $title_english;

    public \DateTime $aired_from;

    public \DateTime $aired_to;

    public Collection $genres;
}