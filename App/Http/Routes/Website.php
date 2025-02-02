<?php

declare(strict_types=1);

namespace App\Http\Routes;

use App\Http\Entity\View;

/**
 * Here you define your website routes.
 * Feel free to modify this class to suit your needs.
 * You can even replace the match statement with a Symfony router,
 * or the standalone router of Laravel Illuminate Router.
 *
 * Other routes to match?
 * Create a new class and register it in App/Bootstrap/Bootstrap.php
 */
class Website
{
    public static function canRender(): bool
    {
        return true;
    }

    public static function render(): View
    {
        return match (true) {
            request()->uri() === '/'                     => new View('website.homepage.homepage'),
            request()->uri() === '/waiting-list'         => new View('website.login'),
            request()->uri() === '/waiting-callback'     => new View('website.login_callback'),
            request()->uri() === '/auth/callback'        => new View('website.includes.auth.callback'),
            request()->uri() === '/pricing'              => new View('website.pricing.pricing'),
            request()->uri() === '/contact'              => new View('website.contact.contact'),
            request()->uri() === '/privacy-policy'       => new View('website.privacy-policy.privacy-policy'),
            request()->uri() === '/blogs'                => new View('website.blog.overview'),
            str_starts_with(request()->uri(), '/blogs/') => new View('website.blog.detail'),
            default                                      => new View('website.404'),
        };
    }
}
