@extends('admin.admin_master')
@section('css')
    <link href="{{ asset('backend/assets/vendors/select2/dist/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/vendors/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/nouislider@15.7.0/dist/nouislider.min.css" rel="stylesheet">
@endsection

@section('admin')
    <div class="container-full">
        <!-- Content Header (user header) -->




        <!-- /////////////////  Start Thambnail Image Update Area ///////// -->

        <section class="content">

            <form method="post" action="{{ route('user.update') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $user->id }}">
                <!-- Basic Forms -->
                <div class="box">

                    <!-- /.box-header -->
                    <div class="box-body">

                        <div class="tab-content">
                            <div class="tab-pane active" id="content" role="tabpanel">
                                <h3>User</h3>
                                <div class="row"> <!-- start 1nd row  -->

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>User Name <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="name" value="{{ $user->name }}"
                                                    class="form-control">
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div> <!-- end col md 4 -->

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Nick Name <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="nick_name" value="{{ $user->nick_name }}"
                                                    class="form-control">
                                                @error('nick_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div> <!-- end col md 4 -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Email<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="email" value="{{ $user->email }}"
                                                    class="form-control">
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div> <!-- end col md 4 -->


                                </div> <!-- end 1nd row  -->


                                <div class="row"> <!-- start 6th row  -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>User Profile Image<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="file" name="thambnail" class="form-control"
                                                    data-preview="#mainThmb" onChange="mainThamUrl(this)" require>
                                                @error('thambnail')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror


                                            </div>
                                        </div>
                                    </div> <!-- end col md 4 -->
                                    <div class="col-md-4">

                                        @if ($user->profile_photo_path)
                                            <img src="{{ asset('storage/' . $user->profile_photo_path) }}" id="mainThmb"
                                                style="max-width: 150px; height: auto;">
                                        @endif
                                    </div>
                                </div> <!-- end 6th row  -->





                                {{-- KYC SECTION --}}
                                <hr>
                                <h3>KYC</h3>
                                <div class="row"> <!-- start 1nd row  -->

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Country <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="country" class="form-control">
                                                    <option value="">Select Country</option>
                                                    @foreach (config('profile_fields.country') as $country)
                                                        <option value="{{ $country }}"
                                                            {{ ($kycDetail->country ?? '') == $country ? 'selected' : '' }}>
                                                            {{ $country }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                                @error('country')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div> <!-- end col md 4 -->


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>User Id Type <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="id_type" class="form-control">
                                                    <option value="">Select Id Type</option>
                                                    @foreach (config('profile_fields.document_type') as $document_type)
                                                        <option value="{{ $document_type }}"
                                                            {{ ($kycDetail->id_type ?? '') == $document_type ? 'selected' : '' }}>
                                                            {{ $document_type }}</option>
                                                    @endforeach
                                                </select>

                                                @error('id_type')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div> <!-- end col md 4 -->
                                </div> <!-- end 1nd row  -->


                                <div class="row"> <!-- start 6th row  -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Identity Document<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="file" name="thambnail_kyc" class="form-control"
                                                    data-preview="#mainThmb_kyc" onChange="mainThamUrl(this)" require>
                                                @error('thambnail')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror


                                            </div>
                                        </div>
                                    </div> <!-- end col md 4 -->
                                    <div class="col-md-4">
                                        <img id="mainThmb_kyc"
                                            src="{{ $kycDetail && $kycDetail->id_document ? asset('storage/' . $kycDetail->id_document) : '' }}"
                                            style="max-width: 150px; height: auto; {{ !$kycDetail || !$kycDetail->id_document ? 'display: none;' : '' }}">
                                    </div>

                                </div> <!-- end 6th row  -->







                                {{-- PROFILE SECTION --}}
                                <hr>
                                <h3>Profile</h3>
                                <div class="row"> <!-- start 1nd row  -->

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Date of Birth <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="dob" placeholder="Select Dob"
                                                    value="{{ $profile && $profile->dob ? \Carbon\Carbon::parse($profile->dob)->format('d/m/Y') : '' }}"
                                                    class="form-control" id="dob-picker" />

                                                @error('dob')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Age</h5>
                                            <div class="controls">
                                                <input type="text" name="age" id="age" class="form-control"
                                                    value="" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Gender <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="gender" class="form-control">
                                                    <option value="">Select Gender</option>
                                                    @foreach (config('profile_fields.gender') as $gender)
                                                        <option value="{{ $gender }}"
                                                            {{ ($profile->gender ?? '') == $gender ? 'selected' : '' }}>
                                                            {{ $gender }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('gender')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 ">
                                        <div class="form-group">
                                            <h5>About You <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <textarea name="about_you" class="form-control" rows="4" placeholder="Write something about yourself...">{{ $profile->about_you ?? '' }}</textarea>
                                                @error('about_you')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Height <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="height" class="form-control">
                                                    <option value="">Select Height</option>
                                                    @foreach (config('profile_fields.height') as $value => $label)
                                                        <option value="{{ $value }}"
                                                            {{ ($profile->height ?? '') === (string) $value ? 'selected' : '' }}>
                                                            {{ $label }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('height')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Body Type <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="body_type" class="form-control">
                                                    <option value="">Select Body Type</option>
                                                    @foreach (config('profile_fields.body_type') as $body_type)
                                                        <option value="{{ $body_type }}"
                                                            {{ ($profile->body_type ?? '') == $body_type ? 'selected' : '' }}>
                                                            {{ $body_type }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('body_type')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Eye Color <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="eye_color" class="form-control">
                                                    <option value="">Select Eye Color</option>
                                                    @foreach (config('profile_fields.eye_color') as $eye_color)
                                                        <option value="{{ $eye_color }}"
                                                            {{ ($profile->eye_color ?? '') == $eye_color ? 'selected' : '' }}>
                                                            {{ $eye_color }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('eye_color')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Hair Color <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="hair_color" class="form-control">
                                                    <option value="">Select Hair Color</option>
                                                    @foreach (config('profile_fields.hair_color') as $hair_color)
                                                        <option value="{{ $hair_color }}"
                                                            {{ ($profile->hair_color ?? '') == $hair_color ? 'selected' : '' }}>
                                                            {{ $hair_color }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('hair_color')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Sleeping Habits <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="sleeping_habits" class="form-control">
                                                    <option value="">Select Sleeping Habit</option>
                                                    @foreach (config('profile_fields.sleeping_habits') as $sleeping_habits)
                                                        <option value="{{ $sleeping_habits }}"
                                                            {{ ($profile->sleeping_habits ?? '') == $sleeping_habits ? 'selected' : '' }}>
                                                            {{ $sleeping_habits }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('sleeping_habits')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Love Language <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="love_language" class="form-control">
                                                    <option value="">Select Love Language</option>
                                                    @foreach (config('profile_fields.love_language') as $love_language)
                                                        <option value="{{ $love_language }}"
                                                            {{ ($profile->love_language ?? '') == $love_language ? 'selected' : '' }}>
                                                            {{ $love_language }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('love_language')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Children <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="childrean" class="form-control">
                                                    <option value="">Select Option</option>
                                                    @foreach (config('profile_fields.childrean') as $childrean)
                                                        <option value="{{ $childrean }}"
                                                            {{ ($profile->childrean ?? '') == $childrean ? 'selected' : '' }}>
                                                            {{ $childrean }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('childrean')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Financial Status <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="financial_status" class="form-control">
                                                    <option value="">Select Financial Status</option>
                                                    @foreach (config('profile_fields.financial_status') as $financial_status)
                                                        <option value="{{ $financial_status }}"
                                                            {{ ($profile->financial_status ?? '') == $financial_status ? 'selected' : '' }}>
                                                            {{ $financial_status }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('financial_status')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Dress Style <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="dress_stype" class="form-control">
                                                    <option value="">Select Dress Style</option>
                                                    @foreach (config('profile_fields.dress_stype') as $dress_stype)
                                                        <option value="{{ $dress_stype }}"
                                                            {{ ($profile->dress_stype ?? '') == $dress_stype ? 'selected' : '' }}>
                                                            {{ $dress_stype }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('dress_stype')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Pets <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="pets" class="form-control">
                                                    <option value="">Select Pet</option>
                                                    @foreach (config('profile_fields.pets') as $pets)
                                                        <option value="{{ $pets }}"
                                                            {{ ($profile->pets ?? '') == $pets ? 'selected' : '' }}>
                                                            {{ $pets }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('pets')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Zodiac Sign <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="zodiac_sign" class="form-control">
                                                    <option value="">Select Zodiac Sign</option>
                                                    @foreach (config('profile_fields.zodiac_sign') as $zodiac_sign)
                                                        <option value="{{ $zodiac_sign }}"
                                                            {{ ($profile->zodiac_sign ?? '') == $zodiac_sign ? 'selected' : '' }}>
                                                            {{ $zodiac_sign }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('zodiac_sign')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Vaccinated <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="vaccinated" class="form-control">
                                                    <option value="">Select Vaccination Status</option>
                                                    @foreach (config('profile_fields.vaccinated') as $vaccinated)
                                                        <option value="{{ $vaccinated }}"
                                                            {{ ($profile->vaccinated ?? '') == $vaccinated ? 'selected' : '' }}>
                                                            {{ $vaccinated }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('vaccinated')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Drinking Habits <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="drinking_habits" class="form-control">
                                                    <option value="">Select Drinking Habit</option>
                                                    @foreach (config('profile_fields.drinking_habits') as $drinking_habits)
                                                        <option value="{{ $drinking_habits }}"
                                                            {{ ($profile->drinking_habits ?? '') == $drinking_habits ? 'selected' : '' }}>
                                                            {{ $drinking_habits }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('drinking_habits')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Smoking Habits <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="smoking_habits" class="form-control">
                                                    <option value="">Select Smoking Habit</option>
                                                    @foreach (config('profile_fields.smoking_habits') as $smoking_habits)
                                                        <option value="{{ $smoking_habits }}"
                                                            {{ ($profile->smoking_habits ?? '') == $smoking_habits ? 'selected' : '' }}>
                                                            {{ $smoking_habits }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('smoking_habits')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Eating Habits <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="eating_habits" class="form-control">
                                                    <option value="">Select Eating Habit</option>
                                                    @foreach (config('profile_fields.eating_habits') as $eating_habits)
                                                        <option value="{{ $eating_habits }}"
                                                            {{ ($profile->eating_habits ?? '') == $eating_habits ? 'selected' : '' }}>
                                                            {{ $eating_habits }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('eating_habits')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Communication Style <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="communication_style" class="form-control">
                                                    <option value="">Select Communication Style</option>
                                                    @foreach (config('profile_fields.communication_style') as $communication_style)
                                                        <option value="{{ $communication_style }}"
                                                            {{ ($profile->communication_style ?? '') == $communication_style ? 'selected' : '' }}>
                                                            {{ $communication_style }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('communication_style')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Workout <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="workout" class="form-control">
                                                    <option value="">Select Workout Habit</option>
                                                    @foreach (config('profile_fields.workout') as $workout)
                                                        <option value="{{ $workout }}"
                                                            {{ ($profile->workout ?? '') == $workout ? 'selected' : '' }}>
                                                            {{ $workout }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('workout')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Education <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="education" class="form-control">
                                                    <option value="">Select Education</option>
                                                    @foreach (config('profile_fields.education') as $education)
                                                        <option value="{{ $education }}"
                                                            {{ ($profile->education ?? '') == $education ? 'selected' : '' }}>
                                                            {{ $education }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('education')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Occupation <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="occupation" class="form-control">
                                                    <option value="">Select Occupation</option>
                                                    @foreach (config('profile_fields.occupation') as $occupation)
                                                        <option value="{{ $occupation }}"
                                                            {{ ($profile->occupation ?? '') == $occupation ? 'selected' : '' }}>
                                                            {{ $occupation }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('occupation')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $selectedLanguages = old('language_speak', $profile->language_speak ?? []);

                                        // If DB value is a string, convert to array
                                        if (is_string($selectedLanguages)) {
                                            $selectedLanguages = array_map('trim', explode(',', $selectedLanguages));
                                        }
                                    @endphp

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Language Speak <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <div class="dropdown">
                                                    <button type="button"
                                                       class="py-2 form-control dropdown-toggle text-start"
                                                        data-bs-toggle="dropdown" aria-expanded="false"
                                                        id="languageSpeakDropdownButton">
                                                        Select Languages
                                                    </button>

                                                    <div class="dropdown-menu p-3"
                                                        style="width: 100%; max-height: 300px; overflow-y: auto;">
                                                        @foreach (config('profile_fields.language_speak') as $language)
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="language_speak_{{ $loop->index }}"
                                                                    name="language_speak[]" value="{{ $language }}"
                                                                    {{ in_array($language, $selectedLanguages) ? 'checked' : '' }}>
                                                                <label class="form-check-label"
                                                                    for="language_speak_{{ $loop->index }}">
                                                                    {{ $language }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>

                                                @error('language_speak')
                                                    <span class="text-danger d-block mt-1">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Relationship Status <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="relationship_status" class="form-control">
                                                    <option value="">Select Relationship Status</option>
                                                    @foreach (config('profile_fields.relationship_status') as $relationship_status)
                                                        <option value="{{ $relationship_status }}"
                                                            {{ ($profile->relationship_status ?? '') == $relationship_status ? 'selected' : '' }}>
                                                            {{ $relationship_status }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('relationship_status')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Religion <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="religion" class="form-control">
                                                    <option value="">Select Religion</option>
                                                    @foreach (config('profile_fields.religion') as $religion)
                                                        <option value="{{ $religion }}"
                                                            {{ ($profile->religion ?? '') == $religion ? 'selected' : '' }}>
                                                            {{ $religion }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('religion')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Location <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="location" class="form-control">
                                                    <option value="">Select Location</option>
                                                    @foreach (config('profile_fields.location') as $location)
                                                        <option value="{{ $location }}"
                                                            {{ ($profile->location ?? '') == $location ? 'selected' : '' }}>
                                                            {{ $location }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('location')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <h5>Love Goals <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <textarea name="love_goals" class="form-control" rows="4" placeholder="Describe your love goals...">{{ old('love_goals', $profile->love_goals ?? '') }}</textarea>
                                                @error('love_goals')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <h5>Looking in a Partner <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <textarea name="looking_in_partner" class="form-control" rows="4"
                                                    placeholder="Describe what you’re looking for in a partner...">{{ old('looking_in_partner', $profile->looking_in_partner ?? '') }}</textarea>
                                                @error('looking_in_partner')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $selectedSports = old('sports', $selectedSports ?? []);
                                    @endphp

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Sports <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <div class="dropdown">
                                                    <button type="button"
                                                       class="py-2 form-control dropdown-toggle text-start"
                                                        data-bs-toggle="dropdown" aria-expanded="false"
                                                        id="sportsDropdownButton">
                                                        Select Sports
                                                    </button>

                                                    <div class="dropdown-menu p-3"
                                                        style="width: 100%; max-height: 300px; overflow-y: auto;">
                                                        @foreach (config('profile_fields.sports') as $sport)
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="sport_{{ $loop->index }}" name="sports[]"
                                                                    value="{{ $sport }}"
                                                                    {{ in_array($sport, $selectedSports) ? 'checked' : '' }}>
                                                                <label class="form-check-label"
                                                                    for="sport_{{ $loop->index }}">
                                                                    {{ $sport }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>

                                                @error('sports')
                                                    <span class="text-danger d-block mt-1">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $selectedEntertainment = old('entertainment', $selectedEntertainment ?? []);
                                    @endphp

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Entertainment <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <div class="dropdown">
                                                    <button type="button"
                                                       class="py-2 form-control dropdown-toggle text-start"
                                                        data-bs-toggle="dropdown" aria-expanded="false"
                                                        id="entertainmentDropdownButton">
                                                        Select Entertainment
                                                    </button>

                                                    <div class="dropdown-menu p-3"
                                                        style="width: 100%; max-height: 300px; overflow-y: auto;">
                                                        @foreach (config('profile_fields.entertainment') as $entertainment)
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="entertainment_{{ $loop->index }}"
                                                                    name="entertainment[]" value="{{ $entertainment }}"
                                                                    {{ in_array($entertainment, $selectedEntertainment) ? 'checked' : '' }}>
                                                                <label class="form-check-label"
                                                                    for="entertainment_{{ $loop->index }}">
                                                                    {{ $entertainment }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>

                                                @error('entertainment')
                                                    <span class="text-danger d-block mt-1">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $selectedInterests = old('my_interests', $selectedInterests ?? []);
                                    @endphp

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>My Interests <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <div class="dropdown">
                                                    <button type="button"
                                                       class="py-2 form-control dropdown-toggle text-start"
                                                        data-bs-toggle="dropdown" aria-expanded="false"
                                                        id="interestsDropdownButton">
                                                        Select Interests
                                                    </button>

                                                    <div class="dropdown-menu p-3"
                                                        style="width: 100%; max-height: 300px; overflow-y: auto;">
                                                        @foreach (config('profile_fields.my_interests') as $interest)
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="interest_{{ $loop->index }}"
                                                                    name="my_interests[]" value="{{ $interest }}"
                                                                    {{ in_array($interest, $selectedInterests) ? 'checked' : '' }}>
                                                                <label class="form-check-label"
                                                                    for="interest_{{ $loop->index }}">
                                                                    {{ $interest }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>

                                                @error('my_interests')
                                                    <span class="text-danger d-block mt-1">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    @php
                                        $selectedLookingFor = old('iam_looking_for', $selectedLookingFor ?? []);
                                    @endphp

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>I am Looking For <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <div class="dropdown">
                                                    <button type="button"
                                                       class="py-2 form-control dropdown-toggle text-start"
                                                        data-bs-toggle="dropdown" aria-expanded="false"
                                                        id="lookingForDropdownButton">
                                                        Select Option
                                                    </button>

                                                    <div class="dropdown-menu p-3"
                                                        style="width: 100%; max-height: 300px; overflow-y: auto;">
                                                        @foreach (config('profile_fields.iam_looking_for') as $option)
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="lookingFor_{{ $loop->index }}"
                                                                    name="iam_looking_for[]" value="{{ $option }}"
                                                                    {{ in_array($option, $selectedLookingFor) ? 'checked' : '' }}>
                                                                <label class="form-check-label"
                                                                    for="lookingFor_{{ $loop->index }}">
                                                                    {{ $option }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>

                                                @error('iam_looking_for')
                                                    <span class="text-danger d-block mt-1">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $selectedSeeking = old('iam_seeking', $selectedSeeking ?? []);
                                    @endphp

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>I Am Seeking <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <div class="dropdown">
                                                    <button type="button"
                                                       class="py-2 form-control dropdown-toggle text-start"
                                                        data-bs-toggle="dropdown" aria-expanded="false"
                                                        id="iamSeekingDropdownButton">
                                                        Select Options
                                                    </button>

                                                    <div class="dropdown-menu p-3"
                                                        style="width: 100%; max-height: 300px; overflow-y: auto;">
                                                        @foreach (config('profile_fields.iam_seeking') as $option)
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="iam_seeking_{{ $loop->index }}"
                                                                    name="iam_seeking[]" value="{{ $option }}"
                                                                    {{ in_array($option, $selectedSeeking) ? 'checked' : '' }}>
                                                                <label class="form-check-label"
                                                                    for="iam_seeking_{{ $loop->index }}">
                                                                    {{ $option }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>

                                                @error('iam_seeking')
                                                    <span class="text-danger d-block mt-1">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        // fallback for old input or DB values
                                        $ageMin = old(
                                            'age_range_in_partner_min',
                                            $profile->age_range_in_partner_min ?? 18,
                                        );
                                        $ageMax = old(
                                            'age_range_in_partner_max',
                                            $profile->age_range_in_partner_max ?? 60,
                                        );
                                    @endphp
                                    <div class="col-md-4"></div>
                                    <hr>
                                    <h3>Desired partner</h3>
                                    <hr>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5 style='margin-bottom: 50px;' >Preferred Age Range <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <div id="ageRangeSlider"></div>

                                                <div class="d-flex justify-content-between mt-2">
                                                    <div>
                                                        Min Age:
                                                        <span id="ageRangeMinValue">{{ $ageMin }}</span>
                                                    </div>
                                                    <div>
                                                        Max Age:
                                                        <span id="ageRangeMaxValue">{{ $ageMax }}</span>
                                                    </div>
                                                </div>

                                                <!-- Hidden inputs to submit the selected values -->
                                                <input type="hidden" name="age_range_in_partner_min" id="ageRangeMin"
                                                    value="{{ $ageMin }}">
                                                <input type="hidden" name="age_range_in_partner_max" id="ageRangeMax"
                                                    value="{{ $ageMax }}">

                                                @error('age_range_in_partner_min')
                                                    <span class="text-danger d-block mt-1">{{ $message }}</span>
                                                @enderror
                                                @error('age_range_in_partner_max')
                                                    <span class="text-danger d-block mt-1">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        // Fallback for old input or DB values
                                        $distanceMin = old(
                                            'partner_distance_min',
                                            $profile->partner_distance_min ?? 10,
                                        );
                                        $distanceMax = old(
                                            'partner_distance_max',
                                            $profile->partner_distance_max ?? 500,
                                        );
                                    @endphp

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5 style='margin-bottom: 50px;'>Preferred Partner Distance (km) <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <div id="distanceRangeSlider"></div>

                                                <div class="d-flex justify-content-between mt-2">
                                                    <div>
                                                        Min Distance:
                                                        <span id="distanceRangeMinValue">{{ $distanceMin }}</span> km
                                                    </div>
                                                    <div>
                                                        Max Distance:
                                                        <span id="distanceRangeMaxValue">{{ $distanceMax }}</span> km
                                                    </div>
                                                </div>

                                                <input type="hidden" name="partner_distance_min" id="distanceRangeMin"
                                                    value="{{ $distanceMin }}">
                                                <input type="hidden" name="partner_distance_max" id="distanceRangeMax"
                                                    value="{{ $distanceMax }}">

                                                @error('partner_distance_min')
                                                    <span class="text-danger d-block mt-1">{{ $message }}</span>
                                                @enderror
                                                @error('partner_distance_max')
                                                    <span class="text-danger d-block mt-1">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        // fallback for old input or DB values
                                        $heightMin = old('partner_height_min', $profile->partner_height_min ?? 122);
                                        $heightMax = old('partner_height_max', $profile->partner_height_max ?? 213);
                                    @endphp

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5 style='margin-bottom: 50px;'>Preferred Partner Height (cm) <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <div id="partnerHeightRangeSlider"></div>

                                                <div class="d-flex justify-content-between mt-2">
                                                    <div>
                                                        Min Height:
                                                        <span id="partnerHeightMinValue">{{ $heightMin }}</span> cm
                                                    </div>
                                                    <div>
                                                        Max Height:
                                                        <span id="partnerHeightMaxValue">{{ $heightMax }}</span> cm
                                                    </div>
                                                </div>

                                                <input type="hidden" name="partner_height_min" id="partnerHeightMin"
                                                    value="{{ $heightMin }}">
                                                <input type="hidden" name="partner_height_max" id="partnerHeightMax"
                                                    value="{{ $heightMax }}">

                                                @error('partner_height_min')
                                                    <span class="text-danger d-block mt-1">{{ $message }}</span>
                                                @enderror
                                                @error('partner_height_max')
                                                    <span class="text-danger d-block mt-1">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Partner Body Type <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="partner_body_type" class="form-control">
                                                    <option value="">Select Partner Body Type</option>
                                                    @foreach (config('profile_fields.body_type') as $body_type)
                                                        <option value="{{ $body_type }}"
                                                            {{ ($profile->partner_body_type ?? '') == $body_type ? 'selected' : '' }}>
                                                            {{ $body_type }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('partner_body_type')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Relationship Status <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="partner_relationship_status" class="form-control">
                                                    <option value="">Select Relationship Status</option>
                                                    @foreach (config('profile_fields.relationship_status') as $relationship_status)
                                                        <option value="{{ $relationship_status }}"
                                                            {{ ($profile->partner_relationship_status ?? '') == $relationship_status ? 'selected' : '' }}>
                                                            {{ $relationship_status }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('partner_relationship_status')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Partner Eye Color <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="partner_eye_color" class="form-control">
                                                    <option value="">Select Partner Eye Color</option>
                                                    @foreach (config('profile_fields.eye_color') as $eye_color)
                                                        <option value="{{ $eye_color }}"
                                                            {{ ($profile->partner_eye_color ?? '') == $eye_color ? 'selected' : '' }}>
                                                            {{ $eye_color }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('partner_eye_color')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Partner Hair Color <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="partner_hair_color" class="form-control">
                                                    <option value="">Select Partner Hair Color</option>
                                                    @foreach (config('profile_fields.hair_color') as $hair_color)
                                                        <option value="{{ $hair_color }}"
                                                            {{ ($profile->partner_hair_color ?? '') == $hair_color ? 'selected' : '' }}>
                                                            {{ $hair_color }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('partner_hair_color')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Partner Smoking Habits <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="partner_smoking_habits" class="form-control">
                                                    <option value="">Select Partner Smoking Habit</option>
                                                    @foreach (config('profile_fields.smoking_habits') as $smoking_habits)
                                                        <option value="{{ $smoking_habits }}"
                                                            {{ ($profile->partner_smoking_habits ?? '') == $smoking_habits ? 'selected' : '' }}>
                                                            {{ $smoking_habits }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('partner_smoking_habits')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Partner Eating Habits <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="partner_eating_habits" class="form-control">
                                                    <option value="">Select Partner Eating Habit</option>
                                                    @foreach (config('profile_fields.eating_habits') as $eating_habits)
                                                        <option value="{{ $eating_habits }}"
                                                            {{ ($profile->partner_eating_habits ?? '') == $eating_habits ? 'selected' : '' }}>
                                                            {{ $eating_habits }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('partner_eating_habits')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Partner Drinking Habits <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="partner_drinking_habits" class="form-control">
                                                    <option value="">Select Partner Drinking Habit</option>
                                                    @foreach (config('profile_fields.drinking_habits') as $drinking_habits)
                                                        <option value="{{ $drinking_habits }}"
                                                            {{ ($profile->partner_drinking_habits ?? '') == $drinking_habits ? 'selected' : '' }}>
                                                            {{ $drinking_habits }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('partner_drinking_habits')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Partner Children <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="partner_children" class="form-control">
                                                    <option value="">Select Option</option>
                                                    @foreach (config('profile_fields.partner_children') as $partner_children)
                                                        <option value="{{ $partner_children }}"
                                                            {{ ($profile->partner_children ?? '') == $partner_children ? 'selected' : '' }}>
                                                            {{ $partner_children }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('partner_children')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Partner Occupation <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="partner_occupation" class="form-control">
                                                    <option value="">Select Partner Occupation</option>
                                                    @foreach (config('profile_fields.occupation') as $occupation)
                                                        <option value="{{ $occupation }}"
                                                            {{ ($profile->partner_occupation ?? '') == $occupation ? 'selected' : '' }}>
                                                            {{ $occupation }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('partner_occupation')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Partner Education <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="partner_education" class="form-control">
                                                    <option value="">Select Partner Education</option>
                                                    @foreach (config('profile_fields.education') as $education)
                                                        <option value="{{ $education }}"
                                                            {{ ($profile->partner_education ?? '') == $education ? 'selected' : '' }}>
                                                            {{ $education }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('partner_education')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Partner Religion <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="partner_religion" class="form-control">
                                                    <option value="">Select Partner Religion</option>
                                                    @foreach (config('profile_fields.religion') as $religion)
                                                        <option value="{{ $religion }}"
                                                            {{ ($profile->partner_religion ?? '') == $religion ? 'selected' : '' }}>
                                                            {{ $religion }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('partner_religion')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Partner Financial Status <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="partner_financial_status" class="form-control">
                                                    <option value="">Select Partner Financial Status</option>
                                                    @foreach (config('profile_fields.financial_status') as $financial_status)
                                                        <option value="{{ $financial_status }}"
                                                            {{ ($profile->partner_financial_status ?? '') == $financial_status ? 'selected' : '' }}>
                                                            {{ $financial_status }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('partner_financial_status')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Partner Dress Style <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="partner_dress_style" class="form-control">
                                                    <option value="">Select Partner Dress Style</option>
                                                    @foreach (config('profile_fields.dress_stype') as $dress_stype)
                                                        <option value="{{ $dress_stype }}"
                                                            {{ ($profile->partner_dress_style ?? '') == $dress_stype ? 'selected' : '' }}>
                                                            {{ $dress_stype }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('partner_dress_stype')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Partner Vaccination Status <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="partner_vaccinated" class="form-control">
                                                    <option value="">Select Partner Vaccination Status</option>
                                                    @foreach (config('profile_fields.vaccinated') as $vaccinated)
                                                        <option value="{{ $vaccinated }}"
                                                            {{ ($profile->partner_vaccinated ?? '') == $vaccinated ? 'selected' : '' }}>
                                                            {{ $vaccinated }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('partner_vaccinated')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $selectedPartnerPets = old('partner_pets', $profile->partner_pets ?? []);

                                        if (is_string($selectedPartnerPets)) {
                                            $selectedPartnerPets = array_map(
                                                'trim',
                                                explode(',', $selectedPartnerPets),
                                            );
                                        }
                                    @endphp

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Partner Pets <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <div class="dropdown">
                                                    <button type="button"
                                                       class="py-2 form-control dropdown-toggle text-start"
                                                        data-bs-toggle="dropdown" aria-expanded="false"
                                                        id="partnerPetsDropdownButton">
                                                        Select Partner Pets
                                                    </button>

                                                    <div class="dropdown-menu p-3"
                                                        style="width: 100%; max-height: 300px; overflow-y: auto;">
                                                        @foreach (config('profile_fields.pets') as $pet)
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="partner_pet_{{ $loop->index }}"
                                                                    name="partner_pets[]" value="{{ $pet }}"
                                                                    {{ in_array($pet, $selectedPartnerPets) ? 'checked' : '' }}>
                                                                <label class="form-check-label"
                                                                    for="partner_pet_{{ $loop->index }}">
                                                                    {{ $pet }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>

                                                @error('partner_pets')
                                                    <span class="text-danger d-block mt-1">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $selectedPartnerSports = old('partner_sports', $profile->partner_sports ?? []);

                                        if (is_string($selectedPartnerSports)) {
                                            $selectedPartnerSports = array_map(
                                                'trim',
                                                explode(',', $selectedPartnerSports),
                                            );
                                        }
                                    @endphp

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Partner Sports <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <div class="dropdown">
                                                    <button type="button"
                                                       class="py-2 form-control dropdown-toggle text-start"
                                                        data-bs-toggle="dropdown" aria-expanded="false"
                                                        id="partnerSportsDropdownButton">
                                                        Select Partner Sports
                                                    </button>

                                                    <div class="dropdown-menu p-3"
                                                        style="width: 100%; max-height: 300px; overflow-y: auto;">
                                                        @foreach (config('profile_fields.sports') as $sport)
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="partner_sport_{{ $loop->index }}"
                                                                    name="partner_sports[]" value="{{ $sport }}"
                                                                    {{ in_array($sport, $selectedPartnerSports) ? 'checked' : '' }}>
                                                                <label class="form-check-label"
                                                                    for="partner_sport_{{ $loop->index }}">
                                                                    {{ $sport }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>

                                                @error('partner_sports')
                                                    <span class="text-danger d-block mt-1">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $selectedPartnerEntertainment = old(
                                            'partner_entertainment',
                                            $profile->partner_entertainment ?? [],
                                        );

                                        if (is_string($selectedPartnerEntertainment)) {
                                            $selectedPartnerEntertainment = array_map(
                                                'trim',
                                                explode(',', $selectedPartnerEntertainment),
                                            );
                                        }
                                    @endphp

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Partner Entertainment <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <div class="dropdown">
                                                    <button type="button"
                                                       class="py-2 form-control dropdown-toggle text-start"
                                                        data-bs-toggle="dropdown" aria-expanded="false"
                                                        id="partnerEntertainmentDropdownButton">
                                                        Select Entertainment
                                                    </button>

                                                    <div class="dropdown-menu p-3"
                                                        style="width: 100%; max-height: 300px; overflow-y: auto;">
                                                        @foreach (config('profile_fields.entertainment') as $entertainment)
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="partner_entertainment_{{ $loop->index }}"
                                                                    name="partner_entertainment[]"
                                                                    value="{{ $entertainment }}"
                                                                    {{ in_array($entertainment, $selectedPartnerEntertainment) ? 'checked' : '' }}>
                                                                <label class="form-check-label"
                                                                    for="partner_entertainment_{{ $loop->index }}">
                                                                    {{ $entertainment }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>

                                                @error('partner_entertainment')
                                                    <span class="text-danger d-block mt-1">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end 1nd row  -->


                                {{-- <div class="row"> <!-- start 6th row  -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Main Thambnail <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="file" name="thambnail_profile" class="form-control"
                                                    data-preview="#mainThmb_profile" onChange="mainThamUrl(this)" require>
                                                @error('thambnail')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror


                                            </div>
                                        </div>
                                    </div> <!-- end col md 4 -->
                                    <div class="col-md-4">

                                        @if ($user->profile_photo_path)
                                            <img src="{{ asset('storage/' . $user->profile_photo_path) }}"
                                                id="mainThmb_profile" style="max-width: 150px; height: auto;">
                                        @endif
                                    </div>
                                </div> <!-- end 6th row  --> --}}
                                <div class="row"> <!-- start gallery photos row -->

                                    @for ($i = 1; $i <= 6; $i++)
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Gallery Photo {{ $i }} <span class="text-danger">*</span>
                                                </h5>
                                                <div class="controls">
                                                    <input type="file" name="gallery_photo{{ $i }}"
                                                        class="form-control"
                                                        data-preview="#galleryPreview{{ $i }}"
                                                        onchange="previewGalleryPhoto(this, {{ $i }})">
                                                    @error('gallery_photo' . $i)
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="mt-2">
                                                    @php
                                                        $photoPath = $profile->{'gallery_photo' . $i} ?? null;
                                                    @endphp
                                                    @if ($photoPath)
                                                        <img src="{{ asset('storage/' . $photoPath) }}"
                                                            id="galleryPreview{{ $i }}"
                                                            style="max-width: 150px; height: auto;">
                                                    @else
                                                        <img id="galleryPreview{{ $i }}"
                                                            style="max-width: 150px; height: auto; display: none;">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endfor

                                </div> <!-- end gallery photos row -->



                                <hr>



                            </div>

                        </div><!-- /.box-body -->
                        <div class="box-footer text-right">
                            <button type="submit" class="btn btn-rounded btn-primary">Submit</button>
                            <button class="btn btn-rounded btn-secondary">Cancel</button>
                        </div>
                    </div><!-- /.box -->
            </form>
        </section>
        <!-- ///////////////// Start Thambnail Image Update Area ///////// -->








        <!-- /.content -->
    </div>
@endsection
@section('js')
    <!-- /// Tgas Input Script -->
    <script src="{{ asset('./assets/vendor_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.js') }}"></script>
    <script src="{{ asset('./assets/vendor_components/select2/dist/js/select2.full.js') }}"></script>
    <!-- // CK EDITOR  -->
    <script src="{{ asset('./assets/vendor_components/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('./assets/vendor_plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/nouislider@15.7.0/dist/nouislider.min.js"></script>

    <script>
        $(function() {
            "use strict";

            //Initialize Select2 Elements
            $('.select2').select2();

            CKEDITOR.replace('textarea');
            //bootstrap WYSIHTML5 - text editor
            //$('.textarea').wysihtml5();

        });
    </script>
    {{-- <script type="text/javascript">
        function mainThamUrl(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#mainThmb').attr('src', e.target.result).width(80).height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script> --}}
    <script type="text/javascript">
        function mainThamUrl(input) {
            const previewId = input.dataset.preview;
            if (input.files && input.files[0] && previewId) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $(previewId)
                        .attr('src', e.target.result)
                        .css({
                            'width': '150px',
                            'height': 'auto',
                            'display': 'block'
                        });
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#dob-picker", {
            dateFormat: "d/m/Y",
            allowInput: true,
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize flatpickr
            flatpickr("#dob-picker", {
                dateFormat: "d/m/Y",
                allowInput: true,
                onChange: function(selectedDates, dateStr, instance) {
                    calculateAge(dateStr);
                }
            });

            // If DOB is already filled, calculate on load
            let initialDob = document.getElementById('dob-picker').value;
            if (initialDob) {
                calculateAge(initialDob);
            }

            function calculateAge(dobString) {
                if (!dobString) {
                    document.getElementById('age').value = '';
                    return;
                }

                let parts = dobString.split('/');
                if (parts.length !== 3) {
                    document.getElementById('age').value = '';
                    return;
                }

                let day = parseInt(parts[0], 10);
                let month = parseInt(parts[1], 10) - 1; // JS months are 0-based
                let year = parseInt(parts[2], 10);

                let birthDate = new Date(year, month, day);
                let today = new Date();

                let age = today.getFullYear() - birthDate.getFullYear();
                let m = today.getMonth() - birthDate.getMonth();

                if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }

                document.getElementById('age').value = isNaN(age) ? '' : age;
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownButton = document.getElementById('sportsDropdownButton');
            const checkboxes = document.querySelectorAll('.sports-checkbox');

            function updateButtonLabel() {
                let selected = [];
                checkboxes.forEach(cb => {
                    if (cb.checked) {
                        selected.push(cb.value);
                    }
                });
                dropdownButton.textContent = selected.length ?
                    selected.join(', ') :
                    'Select Sports';
            }

            checkboxes.forEach(cb => {
                cb.addEventListener('change', updateButtonLabel);
            });

            // Run on page load
            updateButtonLabel();
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.dropdown-menu').forEach(function(menu) {
                menu.addEventListener('click', function(e) {
                    // Prevent dropdown from closing on click inside
                    e.stopPropagation();
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var slider = document.getElementById('ageRangeSlider');

            noUiSlider.create(slider, {
                start: [{{ $ageMin }}, {{ $ageMax }}],
                connect: true,
                range: {
                    'min': 18,
                    'max': 100
                },
                step: 1,
                tooltips: [true, true],
                format: {
                    to: function(value) {
                        return Math.round(value);
                    },
                    from: function(value) {
                        return Number(value);
                    }
                }
            });

            slider.noUiSlider.on('update', function(values, handle) {
                document.getElementById('ageRangeMin').value = values[0];
                document.getElementById('ageRangeMax').value = values[1];
                document.getElementById('ageRangeMinValue').textContent = values[0];
                document.getElementById('ageRangeMaxValue').textContent = values[1];
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var slider = document.getElementById('distanceRangeSlider');

            noUiSlider.create(slider, {
                start: [{{ $distanceMin }}, {{ $distanceMax }}],
                connect: true,
                range: {
                    'min': 0,
                    'max': 1000
                },
                step: 1,
                tooltips: [true, true],
                format: {
                    to: function(value) {
                        return Math.round(value);
                    },
                    from: function(value) {
                        return Number(value);
                    }
                }
            });

            slider.noUiSlider.on('update', function(values, handle) {
                document.getElementById('distanceRangeMin').value = values[0];
                document.getElementById('distanceRangeMax').value = values[1];
                document.getElementById('distanceRangeMinValue').textContent = values[0];
                document.getElementById('distanceRangeMaxValue').textContent = values[1];
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var slider = document.getElementById('partnerHeightRangeSlider');

            noUiSlider.create(slider, {
                start: [{{ $heightMin }}, {{ $heightMax }}],
                connect: true,
                range: {
                    'min': 122,
                    'max': 213
                },
                step: 1,
                tooltips: [true, true],
                format: {
                    to: function(value) {
                        return Math.round(value);
                    },
                    from: function(value) {
                        return Number(value);
                    }
                }
            });

            slider.noUiSlider.on('update', function(values, handle) {
                document.getElementById('partnerHeightMin').value = values[0];
                document.getElementById('partnerHeightMax').value = values[1];
                document.getElementById('partnerHeightMinValue').textContent = values[0];
                document.getElementById('partnerHeightMaxValue').textContent = values[1];
            });
        });
    </script>
    <script>
        function previewGalleryPhoto(input, index) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    document.querySelector('#galleryPreview' + index).setAttribute('src', e.target.result);
                    document.querySelector('#galleryPreview' + index).style.display = 'block';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>









    <script>
        /*
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              $(document).ready(function(){
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               $('#multiImg').on('change', function(){ //on file input change
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      var data = $(this)[0].files; //this file data

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      $.each(data, function(index, file){ //loop though each file
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              var fRead = new FileReader(); //new filereader
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              fRead.onload = (function(file){ //trigger function on successful read
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              return function(e) {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(80)
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              .height(80); //create image element
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  $('#preview_img').append(img); //append image to output element
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              };
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              })(file);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              fRead.readAsDataURL(file); //URL representing the file's data.
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      });

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  }else{
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      alert("Your browser doesn't support File API!"); //if File API is absent
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               });
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              });
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            */
    </script>

    <script>
        /*
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            $(document).ready(function() {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                var child_cateid={{-- $product->subcategory_id --}};
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                $('select[name="category_id"]').on('change', function(){
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    var category_id = $(this).val();
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    if(category_id) {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        $.ajax({
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            url: "{{ url('/category/subcategory/ajax') }}/"+category_id,
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            type:"GET",
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            //dataType:"json",
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            success:function(data) {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                if(data){
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    console.log(data);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    $("#subcategory_id").empty();
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    $("#subcategory_id").append('<option>---- Select Subcategory---</option>');
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        $.each(data,function(key,value){
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            console.log(value.subcategory_name);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        $("#subcategory_id").append('<option value="'+value.id+'" '+(value.id==child_cateid?'selected':'')+'>'+value.subcategory_name+'</option>');
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        });
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        console.log($("#subcategory_id"));
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    }else{
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        $("#subcategory_id").empty();
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                //$('.subcategory').html(data);

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                //$("#subcategory_id").niceSelect('update');
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                //$("#subcategory_id").niceSelect('refresh');
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            },
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        });
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    } else {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        alert('danger');
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                });
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                if(child_cateid!=null){
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    $('select[name="category_id"]').change();
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            });*/
    </script>
@endsection
