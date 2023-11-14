<?php

// В файле SearchController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class SearchController extends Controller
{
    public function index()
    {
        return view('main.search');
    }

    public function search(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        $searchText = $request->input('searchText');

        if (strlen($searchText) >= 3) {
            $results = Comment::where('body', 'like', '%' . $searchText . '%')->with('post')->get();

            return view('main.search', ['results' => $results]);
        } else {
            return redirect()->back()->with('error', 'Введите минимум 3 символа для поиска.');
        }
    }
}
