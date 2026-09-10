<?php

namespace App\Livewire\Guest\Kuliner;

use App\Models\Category;
// use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.guest')]
class Index extends Component
{
    public function render()
    {
        $categories = Category::query()
            ->select([
                'id',
                'nama',
                'slug',
            ])
            ->whereHas('menus')
            ->with([
                'menus' => fn ($query) => $query
                    ->select([
                        'id',
                        'category_id',
                        'nama',
                        'slug',
                        'harga',
                        'foto',
                        'deskripsi',
                    ])
                    ->latest('id'),
            ])
            ->get()
            ->map(function (Category $category) {
                $category->setRelation(
                    'menus',
                    $category->menus->take(5)
                );

                return $category;
        });

        // Ganti ke kode yang sudah di-caching ini saat production 

        // $categories = Cache::remember(
        //     'kuliner_categories',
        //     now()->addHours(6),
        //     fn () => Category::query()
        //         ->select(['id', 'nama', 'slug'])
        //         ->whereHas('menus')
        //         ->with([
        //             'menus' => fn ($query) => $query
        //                 ->select([
        //                     'id',
        //                     'category_id',
        //                     'nama',
        //                     'slug',
        //                     'harga',
        //                     'foto',
        //                     'deskripsi',
        //                 ])
        //                 ->latest('id'),
        //         ])
        //         ->get()
        //         ->map(function (Category $category) {
        //             $category->setRelation(
        //                 'menus',
        //                 $category->menus->take(5)
        //             );

        //             return $category;
        //         })
        // );

        return view('livewire.guest.kuliner.index', [
            'categories' => $categories,
        ]);
    }
}