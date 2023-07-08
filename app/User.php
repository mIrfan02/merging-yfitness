<?php

namespace App;

use Cartalyst\Sentinel\Users\EloquentUser;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends EloquentUser
{
	use HasApiTokens, HasFactory, Notifiable;
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes to be fillable from the model.
	 *
	 * A dirty hack to allow fields to be fillable by calling empty fillable array
	 *
	 * @var array
	 */
	protected $fillable = [];

	protected $guarded = ['id'];

	protected $appends = ['FitnessIngrediants', 'SubscriptionPlan', 'MySubscriptionpayments', 'MyNotifications', 'MyStatistics'];


	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token', 'api_token', 'apple_id', 'facebook_id', 'google_id', 'permissions', 'last_login', 'deleted_at', 'bio', 'language', 'country', 'state', 'city', 'address', 'postal', 'gender', 'dob', 'age', 'pic', 'FitnessIngrediants', 'SubscriptionPlan', 'MySubscriptionpayments', 'MyNotifications', 'MyStatistics', 'trial_to'];

	/**
	 * To allow soft deletes
	 */
	use SoftDeletes;

	protected $dates = ['deleted_at'];

	public function getFitnessIngrediantsAttribute()
	{

		return UserFitnessIngrediants::where('user_id', $this->id)->first();
	}

	public function getSubscriptionPlanAttribute()
	{

		return Subscriptions::where('id', $this->subscription_plan_id)->first();
	}
	
	public function getMySubscriptionpaymentsAttribute()
	{

		return UserSubscriptions::where('user_id', $this->id)->orderBy('id', 'desc')->get();
	}
	public function getMyNotificationsAttribute()
	{

		return UserNotification::where('user_id', $this->id)->first();
	}
	public function getMyStatisticsAttribute()
	{

		return UserStatistics::where('user_id', $this->id)->orderBy('id', 'desc')->take(60)->get();
	}
	// public function getMySettingsAttribute()
	// {

	// 	return UserSettings::where('user_id', $this->id)->get();
	// }

	public static function trainerselectbox()
	{
		$list = User::join('role_users as ru', 'ru.user_id', '=', 'users.id')->where('ru.role_id', 3)->get();
		$options = [];
		$options[0] = 'Select Trainer';
		foreach ($list as $item) {
			$options[$item->id] = $item->first_name . ' ' . $item->last_name;
		}
		return $options;
	}
	# # # bydefault role is user
	public static function totalUserswithDueDate($role = [2], $from = '', $to = '')
	{

		if (empty($from)) $from = date("Y-m-d 00:00:01", strtotime('monday this week'));
		if (empty($to))   $to = date('Y-m-d 23:59:59', strtotime(' +1 day'));
		$to = date('Y-m-d 23:59:59', strtotime(' +1 day', strtotime($to)));
		return self::join('role_users as r', 'users.id', '=', 'r.user_id')
			->whereIn('r.role_id', $role)
			->whereBetween('users.created_at', [$from, $to])
			->count();
	}

	public static function totalUsers($role = [2])
	{

		return self::join('role_users as r', 'users.id', '=', 'r.user_id')->whereIn('r.role_id', $role)->count();
	}

	public function reports()
	{
		return $this->hasMany(Report::class, 'user_id');
	}

	public function reportedReports()
	{
		return $this->hasMany(Report::class, 'reported_user_id');
	}

	// relation with courses to retrive trainer name
	public function courses()
	{
		return $this->hasMany(Course::class, 'trainer_id');
	}
	public function getNameAttribute()
	{
		return $this->first_name . " " . $this->last_name;
	}
}