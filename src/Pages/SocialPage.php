<?php
namespace NourAlmasrieh\SocialWall;
use Page;
use SilverStripe\Forms\LiteralField;
use SilverStripe\Forms\CheckboxField;

class SocialPage extends Page
{
    private static $singular_name = 'Social Seite';
    private static $plural_name = 'Social Seiten';
    private static $description = 'Seite zeigt Social Wall Einträge an';
    private static $db = [
        'ShowOnLimitPosts' => 'Boolean(0)',
        'ShowOnFacebook' => 'Boolean(0)',
        'ShowOnInstagram' => 'Boolean(0)',
    ];
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->addFieldToTab('Root.Main', CheckboxField::create('ShowOnLimitPosts', 'Sollen die Posts auf 8 Stück Limitiert werden?'));
        $fields->addFieldToTab('Root.Main', CheckboxField::create('ShowOnFacebook', 'Sollen nur die Posts von Facebook angezeigt?'));
        $fields->addFieldToTab('Root.Main', CheckboxField::create('ShowOnInstagram', 'Sollen nur die Posts von Instagram angezeigt?'));
        $fields->addFieldToTab('Root.Import Social',LiteralField::create("ImportButton","
            <div class='text-center'>
                <br>
                Um neue Einträge in Social Media zu erhalten
                <a class='btn action btn-primary my-5 ml-3' target='_blank' href='/dev/tasks/socialwall-api-task'>Import</a>
            </div>
        "), 'MenuTitle');
        $this->extend('updateSocialPageCMSFields', $fields);

        return $fields;
    }
    public function getPosts()
    {
        if($this->ShowOnLimitPosts){
            return AllPosts::get()->limit(8); 
        }
        return AllPosts::get();
    }
    public function getOnPosts()
    {
        $arrayfiltter = [];
        if($this->ShowOnFacebook){
            $arrayfiltter[] = 'facebook';
        }
        if($this->ShowOnInstagram){
            $arrayfiltter[] = 'instagram';
        }
        if (count($arrayfiltter) > 0){
            return $this->getPosts()->filter("Platform", $arrayfiltter);
        }
        return $this->getPosts();
    }
    
}
