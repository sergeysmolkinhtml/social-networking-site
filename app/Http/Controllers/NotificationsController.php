<?php

namespace App\Http\Controllers;

use App\Events\NotificationSent;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
   public function get(Request $request)
   {
       $data = $request->all();
       broadcast(new NotificationSent($data));
   }
}
