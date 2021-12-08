<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LeaderboardController extends Controller
{
    public function show()
    {
        $jsonString = file_get_contents(base_path('public/leaderboard.json'));
        $json = Str::replace("\r\n", "", $jsonString);
        $json = Str::replaceLast(',', "", $json);
        $data = json_decode($json, true);

        return view('leaderboard', [
            'data' => $data
        ]);
    }
	
	public function store(Request $request)
	{	
		// Form Validation
		$request->validate([
			'steps' => 'required|numeric|max:50000'
		]);
		
		//Steps to save to database
		//$leaderboard = new Leaderboard();
		//$leaderboard->steps = $request->steps;
		//$leaderboard->save();
		return back()->with('success', 'Your steps saved to database.');
	}
}
