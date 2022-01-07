<?php

namespace App\Entity;

use App\Repository\POIRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=POIRepository::class)
 */
class POI
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=6)
     */
    private $longitude;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=6)
     */
    private $latitude;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    public function __construct(
        $longitude,
        $latitude,
        $title = '',
        $description = '',
        $img_src = ''
    )
    {
        $this->longitude = $longitude;
        $this->latitude = $latitude;
        $this->title = $title;
        $this->description = $description;
        $this->img_src = $img_src;
    }

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $img_src;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(string $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(string $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImgSrc(): ?string
    {
        return $this->img_src;
    }

    public function setImgSrc(?string $img_src): self
    {
        $this->img_src = $img_src;

        return $this;
    }

    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'longitude' => $this->getLongitude(),
            'latitude' => $this->getLatitude(),
            'title' => $this->getTitle(),
            'description' => $this->getDescription(),
            'img_src' => $this->getImgSrc()
        ];
    }
}
