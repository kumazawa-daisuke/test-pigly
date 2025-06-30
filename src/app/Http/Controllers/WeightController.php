<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\WeightLog;
use App\Models\WeightTarget;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterStep1Request;
use App\Http\Requests\RegisterStep2Request;
use App\Http\Requests\StoreWeightLogRequest;
use App\Http\Requests\UpdateWeightLogRequest;
use App\Http\Requests\GoalRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class WeightController extends Controller
{
    public function step1()
    {
        return view('auth.register');
    }

    public function postStep1(RegisterStep1Request $request)
    {
        $request->session()->put('register', [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        return redirect()->route('register.step2');
    }

    public function step2(Request $request)
    {
        if (!$request->session()->has('register')) {
            return redirect()->route('register.step1');
        }
        return view('auth.step2');
    }

    public function postStep2(RegisterStep2Request $request)
    {
        $register = $request->session()->get('register');
        if (!$register) {
            return redirect()->route('register.step1');
        }

        $user = User::create([
            'name' => $register['name'],
            'email' => $register['email'],
            'password' => Hash::make($register['password']),
        ]);

        Auth::login($user);

        $weight_log = WeightLog::create([
            'user_id' => $user->id,
            'weight' => $request->weight,
            'date'   => Carbon::today()->toDateString(),
        ]);

        $weight_target = WeightTarget::create([
            'user_id'=> $user->id,
            'target_weight' => $request->target_weight,
        ]);

        $request->session()->forget('register');

        return redirect()->route('admin');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
    
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return back()->withErrors([
                'email' => 'メールアドレスまたはパスワードが正しくありません。',
            ])->onlyInput('email');
        }

        return redirect()->intended('/weight_logs');
    }

    public function admin()
    {
        $user = Auth::user();

        $latest_weight_log = WeightLog::where('user_id', $user->id)->orderBy('created_at', 'desc')->first();

        $weight_target = WeightTarget::where('user_id', $user->id)->first();

        $latest_weight = $latest_weight_log ? $latest_weight_log->weight : 0;
        $target_weight = $weight_target ? $weight_target->target_weight : 0;
        $diff = $latest_weight - $target_weight;

        $weight_logs = \App\Models\WeightLog::where('user_id', $user->id)
        ->orderBy('date', 'desc')
        ->paginate(8);

        return view('admin',compact('latest_weight','target_weight','diff','weight_logs'));
    }

    public function showModalForm()
    {
        return redirect()->route('admin')->with('show_modal', true);
    }

    public function store(StoreWeightLogRequest $request)
    {
        WeightLog::create([
            'user_id' => Auth::id(),
            'date' => $request->date,
            'weight' => $request->weight,
            'calories' => $request->calories,
            'exercise_time' => $request->exercise_time,
            'exercise_content' => $request->exercise_content,
        ]);

        return redirect()->route('admin')->with('success', 'データを追加しました');
    }

    public function goal()
    {
        $userId = Auth::id();
        $target = WeightTarget::where('user_id', $userId)->first();

        return view('goal', compact('target'));
    }

    public function updateGoal(GoalRequest $request)
    {
        $userId = Auth::id();

        $target = WeightTarget::updateOrCreate(
            ['user_id' => $userId],
            ['target_weight' => $request->input('target_weight')]
        );

        return redirect()->route('admin')->with('status', '目標体重を更新しました。');
    }

    public function detail($weightLogId)
    {
        $log = \App\Models\WeightLog::findOrFail($weightLogId);

        return view('detail', compact('log'));
    }

    public function update(UpdateWeightLogRequest $request, $weightLogId)
    {
        $log = WeightLog::findOrFail($weightLogId);

        $validated = $request->only(['weight', 'calories', 'exercise_time', 'exercise_content']);
        $log->update($validated);

        return redirect()->route('admin')->with('status', 'データを更新しました。');
    }

    public function destroy($weightLogId)
    {
        $log = WeightLog::findOrFail($weightLogId);
    
        if ($log->user_id !== Auth::id()) {
            abort(403);
        }

        $log->delete();

        return redirect()->route('admin')->with('success', '削除しました');
    }

    public function search(Request $request)
    {
        $user = Auth::user();

        $latest_weight_log = WeightLog::where('user_id', $user->id)->orderBy('created_at', 'desc')->first();
        $weight_target = WeightTarget::where('user_id', $user->id)->first();

        $latest_weight = $latest_weight_log ? $latest_weight_log->weight : 0;
        $target_weight = $weight_target ? $weight_target->target_weight : 0;
        $diff = $latest_weight - $target_weight;

        $query = WeightLog::where('user_id', $user->id);

        if ($request->filled('start_date')) {
            $query->where('date', '>=', $request->input('start_date'));
        }

        if ($request->filled('end_date')) {
            $query->where('date', '<=', $request->input('end_date'));
        }

        $weight_logs = $query->orderBy('date', 'desc')->paginate(8);

        return view('admin', compact('latest_weight', 'target_weight', 'diff', 'weight_logs'));
    }

}
