<?php

namespace NourAlmasrieh\SocialWall\Controllers;

use PageController;
use SilverStripe\Control\Director;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\Control\HTTPResponse;
use SilverStripe\Security\Permission;
use SilverStripe\Security\Security;
use NourAlmasrieh\SocialWall\FacebookProvider;

class SocialPageController extends PageController
{
    private static $allowed_actions = [
        'startFaceBookOAuth',
        'endFaceBookOAuth',
    ];

    public function startFaceBookOAuth(HTTPRequest $request): HTTPResponse
    {
        $member = Security::getCurrentUser();

        if ($member && Permission::check('ADMIN', 'any', $member)) {
            $provider = FacebookProvider::get()->first();
            if ($provider) {
                $redirecturi = Director::join_links(Director::absoluteURL('/'), 'sociallwallapi', 'endFaceBookOAuth');
                $redirecturi = str_replace("http://","https://",$redirecturi);
                $url = $provider->StartOAuthLoginURL($redirecturi);
                return $this->redirect($url);
                
            } else {
                return $this->httpError(404, 'No Facebook Provider found');
            }

        } else {
            // The user is not logged in or does not have admin permissions
            return $this->httpError(403, 'You do not have permission to access this page');
        }
    }
    public function endFaceBookOAuth(HTTPRequest $request): HTTPResponse
    {
        $member = Security::getCurrentUser();

        if (!$member || !Permission::check('ADMIN', 'any', $member)) {
            return $this->httpError(403, 'You do not have permission to access this page');
        }

        $provider = FacebookProvider::get()->first();
        if (!$provider) {
            return $this->httpError(404, 'No Facebook Provider found');
        }

        if ($request->getVar('state') !== 'Bernd') {
            return $this->httpError(400, 'Invalid OAuth state parameter');
        }

        $redirecturi = Director::join_links(Director::absoluteURL('/'), 'sociallwallapi', 'endFaceBookOAuth');
        $redirecturi = str_replace('http://', 'https://', $redirecturi);
        $response = $provider->validateAccessToken($redirecturi, (string) $request->getVar('code'));
        return $this->getResponse()->setBody('<pre>' . htmlspecialchars($response ?? '') . '</pre>');
    }
}