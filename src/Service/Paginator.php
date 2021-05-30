<?php

namespace App\Service;

use Hateoas\Helper\LinkHelper;
use Hateoas\Representation\CollectionRepresentation;
use Hateoas\Representation\PaginatedRepresentation;



class Paginator
{

    const LIMIT = 5;


    public function paginate($repository, string $path, int $page, array $criteria = []): PaginatedRepresentation
    {
        if($criteria){
            $total = count($repository->findBy($criteria));
        } else {
            $total = count($repository->findAll());
        }
        $totalPages = ceil($total / self::LIMIT);

        return new PaginatedRepresentation(
            new CollectionRepresentation($repository->findBy($criteria, limit: self::LIMIT, offset: ($page * self::LIMIT - self::LIMIT))),
            $path,
            [],
            $page,
            self::LIMIT,
            $totalPages,
            'page',
            null,
            true,
            $total
        );

    }

    public function getPaginatedResponse($data)
    {
        $data = json_decode($data, true);
        $meta= [
            'page'=>$data['page'],
            'pages'=>$data['pages'],
            'limit'=>$data['limit'],
            'total'=>$data['total'],
            'links'=>$data['_links'],
        ];
        $content = $data['_embedded']['items'];
        return ['meta'=>$meta, 'content' => $content];
    }

}