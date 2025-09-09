<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class UserProfile extends Model
{
	use SoftDeletes;
	protected $guarded=[];
	protected $dates = ['deleted_at'];
	protected $fillable = [
		'user_id', 'dob', 'gender', 'about_you', 'body_type', 'eye_color', 'hair_color', 'sleeping_habits', 'love_language',
		'childrean', 'financial_status', 'dress_stype', 'pets', 'zodiac_sign', 'vaccinated', 'drinking_habits',
		'smoking_habits', 'eating_habits', 'communication_style', 'workout', 'education', 'language_speak',
		'relationship_status', 'religion', 'location', 'love_goals', 'looking_in_partner', 'sports', 'entertainment',
		'my_interests', 'iam_looking_for', 'iam_seeking', 'age_range_in_partner_min', 'age_range_in_partner_max',
		'partner_distance_min', 'partner_distance_max', 'partner_height_min', 'partner_height_max', 'partner_body_type',
		'partner_relationship_status', 'partner_eye_color', 'partner_hair_color', 'partner_smoking_habits',
		'partner_eating_habits', 'partner_children', 'partner_occupation', 'partner_education', 'partner_religion',
		'partner_financial_status', 'partner_dress_style', 'partner_vaccinated', 'partner_pets', 'partner_sports',
		'partner_entertainment', 'profile_photo', 'gallery_photo1', 'gallery_photo2', 'gallery_photo3',
		'gallery_photo4', 'gallery_photo5', 'gallery_photo6','occupation','partner_drinking_habits','languages_spoken',
		'country','height',
		
	];
    //
}
