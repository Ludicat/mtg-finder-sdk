<?php
/**
 * @licence Proprietary
 */

namespace Ludicat\MtgFinder\Model;

/**
 * class Event
 *
 * @author Joseph Lemoine<j.lemoine@ludi.cat>
 */
class Event
{
    public const TYPE_FREE = 'free';
    public const TYPE_FRIENDLY = 'friendly';
    public const TYPE_COMPETITIVE = 'competitive';

    public const STATE_DRAFT = 'draft';
    public const STATE_PUBLISHED = 'published';
    public const STATE_CANCELLED = 'cancelled';

    public function __construct(array $data = [])
    {
        $this->step = $data['step'] ?? null;
        $this->state = $data['state'] ?? null;
        $this->name = $data['name'] ?? null;
        $this->startAt = isset($data['startAt']) ? new \DateTime($data['startAt']) : null;
        $this->endAt = isset($data['endAt']) ? new \DateTime($data['endAt']) : null;
        $this->formats = array_map(function (array $format) {
            return new Format($format);
        }, $data['formats'] ?? []);
        $this->type = $data['type'] ?? null;
        $this->maxPeople = $data['maxPeople'] ?? null;
        $this->public = $data['public'] ?? null;
        $this->createdBy = new User($data['createdBy'] ?? []);
        $this->price = $data['price'] ?? null;
        $this->description = $data['description'] ?? null;
        $this->autoConfirmEnrollment = $data['autoConfirmEnrollment'] ?? null;
        $this->externalRegistration = $data['externalRegistration'] ?? null;
        $this->externalRegistrationUrl = $data['externalRegistrationUrl'] ?? null;
        $this->address = new Address($data['address'] ?? []);
        $this->code = $data['code'] ?? null;
        $this->recurring = $data['recurring'] ?? null;
        $this->href = $data['href'] ?? null;
        $this->uuid = $data['uuid'] ?? null;
        $this->uuidb58 = $data['uuidb58'] ?? null;
    }

    public function toArray()
    {
        return [
            'state' => $this->state,
            'name' => $this->name,
            'type' => $this->type,
            'startAt' => $this->startAt ? $this->startAt->format('Y-m-d H:i:s') : null,
            'endAt' => $this->endAt ? $this->endAt->format('Y-m-d H:i:s') : null,
            'formats' => array_map(function (Format $format) {
                return $format->getId();
            }, $this->formats),
            'maxPeople' => $this->maxPeople,
            'public' => $this->public,
            'price' => $this->price,
            'description' => $this->description,
            'autoConfirmEnrollment' => $this->autoConfirmEnrollment,
            'externalRegistration' => !!$this->externalRegistration,
            'externalRegistrationUrl' => $this->externalRegistrationUrl,
            'address' => [
                'name' => $this->address->getName(),
                'type' => $this->address->getType(),
                'street' => $this->address->getStreet(),
                'additional' => $this->address->getAdditional(),
                'geoname' => $this->address->getGeoname() ? $this->address->getGeoname()->getId() : null,
                'latitude' => $this->address->getLatitude(),
                'longitude' => $this->address->getLongitude(),
            ],
            'uuid' => $this->uuid,
            'uuidb58' => $this->uuidb58,
        ];
    }

    /** @var string|null */
    protected $step;

    /** @var string|null */
    protected $state;

    /** @var string|null */
    protected $name;

    /** @var \DateTime|null */
    protected $startAt;

    /** @var \DateTime|null */
    protected $endAt;

    /** @var array<Format> */
    protected $formats = [];

    /** @var string|null */
    protected $type;

    /** @var int|null */
    protected $maxPeople;

    /** @var bool|null */
    protected $public;

    /** @var User|null */
    protected $createdBy;

    /** @var string|null */
    protected $price;

    /** @var string|null */
    protected $description;

    /** @var bool|null */
    protected $autoConfirmEnrollment;

    /** @var bool|null */
    protected $externalRegistration;

    /** @var string|null */
    protected $externalRegistrationUrl;

    /** @var Address|null */
    protected $address;

    /** @var string|null */
    protected $code;

    /** @var boolean|null */
    protected $recurring;

    /** @var boolean|null */
    protected $href;

    /** @var string|null */
    protected $uuid;

    /** @var string|null */
    protected $uuidb58;

    /** @var string|null */
    protected $publication;

