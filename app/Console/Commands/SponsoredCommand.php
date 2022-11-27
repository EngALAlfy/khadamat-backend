<?php

namespace App\Console\Commands;

use App\Models\Item;
use Illuminate\Console\Command;
use function Psy\debug;

class SponsoredCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sponsored:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $items = Item::with('createdUser')->where('sponsored', true)->get();
        foreach ($items as $item) {
            $user = $item->createdUser;

            //if ($user->role != "admin") {
                if ($user->points <= 0) {
                    $item->sponsored = false;
                    $item->sponsored_index = 0;
                    $item->save();
                } else {
                    $user->points -= 1;
                    $user->save();
                }
            }
        //}
        return 0;
    }
}
