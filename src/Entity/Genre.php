<?php

namespace App\Entity;

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
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="mal_id", type="integer", nullable=false)
     */
    private $malId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=false)
     */
    private $url;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Anime", mappedBy="genre")
     */
    private $anime;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->anime = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
