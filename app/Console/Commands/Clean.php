<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class Clean extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clean';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean registered blogs with 404';

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
        $client = new Client([
            'verify' => false
        ]);
        /** 모든 블로그에 대해 요청을 날립니다. */
        foreach(\App\Blog::get() as $blog) {
            try {
                $response = $client->request('get', $blog->url);
                $this->info("#$blog->id request: \"$blog->url\" successfully");
            }
            catch(RequestException $e) {
                /** 삭제된 블로그에 관하여: 404*/
                if($e->getResponse()->getStatusCode() == '404') {
                    $user = \App\User::where('id', '=', $blog->user_id)->first();
                    /** 
                     * 등록되어 있는 블로그가 단 하나이고, 
                     * 그 블로그가 삭제 대상인경우 유저를 날립니다. 
                     */
                    if(!$user->blogs()->count() < 2) {
                        /** 유저를 날립니다. */
                        $user->delete();
                        $this->warn("deleted: \"$blog->url\" with User \"$user->id\"");
                    }
                    /** 현재 다중블로그를 지원하지 않으므로 이 부분은 도달할 수 없습니다. */
                    else {
                        /** 블로그를 삭제합니다. */
                        $blog->delete();
                        $this->warn("deleted: \"$blog->name\"");
                    }
                }
                continue;
            }
        }
    }
}
