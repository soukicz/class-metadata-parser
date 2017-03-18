<?php

namespace Soukicz\ClassMetadataParser\Model;

class MethodMetadata
{

    /**
     * @var string
     */
    private $name;

    /**
     * @var null|string
     */
    private $fieldName;

    /**
     * @var ReturnMetadata|null
     */
    private $return;

    /**
     * @var string|null
     */
    private $mapping;

    public function __construct(string $name, ?string $fieldName, ?ReturnMetadata $return, string $mapping = null)
    {
        $this->name = $name;
        $this->fieldName = $fieldName;
        $this->return = $return;
        $this->mapping = $mapping;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getFieldName(): ?string
    {
        return $this->fieldName;
    }

    public function getReturn():?ReturnMetadata
    {
        return $this->return;
    }

    public function getMapping():?string
    {
        return $this->mapping;
    }
}
