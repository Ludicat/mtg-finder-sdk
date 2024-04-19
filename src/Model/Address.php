<?php
/**
 * @licence Proprietary
 */

namespace Ludicat\MtgFinder\Model;

/**
 * class Address
 *
 * @author Joseph Lemoine<j.lemoine@ludi.cat>
 */
class Address
{
    public function __construct(array $data = [])
    {
        $this->type = $data['type'] ?? null;
        $this->street = $data['street'] ?? null;
        $this->additional = $data['additional'] ?? null;
        $this->name = $data['name'] ?? null;
        $this->geoname = new Geoname($data['geoname'] ?? []);
        $this->latitude = $data['latitude'] ?? null;
        $this->longitude = $data['longitude'] ?? null;
        $this->uuid = $data['uuid'] ?? null;
        $this->uuidb58 = $data['uuidb58'] ?? null;
    }

    /** @var string|null */
    protected $type;

    /** @var string|null */
    protected $street;

    /** @var string|null */
    protected $additional;

    /** @var string|null */
    protected $name;

    /** @var Geoname */
    protected $geoname;

    /** @var float|null */
    protected $latitude;

    /** @var float|null */
    protected $longitude;

    /** @var string|null */
    protected $uuid;

    /** @var string|null */
    protected $uuidb58;

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type)
    {
        $this->type = $type;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(?string $street)
    {
        $this->street = $street;

        return $this;
    }

    public function getAdditional(): ?string
    {
        return $this->additional;
    }

    public function setAdditional(?string $additional)
    {
        $this->additional = $additional;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name)
    {
        $this->name = $name;

        return $this;
    }

    public function getGeoname(): Geoname
    {
        return $this->geoname;
    }

    public function setGeoname(Geoname $geoname)
    {
        $this->geoname = $geoname;

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

    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    public function setUuid(?string $uuid)
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function getUuidb58(): ?string
    {
        return $this->uuidb58;
    }

    public function setUuidb58(?string $uuidb58)
    {
        $this->uuidb58 = $uuidb58;

        return $this;
    }
}