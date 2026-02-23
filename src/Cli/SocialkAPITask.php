<?php

namespace NourAlmasrieh\SocialWall;

use SilverStripe\Control\HTTPRequest;
use SilverStripe\Dev\BuildTask;

class SocialkAPITask extends BuildTask
{
    private static string $segment = 'socialwall-api-task';

    protected string $title = 'Refresh Social (Facebook + Instagram) API Credentials';

    protected string $description = 'Refresh Social (Facebook + Instagram) API Credentials';
    
    public function process()
    {
        $this->execute();
    }
    public function execute()
    {
        if(InstagramProvider::get() != null){
            foreach (InstagramProvider::get() as $instaProvider) {
                $instaProvider->RequestAccessToken();
                $instaProvider->RequestFreshData();
            }
        }
        
        if(FacebookProvider::get() != null){
            foreach (FacebookProvider::get() as $fbProvider){
                //$fbProvider->RequestAccessToken();
                $fbProvider->RequestFreshData();
            }
        }
    }
    public function run(HTTPRequest $request): void
    {
        $this->execute();
    }
}
