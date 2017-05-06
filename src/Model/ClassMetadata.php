<?php

namespace Soukicz\ClassMetadataParser\Model;

class ClassMetadata
{
    /**
     * @var MethodMetadata[]
     */
    private $methods;

    /**
     * @var \ReflectionClass
     */
    private $reflection;

    public function __construct(array $methods,\ReflectionClass $reflection)
    {
        $this->methods = $methods;
        $this->reflection = $reflection;
    }

    /**
     * @return MethodMetadata[]
     */
    public function getMethods(): array
    {
        return $this->methods;
    }

    public function getMethod(string $methodName): MethodMetadata
    {
        return $this->methods[$methodName];
    }

    public function isInterface(): bool
    {
        return $this->reflection->isInterface();
    }

    public function isAbstract(): bool
    {
        return $this->reflection->isAbstract();
    }
}
