<?php

namespace Soukicz\ClassMetadataParser\Annotation;

use Doctrine\Common\Annotations\Annotation;

/**
 * @Annotation
 * @Target("METHOD")
 */
class CollectionDefinition extends Annotation {
    /**
     * @var string
     */
    public $mapping;
}
