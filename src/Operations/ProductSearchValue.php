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

        $orderBy = $this->request->get("orderby");
        $orderBy = ($orderBy == "desc") ? "desc" : "asc";

        return [
            'query' => $this->request->get('query', ''),
            'order_by' => $orderBy,
            'column' => $this->request->get('column', 'id'),
            'per_page' => $perPage,
        ];
    }
}