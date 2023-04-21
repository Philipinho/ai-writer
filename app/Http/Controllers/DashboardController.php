<?php

namespace App\Http\Controllers;

use App\Models\Template;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Laravel\Fortify\Actions\ConfirmPassword;
use Laravel\Jetstream\Contracts\DeletesUsers;

class DashboardController extends Controller
{

    public function dashboard(): \Inertia\Response
    {

        $top_templates = Template::where('status', 1)
            ->select('uuid', 'name', 'key', 'description', 'icon', 'category_id')
            ->limit(4)
            ->get();

        $documents = auth()->user()->currentTeam->documents()
            ->with(['template' => function ($query) {
                $query->select('id', 'name');
            }])
            ->select('team_id', 'uuid', 'name', 'template_key','template_id', 'favorite', 'created_at', 'updated_at')
            ->limit(10)
            ->orderBy('updated_at', 'DESC')
            ->get()
            ->filter(function ($document) {
                return auth()->user()->can('view', $document);
            });

        return Inertia::render('Dashboard',
            [
                'templates' => $top_templates,
                'documents' => $documents
            ]);
    }

    public function logout(Request $request, StatefulGuard $guard)
    {
        $guard->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('home'));
    }
}
