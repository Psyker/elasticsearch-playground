<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Recommendation
 *
 * @ORM\Table(name="recommendation", indexes={@ORM\Index(name="IDX_433224D270C20237", columns={"recommended_id"}), @ORM\Index(name="IDX_433224D2794BBE89", columns={"anime_id"})})
 * @ORM\Entity
 */
class Recommendation
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
     * @ORM\Column(name="recommendation_count", type="integer", nullable=false)
     */
    private $recommendationCount;

    /**
     * @var \Anime
     *
     * @ORM\ManyToOne(targetEntity="Anime")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="recommended_id", referencedColumnName="id")
     * })
     */
    private $recommended;

    /**
     * @var \Anime
     *
     * @ORM\ManyToOne(targetEntity="Anime")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="anime_id", referencedColumnName="id")
     * })
     */
    private $anime;


}
