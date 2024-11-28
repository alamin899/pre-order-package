<?php

namespace PreOrder\PreOrderBackend\Http\Controllers\Web;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use PreOrder\PreOrderBackend\Features\PreorderDestroyFeature;
use PreOrder\PreOrderBackend\Http\Controllers\Controller;

class PreorderDestroyController extends Controller
{
    public function __invoke($id): RedirectResponse
    {
        try {
            $response = (new PreorderDestroyFeature(id: $id))->handle();
            if ($response) {
                return redirect()->route('dashboard.preorders')->with('success', 'Pre order deleted successfully.');
            }
            return redirect()->route('dashboard.preorders')->with('error', 'Something went wrong.');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('dashboard.preorders')->with('error', 'Pre order not found.');
        }
    }
}