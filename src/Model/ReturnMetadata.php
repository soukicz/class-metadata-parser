<?php
namespace Soukicz\ClassMetadataParser\Model;

class ReturnMetadata {
    /**
     * @var string
     */
    private $type;
    /**
     * @var bool
     */
    private $builtin, $allowsNull, $collection;

    public function __construct(string $type, bool $builtin, bool $allowsNull, bool $collection) {
        $this->type = $type;
        $this->builtin = $builtin;
        $this->allowsNull = $allowsNull;
        $this->collection = $collection;
    }

    public function getType(): string {
        return $this->type;
    }

    public function isBuiltin(): bool {
        return $this->builtin;
    }

    public function allowsNull(): bool {
        return $this->allowsNull;
    }

    public function isCollection(): bool {
        return $this->collection;
    }


}
