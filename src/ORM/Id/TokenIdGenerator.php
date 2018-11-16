<?php declare(strict_types=1);

namespace App\ORM\Id;

use App\Utils\TokenGenerator;
use Doctrine\ORM\Id\AbstractIdGenerator;
use Doctrine\ORM\EntityManager;

class TokenIdGenerator extends AbstractIdGenerator
{
    /**
     * @param EntityManager $em
     * @param null|object $entity
     * @return string
     */
    public function generate(EntityManager $em, $entity): string
    {
        return TokenGenerator::generate(6);
    }
}
