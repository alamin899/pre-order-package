<?php

namespace PreOrder\PreOrderBackend\Operations;

use Illuminate\Http\Request;

class ProductSearchValue
{
    public function __construct(
        private Request   $request,
    )
    {
    }

    public function format(): array
    {
        $perPage = $this->request->get("perPage",15);

        if ($perPage>50){
            $perPage = 50;
        }

        return [
            'query' => $this->request->get('query', ''),
            'sortable' => $this->request->get('sortBy', ''),
            'per_page' => $perPage,
        ];
    }
}