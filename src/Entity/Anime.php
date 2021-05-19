<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * @ORM\Table(name="anime", indexes={@ORM\Index(name="mal_anime_idx", columns={"mal_id"})})
 * @ORM\Entity
 */
class Anime
{
    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private int $id;

    /**
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private string $title;

    /**
     * @ORM\Column(name="description", type="text", length=0, nullable=true)
     */
    private ?string $description;

    /**
     * @ORM\Column(name="image_url", type="string", length=255, nullable=false)
     */
    private ?string $imageUrl;

    /**
     * @ORM\Column(name="episodes_count", type="integer", nullable=false)
     */
    private int $episodesCount;

    /**
     * @ORM\Column(name="airing", type="boolean", nullable=false)
     */
    private bool $airing;

    /**
     * @ORM\Column(name="score", type="float", precision=10, scale=0, nullable=false)
     */
    private float $score;

    /**
     * @ORM\Column(name="mal_id", type="integer", nullable=false)
     */
    private int $malId;

    /**
     * @ORM\Column(name="url", type="string", length=255, nullable=false)
     */
    private string $url;

    /**
     * @ORM\Column(name="trailer_url", type="string", length=255, nullable=true)
     */
    private ?string $trailerUrl;

    /**
     * @SerializedName("title_english")
     * @ORM\Column(name="title_english", type="string", length=255, nullable=true)
     */
    private ?string $titleEnglish;

    /**
     * @ORM\Column(name="title_japanese", type="string", length=255, nullable=true)
     */
    private ?string $titleJapanese;

    /**
     * @ORM\Column(name="status", type="string", length=255, nullable=false)
     */
    private ?string $status;

    /**
     * @ORM\Column(name="aired_from", type="datetime", nullable=true)
     */
    private ?\DateTime $airedFrom;

    /**
     * @ORM\Column(name="aired_to", type="datetime", nullable=true)
     */
    private ?\DateTime $airedTo;

    /**
     * @ORM\Column(name="duration", type="string", length=255, nullable=true)
     */
    private ?string $duration;

    /**
     * @ORM\Column(name="rating", type="string", length=255, nullable=false)
     */
    private ?string $rating;

    /**
     * @ORM\Column(name="synonyms", type="json_array", length=0, nullable=false)
     */
    private array $synonyms;

    /**
     * @ORM\Column(name="type", type="string", length=255, nullable=false)
     */
    private ?string $type;

    /**
     * @ORM\Column(name="rank", type="integer", nullable=false)
     */
    private int $rank;

    /**
     * @ORM\Column(name="popularity", type="integer", nullable=false)
     */
    private int $popularity;

    /**
     * @ORM\Column(name="opening_themes", type="json_array", length=0, nullable=false)
     */
    private array $openingThemes;

    /**
     * @ORM\Column(name="ending_themes", type="json_array", length=0, nullable=false)
     */
    private array $endingThemes;

    /**
     * @ORM\Column(name="broadcast", type="string", length=255, nullable=true)
     */
    private ?string $broadcast;

    /**
     * @ORM\Column(name="banner_image_url", type="string", length=255, nullable=true)
     */
    private ?string $bannerImageUrl;

    /**
     * @ORM\Column(name="poster_image_url", type="string", length=255, nullable=true)
     */
    private ?string $posterImageUrl;

    /**
     * @ORM\Column(name="background_image_url", type="string", length=255, nullable=true)
     */
    private ?string $backgroundImageUrl;

    /**
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
    private Collection $genre;

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
        $model->title_japanese = $this->getTitleJapanese();
        $model->aired_from = $this->getAiredFrom();
        $model->aired_to = $this->getAiredTo();
        /** @var Genre $genre */
        foreach ($this->getGenre() as $genre) {
            $model->genres[] = [
                'id' => $genre->getId(),
                'name' => $genre->getName()
            ];
        }

        return $model;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Anime
    {
        $this->id = $id;
        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): Anime
    {
        $this->title = $title;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): Anime
    {
        $this->description = $description;
        return $this;
    }

    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(string $imageUrl): Anime
    {
        $this->imageUrl = $imageUrl;
        return $this;
    }

    public function getEpisodesCount(): int
    {
        return $this->episodesCount;
    }

    public function setEpisodesCount(int $episodesCount): Anime
    {
        $this->episodesCount = $episodesCount;
        return $this;
    }

