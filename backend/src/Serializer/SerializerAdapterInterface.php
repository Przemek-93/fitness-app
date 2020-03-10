<?php


namespace App\Serializer;


interface SerializerAdapterInterface
{

    public function serialize($items, array $groups = ['json']);

    public function deserialize(string $post, string $entityName, array $groups = ['json']);
}