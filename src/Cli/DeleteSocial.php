<?php

namespace NourAlmasrieh\SocialWall;

use SilverStripe\Control\HTTPRequest;
use SilverStripe\Dev\BuildTask;

class DeleteSocial extends BuildTask
{
    private static string $segment = 'socialwall-delete-social';

    protected string $title = 'Delete Social(Facebook + Instagram)';

    protected string $description = 'Delete Social(Facebook + Instagram)';

    public function run(HTTPRequest $request): void
    {
        $listPosts = AllPosts::get();
        foreach ($listPosts as $item) {
            $item->delete();
        }
    }
}
