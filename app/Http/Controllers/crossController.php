<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CrossController extends Controller
{
    public function crossSelling()
    {
        $topLocationData = $this->getTopSellers('longlat_fix', 'kode');
        $topActivityData = $this->getTopSellers('cross_fix', 'id_owner');
        $commonSellersCount = $this->getCommonSellersDetails($topActivityData);
        $keyInteractions = $this->getKeyInteractions();
        $tableInteractions = $this->gettable();
        $fullLocationData = $this->getToplonglat('longlat_fix', 'kode');
        $fullcrossdata = $this->getTopcross('cross_fix', 'id_owner');
        // dd($tableInteractions);
        return view('cross_top', compact('topActivityData', 'topLocationData', 'commonSellersCount', 'keyInteractions', 'tableInteractions', 'fullLocationData', 'fullcrossdata'));
    }


    private function getTopSellers($table, $column)
    {
        return DB::table($table)
            ->select($column, DB::raw('count(*) as total'))
            ->groupBy($column)
            ->orderByDesc('total')
            ->take(10)
            ->pluck('total', $column);
    }
    private function getToplonglat($table, $column)
    {
        return DB::table($table)
            ->select($column, 'nama', DB::raw('count(*) as total'))
            ->groupBy($column, 'nama')
            ->orderByDesc('total')
            ->get();
    }
    private function getTopcross($table, $column)
    {
        return DB::table($table)
            ->select($column, 'nama_owner', DB::raw('count(*) as total'))
            ->groupBy($column, 'nama_owner')
            ->orderByDesc('total')
            ->get();
    }


    private function getCommonSellersDetails($topSellersCrossSelling)
    {
        $crossSellingIds = $topSellersCrossSelling->keys()->toArray();

        return DB::table('longlat_fix')
            ->whereIn('kode', $crossSellingIds)
            ->select('kode', DB::raw('count(*) as total'))
            ->groupBy('kode')
            ->pluck('total', 'kode');
    }

    private function getKeyInteractions()
    {
        $crossSellingData = DB::table('cross_fix')->get();
        $longlatSellerData = DB::table('longlat_fix')->get()->keyBy(function ($item) {
            return $item->kode . '_' . $item->tanggal;
        });

        $mergedData = $crossSellingData->map(function ($item) use ($longlatSellerData) {
            // Gabungkan berdasarkan id_owner dan tanggal
            $ownerKey = $item->id_owner . '_' . $item->tanggal;
            if (isset($longlatSellerData[$ownerKey])) {
                $longlatItem = $longlatSellerData[$ownerKey];
                $item->Longitude_Penyuplai = $longlatItem->longitude;
                $item->Latitude_Penyuplai = $longlatItem->latitude;
                $item->Nama_Penyuplai = $longlatItem->nama;
            } else {
                $item->Longitude_Penyuplai = null;
                $item->Latitude_Penyuplai = null;
                $item->Nama_Penyuplai = null;
            }

            // Gabungkan berdasarkan id_pembeli dan tanggal
            $pembeliKey = $item->id_pembeli . '_' . $item->tanggal;
            if (isset($longlatSellerData[$pembeliKey])) {
                $longlatItem = $longlatSellerData[$pembeliKey];
                $item->Longitude_Pembeli = $longlatItem->longitude;
                $item->Latitude_Pembeli = $longlatItem->latitude;
                $item->Nama_Pembeli = $longlatItem->nama;
            } else {
                $item->Longitude_Pembeli = null;
                $item->Latitude_Pembeli = null;
                $item->Nama_Pembeli = null;
            }

            return $item;
        });

        $result = $mergedData->groupBy(function ($item) {
            return $item->id_owner . ' & ' . $item->id_pembeli . ' & ' . $item->tanggal . ' & ' .
                $item->nama_owner . ' & ' . $item->nama_pembeli . ' & ' .
                ($item->Longitude_Penyuplai ?? '') . ' & ' . ($item->Latitude_Penyuplai ?? '');
        })
            ->map->count()
            ->sortDesc();
        return $result;
    }
    private function gettable()
    {
        $crossSellingData = DB::table('cross_fix')->get();
        $longlatSellerData = DB::table('longlat_fix')->get()->keyBy(function ($item) {
            return $item->kode . '_' . $item->tanggal;
        });

        $mergedData = $crossSellingData->map(function ($item) use ($longlatSellerData) {
            // Gabungkan berdasarkan id_owner dan tanggal
            $ownerKey = $item->id_owner . '_' . $item->tanggal;
            if (isset($longlatSellerData[$ownerKey])) {
                $longlatItem = $longlatSellerData[$ownerKey];
                $item->Longitude_Penyuplai = $longlatItem->longitude;
                $item->Latitude_Penyuplai = $longlatItem->latitude;
                $item->Nama_Penyuplai = $longlatItem->nama;
            } else {
                $item->Longitude_Penyuplai = null;
                $item->Latitude_Penyuplai = null;
                $item->Nama_Penyuplai = null;
            }

            // Gabungkan berdasarkan id_pembeli dan tanggal
            $pembeliKey = $item->id_pembeli . '_' . $item->tanggal;
            if (isset($longlatSellerData[$pembeliKey])) {
                $longlatItem = $longlatSellerData[$pembeliKey];
                $item->Longitude_Pembeli = $longlatItem->longitude;
                $item->Latitude_Pembeli = $longlatItem->latitude;
                $item->Nama_Pembeli = $longlatItem->nama;
            } else {
                $item->Longitude_Pembeli = null;
                $item->Latitude_Pembeli = null;
                $item->Nama_Pembeli = null;
            }

            return $item;
        });

        $groupedData = $mergedData->groupBy(function ($item) {
            return $item->id_owner . ' & ' . $item->id_pembeli . ' & ' . $item->tanggal;
        });

        $result = $groupedData->map(function ($group) {
            $firstItem = $group->first();
            $longlat = $this->getLonglat($firstItem->Longitude_Penyuplai, $firstItem->Latitude_Penyuplai);
            return [
                'id_owner' => $firstItem->id_owner,
                'nama_owner' => $firstItem->nama_owner,
                'id_pembeli' => $firstItem->id_pembeli,
                'nama_pembeli' => $firstItem->nama_pembeli,
                'tanggal' => $firstItem->tanggal,
                'jumlah_kejadian' => $group->count(),
                'longlat' => $longlat,
            ];
        })->filter(function ($item) {
            return !empty($item['longlat']);
        });

        return $result->sortByDesc('jumlah_kejadian')->values()->all();
    }

    private function getLonglat($longitude, $latitude)
    {
        if (!empty($longitude) && !empty($latitude)) {
            return $longitude . ', ' . $latitude;
        }
        return null;
    }
}
