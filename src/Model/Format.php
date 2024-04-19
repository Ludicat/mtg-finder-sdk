<?php
/**
 * @licence Proprietary
 */

namespace Ludicat\MtgFinder\Model;

/**
 * class Format
 *
 * @author Joseph Lemoine<j.lemoine@ludi.cat>
 */
class Format
{
    public function __construct(
        array $data = []
    )
    {
        $this->id = $data['id'] ?? null;
        $this->name = $data['name'] ?? null;
        $this->description = $data['description'] ?? null;
        $this->preferred = $data['preferred'] ?? null;
    }

    /** @var int|null */
    protected $id;

    /** @var string|null */
    protected $name;

    /** @var string|null */
    protected $description;

    /** @var bool|null */
    protected $preferred;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id)
    {
        $this->id = $id;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description)
    {
        $this->description = $description;

        return $this;
    }

    public function isPreferred(): ?bool
    {
        return $this->preferred;
    }

    public function setPreferred(?bool $preferred)
    {
        $this->preferred = $preferred;

        return $this;
    }
}
