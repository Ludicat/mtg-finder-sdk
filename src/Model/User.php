<?php
/**
 * @licence Proprietary
 */

namespace Ludicat\MtgFinder\Model;

/**
 * class User
 *
 * @author Joseph Lemoine<j.lemoine@ludi.cat>
 */
class User
{
    public function __construct(array $data = [])
    {
        $this->username = $data['username'] ?? null;
        $this->displayName = $data['displayName'] ?? null;
        $this->isVerified = $data['isVerified'] ?? null;
        $this->playedFormats = array_map(function (array $format) {
            return new Format($format);
        }, $data['playedFormats'] ?? []);
        $this->favoriteFormat = array_map(function (array $format) {
            return new Format($format);
        }, $data['favoriteFormat'] ?? []);
        $this->uuid = $data['uuid'] ?? null;
        $this->uuidb58 = $data['uuidb58'] ?? null;
    }

    /** @var string|null */
    protected $username;

    /** @var string|null */
    protected $displayName;

    /** @var bool|null */
    protected $isVerified;

    /** @var array<Format> */
    protected $playedFormats = [];

    /** @var array<Format> */
    protected $favoriteFormat = [];

    /** @var string|null */
    protected $uuid;

    /** @var string|null */
    protected $uuidb58;

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username)
    {
        $this->username = $username;

        return $this;
    }

    public function getDisplayName(): ?string
    {
        return $this->displayName;
    }

    public function setDisplayName(?string $displayName)
    {
        $this->displayName = $displayName;

        return $this;
    }

    public function getIsVerified(): ?bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(?bool $isVerified)
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getPlayedFormats(): array
    {
        return $this->playedFormats;
    }

    public function setPlayedFormats(array $playedFormats)
    {
        $this->playedFormats = $playedFormats;

        return $this;
    }

    public function getFavoriteFormat(): array
    {
        return $this->favoriteFormat;
    }

    public function setFavoriteFormat(array $favoriteFormat)
    {
        $this->favoriteFormat = $favoriteFormat;

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