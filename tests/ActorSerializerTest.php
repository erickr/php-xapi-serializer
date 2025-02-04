<?php

/*
 * This file is part of the xAPI package.
 *
 * (c) Christian Flothmann <christian.flothmann@xabbuh.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xabbuh\XApi\Serializer\Tests;

use Xabbuh\XApi\Model\Actor;

/**
 * @author Christian Flothmann <christian.flothmann@xabbuh.de>
 */
abstract class ActorSerializerTest extends SerializerTest
{
    private $actorSerializer;

    protected function setUp(): void
    {
        $this->actorSerializer = $this->createActorSerializer();
    }

    /**
     * @dataProvider serializeData
     */
    public function testSerializeActor(Actor $actor, $expectedJson)
    {
        $this->assertJsonStringEqualsJsonString($expectedJson, $this->actorSerializer->serializeActor($actor));
    }

    /**
     * @return array
     */
    public function serializeData()
    {
        return $this->buildSerializeTestCases('Actor');
    }

    /**
     * @dataProvider deserializeData
     */
    public function testDeserializeActor($json, Actor $expectedActor)
    {
        $actor = $this->actorSerializer->deserializeActor($json);

        $this->assertInstanceOf('Xabbuh\XApi\Model\Actor', $actor);
        $this->assertTrue($expectedActor->equals($actor), 'Deserialized actor has the expected properties');
    }

    /**
     * @return array
     */
    public function deserializeData()
    {
        return $this->buildDeserializeTestCases('Actor');
    }

    abstract protected function createActorSerializer();
}
