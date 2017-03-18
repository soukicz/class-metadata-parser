<?php
namespace Soukicz\ClassMetadataParser;

use Doctrine\Common\Annotations\PhpParser;
use Doctrine\Common\Annotations\Reader;
use Soukicz\ClassMetadataParser\Annotation\CollectionDefinition;
use Soukicz\ClassMetadataParser\Model\ClassMetaData;
use Soukicz\ClassMetadataParser\Model\MethodMetadata;
use Soukicz\ClassMetadataParser\Model\ReturnMetadata;

class ClassMetadataParser {
    /**
     * @var Reader
     */
    private $annotationReader;

    /**
     * @var PhpParser
     */
    private $phpParser;

    public function __construct(Reader $annotationReader) {
        $this->annotationReader = $annotationReader;
        $this->phpParser = new PhpParser();
    }

    /**
     * @var ClassMetaData[]
     */
    private $cache = [];

    public function getClass(string $className): ClassMetadata {
        if(!isset($this->cache[$className])) {
            $reflectionClass = new \ReflectionClass($className);
            $methods = [];

            $imports = $this->phpParser->parseClass($reflectionClass);

            foreach ($reflectionClass->getMethods(\ReflectionMethod::IS_PUBLIC) as $method) {
                $mapping = $this->annotationReader->getMethodAnnotation($method, CollectionDefinition::class);
                $methods[$method->getName()] = new MethodMetadata(
                    $method->getName(),
                    self::getFieldName($method->getName()),
                    $this->getReturn($method, $imports),
                    $mapping instanceof CollectionDefinition ? $mapping->mapping : null
                );
            }

            $this->cache[$className] = new ClassMetadata($methods);
        }
        return $this->cache[$className];
    }

    private function isTypeBuiltIn(string $type) {
        return in_array($type, ['null', 'void', 'string', 'int', 'float', 'bool']);
    }

    private function getReturn(\ReflectionMethod $method, array $imports):?ReturnMetadata {
        $docBlock = $method->getDocComment();
        if(preg_match('~\s\*\s*@return\s+null\|([a-zA-Z0-9]+)(\[\])?~', $docBlock, $m)) {
            return new ReturnMetadata(
                $this->getFullQualifiedName($m[1], $imports),
                $this->isTypeBuiltIn($m[1]),
                true,
                !empty($m[2])
            );
        } elseif(preg_match('~\s\*\s*@return\s+([a-zA-Z0-9]+)(\[\])?(\|null)?~', $docBlock, $m)) {
            return new ReturnMetadata(
                $this->getFullQualifiedName($m[1], $imports),
                $this->isTypeBuiltIn($m[1]),
                !empty($m[3]),
                !empty($m[2])
            );
        } elseif($method->hasReturnType()) {
            return new ReturnMetadata(
                (string)$method->getReturnType(),
                $method->getReturnType()->isBuiltin(),
                $method->getReturnType()->allowsNull(),
                false
            );
        }
        return null;
    }

    private function getFullQualifiedName(string $alias, array $imports): string {
        $parts = explode('\\', $alias);
        $first = strtolower(array_shift($parts));
        if(isset($imports[$first])) {
            if(empty($parts)) {
                return $imports[$first];
            }
            return $imports[$first] . '\\' . implode('\\', $parts);
        }
        return $alias;
    }

    public static function getFieldName(string $methodName):?string {
        if(substr($methodName, 0, 3) !== 'get') {
            return null;
        }
        $name = substr($methodName, 3);
        $newName = '';
        $length = strlen($name);
        for ($i = 0; $i < $length; $i++) {
            if($i == 0) {
                $newName = strtolower($name[$i]);
            } elseif(strtolower($name[$i]) === $name[$i]) {
                $newName .= $name[$i];
            } else {
                $newName .= '_' . strtolower($name[$i]);
            }
        }
        return $newName;
    }
}