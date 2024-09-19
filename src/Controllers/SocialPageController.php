<?php

use SilverStripe\Dev\Debug;
use SilverStripe\Core\Convert;
use SilverStripe\Control\Director;
use SilverStripe\Security\Security;
use SilverStripe\Control\Controller;
use SilverStripe\Security\Permission;
use NourAlmasrieh\SocialWall\FacebookProvider;

class SocialPageController extends PageController
{
    private static $allowed_actions = [
        'startFaceBookOAuth',
        'endFaceBookOAuth',
    ];

    public function startFaceBookOAuth()
    {
        $member = Security::getCurrentUser();

        if ($member && Permission::check('ADMIN', 'any', $member)) {
            $provider = FacebookProvider::get()->first();
            if ($provider) {
                $redirecturi = Controller::join_links(Director::absoluteURL("/"),'sociallwallapi','endFaceBookOAuth');
                $redirecturi = str_replace("http://","https://",$redirecturi);
                $url = $provider->StartOAuthLoginURL($redirecturi);
                $this->redirect($url);
                
            } else {
                return $this->httpError(404, 'No Facebook Provider found');
            }

        } else {
            // The user is not logged in or does not have admin permissions
            return $this->httpError(403, 'You do not have permission to access this page');
        }
    }
    public function endFaceBookOAuth()
    {
        $member = Security::getCurrentUser();

        if ($member && Permission::check('ADMIN', 'any', $member)) {
            $provider = FacebookProvider::get()->first();
            if ($provider) {
                if($_GET["state"] == "Bernd")
                {
                    $redirecturi = Controller::join_links(Director::absoluteURL("/"),'sociallwallapi','endFaceBookOAuth');
                    
                    $redirecturi = str_replace("http://","https://",$redirecturi);
                    $response = $provider->validateAccessToken($redirecturi, $_GET["code"]);
                    Debug::dump($response);die;
                }
                
                
            } else {
                return $this->httpError(404, 'No Facebook Provider found');
            }

        } else {
            // The user is not logged in or does not have admin permissions
            return $this->httpError(403, 'You do not have permission to access this page');
        }
    }
}