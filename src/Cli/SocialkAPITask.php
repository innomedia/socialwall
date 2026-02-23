<?php

namespace NourAlmasrieh\SocialWall;

use SilverStripe\Dev\BuildTask;
use SilverStripe\PolyExecution\PolyOutput;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;

class SocialkAPITask extends BuildTask
{
    private static string $segment = 'socialwall-api-task';

    protected string $title = 'Refresh Social (Facebook + Instagram) API Credentials';

    protected static string $description = 'Refresh Social (Facebook + Instagram) API Credentials';
    
    protected function execute(InputInterface $input, PolyOutput $output): int
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
        return Command::SUCCESS;
    }
}
