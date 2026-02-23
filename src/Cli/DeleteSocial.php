<?php

namespace NourAlmasrieh\SocialWall;

use NourAlmasrieh\SocialWall\AllPosts;
use SilverStripe\Dev\BuildTask;
use SilverStripe\PolyExecution\PolyOutput;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;

class DeleteSocial extends BuildTask
{
    private static string $segment = 'socialwall-delete-social';

    protected string $title = 'Delete Social(Facebook + Instagram)';

    protected static string $description = 'Delete Social(Facebook + Instagram)';

    protected function execute(InputInterface $input, PolyOutput $output): int
    {
        $listPosts = AllPosts::get();
        foreach ($listPosts as $item) {
            $item->delete();
        }
        return Command::SUCCESS;
    }
}
