<?php

namespace App\GraphQL\Resolver;

use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

class AnimeResolver implements ResolverInterface
{
    public function __invoke()
    {
        return [];
    }
}