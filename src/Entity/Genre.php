<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Genre
 *
 * @ORM\Table(name="genre", indexes={@ORM\Index(name="mal_genre_idx", columns={"mal_id"})})
 * @ORM\Entity
 */
class Genre
{
    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private int $id;

    /**
     * @ORM\Column(name="mal_id", type="integer", nullable=false)
     */
    private int $malId;

    /**
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private string $name;

    /**
     * @ORM\Column(name="url", type="string", length=255, nullable=false)
     */
    private string $url;

    /**
     * @ORM\ManyToMany(targetEntity="Anime", mappedBy="genre")
     */
    private Collection $anime;

    public function __construct()
    {
        $this->anime = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
