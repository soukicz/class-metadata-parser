<?php
namespace Soukicz\ClassMetadataParser\Tests;

class Dummy {

    public function getNoType() {

    }

    public function getBuiltInType(): string {
        return '';
    }

    public function getBuiltInTypeNull():?string {
        return null;
    }

    public function getCustomType(): Dummy {
        return new Dummy;
    }

    public function getCustomNull():?Dummy {
        return null;
    }

    /**
     * @return string
     */
    public function getAnnotationBuiltInType(): string {
        return '';
    }

    /**
     * @return null|string
     */
    public function getAnnotationBuiltInTypeNull():?string {
        return null;
    }

    /**
     * @return Dummy
     */
    public function getAnnotationCustomType(): Dummy {
        return new Dummy();
    }

    /**
     * @return null|Dummy
     */
    public function getAnnotationCustomNull():?Dummy {
        return null;
    }

    /**
     * @return string[]
     */
    public function getCollectionAnnotationBuiltInType() {
        return [];
    }

    /**
     * @return null|string[]
     */
    public function getCollectionAnnotationBuiltInTypeNull() {
        return null;
    }

    /**
     * @return Dummy[]
     */
    public function getCollectionAnnotationCustomType() {
        return [];
    }

    /**
     * @return null|Dummy[]
     */
    public function getCollectionAnnotationCustomNull() {
        return null;
    }
}
