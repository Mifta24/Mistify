<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Filament\Notifications\Notification;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->user()?->hasRole('admin')) {
            Notification::make()
                ->danger()
                ->title('Access Denied')
                ->body('You do not have permission to access the admin panel.')
                ->send();

            return redirect()->route('home');
        }

        return $next($request);
    }
}
