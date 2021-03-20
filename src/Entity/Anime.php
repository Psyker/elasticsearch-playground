<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * Anime
 *
 * @ORM\Table(name="anime", indexes={@ORM\Index(name="mal_anime_idx", columns={"mal_id"})})
 * @ORM\Entity
 */
class Anime
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
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="text", length=0, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="image_url", type="string", length=255, nullable=false)
     */
    private $imageUrl;

    /**
     * @var int
     *
     * @ORM\Column(name="episodes_count", type="integer", nullable=false)
     */
    private $episodesCount;

    /**
     * @var bool
     *
     * @ORM\Column(name="airing", type="boolean", nullable=false)
     */
    private $airing;

    /**
     * @var float
     *
     * @ORM\Column(name="score", type="float", precision=10, scale=0, nullable=false)
     */
    private $score;

    /**
     * @var int
     *
     * @ORM\Column(name="mal_id", type="integer", nullable=false)
     */
    private $malId;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=false)
     */
    private $url;

    /**
     * @var string|null
     *
     * @ORM\Column(name="trailer_url", type="string", length=255, nullable=true)
     */
    private $trailerUrl;

    /**
     * @var string|null
     * @SerializedName("title_english")
     * @ORM\Column(name="title_english", type="string", length=255, nullable=true)
     */
    private $titleEnglish;

    /**
     * @var string|null
     *
     * @ORM\Column(name="title_japanese", type="string", length=255, nullable=true)
     */
    private $titleJapanese;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255, nullable=false)
     */
    private $status;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="aired_from", type="datetime", nullable=true)
     */
    private $airedFrom;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="aired_to", type="datetime", nullable=true)
     */
    private $airedTo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="duration", type="string", length=255, nullable=true)
     */
    private $duration;

    /**
     * @var string
     *
     * @ORM\Column(name="rating", type="string", length=255, nullable=false)
     */
    private $rating;

    /**
     * @var array
     *
     * @ORM\Column(name="synonyms", type="json_array", length=0, nullable=false)
     */
    private $synonyms;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=false)
     */
    private $type;

    /**
     * @var int
     *
     * @ORM\Column(name="rank", type="integer", nullable=false)
     */
    private $rank;

    /**
     * @var int
     *
     * @ORM\Column(name="popularity", type="integer", nullable=false)
     */
    private $popularity;

    /**
     * @var array
     *
     * @ORM\Column(name="opening_themes", type="json_array", length=0, nullable=false)
     */
    private $openingThemes;

    /**
     * @var array
     *
     * @ORM\Column(name="ending_themes", type="json_array", length=0, nullable=false)
     */
    private $endingThemes;

    /**
     * @var string|null
     *
     * @ORM\Column(name="broadcast", type="string", length=255, nullable=true)
     */
    private $broadcast;

    /**
     * @var string|null
     *
     * @ORM\Column(name="banner_image_url", type="string", length=255, nullable=true)
     */
    private $bannerImageUrl;

    /**
     * @var string|null
     *
     * @ORM\Column(name="poster_image_url", type="string", length=255, nullable=true)
     */
    private $posterImageUrl;

    /**
     * @var string|null
     *
     * @ORM\Column(name="background_image_url", type="string", length=255, nullable=true)
     */
    private $backgroundImageUrl;

    /**
     * @var Collection
     *
     * @ORM\ManyToMany(targetEntity="Genre", inversedBy="anime")
     * @ORM\JoinTable(name="anime_genre",
     *   joinColumns={
     *     @ORM\JoinColumn(name="anime_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="genre_id", referencedColumnName="id")
     *   }
     * )
     */
    private $genre;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->genre = new ArrayCollection();
    }

    public function toModel(): \App\Model\Anime
    {
        $model = new \App\Model\Anime();
        $model->title = $this->getTitle();
        $model->description = $this->description;
        $model->episodes_count = $this->getEpisodesCount();
        $model->airing = $this->isAiring();
        $model->score = $this->getScore();
        $model->title_english = $this->getTitleEnglish();

        return $model;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Anime
     */
    public function setId(int $id): Anime
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Anime
     */
    public function setTitle(string $title): Anime
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     * @return Anime
     */
    public function setDescription(?string $description): Anime
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }

    /**
     * @param string $imageUrl
     * @return Anime
     */
    public function setImageUrl(string $imageUrl): Anime
    {
        $this->imageUrl = $imageUrl;
        return $this;
    }

    /**
     * @return int
     */
    public function getEpisodesCount(): int
    {
        return $this->episodesCount;
    }

    /**
     * @param int $episodesCount
     * @return Anime
     */
    public function setEpisodesCount(int $episodesCount): Anime
    {
        $this->episodesCount = $episodesCount;
        return $this;
    }

    /**
     * @return bool
     */
    public function isAiring(): bool
    {
        return $this->airing;
    }

    /**
     * @param bool $airing
     * @return Anime
     */
    public function setAiring(bool $airing): Anime
    {
        $this->airing = $airing;
        return $this;
    }

    /**
     * @return float
     */
    public function getScore(): float
    {
        return $this->score;
    }

    /**
     * @param float $score
     * @return Anime
     */
    public function setScore(float $score): Anime
    {
        $this->score = $score;
        return $this;
    }

    /**
     * @return int
     */
    public function getMalId(): int
    {
        return $this->malId;
    }

    /**
     * @param int $malId
     * @return Anime
     */
    public function setMalId(int $malId): Anime
    {
        $this->malId = $malId;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return Anime
     */
    public function setUrl(string $url): Anime
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTrailerUrl(): ?string
    {
        return $this->trailerUrl;
    }

    /**
     * @param string|null $trailerUrl
     * @return Anime
     */
    public function setTrailerUrl(?string $trailerUrl): Anime
    {
        $this->trailerUrl = $trailerUrl;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTitleEnglish(): ?string
    {
        return $this->titleEnglish;
    }

    /**
     * @param string|null $titleEnglish
     * @return Anime
     */
    public function setTitleEnglish(?string $titleEnglish): Anime
    {
        $this->titleEnglish = $titleEnglish;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTitleJapanese(): ?string
    {
        return $this->titleJapanese;
    }

    /**
     * @param string|null $titleJapanese
     * @return Anime
     */
    public function setTitleJapanese(?string $titleJapanese): Anime
    {
        $this->titleJapanese = $titleJapanese;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return Anime
     */
    public function setStatus(string $status): Anime
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getAiredFrom(): ?\DateTime
    {
        return $this->airedFrom;
    }

    /**
     * @param \DateTime|null $airedFrom
     * @return Anime
     */
    public function setAiredFrom(?\DateTime $airedFrom): Anime
    {
        $this->airedFrom = $airedFrom;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getAiredTo(): ?\DateTime
    {
        return $this->airedTo;
    }

    /**
     * @param \DateTime|null $airedTo
     * @return Anime
     */
    public function setAiredTo(?\DateTime $airedTo): Anime
    {
        $this->airedTo = $airedTo;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDuration(): ?string
    {
        return $this->duration;
    }

    /**
     * @param string|null $duration
     * @return Anime
     */
    public function setDuration(?string $duration): Anime
    {
        $this->duration = $duration;
        return $this;
    }

    /**
     * @return string
     */
    public function getRating(): string
    {
        return $this->rating;
    }

    /**
     * @param string $rating
     * @return Anime
     */
    public function setRating(string $rating): Anime
    {
        $this->rating = $rating;
        return $this;
    }

    /**
     * @return array
     */
    public function getSynonyms(): array
    {
        return $this->synonyms;
    }

    /**
     * @param array $synonyms
     * @return Anime
     */
    public function setSynonyms(array $synonyms): Anime
    {
        $this->synonyms = $synonyms;
        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Anime
     */
    public function setType(string $type): Anime
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return int
     */
    public function getRank(): int
    {
        return $this->rank;
    }

    /**
     * @param int $rank
     * @return Anime
     */
    public function setRank(int $rank): Anime
    {
        $this->rank = $rank;
        return $this;
    }

    /**
     * @return int
     */
    public function getPopularity(): int
    {
        return $this->popularity;
    }

    /**
     * @param int $popularity
     * @return Anime
     */
    public function setPopularity(int $popularity): Anime
    {
        $this->popularity = $popularity;
        return $this;
    }

    /**
     * @return array
     */
    public function getOpeningThemes(): array
    {
        return $this->openingThemes;
    }

    /**
     * @param array $openingThemes
     * @return Anime
     */
    public function setOpeningThemes(array $openingThemes): Anime
    {
        $this->openingThemes = $openingThemes;
        return $this;
    }

    /**
     * @return array
     */
    public function getEndingThemes(): array
    {
        return $this->endingThemes;
    }

    /**
     * @param array $endingThemes
     * @return Anime
     */
    public function setEndingThemes(array $endingThemes): Anime
    {
        $this->endingThemes = $endingThemes;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getBroadcast(): ?string
    {
        return $this->broadcast;
    }

    /**
     * @param string|null $broadcast
     * @return Anime
     */
    public function setBroadcast(?string $broadcast): Anime
    {
        $this->broadcast = $broadcast;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getBannerImageUrl(): ?string
    {
        return $this->bannerImageUrl;
    }

    /**
     * @param string|null $bannerImageUrl
     * @return Anime
     */
    public function setBannerImageUrl(?string $bannerImageUrl): Anime
    {
        $this->bannerImageUrl = $bannerImageUrl;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPosterImageUrl(): ?string
    {
        return $this->posterImageUrl;
    }

    /**
     * @param string|null $posterImageUrl
     * @return Anime
     */
    public function setPosterImageUrl(?string $posterImageUrl): Anime
    {
        $this->posterImageUrl = $posterImageUrl;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getBackgroundImageUrl(): ?string
    {
        return $this->backgroundImageUrl;
    }

    /**
     * @param string|null $backgroundImageUrl
     * @return Anime
     */
    public function setBackgroundImageUrl(?string $backgroundImageUrl): Anime
    {
        $this->backgroundImageUrl = $backgroundImageUrl;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * @param Collection $genre
     * @return Anime
     */
    public function setGenre(Collection $genre): Anime
    {
        $this->genre = $genre;
        return $this;
    }



}
