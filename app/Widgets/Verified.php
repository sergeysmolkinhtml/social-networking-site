<?php

namespace App\Widgets;

use App\Models\User;
use Arrilot\Widgets\AbstractWidget;

class Verified extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * @var int
     */
    public $cacheTime = 20;


    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $verified = User::where('id',$this->config['id'])
                        ->where('verified',1)->first();

        return view('widgets.verified', [
            'config' => $this->config,
            'verified' => $verified
        ]);
    }
}
