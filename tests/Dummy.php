<?php
namespace Soukicz\ClassMetadataParser\Tests;

use Soukicz\ClassMetadataParser\Model\ClassMetadata;

class Dummy
{

    public function getNoType()
    {

    }

    public function getBuiltInType(): string
    {
        return '';
    }

    public function getBuiltInTypeNull():?string
    {
        return null;
    }

    public function getCustomType(): ClassMetadata
    {
        return new ClassMetadata([], new \ReflectionClass(self::class));
    }

    public function getCustomNull():?ClassMetadata
    {
        return null;
    }

    /**
     * @return string
     */
    public function getAnnotationBuiltInType(): string
    {
        return '';
    }

    /**
     * @return null|string
     */
    public function getAnnotationBuiltInTypeNull():?string
    {
        return null;
    }

    /**
     * @return ClassMetadata
     */
    public function getAnnotationCustomType(): ClassMetadata
    {
        return new ClassMetadata([], new \ReflectionClass(self::class));
    }

    /**
     * @return null|ClassMetadata
     */
    public function getAnnotationCustomNull():?ClassMetadata
    {
        return null;
    }

    /**
     * @return string[]
     */
    public function getCollectionAnnotationBuiltInType()
    {
        return [];
    }

    /**
     * @return null|string[]
     */
    public function getCollectionAnnotationBuiltInTypeNull()
    {
        return null;
    }

    /**
     * @return ClassMetadata[]
     */
    public function getCollectionAnnotationCustomType()
    {
        return [];
    }

    /**
     * @return null|ClassMetadata[]
     */
    public function getCollectionAnnotationCustomNull()
    {
        return null;
    }

    public function getDummy():?Dummy
    {
        return null;
    }

    /**
     * @return null|Dummy
     */
    public function getDummyAnnotation():?Dummy
    {
        return null;
    }

    public function getSelf():?self
    {
        return null;
    }

    /**
     * @return null|self
     */
    public function getSelfAnnotation():?self
    {
        return null;
    }
}
