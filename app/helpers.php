<?php

use App\Models\User;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

function get_count_notificatios()
{

    return Notification::where('user_id', Auth::user()->id)
        ->where('status', 0)->get()->count();
}
function get_my_notificatios()
{

    return Notification::where('user_id', Auth::user()->id)
         
        ->orderByDesc('id')
        ->limit(5)
        ->get();
}
function dateDiff($date1,$date2){
    $diff = strtotime($date2)- strtotime($date1) ; 
    return round($diff/86400) ; 

}
