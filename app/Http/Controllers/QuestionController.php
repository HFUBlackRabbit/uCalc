<?php

namespace App\Http\Controllers;

use App\Question;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    /**
     * @param User $user
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(User $user = null) {
        $user = $user ?? Auth::user();
        $this->authorize('viewAny', [Question::class, $user]);

        $questions = Question::with('labels')->where('user_id', $user['id'])->get();

        return view('question/index', compact('user', 'questions'));
    }
}
