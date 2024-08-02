<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class MapsController extends Controller
{
    public function maps()
    {

        $frequentLocations = $this->getFrequentLocations();
        $locationSellers = [];


        return view('maps', compact('frequentLocations', 'locationSellers'));
    }




    public function getFrequentLocations()
    {
        return Cache::remember('frequent_locations', 60, function () {
            return DB::table('longlat_fix')
                ->select('longitude', 'latitude', DB::raw('count(*) as total'))
                ->groupBy('longitude', 'latitude')
                ->orderByDesc('total')
                ->take(10)
                ->get()
                ->map(function ($item) {
                    return [
                        'longitude' => $item->longitude,
                        'latitude' => $item->latitude,
                        'count' => $item->total,
                    ];
                });
        });
    }


    public function getLocationSellers(Request $request)
    {
        $latitude = trim($request->input('latitude'));
        $longitude = trim($request->input('longitude'));

        if ($latitude && $longitude) {
            $sellers = Cache::remember("location_sellers_{$longitude}_{$latitude}", 60, function () use ($longitude, $latitude) {
                return DB::table('longlat_fix')
                    ->where('longitude', $longitude)
                    ->where('latitude', $latitude)
                    ->select('kode', 'nama', DB::raw('count(*) as count'), DB::raw('MAX(tanggal) as tanggal_baru'))
                    ->groupBy('kode', 'nama')
                    ->get();
            });
            return response()->json($sellers);
        }
        return response()->json([]);
    }

    public function getLocationsByKode(Request $request)
    {
        $kode = trim($request->input('kode'));

        if ($kode) {
            $locations = DB::table('longlat_fix')
                ->where('kode', $kode)
                ->select('longitude', 'latitude', 'tanggal', 'nama', DB::raw('count(*) as count'))
                ->groupBy('longitude', 'latitude', 'tanggal', 'nama')
                ->get();

            return response()->json($locations);
        }
        return response()->json([]);
    }
}