    public function isAiring(): bool
    {
        return $this->airing;
    }

    public function setAiring(bool $airing): Anime
    {
        $this->airing = $airing;
        return $this;
    }

    public function getScore(): float
    {
        return $this->score;
    }

    public function setScore(float $score): Anime
    {
        $this->score = $score;
        return $this;
    }

    public function getMalId(): int
    {
        return $this->malId;
    }

    public function setMalId(int $malId): Anime
    {
        $this->malId = $malId;
        return $this;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): Anime
    {
        $this->url = $url;
        return $this;
    }

    public function getTrailerUrl(): ?string
    {
        return $this->trailerUrl;
    }

    public function setTrailerUrl(?string $trailerUrl): Anime
    {
        $this->trailerUrl = $trailerUrl;
        return $this;
    }

    public function getTitleEnglish(): ?string
    {
        return $this->titleEnglish;
    }

    public function setTitleEnglish(?string $titleEnglish): Anime
    {
        $this->titleEnglish = $titleEnglish;
        return $this;
    }

    public function getTitleJapanese(): ?string
    {
        return $this->titleJapanese;
    }

    public function setTitleJapanese(?string $titleJapanese): Anime
    {
        $this->titleJapanese = $titleJapanese;

        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): Anime
    {
        $this->status = $status;

        return $this;
    }

    public function getAiredFrom(): ?\DateTime
    {
        return $this->airedFrom;
    }

    public function setAiredFrom(?\DateTime $airedFrom): Anime
    {
        $this->airedFrom = $airedFrom;

        return $this;
    }

    public function getAiredTo(): ?\DateTime
    {
        return $this->airedTo;
    }

    public function setAiredTo(?\DateTime $airedTo): Anime
    {
        $this->airedTo = $airedTo;

        return $this;
    }

    public function getDuration(): ?string
    {
        return $this->duration;
    }

    public function setDuration(?string $duration): Anime
    {
        $this->duration = $duration;

        return $this;
    }

    public function getRating(): string
    {
        return $this->rating;
    }

    public function setRating(string $rating): Anime
    {
        $this->rating = $rating;

        return $this;
    }

    public function getSynonyms(): array
    {
        return $this->synonyms;
    }

    public function setSynonyms(array $synonyms): Anime
    {
        $this->synonyms = $synonyms;

        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): Anime
    {
        $this->type = $type;

        return $this;
    }

    public function getRank(): int
    {
        return $this->rank;
    }

    public function setRank(int $rank): Anime
    {
        $this->rank = $rank;

        return $this;
    }

    public function getPopularity(): int
    {
        return $this->popularity;
    }

    public function setPopularity(int $popularity): Anime
    {
        $this->popularity = $popularity;

        return $this;
    }

    public function getOpeningThemes(): array
    {
        return $this->openingThemes;
    }

    public function setOpeningThemes(array $openingThemes): Anime
    {
        $this->openingThemes = $openingThemes;

        return $this;
    }

    public function getEndingThemes(): array
    {
        return $this->endingThemes;
    }

    public function setEndingThemes(array $endingThemes): Anime
    {
        $this->endingThemes = $endingThemes;

        return $this;
    }

    public function getBroadcast(): ?string
    {
        return $this->broadcast;
    }

    public function setBroadcast(?string $broadcast): Anime
    {
        $this->broadcast = $broadcast;
        return $this;
    }

    public function getBannerImageUrl(): ?string
    {
        return $this->bannerImageUrl;
    }

    public function setBannerImageUrl(?string $bannerImageUrl): Anime
    {
        $this->bannerImageUrl = $bannerImageUrl;

        return $this;
    }

    public function getPosterImageUrl(): ?string
    {
        return $this->posterImageUrl;
    }

    public function setPosterImageUrl(?string $posterImageUrl): Anime
    {
        $this->posterImageUrl = $posterImageUrl;

        return $this;
    }

    public function getBackgroundImageUrl(): ?string
    {
        return $this->backgroundImageUrl;
    }

    public function setBackgroundImageUrl(?string $backgroundImageUrl): Anime
    {
        $this->backgroundImageUrl = $backgroundImageUrl;

        return $this;
    }

    public function getGenre()
    {
        return $this->genre;
    }

    public function setGenre(Collection $genre): Anime
    {
        $this->genre = $genre;

        return $this;
    }
}
