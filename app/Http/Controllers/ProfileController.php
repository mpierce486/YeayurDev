<?php

namespace Yeayurdev\Http\Controllers;

use Carbon\Carbon;
use DB;
use Image;
use Input;
use Auth;
use Yeayurdev\Models\User;
use Yeayurdev\Models\Post;
use Yeayurdev\Models\Type;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
	public function getProfile ($username)
	{

		$user = User::where('username', $username)->first();

		$posts = Post::where('profile_id', $user->id)->orderBy('created_at', 'desc')->get();

		$gameDetails = DB::table('user_type')
			->where('user_id' , $user->id)
			->where('type_id' , 1)
			->lists('user_type_details');

		$artDetails = DB::table('user_type')
			->where('user_id' , $user->id)
			->where('type_id' , 2)
			->lists('user_type_details');
		
		$musicDetails = DB::table('user_type')
			->where('user_id' , $user->id)
			->where('type_id' , 3)
			->lists('user_type_details');

		$buildingStuffDetails = DB::table('user_type')
			->where('user_id' , $user->id)
			->where('type_id' , 4)
			->lists('user_type_details');

		$educationalDetails = DB::table('user_type')
			->where('user_id' , $user->id)
			->where('type_id' , 5)
			->lists('user_type_details');	

		$aboutMe = DB::table('user_optional_details')
			->where('user_id' , $user->id)
			->value('about_me');

		$systemSpecs = DB::table('user_optional_details')
			->where('user_id' , $user->id)
			->value('system_specs');

		$streamSchedule = DB::table('user_optional_details')
			->where('user_id' , $user->id)
			->value('stream_schedule');

		$aboutMe = DB::table('user_optional_details')
			->where('user_id' , Auth::user()->id)
			->value('about_me');
		/**
		 *  Code for recently_visited table. If user has not previously
		 *  visited that profile, create a record. If user has, then  
		 *  increment the "times_visited" column.
		 */

		if (!Auth::user()->previouslyVisited($user) && Auth::user()->id !== $user->id) {

			Auth::user()->addProfileVisits($user);
        }
			
		$visits = DB::table('recently_visited')
			->where('profile_id',$user->id)
			->where('visitor_id',Auth::user()->id)
			->increment('times_visited', 1, ['last_visit' => Carbon::now()]);
			
		if (!$user) {
			abort(404);
		}

		return view('profile.index')
			->with([
				'user' => $user,
				'posts' => $posts,
				'gameDetails' => $gameDetails,
				'artDetails' => $artDetails,
				'musicDetails' => $musicDetails,
				'buildingStuffDetails' => $buildingStuffDetails,
				'educationalDetails' => $educationalDetails,
				'aboutMe' => $aboutMe,
				'systemSpecs' => $systemSpecs,
				'streamSchedule' => $streamSchedule,
				'aboutMe' => $aboutMe,
			]);
			
	}

	public function getEdit()
	{

		$aboutMe = DB::table('user_optional_details')
			->where('user_id' , Auth::user()->id)
			->value('about_me');

		return view('profile.edit')
			->with([
				'aboutMe' => $aboutMe,
			]);
	}

	public function postEdit(Request $request)
	{
		$this->validate($request, [
			'email' => 'unique:users,email,'.Auth::user()->id.'|email|max:255',
			'password' => 'min:6',
			'confirm_password' => 'same:password', 
			'profile-image' => 'image|max:4999',
			'about_me' => 'max:500',
		]);

		Auth::user()->update([
			'email' => $request->input('email'),
		]);

		if ($request->has('about_me'))
		{
			DB::table('user_optional_details')
				->update([
					'about_me' => $request->input('about_me')
				]);
		}

		if (Input::hasFile('profile-image'))
		{
			$extension = Input::file('profile-image')->getClientOriginalExtension();
			$fileName = rand(11111,99999).'.'.$extension;
			
			$image = Image::make(Input::file('profile-image'))
				->orientate()
				->resize(300, null, function ($constraint) { 
					$constraint->aspectRatio();
				})
				->save('images/profiles/'.$fileName);
			
			Auth::user()->update([
				'image_path' => $fileName,
			]);
		}

		if ($request->has('password'))
		{
			Auth::user()->update([
				'password' => bcrypt($request->input('password')),
				'confirm_password' => bcrypt($request->input('confirm_password')),
			]);
		}

		return redirect()->route('profile.edit')->with('info', 'You have updated your profile!');
	}

	

}