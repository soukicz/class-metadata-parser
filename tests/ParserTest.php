<?php
namespace Soukicz\ClassMetadataParser\Tests;

use Doctrine\Common\Annotations\AnnotationReader;
use PHPUnit\Framework\TestCase;
use Soukicz\ClassMetadataParser\ClassMetadataParser;
use Soukicz\ClassMetadataParser\Model\ClassMetadata;


class ParserTest extends TestCase {

    function testMethodCount() {
        $this->assertCount(17, $this->getParser()->getClass(Dummy::class)->getMethods());
    }

    function testReturnTypes() {
        $data = $this->getParser()->getClass(Dummy::class);

        $this->assertNull($data->getMethod('getNoType')->getReturn());

        // simple return

        $this->assertEquals('string', $data->getMethod('getBuiltInType')->getReturn()->getType());
        $this->assertTrue($data->getMethod('getBuiltInType')->getReturn()->isBuiltin());
        $this->assertFalse($data->getMethod('getBuiltInType')->getReturn()->isCollection());
        $this->assertFalse($data->getMethod('getBuiltInType')->getReturn()->allowsNull());

        $this->assertEquals('string', $data->getMethod('getBuiltInTypeNull')->getReturn()->getType());
        $this->assertTrue($data->getMethod('getBuiltInTypeNull')->getReturn()->isBuiltin());
        $this->assertFalse($data->getMethod('getBuiltInTypeNull')->getReturn()->isCollection());
        $this->assertTrue($data->getMethod('getBuiltInTypeNull')->getReturn()->allowsNull());

        $this->assertEquals(ClassMetadata::class, $data->getMethod('getCustomType')->getReturn()->getType());
        $this->assertFalse($data->getMethod('getCustomType')->getReturn()->isBuiltin());
        $this->assertFalse($data->getMethod('getCustomType')->getReturn()->isCollection());
        $this->assertFalse($data->getMethod('getCustomType')->getReturn()->allowsNull());


        $this->assertEquals(ClassMetadata::class, $data->getMethod('getCustomNull')->getReturn()->getType());
        $this->assertFalse($data->getMethod('getCustomNull')->getReturn()->isBuiltin());
        $this->assertFalse($data->getMethod('getCustomNull')->getReturn()->isCollection());
        $this->assertTrue($data->getMethod('getCustomNull')->getReturn()->allowsNull());

        // annotations

        $this->assertEquals('string', $data->getMethod('getAnnotationBuiltInType')->getReturn()->getType());
        $this->assertTrue($data->getMethod('getAnnotationBuiltInType')->getReturn()->isBuiltin());
        $this->assertFalse($data->getMethod('getAnnotationBuiltInType')->getReturn()->isCollection());
        $this->assertFalse($data->getMethod('getAnnotationBuiltInType')->getReturn()->allowsNull());

        $this->assertEquals('string', $data->getMethod('getAnnotationBuiltInTypeNull')->getReturn()->getType());
        $this->assertTrue($data->getMethod('getAnnotationBuiltInTypeNull')->getReturn()->isBuiltin());
        $this->assertFalse($data->getMethod('getAnnotationBuiltInTypeNull')->getReturn()->isCollection());
        $this->assertTrue($data->getMethod('getAnnotationBuiltInTypeNull')->getReturn()->allowsNull());

        $this->assertEquals(ClassMetadata::class, $data->getMethod('getAnnotationCustomType')->getReturn()->getType());
        $this->assertFalse($data->getMethod('getAnnotationCustomType')->getReturn()->isBuiltin());
        $this->assertFalse($data->getMethod('getAnnotationCustomType')->getReturn()->isCollection());
        $this->assertFalse($data->getMethod('getAnnotationCustomType')->getReturn()->allowsNull());

        $this->assertEquals(ClassMetadata::class, $data->getMethod('getAnnotationCustomNull')->getReturn()->getType());
        $this->assertFalse($data->getMethod('getAnnotationCustomNull')->getReturn()->isBuiltin());
        $this->assertFalse($data->getMethod('getAnnotationCustomNull')->getReturn()->isCollection());
        $this->assertTrue($data->getMethod('getAnnotationCustomNull')->getReturn()->allowsNull());

        // collections

        $this->assertEquals('string', $data->getMethod('getCollectionAnnotationBuiltInType')->getReturn()->getType());
        $this->assertTrue($data->getMethod('getCollectionAnnotationBuiltInType')->getReturn()->isBuiltin());
        $this->assertTrue($data->getMethod('getCollectionAnnotationBuiltInType')->getReturn()->isCollection());
        $this->assertFalse($data->getMethod('getCollectionAnnotationBuiltInType')->getReturn()->allowsNull());

        $this->assertEquals('string', $data->getMethod('getCollectionAnnotationBuiltInTypeNull')->getReturn()->getType());
        $this->assertTrue($data->getMethod('getCollectionAnnotationBuiltInTypeNull')->getReturn()->isBuiltin());
        $this->assertTrue($data->getMethod('getCollectionAnnotationBuiltInTypeNull')->getReturn()->isCollection());
        $this->assertTrue($data->getMethod('getCollectionAnnotationBuiltInTypeNull')->getReturn()->allowsNull());

        $this->assertEquals(ClassMetadata::class, $data->getMethod('getCollectionAnnotationCustomType')->getReturn()->getType());
        $this->assertFalse($data->getMethod('getCollectionAnnotationCustomType')->getReturn()->isBuiltin());
        $this->assertTrue($data->getMethod('getCollectionAnnotationCustomType')->getReturn()->isCollection());
        $this->assertFalse($data->getMethod('getCollectionAnnotationCustomType')->getReturn()->allowsNull());


        $this->assertEquals(ClassMetadata::class, $data->getMethod('getCollectionAnnotationCustomNull')->getReturn()->getType());
        $this->assertFalse($data->getMethod('getCollectionAnnotationCustomNull')->getReturn()->isBuiltin());
        $this->assertTrue($data->getMethod('getCollectionAnnotationCustomNull')->getReturn()->isCollection());
        $this->assertTrue($data->getMethod('getCollectionAnnotationCustomNull')->getReturn()->allowsNull());

    }

    public function testSelfReturn() {
        $data = $this->getParser()->getClass(Dummy::class);
        $this->assertEquals(Dummy::class, $data->getMethod('getDummy')->getReturn()->getType());
        $this->assertEquals(Dummy::class, $data->getMethod('getDummyAnnotation')->getReturn()->getType());

        $this->assertEquals(Dummy::class, $data->getMethod('getSelf')->getReturn()->getType());
        $this->assertEquals(Dummy::class, $data->getMethod('getSelfAnnotation')->getReturn()->getType());
    }

    function testFieldFromMethod() {
        $this->assertEquals('name', ClassMetadataParser::getFieldName('getName'));
        $this->assertEquals('top_name', ClassMetadataParser::getFieldName('getTopName'));
    }

    private function getParser(): ClassMetadataParser {
        return new ClassMetadataParser(new AnnotationReader());
    }
}
