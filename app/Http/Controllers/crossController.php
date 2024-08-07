<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CrossController extends Controller
{
    public function crossSelling(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');


        if (!$startDate || !$endDate) {
            $startDate = '2024-01-01';
            $endDate = date('Y-m-d');
        }

        $topLocationData = $this->getTopSellers('longlat_fix', 'kode');
        $topActivityData = $this->getTopSellers('cross_fix', 'id_owner');
        $commonSellersCount = $this->getCommonSellersDetails($topActivityData);
        $keyInteractions = $this->getKeyInteractions();
        $tableInteractions = $this->gettable();
        $fullLocationData = $this->getToplonglat('longlat_fix', 'kode');
        $fullcrossdata = $this->getTopcross('cross_fix', 'id_owner');
        $detailid = $this->gettabelid($startDate, $endDate);
        $id3months = $this->gettabel3();
        $threeMonthsData = $this->getThreeMonthsSummary($id3months);

        return view('cross_top', compact('topActivityData', 'topLocationData', 'commonSellersCount', 'keyInteractions', 'tableInteractions', 'fullLocationData', 'fullcrossdata','detailid', 'threeMonthsData','id3months'));
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

    private function gettabelid($startDate, $endDate)
    {
        $crossSellingData = DB::table('cross_fix')
            ->whereBetween('tanggal', [$startDate, $endDate])
            ->get();
        $longlatSellerData = DB::table('longlat_fix')
            ->whereBetween('tanggal', [$startDate, $endDate])
            ->get();

        $crossSellingCounts = $crossSellingData->reduce(function ($carry, $item) {
            $carry['penjualan'][$item->id_owner] = ($carry['penjualan'][$item->id_owner] ?? 0) + 1;
            $carry['pembelian'][$item->id_pembeli] = ($carry['pembelian'][$item->id_pembeli] ?? 0) + 1;
            return $carry;
        }, ['penjualan' => [], 'pembelian' => []]);

        $longlatCounts = $longlatSellerData->reduce(function ($carry, $item) {
            $carry[$item->kode] = ($carry[$item->kode] ?? 0) + 1;
            return $carry;
        }, []);

        $result = [];
        foreach ($crossSellingData as $item) {
            $range = "$startDate - $endDate"; // Menggunakan range tanggal sebagai nama bulan

            $resultKeyOwner = $item->id_owner . '_' . $range;
            if (!isset($result[$resultKeyOwner])) {
                $result[$resultKeyOwner] = [
                    'id' => $item->id_owner,
                    'nama' => $item->nama_owner,
                    'tanggal' => $range,
                    'cross_selling_penjualan' => $crossSellingCounts['penjualan'][$item->id_owner] ?? 0,
                    'cross_selling_pembelian' => 0,
                    'kejadian_longlat' => $longlatCounts[$item->id_owner] ?? 0,
                ];
            } else {
                $result[$resultKeyOwner]['cross_selling_penjualan'] = $crossSellingCounts['penjualan'][$item->id_owner] ?? 0;
            }

            $resultKeyPembeli = $item->id_pembeli . '_' . $range;
            if (!isset($result[$resultKeyPembeli])) {
                $result[$resultKeyPembeli] = [
                    'id' => $item->id_pembeli,
                    'nama' => $item->nama_pembeli,
                    'tanggal' => $range,
                    'cross_selling_penjualan' => 0,
                    'cross_selling_pembelian' => $crossSellingCounts['pembelian'][$item->id_pembeli] ?? 0,
                    'kejadian_longlat' => $longlatCounts[$item->id_pembeli] ?? 0,
                ];
            } else {
                $result[$resultKeyPembeli]['cross_selling_pembelian'] = $crossSellingCounts['pembelian'][$item->id_pembeli] ?? 0;
            }
        }

        return array_values($result);
    }

    private function gettabel3()
    {
        $crossSellingData = DB::table('cross_fix')->get();
        $longlatSellerData = DB::table('longlat_fix')->get();


        $crossSellingCounts = $crossSellingData->reduce(function ($carry, $item) {
            $bulan = substr($item->tanggal, 0, 7);
            $carry['penjualan'][$item->id_owner][$bulan] = ($carry['penjualan'][$item->id_owner][$bulan] ?? 0) + 1;
            $carry['pembelian'][$item->id_pembeli][$bulan] = ($carry['pembelian'][$item->id_pembeli][$bulan] ?? 0) + 1;
            return $carry;
        }, ['penjualan' => [], 'pembelian' => []]);


        $longlatCounts = $longlatSellerData->reduce(function ($carry, $item) {
            $bulan = substr($item->tanggal, 0, 7);
            $carry[$item->kode][$bulan] = ($carry[$item->kode][$bulan] ?? 0) + 1;
            return $carry;
        }, []);


        $result = [];
        foreach ($crossSellingData as $item) {
            $bulan = substr($item->tanggal, 0, 7); // Mengambil bulan dari tanggal

            $resultKeyOwner = $item->id_owner . '_' . $bulan;
            if (!isset($result[$resultKeyOwner])) {
                $result[$resultKeyOwner] = [
                    'id' => $item->id_owner,
                    'nama' => $item->nama_owner,
                    'bulan' => $bulan,
                    'cross_selling_penjualan' => $crossSellingCounts['penjualan'][$item->id_owner][$bulan] ?? 0,
                    'cross_selling_pembelian' => 0,
                    'kejadian_longlat' => $longlatCounts[$item->id_owner][$bulan] ?? 0,
                ];
            } else {
                $result[$resultKeyOwner]['cross_selling_penjualan'] = $crossSellingCounts['penjualan'][$item->id_owner][$bulan] ?? 0;
            }

            $resultKeyPembeli = $item->id_pembeli . '_' . $bulan;
            if (!isset($result[$resultKeyPembeli])) {
                $result[$resultKeyPembeli] = [
                    'id' => $item->id_pembeli,
                    'nama' => $item->nama_pembeli,
                    'bulan' => $bulan,
                    'cross_selling_penjualan' => 0,
                    'cross_selling_pembelian' => $crossSellingCounts['pembelian'][$item->id_pembeli][$bulan] ?? 0,
                    'kejadian_longlat' => $longlatCounts[$item->id_pembeli][$bulan] ?? 0,
                ];
            } else {
                $result[$resultKeyPembeli]['cross_selling_pembelian'] = $crossSellingCounts['pembelian'][$item->id_pembeli][$bulan] ?? 0;
            }
        }

        return array_values($result);
    }
    private function getThreeMonthsSummary($id3months)
    {

        $threeMonths = [
            date('Y-m', strtotime('-2 months')),
            date('Y-m', strtotime('-1 month')),
            date('Y-m')
        ];

        $threeMonthsData = array_filter($id3months, function ($item) use ($threeMonths) {
            return in_array($item['bulan'], $threeMonths);
        });


        $totals = [];
        foreach ($threeMonthsData as $item) {
            $id = $item['id'];
            if (!isset($totals[$id])) {
                $totals[$id] = [
                    'id' => $id,
                    'nama' => $item['nama'],
                    'total_penjualan' => 0,
                    'total_pembelian' => 0,
                    'total_longlat' => 0
                ];
            }

            $totals[$id]['total_penjualan'] += $item['cross_selling_penjualan'];
            $totals[$id]['total_pembelian'] += $item['cross_selling_pembelian'];
            $totals[$id]['total_longlat'] += $item['kejadian_longlat'];
        }

        usort($totals, function ($a, $b) {
            $totalA = $a['total_penjualan'] + $a['total_pembelian'] + $a['total_longlat'];
            $totalB = $b['total_penjualan'] + $b['total_pembelian'] + $b['total_longlat'];
            return $totalB <=> $totalA;
        });

        return array_slice($totals, 0, 10);
    }
}
