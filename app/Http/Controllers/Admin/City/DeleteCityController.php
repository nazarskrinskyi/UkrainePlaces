<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin\City;

use App\Models\City;
use Illuminate\Http\RedirectResponse;

class DeleteCityController
{
    public function destroy($id): RedirectResponse
    {
        City::destroy($id);
        return redirect()->route('admin.city.index')->with('success', 'City deleted successfully.');
    }
}
