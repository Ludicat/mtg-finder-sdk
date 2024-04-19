<?php
/**
 * @licence Proprietary
 */
namespace Ludicat\MtgFinder\Model;

/**
 * class Geoname
 *
 * @author Joseph Lemoine<j.lemoine@ludi.cat>
 */
class Geoname
{
    public function __construct(array $data = [])
    {
        $this->id = $data['id'] ?? null;
        $this->countryCode = $data['countryCode'] ?? null;
        $this->postalCode = $data['postalCode'] ?? null;
        $this->placeName = $data['placeName'] ?? null;
        $this->latitude = $data['latitude'] ?? null;
        $this->longitude = $data['longitude'] ?? null;
        $this->slug = $data['slug'] ?? null;
    }

    /** @var int|null */
    protected $id;

    /** @var string|null */
    protected $countryCode;

    /** @var string|null */
    protected $postalCode;

    /** @var string|null */
    protected $placeName;

    /** @var float|null */
    protected $latitude;

    /** @var float|null */
    protected $longitude;

    /** @var string|null */
    protected $slug;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id)
    {
        $this->id = $id;

        return $this;
    }

    public function getCountryCode(): ?string
    {
        return $this->countryCode;
    }

    public function setCountryCode(?string $countryCode)
    {
        $this->countryCode = $countryCode;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(?string $postalCode)
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getPlaceName(): ?string
    {
        return $this->placeName;
    }

    public function setPlaceName(?string $placeName)
    {
        $this->placeName = $placeName;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(?float $latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(?float $longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug)
    {
        $this->slug = $slug;

        return $this;
    }
}