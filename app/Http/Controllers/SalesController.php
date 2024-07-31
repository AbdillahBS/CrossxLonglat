<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SalesController extends Controller
{
    public function index()
    {
        $kontribusi = $this->getChart1();
        $penjualanBulan = $this->getLineChart();
        $stackedBarData = $this->getStackedBarData();
        $topSellers = $this->getTopSellers();
        $totalPenjualan = $this->getTotalPenjualan();
        $totalMasterSeller = $this->getTotalMasterSeller();
        $topSellerMonthlySales = $this->getTopSellerMonthlySales();

        // dd($topSellerMonthlySales);

        return view('index', compact('kontribusi', 'penjualanBulan', 'stackedBarData', 'topSellers', 'totalPenjualan', 'totalMasterSeller', 'topSellerMonthlySales'));
    }




    public function getChart1()
    {
        $pgp = DB::table('pgp')->get();
        $pj_lv1 = DB::table('pj_lv1')->get();
        $pj_lv2 = DB::table('pj_lv2')->get();

        $data_bulan_pjlvl0 = $pgp->toArray();
        $data_bulan_pjlvl1 = $pj_lv1->toArray();
        $data_bulan_pjlv2 = $pj_lv2->toArray();

        $data_bulan_pjlvl0 = collect($data_bulan_pjlvl0)->each(function ($data) {
            $data->level = 'Pusat';
        });
        $data_bulan_pjlvl1 = collect($data_bulan_pjlvl1)->each(function ($data) {
            $data->level = 'Lvl 1';
        });
        $data_bulan_pjlv2 = collect($data_bulan_pjlv2)->each(function ($data) {
            $data->level = 'Lvl 2';
        });

        // $data_bulan = array_merge_recursive($data_bulan_pjlvl0, $data_bulan_pjlvl1, $data_bulan_pjlv2);
        $data_bulan = $data_bulan_pjlvl0->merge($data_bulan_pjlvl1)->merge($data_bulan_pjlv2);

        $penjualan = [];
        foreach ($data_bulan as $data) {
            if (!isset($penjualan[$data->level])) {
                $penjualan[$data->level] = 0;
            }

            $penjualan[$data->level] += $data->total_qty;
        }

        $total_penjualan = array_sum($penjualan);
        $kontribusi = [];
        foreach ($penjualan as $level => $total) {
            $kontribusi[$level] = ($total / $total_penjualan) * 100;
        }

        return $kontribusi;
    }
    public function getLineChart()
    {
        $pgp = DB::table('pgp')->select(DB::raw('CAST(bulan AS UNSIGNED) as bulan, CAST(total_qty AS UNSIGNED) as total_qty, "Pusat" as level'))->get();
        $pj_lv1 = DB::table('pj_lv1')->select(DB::raw('CAST(bulan AS UNSIGNED) as bulan, CAST(total_qty AS UNSIGNED) as total_qty, "Lvl 1" as level'))->get();
        $pj_lv2 = DB::table('pj_lv2')->select(DB::raw('CAST(bulan AS UNSIGNED) as bulan, CAST(total_qty AS UNSIGNED) as total_qty, "Lvl 2" as level'))->get();

        $data_bulan_pjlvl0 = collect($pgp)->map(function ($item) {
            return (array) $item;
        });
        $data_bulan_pjlvl1 = collect($pj_lv1)->map(function ($item) {
            return (array) $item;
        });
        $data_bulan_pjlv2 = collect($pj_lv2)->map(function ($item) {
            return (array) $item;
        });

        $data_bulan = $data_bulan_pjlvl0->concat($data_bulan_pjlvl1)->concat($data_bulan_pjlv2);

        // Debug data before grouping
        // dd('Data Bulan:', $data_bulan);

        $penjualan_bulan = $data_bulan->groupBy('bulan')->map(function ($group) {
            return $group->groupBy('level')->map(function ($subgroup) {
                return $subgroup->sum('total_qty');
            });
        })->toArray();

        // Debug the grouped data
        // dd('Penjualan Bulan:', $penjualan_bulan);

        $bulan_mapping = [
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni'
        ];

        $penjualan_bulan = collect($penjualan_bulan)->mapWithKeys(function ($levels, $bulan) use ($bulan_mapping) {
            $bulan_name = $bulan_mapping[(int) $bulan];
            return [$bulan_name => $levels];
        })->toArray();

        // Debug the final formatted data
        // dd('Formatted Penjualan Bulan:', $penjualan_bulan);

        return $penjualan_bulan;
    }
    public function getStackedBarData()
    {
        // Fetch data from database and prepare it for the stacked bar chart
        $so_pusat = DB::table('so_pusat')->select('qr_owner_id as id_seller', DB::raw('SUM(jumlah_opname) as so_pusat'))->groupBy('id_seller')->get();
        $so_lv1 = DB::table('so_lv1')->select('qr_owner_id as id_seller', DB::raw('SUM(jumlah_opname) as so_lv1'))->groupBy('id_seller')->get();
        $pgp = DB::table('pgp')->select('id_member as id_seller', DB::raw('SUM(total_qty) as pgp'))->groupBy('id_seller')->get();
        $pj_lv1 = DB::table('pj_lv1')->select('id_jual as id_seller', DB::raw('SUM(total_qty) as pj_lv1'))->groupBy('id_seller')->get();
        $pj_lv2 = DB::table('pj_lv2')->select('id_upline as id_seller', DB::raw('SUM(total_qty) as pj_lv2'))->groupBy('id_seller')->get();
        $aktivasi_pusat = DB::table('aktivasi_pusat')->select('activated_by as id_seller', DB::raw('SUM(jumlah_aktivasi) as aktivasi_pusat'))->groupBy('id_seller')->get();
        $aktivasi_lv1 = DB::table('aktivasi_lv1')->select('upline as id_seller', DB::raw('SUM(jumlah_aktivasi) as aktivasi_lv1'))->groupBy('id_seller')->get();
        $stok_pusat = DB::table('stok_pusat')->select('kode as id_seller', DB::raw('SUM(stock_quantity) as stok_pusat'))->groupBy('id_seller')->get();
        $stok_downline = DB::table('stok_downline')->select('id_upline as id_seller', DB::raw('SUM(stock_quantity) as stok_downline'))->groupBy('id_seller')->get();

        // Merge dataframes
        $master_seller = DB::table('master_seller')->get()->keyBy('id_seller')->toArray();
        $merged_data = $master_seller;
        $this->initializeProperties($merged_data);
        $this->mergeData($merged_data, $so_pusat, 'so_pusat');
        $this->mergeData($merged_data, $so_lv1, 'so_lv1');
        $this->mergeData($merged_data, $pgp, 'pgp');
        $this->mergeData($merged_data, $pj_lv1, 'pj_lv1');
        $this->mergeData($merged_data, $pj_lv2, 'pj_lv2');
        $this->mergeData($merged_data, $aktivasi_pusat, 'aktivasi_pusat');
        $this->mergeData($merged_data, $aktivasi_lv1, 'aktivasi_lv1');
        $this->mergeData($merged_data, $stok_pusat, 'stok_pusat');
        $this->mergeData($merged_data, $stok_downline, 'stok_downline');

        // Calculate the total score for each seller
        foreach ($merged_data as &$data) {
            $data->total_score = (
                ($data->so_pusat ?? 0) * -1 +
                    ($data->so_lv1 ?? 0) * -1 +
                        ($data->pgp ?? 0) * 1 +
                        ($data->pj_lv1 ?? 0) * 1 +
                        ($data->pj_lv2 ?? 0) * 1 +
                        ($data->aktivasi_pusat ?? 0) * 1 +
                        ($data->aktivasi_lv1 ?? 0) * 1 +
                        ($data->stok_pusat ?? 0) * 0.5 +
                        ($data->stok_downline ?? 0) * 0.5
            );
        }

        // Sort sellers by total score in descending order and take top 10
        $top_sellers = collect($merged_data)->sortByDesc('total_score')->take(10);

        // Format data for stacked bar chart
        $metrics = ['so_pusat', 'so_lv1', 'pgp', 'pj_lv1', 'pj_lv2', 'aktivasi_pusat', 'aktivasi_lv1', 'stok_pusat', 'stok_downline'];
        $stackedBarData = [];
        foreach ($top_sellers as $seller) {
            $seller_name = $seller->NAMA;
            foreach ($metrics as $metric) {
                $stackedBarData[$seller_name][$metric] = $seller->$metric ?? 0;
            }
        }

        return $stackedBarData;
    }
    private function getTotalPenjualan()
    {
        $pgp = DB::table('pgp')->sum('total_qty');
        $pj_lv1 = DB::table('pj_lv1')->sum('total_qty');
        $pj_lv2 = DB::table('pj_lv2')->sum('total_qty');

        $totalPenjualan = $pgp + $pj_lv1 + $pj_lv2;

        return $totalPenjualan;
    }
    private function getTopSellers()
    {
        // Fetch data and prepare for top sellers
        $so_pusat = DB::table('so_pusat')->select('qr_owner_id as id_seller', DB::raw('SUM(jumlah_opname) as so_pusat'))->groupBy('id_seller')->get();
        $so_lv1 = DB::table('so_lv1')->select('qr_owner_id as id_seller', DB::raw('SUM(jumlah_opname) as so_lv1'))->groupBy('id_seller')->get();
        $pgp = DB::table('pgp')->select('id_member as id_seller', DB::raw('SUM(total_qty) as pgp'))->groupBy('id_seller')->get();
        $pj_lv1 = DB::table('pj_lv1')->select('id_jual as id_seller', DB::raw('SUM(total_qty) as pj_lv1'))->groupBy('id_seller')->get();
        $pj_lv2 = DB::table('pj_lv2')->select('id_upline as id_seller', DB::raw('SUM(total_qty) as pj_lv2'))->groupBy('id_seller')->get();
        $aktivasi_pusat = DB::table('aktivasi_pusat')->select('activated_by as id_seller', DB::raw('SUM(jumlah_aktivasi) as aktivasi_pusat'))->groupBy('id_seller')->get();
        $aktivasi_lv1 = DB::table('aktivasi_lv1')->select('upline as id_seller', DB::raw('SUM(jumlah_aktivasi) as aktivasi_lv1'))->groupBy('id_seller')->get();
        $stok_pusat = DB::table('stok_pusat')->select('kode as id_seller', DB::raw('SUM(stock_quantity) as stok_pusat'))->groupBy('id_seller')->get();
        $stok_downline = DB::table('stok_downline')->select('id_upline as id_seller', DB::raw('SUM(stock_quantity) as stok_downline'))->groupBy('id_seller')->get();

        // Merge dataframes
        $master_seller = DB::table('master_seller')->get()->keyBy('id_seller')->toArray();
        $merged_data = $master_seller;
        $this->initializeProperties($merged_data);
        $this->mergeData($merged_data, $so_pusat, 'so_pusat');
        $this->mergeData($merged_data, $so_lv1, 'so_lv1');
        $this->mergeData($merged_data, $pgp, 'pgp');
        $this->mergeData($merged_data, $pj_lv1, 'pj_lv1');
        $this->mergeData($merged_data, $pj_lv2, 'pj_lv2');
        $this->mergeData($merged_data, $aktivasi_pusat, 'aktivasi_pusat');
        $this->mergeData($merged_data, $aktivasi_lv1, 'aktivasi_lv1');
        $this->mergeData($merged_data, $stok_pusat, 'stok_pusat');
        $this->mergeData($merged_data, $stok_downline, 'stok_downline');

        // Calculate the total score for each seller
        foreach ($merged_data as &$data) {
            $data->total_score = (
                ($data->so_pusat ?? 0) * -1 +
                    ($data->so_lv1 ?? 0) * -1 +
                        ($data->pgp ?? 0) * 1 +
                        ($data->pj_lv1 ?? 0) * 1 +
                        ($data->pj_lv2 ?? 0) * 1 +
                        ($data->aktivasi_pusat ?? 0) * 1 +
                        ($data->aktivasi_lv1 ?? 0) * 1 +
                        ($data->stok_pusat ?? 0) * 0.5 +
                        ($data->stok_downline ?? 0) * 0.5
            );
        }

        // Sort sellers by total score in descending order and take top 5
        $top_sellers = collect($merged_data)->sortByDesc('total_score')->take(5);

        // Extract seller names and statuses for display
        $top_seller_data = [];
        foreach ($top_sellers as $seller) {
            $top_seller_data[] = [
                'nama' => $seller->NAMA,
                'status' => $seller->STATUS
            ];
        }

        return $top_seller_data;
    }

    private function mergeData(&$merged_data, $data, $column)
    {
        foreach ($data as $item) {
            if (isset($merged_data[$item->id_seller])) {
                $merged_data[$item->id_seller]->$column = $item->$column;
            } else {
                $merged_data[$item->id_seller] = (object) ['id_seller' => $item->id_seller, $column => $item->$column];
            }
        }
    }

    private function initializeProperties(&$merged_data)
    {
        $properties = ['so_pusat', 'so_lv1', 'pgp', 'pj_lv1', 'pj_lv2', 'aktivasi_pusat', 'aktivasi_lv1', 'stok_pusat', 'stok_downline'];
        foreach ($merged_data as &$data) {
            foreach ($properties as $property) {
                if (!isset($data->$property)) {
                    $data->$property = 0;
                }
            }
        }
    }
    private function getTotalMasterSeller()
    {
        return DB::table('master_seller')->count();
    }
    private function getTopSellerMonthlySales()
    {
        // Dapatkan top 5 sellers berdasarkan total penjualan
        $topSellers = DB::table('pgp')
            ->select('id_member as id_seller', DB::raw('SUM(total_qty) as total_qty'))
            ->groupBy('id_seller')
            ->orderByDesc('total_qty')
            ->limit(5)
            ->pluck('id_seller');

        // Dapatkan data penjualan bulanan untuk top 5 sellers dari pgp, pj_lv1, dan pj_lv2
        $pgpSales = DB::table('pgp')
            ->select('id_member as id_seller', 'bulan', DB::raw('SUM(total_qty) as total_qty'))
            ->whereIn('id_member', $topSellers)
            ->groupBy('id_seller', 'bulan')
            ->get();

        $pjLv1Sales = DB::table('pj_lv1')
            ->select('id_jual as id_seller', 'bulan', DB::raw('SUM(total_qty) as total_qty'))
            ->whereIn('id_jual', $topSellers)
            ->groupBy('id_seller', 'bulan')
            ->get();

        $pjLv2Sales = DB::table('pj_lv2')
            ->select('id_upline as id_seller', 'bulan', DB::raw('SUM(total_qty) as total_qty'))
            ->whereIn('id_upline', $topSellers)
            ->groupBy('id_seller', 'bulan')
            ->get();

        // Gabungkan data penjualan
        $monthlySales = collect($pgpSales)->merge($pjLv1Sales)->merge($pjLv2Sales);

        // Format data untuk digunakan dalam chart
        // Buat mapping untuk mengganti angka bulan dengan nama bulan
        $bulanMapping = [
            '2' => 'Februari',
            '3' => 'Maret',
            '4' => 'April',
            '5' => 'Mei',
            '6' => 'Juni'
        ];

        // Format data untuk digunakan dalam chart
        $formattedData = [];
        foreach ($topSellers as $seller) {
            $formattedData[$seller] = [];
            foreach ($bulanMapping as $num => $name) {
                $monthlyTotal = $monthlySales->where('id_seller', $seller)->where('bulan', $num)->sum('total_qty');
                $formattedData[$seller][$name] = $monthlyTotal;
            }
        }

        return $formattedData;
    }
}
