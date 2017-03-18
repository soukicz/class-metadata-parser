<?php

namespace Soukicz\ClassMetadataParser\Model;

class ClassMetadata {
    /**
     * @var MethodMetadata[]
     */
    private $methods;

    function __construct(array $methods) {
        $this->methods = $methods;
    }

    /**
     * @return MethodMetadata[]
     */
    public function getMethods(): array {
        return $this->methods;
    }

    public function getMethod(string $methodName): MethodMetadata {
        return $this->methods[$methodName];
    }
}