    /**
     * @return mixed|string|null
     */
    public function getStep()
    {
        return $this->step;
    }

    /**
     * @param mixed|string|null $step
     *
     * @return Event
     */
    public function setStep($step)
    {
        $this->step = $step;

        return $this;
    }

    /**
     * @return mixed|string|null
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param mixed|string|null $state
     *
     * @return Event
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @return mixed|string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed|string|null $name
     *
     * @return Event
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getStartAt(): ?\DateTime
    {
        return $this->startAt;
    }

    public function setStartAt(?\DateTime $startAt)
    {
        $this->startAt = $startAt;

        return $this;
    }

    public function getEndAt(): ?\DateTime
    {
        return $this->endAt;
    }

    public function setEndAt(?\DateTime $endAt)
    {
        $this->endAt = $endAt;

        return $this;
    }

    public function getFormats(): array
    {
        return $this->formats;
    }

    public function setFormats(array $formats)
    {
        $this->formats = $formats;

        return $this;
    }

    /**
     * @return mixed|string|null
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed|string|null $type
     *
     * @return Event
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return int|mixed|null
     */
    public function getMaxPeople()
    {
        return $this->maxPeople;
    }

    /**
     * @param int|mixed|null $maxPeople
     *
     * @return Event
     */
    public function setMaxPeople($maxPeople)
    {
        $this->maxPeople = $maxPeople;

        return $this;
    }

    /**
     * @return bool|mixed|null
     */
    public function getPublic()
    {
        return $this->public;
    }

    /**
     * @param bool|mixed|null $public
     *
     * @return Event
     */
    public function setPublic($public)
    {
        $this->public = $public;

        return $this;
    }

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?User $createdBy)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * @return mixed|string|null
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed|string|null $price
     *
     * @return Event
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return mixed|string|null
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed|string|null $description
     *
     * @return Event
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return bool|mixed|null
     */
    public function getAutoConfirmEnrollment()
    {
        return $this->autoConfirmEnrollment;
    }

    /**
     * @param bool|mixed|null $autoConfirmEnrollment
     *
     * @return Event
     */
    public function setAutoConfirmEnrollment($autoConfirmEnrollment)
    {
        $this->autoConfirmEnrollment = $autoConfirmEnrollment;

        return $this;
    }

    /**
     * @return bool|mixed|null
     */
    public function getExternalRegistration()
    {
        return $this->externalRegistration;
    }

    /**
     * @param bool|mixed|null $externalRegistration
     *
     * @return Event
     */
    public function setExternalRegistration($externalRegistration)
    {
        $this->externalRegistration = $externalRegistration;

        return $this;
    }

    /**
     * @return mixed|string|null
     */
    public function getExternalRegistrationUrl()
    {
        return $this->externalRegistrationUrl;
    }

    /**
     * @param mixed|string|null $externalRegistrationUrl
     *
     * @return Event
     */
    public function setExternalRegistrationUrl($externalRegistrationUrl)
    {
        $this->externalRegistrationUrl = $externalRegistrationUrl;

        return $this;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function setAddress(?Address $address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return mixed|string|null
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed|string|null $code
     *
     * @return Event
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return bool|mixed|null
     */
    public function getRecurring()
    {
        return $this->recurring;
    }

    /**
     * @param bool|mixed|null $recurring
     *
     * @return Event
     */
    public function setRecurring($recurring)
    {
        $this->recurring = $recurring;

        return $this;
    }

    /**
     * @return bool|mixed|null
     */
    public function getHref()
    {
        return $this->href;
    }

    /**
     * @param bool|mixed|null $href
     *
     * @return Event
     */
    public function setHref($href)
    {
        $this->href = $href;

        return $this;
    }

    /**
     * @return mixed|string|null
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * @param mixed|string|null $uuid
     *
     * @return Event
     */
    public function setUuid($uuid)
    {
        $this->uuid = $uuid;

        return $this;
    }

    /**
     * @return mixed|string|null
     */
    public function getUuidb58()
    {
        return $this->uuidb58;
    }

    /**
     * @param mixed|string|null $uuidb58
     *
     * @return Event
     */
    public function setUuidb58($uuidb58)
    {
        $this->uuidb58 = $uuidb58;

        return $this;
    }

    public function getPublication(): ?string
    {
        return $this->publication;
    }

    public function setPublication(?string $publication)
    {
        $this->publication = $publication;

        return $this;
    }
}