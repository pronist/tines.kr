<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Deploy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deploy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deploy tines.kr laravel project';

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
     * @return mixed
     */
    public function handle()
    {
        $now = \Carbon\Carbon::now('Asia/Seoul');

        exec("npm run production");

        $deploy = $now->toDateTimeString();
    
        exec("git add .");
        exec("git commit -m \"deploy: ${deploy}\"");
        exec("git push deployer@Deployer:~/.git");
        exec("git push -u git master");
    
        deploy();
    
        \SSH::run([
            "sudo service nginx restart",
            "sudo service php7.2-fpm restart"
        ]);
    }
}
