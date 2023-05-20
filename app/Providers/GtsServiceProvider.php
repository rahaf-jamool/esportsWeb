<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App;

class GtsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        App::bind('ApiService', function () {
            return new \App\Services\ApiService;
        });
        App::bind('languageservice', function () {
            return new \App\Services\LanguageService;
        });
        App::bind('mediaservice', function () {
            return new \App\Services\MediaService;
        });
        App::bind('sitestaticpageservice', function () {
            return new \App\Services\SiteStaticPageService;
        });
        App::bind('userservice', function () {
            return new \App\Services\UserService;
        });
        App::bind('userratingservice', function () {
            return new \App\Services\UserRatingService;
        });
        #############################
        App::bind('ProductService', function () {
            return new \App\Services\ProductService;
        });
        App::bind('CurrenciesService', function () {
            return new \App\Services\CurrenciesService;
        });
        App::bind('UnitService', function () {
            return new \App\Services\UnitService;
        });
        App::bind('CountriesService', function () {
            return new \App\Services\CountriesService;
        });
        App::bind('TranslationService', function () {
            return new \App\Services\TranslationService;
        });
        App::bind('PagesService', function () {
            return new \App\Services\PagesService;
        });
        App::bind('BlocksService', function () {
            return new \App\Services\BlocksService;
        });
        App::bind('MenuService', function () {
            return new \App\Services\MenuService;
        });
        App::bind('PersonClientService', function () {
            return new \App\Services\PersonClientService;
        });
        App::bind('AcademiesService',function (){
            return new \App\Services\AcademiesService;
        });
        App::bind('ClubsService',function (){
            return new \App\Services\ClubsService;
        });
        App::bind('PlayersService',function (){
            return new \App\Services\PlayersService;
        });
        App::bind('GamesService',function (){
            return new \App\Services\GamesService;
        });
        App::bind('PlatformService',function (){
            return new \App\Services\PlatformService;
        });
        App::bind('NationalityService',function (){
            return new \App\Services\NationalityService;
        });
        App::bind('EventsService',function (){
            return new \App\Services\EventsService;
        });
        App::bind('PrincedomsService',function (){
            return new \App\Services\PrincedomsService;
        });
        App::bind('BlogService',function (){
            return new \App\Services\BlogService;
        });
        App::bind('NationalTeamsService',function (){
            return new \App\Services\NationalTeamsService;
        });
        App::bind('OnlineService',function (){
            return new \App\Services\OnlineService;
        });

    }

    public function provides()
    {
        return [
            'LanguageService',
            'MediaService',
            'SiteStaticPageService',
            'UserRatingService',
            'UserService',
			'CouponService',
			'UserCouponService',
            #############################
			'ProductService',
			'CurrenciesService',
			'UnitService',
			'CountriesService',
			'TranslationService',
			'PagesService',
            'BlocksService',
            'MenuService',
            'PersonClientService',
            'ApiService',
            'AcademiesService',
            'PlayersService',
            'ClubsService',
            'GamesService',
            'PlatformService',
            'NationalityService',
            'EventsService',
            'PrincedomsService',
            'BlogService',
            'NationalTeamsService',
            'OnlineService'
        ];
    }
}
