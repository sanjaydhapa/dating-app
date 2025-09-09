<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('dob')->nullable();
            $table->string('age')->nullable();
            $table->string('gender')->nullable();
            $table->text('about_you')->nullable();
            $table->string('height')->nullable();
            $table->string('body_type')->nullable();
            $table->string('eye_color')->nullable();
            $table->string('hair_color')->nullable();
            $table->string('sleeping_habits')->nullable();
            $table->string('love_language')->nullable();
            $table->string('childrean')->nullable();
            $table->string('financial_status')->nullable();
            $table->string('dress_stype')->nullable();
            $table->string('pets')->nullable();
            $table->string('zodiac_sign')->nullable();
            $table->string('vaccinated')->nullable();
            $table->string('drinking_habits')->nullable();
            $table->string('smoking_habits')->nullable();
            $table->string('eating_habits')->nullable();
            $table->string('communication_style')->nullable();
            $table->string('workout')->nullable();
            $table->string('education')->nullable();
            $table->string('occupation')->nullable();
            $table->string('language_speak')->nullable();
            $table->string('relationship_status')->nullable();
            $table->string('religion')->nullable();
            $table->string('location')->nullable();
            $table->string('love_goals')->nullable();
            $table->text('looking_in_partner')->nullable();
            $table->string('sports')->nullable();
            $table->string('entertainment')->nullable();
            $table->string('my_interests')->nullable();
            $table->string('iam_looking_for')->nullable();
            $table->string('iam_seeking')->nullable();
            $table->integer('age_range_in_partner_min')->nullable();
            $table->integer('age_range_in_partner_max')->nullable();
            $table->integer('partner_distance_min')->nullable();
            $table->integer('partner_distance_max')->nullable();
            $table->integer('partner_height_min')->nullable();
            $table->integer('partner_height_max')->nullable();
            $table->string('partner_body_type')->nullable();
            $table->string('partner_relationship_status')->nullable();
            $table->string('partner_eye_color')->nullable();
            $table->string('partner_hair_color')->nullable();
            $table->string('partner_smoking_habits')->nullable();
            $table->string('partner_eating_habits')->nullable();
            $table->string('partner_drinking_habits')->nullable();
            $table->string('partner_children')->nullable();
            $table->string('partner_occupation')->nullable();
            $table->string('partner_education')->nullable();
            $table->string('partner_religion')->nullable();
            $table->string('partner_financial_status')->nullable();
            $table->string('partner_dress_style')->nullable();
            $table->string('partner_vaccinated')->nullable();
            $table->string('partner_pets')->nullable();
            $table->string('partner_sports')->nullable();
            $table->string('partner_entertainment')->nullable();
            $table->string('profile_photo')->nullable();
            $table->string('gallery_photo1')->nullable();
            $table->string('gallery_photo2')->nullable();
            $table->string('gallery_photo3')->nullable();
            $table->string('gallery_photo4')->nullable();
            $table->string('gallery_photo5')->nullable();
            $table->string('gallery_photo6')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_profiles');
    }
}
