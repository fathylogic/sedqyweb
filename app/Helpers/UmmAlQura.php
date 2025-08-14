<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\UmmAlQura;

class HijriDateController extends Controller
{
    public function toHijri(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
        ]);

        $gregorianDate = $request->input('date');
        $dateParts = explode('-', $gregorianDate);

        $umm = new UmmAlQura();
        $umm->setGregorian($dateParts[0], $dateParts[1], $dateParts[2]);
        $hijri = [
            'year' => $umm->getHijriYear(),
            'month' => $umm->getHijriMonth(),
            'day' => $umm->getHijriDay(),
        ];

        return response()->json([
            'gregorian' => $gregorianDate,
            'hijri' => $hijri['year'].'-'.str_pad($hijri['month'], 2, '0', STR_PAD_LEFT).'-'.str_pad($hijri['day'], 2, '0', STR_PAD_LEFT),
        ]);
    }

    public function toGregorian(Request $request)
    {
        $request->validate([
            'hijri' => 'required|date_format:Y-m-d',
        ]);

        $hijriDate = $request->input('hijri');
        [$hYear, $hMonth, $hDay] = explode('-', $hijriDate);

        $umm = new UmmAlQura();
        $umm->setHijri($hYear, $hMonth, $hDay);
        $g = $umm->getGregorianDate();

        return response()->json([
            'hijri' => $hijriDate,
            'gregorian' => $g->format('Y-m-d'),
        ]);
    }
}
