<?php

namespace  App\Service;

use App\Entity\Agents;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class DataDenormalizer implements DenormalizerInterface
{
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = [])
    {
        if ($data['isPlayableCharacter'] === true && !empty($data)) {
            $agent = new Agents();
            $agent->setDisplayName($data['displayName']);
            $agent->setBustPortrait($data['bustPortrait']);
            $agent->setRole($data['role'] ?? []);
            $agent->setAbilities($data['abilities'] ?? []);
            $agent->setUuid($data['uuid']);
            $agent->setDescription($data['description']);
            return $agent;
        }
        return null;
        if ($data === null) {
        }
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === Agents::class;
    }
}
