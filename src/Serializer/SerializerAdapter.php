<?php


namespace App\Serializer;


use JMS\Serializer\DeserializationContext;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;

class SerializerAdapter implements SerializerAdapterInterface
{

    protected SerializerInterface $serializer;

    public function __construct(
        SerializerInterface $serializer
    ) {
        $this->serializer = $serializer;
    }

    public function serialize($items, array $groups = ['json']): string
    {
        $serializerContext = SerializationContext::create()
            ->setGroups($groups);

        return $this->serializer->serialize($items, 'json', $serializerContext);
    }

    public function deserialize(string $post, string $entityName, array $groups = ['json'])
    {
        $deserializationContext = DeserializationContext::create()
            ->setGroups($groups);

        return $this->serializer->deserialize($post, $entityName, 'json', $deserializationContext);
    }
}