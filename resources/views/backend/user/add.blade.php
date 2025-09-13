@extends('admin.admin_master')
@section('css')
    <link href="{{ asset('backend/assets/vendors/select2/dist/css/select2.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('backend/assets/vendors/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}"
          rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/nouislider@15.7.0/dist/nouislider.min.css" rel="stylesheet">
@endsection

@section('admin')
    <div class="container-full">
        <!-- Content Header (user header) -->
        <!-- /////////////////  Start Thambnail Image Update Area ///////// -->

        <section class="content">
            <form method="post" action="{{ route('user.store') }}" enctype="multipart/form-data">
                @csrf
                {{--                <input type="hidden" name="id" value="{{ $user->id }}">--}}
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
                                                <input type="text" name="name"
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
                                                <input type="text" name="nick_name"
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
                                                <input type="text" name="email"
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
                                            <h5>Password<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="password" value="" class="form-control">
                                                @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
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
                                    {{--                                    <div class="col-md-4">--}}
                                    {{--                                        @if ($user->profile_photo_path)--}}
                                    {{--                                            <img src="{{ asset('storage/' . $user->profile_photo_path) }}" id="mainThmb"--}}
                                    {{--                                                 style="max-width: 150px; height: auto;">--}}
                                    {{--                                        @endif--}}
                                    {{--                                    </div>--}}
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
                                                        <option value="{{ $country }}">
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
                                                        <option value="{{ $document_type }}">
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
                                                       data-preview="#mainThmb_kyc" onChange="mainThamUrl(this)"
                                                       require>
                                                @error('thambnail')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div> <!-- end col md 4 -->
                                    {{--                                    <div class="col-md-4">--}}
                                    {{--                                        <img id="mainThmb_kyc"--}}
                                    {{--                                             src="{{ $kycDetail && $kycDetail->id_document ? asset('storage/' . $kycDetail->id_document) : '' }}"--}}
                                    {{--                                             style="max-width: 150px; height: auto; {{ !$kycDetail || !$kycDetail->id_document ? 'display: none;' : '' }}">--}}
                                    {{--                                    </div>--}}
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
                                                       class="form-control" id="dob-picker"/>
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
                                                <input type="text" name="age" id="age" class="form-control" disabled>
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
                                                        <option value="{{ $gender }}">
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
                                                <textarea name="about_you" class="form-control" rows="4"
                                                          placeholder="Write something about yourself..."></textarea>
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
                                                        <option value="{{ $value }}">
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
                                                        <option value="{{ $body_type }}">
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
                                                        <option value="{{ $eye_color }}">
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
                                                        <option value="{{ $hair_color }}">
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
                                                        <option value="{{ $sleeping_habits }}">
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
                                                        <option value="{{ $love_language }}">
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
                                                        <option value="{{ $childrean }}">
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
                                                        <option value="{{ $financial_status }}">
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
                                                    @foreach (config('profile_fields.dress_style') as $dress_style)
                                                        <option value="{{ $dress_style }}">
                                                            {{ $dress_style }}
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
                                                <div class="dropdown">
                                                    <button type="button"
                                                            class="btn btn-default form-control dropdown-toggle"
                                                            data-bs-toggle="dropdown" aria-expanded="false"
                                                            id="petsDropdownButton">
                                                        Select Pets
                                                    </button>
                                                    <div class="dropdown-menu p-3"
                                                         style="width: 100%; max-height: 300px; overflow-y: auto;">
                                                        @foreach (config('profile_fields.pets') as $pet)
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input"
                                                                       id="pet_{{ $loop->index }}"
                                                                       name="pets[]" value="{{ $pet }}">
                                                                <label class="form-check-label"
                                                                       for="pet_{{ $loop->index }}">
                                                                    {{ $pet }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                @error('pets')
                                                <span class="text-danger d-block mt-1">{{ $message }}</span>
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
                                                        <option value="{{ $zodiac_sign }}">
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
                                                        <option value="{{ $vaccinated }}">
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
                                                        <option value="{{ $drinking_habits }}">
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
                                                        <option value="{{ $smoking_habits }}">
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
                                                        <option value="{{ $eating_habits }}">
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
                                                        <option value="{{ $communication_style }}">
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
                                                        <option value="{{ $workout }}">
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
                                                        <option value="{{ $education }}">
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
                                                        <option value="{{ $occupation }}">
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
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Language Speak <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <div class="dropdown">
                                                    <button type="button"
                                                            class="btn btn-default form-control dropdown-toggle text-start"
                                                            data-bs-toggle="dropdown" aria-expanded="false"
                                                            id="languageSpeakDropdownButton">
                                                        Select Languages
                                                    </button>

                                                    <div class="dropdown-menu p-3"
                                                         style="width: 100%; max-height: 300px; overflow-y: auto;">
                                                        @foreach (config('profile_fields.language_speak') as $language)
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input language-speak-checkbox"
                                                                       id="language_speak_{{ $loop->index }}"
                                                                       name="language_speak[]"
                                                                       value="{{ $language }}">
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
                                                        <option value="{{ $relationship_status }}">
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
                                                        <option value="{{ $religion }}">
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
                                                        <option value="{{ $location }}">
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
                                            <h5>User's Location <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea name="user_location" class="form-control" rows="4" id="userLocationTextarea"
                                                            placeholder="Your location will be auto-filled based on coordinates..."></textarea>
                                                            @error('user_location')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <h5>Love Goals <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <textarea name="love_goals" class="form-control" rows="4"
                                                          placeholder="Describe your love goals..."></textarea>
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
                                                          placeholder="Describe what you’re looking for in a partner..."></textarea>
                                                @error('looking_in_partner')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Sports <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <div class="dropdown">
                                                    <button type="button"
                                                            class="btn btn-default form-control dropdown-toggle"
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
                                                                       value="{{ $sport }}">
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
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Entertainment <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <div class="dropdown">
                                                    <button type="button"
                                                            class="btn btn-default form-control dropdown-toggle"
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
                                                                       name="entertainment[]"
                                                                       value="{{ $entertainment }}">
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
                                    {{-- <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>My Interests <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <div class="dropdown">
                                                    <button type="button"
                                                            class="btn btn-default form-control dropdown-toggle"
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
                                                                       name="my_interests[]" value="{{ $interest }}">
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
                                    </div> --}}
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>I am Looking For <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <div class="dropdown">
                                                    <button type="button"
                                                            class="btn btn-default form-control dropdown-toggle"
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
                                                                       name="iam_looking_for[]" value="{{ $option }}">
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
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>I Am Seeking <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <div class="dropdown">
                                                    <button type="button"
                                                            class="btn btn-default form-control dropdown-toggle text-start"
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
                                                                       name="iam_seeking[]" value="{{ $option }}">
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
                                    <div class="col-md-12">
                                    <hr>
                                    <h3 class="pb-5">Desired partner</h3>
                                    <hr>
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
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Preferred Age Range <span class="text-danger">*</span></h5>
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
                                        $distanceMin = old('partner_distance_min') ?? 10;
                                        $distanceMax = old('partner_distance_max') ?? 500;
                                    @endphp
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Preferred Partner Distance (km) <span class="text-danger">*</span></h5>
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
                                        $heightMin = old('partner_height_min') ?? 122;
                                        $heightMax = old('partner_height_max') ?? 213;
                                    @endphp
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Preferred Partner Height (cm) <span class="text-danger">*</span></h5>
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

                                    @php
                                        $selectedBodyType = old('partner_body_type', $profile->partner_body_type ?? []);
                                        if (is_string($selectedBodyType)) {
                                            $selectedBodyType = array_map(
                                                'trim',
                                                explode(',', $selectedBodyType),
                                            );
                                        }
                                    @endphp
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Partner Body Type <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                {{--                                                <select name="partner_body_type[]" class="form-control">--}}
                                                {{--                                                    <option value="">Select Partner Body Type</option>--}}
                                                {{--                                                    @foreach (config('profile_fields.body_type') as $body_type)--}}
                                                {{--                                                        <option value="{{ $body_type }}">--}}
                                                {{--                                                            {{ $body_type }}--}}
                                                {{--                                                        </option>--}}
                                                {{--                                                    @endforeach--}}
                                                {{--                                                </select>--}}
                                                <div class="dropdown">
                                                    <button type="button"
                                                            class="btn btn-default form-control dropdown-toggle text-center"
                                                            data-bs-toggle="dropdown" aria-expanded="false"
                                                            id="partnerBodyTypeDropdownButton">
                                                        Select Partner Body Type
                                                    </button>

                                                    <div class="dropdown-menu p-3"
                                                         style="width: 100%; max-height: 300px; overflow-y: auto;">
                                                        @foreach (config('profile_fields.body_type') as $body_type)
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input"
                                                                       id="partner_body_type_{{ $loop->index }}"
                                                                       name="partner_body_type[]"
                                                                       value="{{ $body_type }}"
                                                                    {{ in_array($body_type, $selectedBodyType) ? 'checked' : '' }}>
                                                                <label class="form-check-label"
                                                                       for="partner_body_type_{{ $loop->index }}">
                                                                    {{ $body_type }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                @error('partner_body_type')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $selectedRelationshipStatus = old('partner_relationship_status', $profile->partner_relationship_status ?? []);
                                        if (is_string($selectedRelationshipStatus)) {
                                            $selectedRelationshipStatus = array_map(
                                                'trim',
                                                explode(',', $selectedRelationshipStatus),
                                            );
                                        }
                                    @endphp
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Relationship Status <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                {{--                                                <select name="partner_relationship_status" class="form-control">--}}
                                                {{--                                                    <option value="">Select Relationship Status</option>--}}
                                                {{--                                                    @foreach (config('profile_fields.relationship_status') as $relationship_status)--}}
                                                {{--                                                        <option value="{{ $relationship_status }}">--}}
                                                {{--                                                            {{ $relationship_status }}--}}
                                                {{--                                                        </option>--}}
                                                {{--                                                    @endforeach--}}
                                                {{--                                                </select>--}}
                                                <div class="dropdown">
                                                    <button type="button"
                                                            class="btn btn-default form-control dropdown-toggle text-center"
                                                            data-bs-toggle="dropdown" aria-expanded="false"
                                                            id="relationshipStatusDropdownButton">
                                                        Select Relationship Status
                                                    </button>

                                                    <div class="dropdown-menu p-3"
                                                         style="width: 100%; max-height: 300px; overflow-y: auto;">
                                                        @foreach (config('profile_fields.relationship_status') as $relationship_status)
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input"
                                                                       id="relationship_status_{{ $loop->index }}"
                                                                       name="partner_relationship_status[]"
                                                                       value="{{ $relationship_status }}"
                                                                    {{ in_array($relationship_status, $selectedRelationshipStatus) ? 'checked' : '' }}>
                                                                <label class="form-check-label"
                                                                       for="relationship_status_{{ $loop->index }}">
                                                                    {{ $relationship_status }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                @error('partner_relationship_status')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $selectedPartnerEyeColor = old('partner_eye_color', $profile->partner_eye_color ?? []);
                                        if (is_string($selectedPartnerEyeColor)) {
                                            $selectedPartnerEyeColor = array_map(
                                                'trim',
                                                explode(',', $selectedPartnerEyeColor),
                                            );
                                        }
                                    @endphp
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Partner Eye Color <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                {{--                                                <select name="partner_eye_color" class="form-control">--}}
                                                {{--                                                    <option value="">Select Partner Eye Color</option>--}}
                                                {{--                                                    @foreach (config('profile_fields.eye_color') as $eye_color)--}}
                                                {{--                                                        <option value="{{ $eye_color }}">--}}
                                                {{--                                                            {{ $eye_color }}--}}
                                                {{--                                                        </option>--}}
                                                {{--                                                    @endforeach--}}
                                                {{--                                                </select>--}}
                                                <div class="dropdown">
                                                    <button type="button"
                                                            class="btn btn-default form-control dropdown-toggle text-center"
                                                            data-bs-toggle="dropdown" aria-expanded="false"
                                                            id="partnerEyeColorDropdownButton">
                                                        Select Partner Eye Color
                                                    </button>

                                                    <div class="dropdown-menu p-3"
                                                         style="width: 100%; max-height: 300px; overflow-y: auto;">
                                                        @foreach (config('profile_fields.eye_color') as $partner_eye_color)
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input"
                                                                       id="partner_eye_color_{{ $loop->index }}"
                                                                       name="partner_eye_color[]"
                                                                       value="{{ $partner_eye_color }}"
                                                                    {{ in_array($partner_eye_color, $selectedPartnerEyeColor) ? 'checked' : '' }}>
                                                                <label class="form-check-label"
                                                                       for="partner_eye_color_{{ $loop->index }}">
                                                                    {{ $partner_eye_color }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                @error('partner_eye_color')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $selectedHairColor = old('partner_hair_color', $profile->partner_hair_color ?? []);
                                        if (is_string($selectedHairColor)) {
                                            $selectedHairColor = array_map(
                                                'trim',
                                                explode(',', $selectedHairColor),
                                            );
                                        }
                                    @endphp
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Partner Hair Color <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                {{--                                                <select name="partner_hair_color" class="form-control">--}}
                                                {{--                                                    <option value="">Select Partner Hair Color</option>--}}
                                                {{--                                                    @foreach (config('profile_fields.hair_color') as $hair_color)--}}
                                                {{--                                                        <option value="{{ $hair_color }}">--}}
                                                {{--                                                            {{ $hair_color }}--}}
                                                {{--                                                        </option>--}}
                                                {{--                                                    @endforeach--}}
                                                {{--                                                </select>--}}
                                                <div class="dropdown">
                                                    <button type="button"
                                                            class="btn btn-default form-control dropdown-toggle text-center"
                                                            data-bs-toggle="dropdown" aria-expanded="false"
                                                            id="partnerHairColorDropdownButton">
                                                        Select Partner Hair Color
                                                    </button>

                                                    <div class="dropdown-menu p-3"
                                                         style="width: 100%; max-height: 300px; overflow-y: auto;">
                                                        @foreach (config('profile_fields.hair_color') as $hair_color)
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input"
                                                                       id="partner_hair_color_{{ $loop->index }}"
                                                                       name="partner_hair_color[]"
                                                                       value="{{ $hair_color }}"
                                                                    {{ in_array($hair_color, $selectedHairColor) ? 'checked' : '' }}>
                                                                <label class="form-check-label"
                                                                       for="partner_hair_color_{{ $loop->index }}">
                                                                    {{ $hair_color }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                @error('partner_hair_color')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $selectedSmokingHabits = old('partner_smoking_habits', $profile->partner_smoking_habits ?? []);
                                        if (is_string($selectedSmokingHabits)) {
                                            $selectedSmokingHabits = array_map(
                                                'trim',
                                                explode(',', $selectedSmokingHabits),
                                            );
                                        }
                                    @endphp
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Partner Smoking Habits <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                {{--                                                <select name="partner_smoking_habits" class="form-control">--}}
                                                {{--                                                    <option value="">Select Partner Smoking Habit</option>--}}
                                                {{--                                                    @foreach (config('profile_fields.smoking_habits') as $smoking_habits)--}}
                                                {{--                                                        <option value="{{ $smoking_habits }}">--}}
                                                {{--                                                            {{ $smoking_habits }}--}}
                                                {{--                                                        </option>--}}
                                                {{--                                                    @endforeach--}}
                                                {{--                                                </select>--}}
                                                <div class="dropdown">
                                                    <button type="button"
                                                            class="btn btn-default form-control dropdown-toggle text-center"
                                                            data-bs-toggle="dropdown" aria-expanded="false"
                                                            id="partnerSmokingHabitDropdownButton">
                                                        Select Partner Smoking Habit
                                                    </button>

                                                    <div class="dropdown-menu p-3"
                                                         style="width: 100%; max-height: 300px; overflow-y: auto;">
                                                        @foreach (config('profile_fields.smoking_habits') as $smoking_habits)
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input"
                                                                       id="partner_smoking_habits_{{ $loop->index }}"
                                                                       name="partner_smoking_habits[]"
                                                                       value="{{ $smoking_habits }}"
                                                                    {{ in_array($smoking_habits, $selectedSmokingHabits) ? 'checked' : '' }}>
                                                                <label class="form-check-label"
                                                                       for="partner_smoking_habits_{{ $loop->index }}">
                                                                    {{ $smoking_habits }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                @error('partner_smoking_habits')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $selectedEatingHabits = old('partner_eating_habits', $profile->partner_eating_habits ?? []);
                                        if (is_string($selectedEatingHabits)) {
                                            $selectedEatingHabits = array_map(
                                                'trim',
                                                explode(',', $selectedEatingHabits),
                                            );
                                        }
                                    @endphp
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Partner Eating Habits <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                {{--                                                <select name="partner_eating_habits" class="form-control">--}}
                                                {{--                                                    <option value="">Select Partner Eating Habit</option>--}}
                                                {{--                                                    @foreach (config('profile_fields.eating_habits') as $eating_habits)--}}
                                                {{--                                                        <option value="{{ $eating_habits }}"--}}
                                                {{--                                                        >--}}
                                                {{--                                                            {{ $eating_habits }}--}}
                                                {{--                                                        </option>--}}
                                                {{--                                                    @endforeach--}}
                                                {{--                                                </select>--}}
                                                <div class="dropdown">
                                                    <button type="button"
                                                            class="btn btn-default form-control dropdown-toggle text-center"
                                                            data-bs-toggle="dropdown" aria-expanded="false"
                                                            id="partnerEatingHabitDropdownButton">
                                                        Select Partner Eating Habit
                                                    </button>

                                                    <div class="dropdown-menu p-3"
                                                         style="width: 100%; max-height: 300px; overflow-y: auto;">
                                                        @foreach (config('profile_fields.eating_habits') as $eating_habits)
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input"
                                                                       id="partner_eating_habits_{{ $loop->index }}"
                                                                       name="partner_eating_habits[]"
                                                                       value="{{ $eating_habits }}"
                                                                    {{ in_array($eating_habits, $selectedEatingHabits) ? 'checked' : '' }}>
                                                                <label class="form-check-label"
                                                                       for="partner_eating_habits_{{ $loop->index }}">
                                                                    {{ $eating_habits }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                @error('partner_eating_habits')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $selectedDrinkingHabits = old('partner_drinking_habits', $profile->partner_drinking_habits ?? []);
                                        if (is_string($selectedDrinkingHabits)) {
                                            $selectedDrinkingHabits = array_map(
                                                'trim',
                                                explode(',', $selectedDrinkingHabits),
                                            );
                                        }
                                    @endphp
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Partner Drinking Habits <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                {{--                                                <select name="partner_drinking_habits" class="form-control">--}}
                                                {{--                                                    <option value="">Select Partner Drinking Habit</option>--}}
                                                {{--                                                    @foreach (config('profile_fields.drinking_habits') as $drinking_habits)--}}
                                                {{--                                                        <option value="{{ $drinking_habits }}">--}}
                                                {{--                                                            {{ $drinking_habits }}--}}
                                                {{--                                                        </option>--}}
                                                {{--                                                    @endforeach--}}
                                                {{--                                                </select>--}}
                                                <div class="dropdown">
                                                    <button type="button"
                                                            class="btn btn-default form-control dropdown-toggle text-center"
                                                            data-bs-toggle="dropdown" aria-expanded="false"
                                                            id="partnerDrinkingHabitDropdownButton">
                                                        Select Partner Drinking Habit
                                                    </button>

                                                    <div class="dropdown-menu p-3"
                                                         style="width: 100%; max-height: 300px; overflow-y: auto;">
                                                        @foreach (config('profile_fields.drinking_habits') as $drinking_habits)
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input"
                                                                       id="partner_drinking_habits_{{ $loop->index }}"
                                                                       name="partner_drinking_habits[]"
                                                                       value="{{ $drinking_habits }}"
                                                                    {{ in_array($drinking_habits, $selectedDrinkingHabits) ? 'checked' : '' }}>
                                                                <label class="form-check-label"
                                                                       for="partner_drinking_habits_{{ $loop->index }}">
                                                                    {{ $drinking_habits }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                @error('partner_drinking_habits')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $selectedPartnerChildren = old('partner_children', $profile->partner_children ?? []);
                                        if (is_string($selectedPartnerChildren)) {
                                            $selectedPartnerChildren = array_map(
                                                'trim',
                                                explode(',', $selectedPartnerChildren),
                                            );
                                        }
                                    @endphp
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Partner Children <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                {{--                                                <select name="partner_children" class="form-control">--}}
                                                {{--                                                    <option value="">Select Option</option>--}}
                                                {{--                                                    @foreach (config('profile_fields.partner_children') as $partner_children)--}}
                                                {{--                                                        <option value="{{ $partner_children }}">--}}
                                                {{--                                                            {{ $partner_children }}--}}
                                                {{--                                                        </option>--}}
                                                {{--                                                    @endforeach--}}
                                                {{--                                                </select>--}}
                                                <div class="dropdown">
                                                    <button type="button"
                                                            class="btn btn-default form-control dropdown-toggle text-center"
                                                            data-bs-toggle="dropdown" aria-expanded="false"
                                                            id="partnerChildrenDropdownButton">
                                                        Select Partner Children
                                                    </button>

                                                    <div class="dropdown-menu p-3"
                                                         style="width: 100%; max-height: 300px; overflow-y: auto;">
                                                        @foreach (config('profile_fields.childrean') as $partner_children)
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input"
                                                                       id="partner_children_{{ $loop->index }}"
                                                                       name="partner_children[]"
                                                                       value="{{ $partner_children }}"
                                                                    {{ in_array($partner_children, $selectedPartnerChildren) ? 'checked' : '' }}>
                                                                <label class="form-check-label"
                                                                       for="partner_children_{{ $loop->index }}">
                                                                    {{ $partner_children }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                @error('partner_children')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $selectedPartnerOccupation = old('partner_occupation', $profile->partner_occupation ?? []);
                                        if (is_string($selectedPartnerOccupation)) {
                                            $selectedPartnerOccupation = array_map(
                                                'trim',
                                                explode(',', $selectedPartnerOccupation),
                                            );
                                        }
                                    @endphp
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Partner Occupation <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                {{--                                                <select name="partner_occupation" class="form-control">--}}
                                                {{--                                                    <option value="">Select Partner Occupation</option>--}}
                                                {{--                                                    @foreach (config('profile_fields.occupation') as $occupation)--}}
                                                {{--                                                        <option value="{{ $occupation }}">--}}
                                                {{--                                                            {{ $occupation }}--}}
                                                {{--                                                        </option>--}}
                                                {{--                                                    @endforeach--}}
                                                {{--                                                </select>--}}
                                                <div class="dropdown">
                                                    <button type="button"
                                                            class="btn btn-default form-control dropdown-toggle text-center"
                                                            data-bs-toggle="dropdown" aria-expanded="false"
                                                            id="partnerOccupationDropdownButton">
                                                        Select Partner Occupation
                                                    </button>

                                                    <div class="dropdown-menu p-3"
                                                         style="width: 100%; max-height: 300px; overflow-y: auto;">
                                                        @foreach (config('profile_fields.occupation') as $occupation)
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input"
                                                                       id="partner_occupation_{{ $loop->index }}"
                                                                       name="partner_occupation[]"
                                                                       value="{{ $occupation }}"
                                                                    {{ in_array($occupation, $selectedPartnerOccupation) ? 'checked' : '' }}>
                                                                <label class="form-check-label"
                                                                       for="partner_occupation_{{ $loop->index }}">
                                                                    {{ $occupation }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                @error('partner_occupation')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $selectedPartnerEducation = old('partner_education', $profile->partner_education ?? []);
                                        if (is_string($selectedPartnerEducation)) {
                                            $selectedPartnerEducation = array_map(
                                                'trim',
                                                explode(',', $selectedPartnerEducation),
                                            );
                                        }
                                    @endphp
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Partner Education <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                {{--                                                <select name="partner_education" class="form-control">--}}
                                                {{--                                                    <option value="">Select Partner Education</option>--}}
                                                {{--                                                    @foreach (config('profile_fields.education') as $education)--}}
                                                {{--                                                        <option value="{{ $education }}">--}}
                                                {{--                                                            {{ $education }}--}}
                                                {{--                                                        </option>--}}
                                                {{--                                                    @endforeach--}}
                                                {{--                                                </select>--}}
                                                <div class="dropdown">
                                                    <button type="button"
                                                            class="btn btn-default form-control dropdown-toggle text-center"
                                                            data-bs-toggle="dropdown" aria-expanded="false"
                                                            id="partnerPartnerEducationDropdownButton">
                                                        Select Partner Education
                                                    </button>

                                                    <div class="dropdown-menu p-3"
                                                         style="width: 100%; max-height: 300px; overflow-y: auto;">
                                                        @foreach (config('profile_fields.education') as $education)
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input"
                                                                       id="partner_education_{{ $loop->index }}"
                                                                       name="partner_education[]"
                                                                       value="{{ $education }}"
                                                                    {{ in_array($education, $selectedPartnerEducation) ? 'checked' : '' }}>
                                                                <label class="form-check-label"
                                                                       for="partner_education_{{ $loop->index }}">
                                                                    {{ $education }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                @error('partner_education')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $selectedPartnerReligion = old('partner_religion', $profile->partner_religion ?? []);
                                        if (is_string($selectedPartnerReligion)) {
                                            $selectedPartnerReligion = array_map(
                                                'trim',
                                                explode(',', $selectedPartnerReligion),
                                            );
                                        }
                                    @endphp
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Partner Religion <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                {{--                                                <select name="partner_religion" class="form-control">--}}
                                                {{--                                                    <option value="">Select Partner Religion</option>--}}
                                                {{--                                                    @foreach (config('profile_fields.religion') as $religion)--}}
                                                {{--                                                        <option value="{{ $religion }}">--}}
                                                {{--                                                            {{ $religion }}--}}
                                                {{--                                                        </option>--}}
                                                {{--                                                    @endforeach--}}
                                                {{--                                                </select>--}}
                                                <div class="dropdown">
                                                    <button type="button"
                                                            class="btn btn-default form-control dropdown-toggle text-center"
                                                            data-bs-toggle="dropdown" aria-expanded="false"
                                                            id="partnerPartnerReligionDropdownButton">
                                                        Select Partner Religion
                                                    </button>

                                                    <div class="dropdown-menu p-3"
                                                         style="width: 100%; max-height: 300px; overflow-y: auto;">
                                                        @foreach (config('profile_fields.religion') as $religion)
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input"
                                                                       id="partner_religion_{{ $loop->index }}"
                                                                       name="partner_religion[]" value="{{ $religion }}"
                                                                    {{ in_array($religion, $selectedPartnerReligion) ? 'checked' : '' }}>
                                                                <label class="form-check-label"
                                                                       for="partner_religion_{{ $loop->index }}">
                                                                    {{ $religion }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                @error('partner_religion')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $selectedFinancialStatus = old('partner_financial_status', $profile->partner_financial_status ?? []);
                                        if (is_string($selectedFinancialStatus)) {
                                            $selectedFinancialStatus = array_map(
                                                'trim',
                                                explode(',', $selectedFinancialStatus),
                                            );
                                        }
                                    @endphp
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Partner Financial Status <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                {{--                                                <select name="partner_financial_status" class="form-control">--}}
                                                {{--                                                    <option value="">Select Partner Financial Status</option>--}}
                                                {{--                                                    @foreach (config('profile_fields.financial_status') as $financial_status)--}}
                                                {{--                                                        <option value="{{ $financial_status }}">--}}
                                                {{--                                                            {{ $financial_status }}--}}
                                                {{--                                                        </option>--}}
                                                {{--                                                    @endforeach--}}
                                                {{--                                                </select>--}}
                                                <div class="dropdown">
                                                    <button type="button"
                                                            class="btn btn-default form-control dropdown-toggle text-center"
                                                            data-bs-toggle="dropdown" aria-expanded="false"
                                                            id="partnerPartnerFinancialStatusDropdownButton">
                                                        Select Partner Financial Status
                                                    </button>

                                                    <div class="dropdown-menu p-3"
                                                         style="width: 100%; max-height: 300px; overflow-y: auto;">
                                                        @foreach (config('profile_fields.financial_status') as $financial_status)
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input"
                                                                       id="partner_financial_status_{{ $loop->index }}"
                                                                       name="partner_financial_status[]"
                                                                       value="{{ $financial_status }}"
                                                                    {{ in_array($financial_status, $selectedFinancialStatus) ? 'checked' : '' }}>
                                                                <label class="form-check-label"
                                                                       for="partner_financial_status_{{ $loop->index }}">
                                                                    {{ $financial_status }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                @error('partner_financial_status')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $selectedDressStyle = old('partner_dress_style', $profile->partner_dress_style ?? []);
                                        if (is_string($selectedDressStyle)) {
                                            $selectedDressStyle = array_map(
                                                'trim',
                                                explode(',', $selectedDressStyle),
                                            );
                                        }
                                    @endphp
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Partner Dress Style <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                {{--                                                <select name="partner_dress_style" class="form-control">--}}
                                                {{--                                                    <option value="">Select Partner Dress Style</option>--}}
                                                {{--                                                    @foreach (config('profile_fields.dress_stype') as $dress_stype)--}}
                                                {{--                                                        <option value="{{ $dress_stype }}">--}}
                                                {{--                                                            {{ $dress_stype }}--}}
                                                {{--                                                        </option>--}}
                                                {{--                                                    @endforeach--}}
                                                {{--                                                </select>--}}
                                                <div class="dropdown">
                                                    <button type="button"
                                                            class="btn btn-default form-control dropdown-toggle text-center"
                                                            data-bs-toggle="dropdown" aria-expanded="false"
                                                            id="partnerPartnerDressStyleDropdownButton">
                                                        Select Partner Dress Style
                                                    </button>

                                                    <div class="dropdown-menu p-3"
                                                         style="width: 100%; max-height: 300px; overflow-y: auto;">
                                                        @foreach (config('profile_fields.dress_style') as $dress_style)
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input"
                                                                       id="partner_dress_style_{{ $loop->index }}"
                                                                       name="partner_dress_style[]"
                                                                       value="{{ $dress_style }}"
                                                                    {{ in_array($dress_style, $selectedDressStyle) ? 'checked' : '' }}>
                                                                <label class="form-check-label"
                                                                       for="partner_dress_style_{{ $loop->index }}">
                                                                    {{ $dress_style }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                @error('partner_dress_stype')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $selectedPartnerVaccinated = old('partner_vaccinated', $profile->partner_vaccinated ?? []);
                                        if (is_string($selectedPartnerVaccinated)) {
                                            $selectedPartnerVaccinated = array_map(
                                                'trim',
                                                explode(',', $selectedPartnerVaccinated),
                                            );
                                        }
                                    @endphp
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Partner Vaccination Status <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                {{--                                                <select name="partner_vaccinated" class="form-control">--}}
                                                {{--                                                    <option value="">Select Partner Vaccination Status</option>--}}
                                                {{--                                                    @foreach (config('profile_fields.vaccinated') as $vaccinated)--}}
                                                {{--                                                        <option value="{{ $vaccinated }}">--}}
                                                {{--                                                            {{ $vaccinated }}--}}
                                                {{--                                                        </option>--}}
                                                {{--                                                    @endforeach--}}
                                                {{--                                                </select>--}}
                                                <div class="dropdown">
                                                    <button type="button"
                                                            class="btn btn-default form-control dropdown-toggle text-center"
                                                            data-bs-toggle="dropdown" aria-expanded="false"
                                                            id="partnerVaccinationStatusDropdownButton">
                                                        Select Partner Vaccination Status
                                                    </button>

                                                    <div class="dropdown-menu p-3"
                                                         style="width: 100%; max-height: 300px; overflow-y: auto;">
                                                        @foreach (config('profile_fields.vaccinated') as $vaccinated)
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input"
                                                                       id="partner_vaccinated_{{ $loop->index }}"
                                                                       name="partner_vaccinated[]"
                                                                       value="{{ $vaccinated }}"
                                                                    {{ in_array($vaccinated, $selectedPartnerVaccinated) ? 'checked' : '' }}>
                                                                <label class="form-check-label"
                                                                       for="partner_vaccinated_{{ $loop->index }}">
                                                                    {{ $vaccinated }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                @error('partner_vaccinated')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $selectedPartnerPets = old('partner_pets') ?? [];
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
                                                            class="btn btn-default form-control dropdown-toggle text-center"
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
                                                                       name="partner_pets[]" value="{{ $pet }}">
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
                                        $selectedPartnerSports = old('partner_sports') ?? [];

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
                                                            class="btn btn-default form-control dropdown-toggle"
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
                                                                       name="partner_sports[]" value="{{ $sport }}">
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
                                        $selectedPartnerEntertainment = old('partner_entertainment') ?? [];
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
                                                            class="btn btn-default form-control dropdown-toggle"
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
                                                                       value="{{ $entertainment }}">
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
                                    @php
                                        $selectedGoalsAndDreams = old('goals_and_dreams', $profile->goals_and_dreams ?? []);
                                        if (is_string($selectedGoalsAndDreams)) {
                                            $selectedGoalsAndDreams = array_map(
                                                'trim',
                                                explode(',', $selectedGoalsAndDreams),
                                            );
                                        }
                                    @endphp
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Goals And Dreams<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <div class="dropdown">
                                                    <button type="button"
                                                            class="btn btn-default form-control dropdown-toggle text-center"
                                                            data-bs-toggle="dropdown" aria-expanded="false"
                                                            id="goalsAndDreamsDropdownButton">
                                                        Select Goals And Dreams
                                                    </button>

                                                    <div class="dropdown-menu p-3"
                                                         style="width: 100%; max-height: 300px; overflow-y: auto;">
                                                        @foreach (config('profile_fields.goals_and_dreams') as $goals)
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input"
                                                                       id="goals_and_dreams_{{ $loop->index }}"
                                                                       name="goals_and_dreams[]"
                                                                       value="{{ $goals }}"
                                                                    {{ in_array($goals, $selectedGoalsAndDreams) ? 'checked' : '' }}>
                                                                <label class="form-check-label"
                                                                       for="goals_and_dreams_{{ $loop->index }}">
                                                                    {{ $goals }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                @error('goals_and_dreams')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end 1nd row  -->
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
                            <button type="button" class="btn btn-rounded btn-secondary" id="cancelBtn">Cancel</button>
                        </div>
                    </div><!-- /.box -->
                </div>
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
        $(function () {
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
                reader.onload = function (e) {
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
        document.addEventListener('DOMContentLoaded', function () {
            // Initialize flatpickr
            flatpickr("#dob-picker", {
                dateFormat: "d/m/Y",
                allowInput: true,
                onChange: function (selectedDates, dateStr, instance) {
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
        document.addEventListener('DOMContentLoaded', function () {
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
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.dropdown-menu').forEach(function (menu) {
                menu.addEventListener('click', function (e) {
                    // Prevent dropdown from closing on click inside
                    e.stopPropagation();
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
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
                    to: function (value) {
                        return Math.round(value);
                    },
                    from: function (value) {
                        return Number(value);
                    }
                }
            });

            slider.noUiSlider.on('update', function (values, handle) {
                document.getElementById('ageRangeMin').value = values[0];
                document.getElementById('ageRangeMax').value = values[1];
                document.getElementById('ageRangeMinValue').textContent = values[0];
                document.getElementById('ageRangeMaxValue').textContent = values[1];
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
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
                    to: function (value) {
                        return Math.round(value);
                    },
                    from: function (value) {
                        return Number(value);
                    }
                }
            });

            slider.noUiSlider.on('update', function (values, handle) {
                document.getElementById('distanceRangeMin').value = values[0];
                document.getElementById('distanceRangeMax').value = values[1];
                document.getElementById('distanceRangeMinValue').textContent = values[0];
                document.getElementById('distanceRangeMaxValue').textContent = values[1];
            });
            document.getElementById('cancelBtn').addEventListener('click', function () {
                window.location.href = "{{ route('all.user') }}";
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
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
                    to: function (value) {
                        return Math.round(value);
                    },
                    from: function (value) {
                        return Number(value);
                    }
                }
            });

            slider.noUiSlider.on('update', function (values, handle) {
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
                reader.onload = function (e) {
                    document.querySelector('#galleryPreview' + index).setAttribute('src', e.target.result);
                    document.querySelector('#galleryPreview' + index).style.display = 'block';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <!-- Multiselect Dropdown JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Language Speak Multiselect
            const languageButton = document.getElementById('languageSpeakDropdownButton');
            const languageCheckboxes = document.querySelectorAll('.language-speak-checkbox');

            function updateLanguageButton() {
                let selected = [];
                languageCheckboxes.forEach(cb => {
                    if (cb.checked) {
                        selected.push(cb.value);
                    }
                });
                languageButton.textContent = selected.length > 0 ?
                    (selected.length > 3 ? selected.slice(0, 3).join(', ') + ` +${selected.length - 3} more` : selected.join(', ')) :
                    'Select Languages';
            }

            languageCheckboxes.forEach(cb => {
                cb.addEventListener('change', updateLanguageButton);
            });

            // Sports Multiselect
            const sportsButton = document.getElementById('sportsDropdownButton');
            const sportsCheckboxes = document.querySelectorAll('input[name="sports[]"]');

            function updateSportsButton() {
                let selected = [];
                sportsCheckboxes.forEach(cb => {
                    if (cb.checked) {
                        selected.push(cb.value);
                    }
                });
                sportsButton.textContent = selected.length > 0 ?
                    (selected.length > 3 ? selected.slice(0, 3).join(', ') + ` +${selected.length - 3} more` : selected.join(', ')) :
                    'Select Sports';
            }

            sportsCheckboxes.forEach(cb => {
                cb.addEventListener('change', updateSportsButton);
            });

            // Entertainment Multiselect
            const entertainmentButton = document.getElementById('entertainmentDropdownButton');
            const entertainmentCheckboxes = document.querySelectorAll('input[name="entertainment[]"]');

            function updateEntertainmentButton() {
                let selected = [];
                entertainmentCheckboxes.forEach(cb => {
                    if (cb.checked) {
                        selected.push(cb.value);
                    }
                });
                entertainmentButton.textContent = selected.length > 0 ?
                    (selected.length > 3 ? selected.slice(0, 3).join(', ') + ` +${selected.length - 3} more` : selected.join(', ')) :
                    'Select Entertainment';
            }

            entertainmentCheckboxes.forEach(cb => {
                cb.addEventListener('change', updateEntertainmentButton);
            });

            // Interests Multiselect
            const interestsButton = document.getElementById('interestsDropdownButton');
            const interestsCheckboxes = document.querySelectorAll('input[name="my_interests[]"]');

            function updateInterestsButton() {
                let selected = [];
                interestsCheckboxes.forEach(cb => {
                    if (cb.checked) {
                        selected.push(cb.value);
                    }
                });
                interestsButton.textContent = selected.length > 0 ?
                    (selected.length > 3 ? selected.slice(0, 3).join(', ') + ` +${selected.length - 3} more` : selected.join(', ')) :
                    'Select Interests';
            }

            interestsCheckboxes.forEach(cb => {
                cb.addEventListener('change', updateInterestsButton);
            });

            // Prevent dropdown from closing when clicking inside
            document.querySelectorAll('.dropdown-menu').forEach(function (menu) {
                menu.addEventListener('click', function (e) {
                    e.stopPropagation();
                });
            });
        });
    </script>

<script>
        async function reverseGeocodeToZipCityCountry(lat, lon) {
            const url = new URL("https://nominatim.openstreetmap.org/reverse");
            url.searchParams.set("format", "jsonv2");
            url.searchParams.set("lat", lat);
            url.searchParams.set("lon", lon);
            url.searchParams.set("addressdetails", "1");
            url.searchParams.set("accept-language", "en"); // Added accept-language=en

            try {
                const res = await fetch(url.toString(), {
                    headers: {
                        "User-Agent": "my-app/1.0 (myemail@example.com)" // Replace with your app's details
                    }
                });
                if (!res.ok) throw new Error(`Nominatim error: ${res.status}`);

                const data = await res.json();
                const a = data.address || {};

                const postalCode = a.postcode || "";
                const city = a.city || a.town || a.village || a.hamlet || a.municipality || a.county || "";
                const country = a.country || "";

                if (!postalCode || !city || !country) {
                    return data.display_name || "Address not found";
                }
                // return `${postalCode} ${city}, ${country}`;
                return data.display_name;
            } catch (err) {
                console.error("Reverse geocode failed:", err.message);
                return "Error fetching address";
            }
        }

        function getUserLocation() {
            const textarea = document.getElementById("userLocationTextarea");
            if (!textarea) {
                console.error("Textarea not found!");
                return;
            }

            if (!navigator.geolocation) {
                console.error("Geolocation not supported");
                textarea.value = "Geolocation not supported by your browser";
                textarea.disabled = false;
                return;
            }

            navigator.geolocation.getCurrentPosition(
                async (pos) => {
                    const lat = pos.coords.latitude;
                    const lon = pos.coords.longitude;
                    console.log("User coords:", lat, lon);

                    try {
                        const address = await reverseGeocodeToZipCityCountry(lat, lon);
                        textarea.value = address; // e.g., "2000 Maribor, Slovenia"
                        textarea.disabled = false;
                        console.log("Formatted address:", address);
                    } catch (err) {
                        textarea.value = "Unable to fetch location";
                        textarea.disabled = false;
                        console.error("Reverse geocode failed:", err.message);
                    }
                },
                (err) => {
                    let errorMessage = "Unable to fetch location";
                    switch (err.code) {
                        case err.PERMISSION_DENIED:
                            errorMessage = "Please enable location access";
                            break;
                        case err.POSITION_UNAVAILABLE:
                            errorMessage = "Location information unavailable";
                            break;
                        case err.TIMEOUT:
                            errorMessage = "Location request timed out";
                            break;
                        default:
                            errorMessage = "An error occurred while fetching location";
                            break;
                    }
                    console.error(`Geolocation error: ${err.message} (Code: ${err.code})`);
                    textarea.value = errorMessage;
                    textarea.disabled = false;
                },
                { enableHighAccuracy: true, timeout: 10000 }
            );
        }

        // Auto-call on page load
        document.addEventListener("DOMContentLoaded", getUserLocation);
    </script>

    <!-- Partner Preference Multiselect JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // User Profile Multiselect Dropdowns

            // Language Speak Multiselect
            const languageButton = document.getElementById('languageSpeakDropdownButton');
            const languageCheckboxes = document.querySelectorAll('input[name="language_speak[]"]');

            function updateLanguageButton() {
                let selected = [];
                languageCheckboxes.forEach(cb => {
                    if (cb.checked) {
                        selected.push(cb.value);
                    }
                });
                if (languageButton) {
                    const buttonText = selected.length > 0 ?
                        (selected.length > 3 ? selected.slice(0, 3).join(', ') + ` +${selected.length - 3} more` : selected.join(', ')) :
                        'Select Languages';
                    languageButton.textContent = buttonText;
                }
            }

            if (languageCheckboxes.length > 0) {
                languageCheckboxes.forEach(cb => {
                    cb.addEventListener('change', updateLanguageButton);
                });
                updateLanguageButton();
            }

            // Sports Multiselect
            const sportsButton = document.getElementById('sportsDropdownButton');
            const sportsCheckboxes = document.querySelectorAll('input[name="sports[]"]');

            function updateSportsButton() {
                let selected = [];
                sportsCheckboxes.forEach(cb => {
                    if (cb.checked) {
                        selected.push(cb.value);
                    }
                });
                if (sportsButton) {
                    const buttonText = selected.length > 0 ?
                        (selected.length > 3 ? selected.slice(0, 3).join(', ') + ` +${selected.length - 3} more` : selected.join(', ')) :
                        'Select Sports';
                    sportsButton.textContent = buttonText;
                }
            }

            if (sportsCheckboxes.length > 0) {
                sportsCheckboxes.forEach(cb => {
                    cb.addEventListener('change', updateSportsButton);
                });
                updateSportsButton();
            }

            // Entertainment Multiselect
            const entertainmentButton = document.getElementById('entertainmentDropdownButton');
            const entertainmentCheckboxes = document.querySelectorAll('input[name="entertainment[]"]');

            function updateEntertainmentButton() {
                let selected = [];
                entertainmentCheckboxes.forEach(cb => {
                    if (cb.checked) {
                        selected.push(cb.value);
                    }
                });
                if (entertainmentButton) {
                    const buttonText = selected.length > 0 ?
                        (selected.length > 3 ? selected.slice(0, 3).join(', ') + ` +${selected.length - 3} more` : selected.join(', ')) :
                        'Select Entertainment';
                    entertainmentButton.textContent = buttonText;
                }
            }

            if (entertainmentCheckboxes.length > 0) {
                entertainmentCheckboxes.forEach(cb => {
                    cb.addEventListener('change', updateEntertainmentButton);
                });
                updateEntertainmentButton();
            }

            // I am Looking For Multiselect
            const lookingForButton = document.getElementById('lookingForDropdownButton');
            const lookingForCheckboxes = document.querySelectorAll('input[name="iam_looking_for[]"]');

            function updateLookingForButton() {
                let selected = [];
                lookingForCheckboxes.forEach(cb => {
                    if (cb.checked) {
                        selected.push(cb.value);
                    }
                });
                if (lookingForButton) {
                    const buttonText = selected.length > 0 ?
                        (selected.length > 3 ? selected.slice(0, 3).join(', ') + ` +${selected.length - 3} more` : selected.join(', ')) :
                        'Select Option';
                    lookingForButton.textContent = buttonText;
                }
            }

            if (lookingForCheckboxes.length > 0) {
                lookingForCheckboxes.forEach(cb => {
                    cb.addEventListener('change', updateLookingForButton);
                });
                updateLookingForButton();
            }

            // I Am Seeking Multiselect
            const seekingButton = document.getElementById('iamSeekingDropdownButton');
            const seekingCheckboxes = document.querySelectorAll('input[name="iam_seeking[]"]');

            function updateSeekingButton() {
                let selected = [];
                seekingCheckboxes.forEach(cb => {
                    if (cb.checked) {
                        selected.push(cb.value);
                    }
                });
                if (seekingButton) {
                    const buttonText = selected.length > 0 ?
                        (selected.length > 3 ? selected.slice(0, 3).join(', ') + ` +${selected.length - 3} more` : selected.join(', ')) :
                        'Select Options';
                    seekingButton.textContent = buttonText;
                }
            }

            if (seekingCheckboxes.length > 0) {
                seekingCheckboxes.forEach(cb => {
                    cb.addEventListener('change', updateSeekingButton);
                });
                updateSeekingButton();
            }

            // Pets Multiselect
            const petsButton = document.getElementById('petsDropdownButton');
            const petsCheckboxes = document.querySelectorAll('input[name="pets[]"]');

            function updatePetsButton() {
                let selected = [];
                petsCheckboxes.forEach(cb => {
                    if (cb.checked) {
                        selected.push(cb.value);
                    }
                });
                if (petsButton) {
                    const buttonText = selected.length > 0 ?
                        (selected.length > 3 ? selected.slice(0, 3).join(', ') + ` +${selected.length - 3} more` : selected.join(', ')) :
                        'Select Pets';
                    petsButton.textContent = buttonText;
                }
            }

            if (petsCheckboxes.length > 0) {
                petsCheckboxes.forEach(cb => {
                    cb.addEventListener('change', updatePetsButton);
                });
                updatePetsButton();
            }

            // Prevent dropdown from closing when clicking inside
            document.querySelectorAll('.dropdown-menu').forEach(function (menu) {
                menu.addEventListener('click', function (e) {
                    e.stopPropagation();
                });
            });

            // Partner Body Type Multiselect
            const partnerBodyTypeButton = document.getElementById('partnerBodyTypeDropdownButton');
            const partnerBodyTypeCheckboxes = document.querySelectorAll('input[name="partner_body_type[]"]');

            function updatePartnerBodyTypeButton() {
                let selected = [];
                partnerBodyTypeCheckboxes.forEach(cb => {
                    if (cb.checked) {
                        selected.push(cb.value);
                    }
                });
                if (partnerBodyTypeButton) {
                    const buttonText = selected.length > 0 ?
                        (selected.length > 3 ? selected.slice(0, 3).join(', ') + ` +${selected.length - 3} more` : selected.join(', ')) :
                        'Select Partner Body Type';
                    partnerBodyTypeButton.textContent = buttonText;
                }
            }

            if (partnerBodyTypeCheckboxes.length > 0) {
                partnerBodyTypeCheckboxes.forEach(cb => {
                    cb.addEventListener('change', updatePartnerBodyTypeButton);
                });
                updatePartnerBodyTypeButton();
            }

            // Relationship Status Multiselect
            const relationshipStatusButton = document.getElementById('relationshipStatusDropdownButton');
            const relationshipStatusCheckboxes = document.querySelectorAll('input[name="partner_relationship_status[]"]');

            function updateRelationshipStatusButton() {
                let selected = [];
                relationshipStatusCheckboxes.forEach(cb => {
                    if (cb.checked) {
                        selected.push(cb.value);
                    }
                });
                if (relationshipStatusButton) {
                    const buttonText = selected.length > 0 ?
                        (selected.length > 3 ? selected.slice(0, 3).join(', ') + ` +${selected.length - 3} more` : selected.join(', ')) :
                        'Select Relationship Status';
                    relationshipStatusButton.textContent = buttonText;
                }
            }

            if (relationshipStatusCheckboxes.length > 0) {
                relationshipStatusCheckboxes.forEach(cb => {
                    cb.addEventListener('change', updateRelationshipStatusButton);
                });
                updateRelationshipStatusButton();
            }

            // Partner Eye Color Multiselect
            const partnerEyeColorButton = document.getElementById('partnerEyeColorDropdownButton');
            const partnerEyeColorCheckboxes = document.querySelectorAll('input[name="partner_eye_color[]"]');

            function updatePartnerEyeColorButton() {
                let selected = [];
                partnerEyeColorCheckboxes.forEach(cb => {
                    if (cb.checked) {
                        selected.push(cb.value);
                    }
                });
                if (partnerEyeColorButton) {
                    const buttonText = selected.length > 0 ?
                        (selected.length > 3 ? selected.slice(0, 3).join(', ') + ` +${selected.length - 3} more` : selected.join(', ')) :
                        'Select Partner Eye Color';
                    partnerEyeColorButton.textContent = buttonText;
                }
            }

            if (partnerEyeColorCheckboxes.length > 0) {
                partnerEyeColorCheckboxes.forEach(cb => {
                    cb.addEventListener('change', updatePartnerEyeColorButton);
                });
                updatePartnerEyeColorButton();
            }

            // Partner Hair Color Multiselect
            const partnerHairColorButton = document.getElementById('partnerHairColorDropdownButton');
            const partnerHairColorCheckboxes = document.querySelectorAll('input[name="partner_hair_color[]"]');

            function updatePartnerHairColorButton() {
                let selected = [];
                partnerHairColorCheckboxes.forEach(cb => {
                    if (cb.checked) {
                        selected.push(cb.value);
                    }
                });
                if (partnerHairColorButton) {
                    const buttonText = selected.length > 0 ?
                        (selected.length > 3 ? selected.slice(0, 3).join(', ') + ` +${selected.length - 3} more` : selected.join(', ')) :
                        'Select Partner Hair Color';
                    partnerHairColorButton.textContent = buttonText;
                }
            }

            if (partnerHairColorCheckboxes.length > 0) {
                partnerHairColorCheckboxes.forEach(cb => {
                    cb.addEventListener('change', updatePartnerHairColorButton);
                });
                updatePartnerHairColorButton();
            }

            // Partner Smoking Habits Multiselect
            const partnerSmokingHabitButton = document.getElementById('partnerSmokingHabitDropdownButton');
            const partnerSmokingHabitCheckboxes = document.querySelectorAll('input[name="partner_smoking_habits[]"]');

            function updatePartnerSmokingHabitButton() {
                let selected = [];
                partnerSmokingHabitCheckboxes.forEach(cb => {
                    if (cb.checked) {
                        selected.push(cb.value);
                    }
                });
                if (partnerSmokingHabitButton) {
                    const buttonText = selected.length > 0 ?
                        (selected.length > 3 ? selected.slice(0, 3).join(', ') + ` +${selected.length - 3} more` : selected.join(', ')) :
                        'Select Partner Smoking Habit';
                    partnerSmokingHabitButton.textContent = buttonText;
                }
            }

            if (partnerSmokingHabitCheckboxes.length > 0) {
                partnerSmokingHabitCheckboxes.forEach(cb => {
                    cb.addEventListener('change', updatePartnerSmokingHabitButton);
                });
                updatePartnerSmokingHabitButton();
            }

            // Partner Eating Habits Multiselect
            const partnerEatingHabitButton = document.getElementById('partnerEatingHabitDropdownButton');
            const partnerEatingHabitCheckboxes = document.querySelectorAll('input[name="partner_eating_habits[]"]');

            function updatePartnerEatingHabitButton() {
                let selected = [];
                partnerEatingHabitCheckboxes.forEach(cb => {
                    if (cb.checked) {
                        selected.push(cb.value);
                    }
                });
                if (partnerEatingHabitButton) {
                    const buttonText = selected.length > 0 ?
                        (selected.length > 3 ? selected.slice(0, 3).join(', ') + ` +${selected.length - 3} more` : selected.join(', ')) :
                        'Select Partner Eating Habit';
                    partnerEatingHabitButton.textContent = buttonText;
                }
            }

            if (partnerEatingHabitCheckboxes.length > 0) {
                partnerEatingHabitCheckboxes.forEach(cb => {
                    cb.addEventListener('change', updatePartnerEatingHabitButton);
                });
                updatePartnerEatingHabitButton();
            }

            // Partner Drinking Habits Multiselect
            const partnerDrinkingHabitButton = document.getElementById('partnerDrinkingHabitDropdownButton');
            const partnerDrinkingHabitCheckboxes = document.querySelectorAll('input[name="partner_drinking_habits[]"]');

            function updatePartnerDrinkingHabitButton() {
                let selected = [];
                partnerDrinkingHabitCheckboxes.forEach(cb => {
                    if (cb.checked) {
                        selected.push(cb.value);
                    }
                });
                if (partnerDrinkingHabitButton) {
                    const buttonText = selected.length > 0 ?
                        (selected.length > 3 ? selected.slice(0, 3).join(', ') + ` +${selected.length - 3} more` : selected.join(', ')) :
                        'Select Partner Drinking Habit';
                    partnerDrinkingHabitButton.textContent = buttonText;
                }
            }

            if (partnerDrinkingHabitCheckboxes.length > 0) {
                partnerDrinkingHabitCheckboxes.forEach(cb => {
                    cb.addEventListener('change', updatePartnerDrinkingHabitButton);
                });
                updatePartnerDrinkingHabitButton();
            }

            // Partner Children Multiselect
            const partnerChildrenButton = document.getElementById('partnerChildrenDropdownButton');
            const partnerChildrenCheckboxes = document.querySelectorAll('input[name="partner_children[]"]');

            function updatePartnerChildrenButton() {
                let selected = [];
                partnerChildrenCheckboxes.forEach(cb => {
                    if (cb.checked) {
                        selected.push(cb.value);
                    }
                });
                if (partnerChildrenButton) {
                    const buttonText = selected.length > 0 ?
                        (selected.length > 3 ? selected.slice(0, 3).join(', ') + ` +${selected.length - 3} more` : selected.join(', ')) :
                        'Select Partner Children';
                    partnerChildrenButton.textContent = buttonText;
                }
            }

            if (partnerChildrenCheckboxes.length > 0) {
                partnerChildrenCheckboxes.forEach(cb => {
                    cb.addEventListener('change', updatePartnerChildrenButton);
                });
                updatePartnerChildrenButton();
            }

            // Partner Occupation Multiselect
            const partnerOccupationButton = document.getElementById('partnerOccupationDropdownButton');
            const partnerOccupationCheckboxes = document.querySelectorAll('input[name="partner_occupation[]"]');

            function updatePartnerOccupationButton() {
                let selected = [];
                partnerOccupationCheckboxes.forEach(cb => {
                    if (cb.checked) {
                        selected.push(cb.value);
                    }
                });
                if (partnerOccupationButton) {
                    const buttonText = selected.length > 0 ?
                        (selected.length > 3 ? selected.slice(0, 3).join(', ') + ` +${selected.length - 3} more` : selected.join(', ')) :
                        'Select Partner Occupation';
                    partnerOccupationButton.textContent = buttonText;
                }
            }

            if (partnerOccupationCheckboxes.length > 0) {
                partnerOccupationCheckboxes.forEach(cb => {
                    cb.addEventListener('change', updatePartnerOccupationButton);
                });
                updatePartnerOccupationButton();
            }

            // Partner Education Multiselect
            const partnerEducationButton = document.getElementById('partnerPartnerEducationDropdownButton');
            const partnerEducationCheckboxes = document.querySelectorAll('input[name="partner_education[]"]');

            function updatePartnerEducationButton() {
                let selected = [];
                partnerEducationCheckboxes.forEach(cb => {
                    if (cb.checked) {
                        selected.push(cb.value);
                    }
                });
                if (partnerEducationButton) {
                    const buttonText = selected.length > 0 ?
                        (selected.length > 3 ? selected.slice(0, 3).join(', ') + ` +${selected.length - 3} more` : selected.join(', ')) :
                        'Select Partner Education';
                    partnerEducationButton.textContent = buttonText;
                }
            }

            if (partnerEducationCheckboxes.length > 0) {
                partnerEducationCheckboxes.forEach(cb => {
                    cb.addEventListener('change', updatePartnerEducationButton);
                });
                updatePartnerEducationButton();
            }

            // Partner Religion Multiselect
            const partnerReligionButton = document.getElementById('partnerPartnerReligionDropdownButton');
            const partnerReligionCheckboxes = document.querySelectorAll('input[name="partner_religion[]"]');

            function updatePartnerReligionButton() {
                let selected = [];
                partnerReligionCheckboxes.forEach(cb => {
                    if (cb.checked) {
                        selected.push(cb.value);
                    }
                });
                if (partnerReligionButton) {
                    const buttonText = selected.length > 0 ?
                        (selected.length > 3 ? selected.slice(0, 3).join(', ') + ` +${selected.length - 3} more` : selected.join(', ')) :
                        'Select Partner Religion';
                    partnerReligionButton.textContent = buttonText;
                }
            }

            if (partnerReligionCheckboxes.length > 0) {
                partnerReligionCheckboxes.forEach(cb => {
                    cb.addEventListener('change', updatePartnerReligionButton);
                });
                updatePartnerReligionButton();
            }

            // Partner Financial Status Multiselect
            const partnerFinancialStatusButton = document.getElementById('partnerPartnerFinancialStatusDropdownButton');
            const partnerFinancialStatusCheckboxes = document.querySelectorAll('input[name="partner_financial_status[]"]');

            function updatePartnerFinancialStatusButton() {
                let selected = [];
                partnerFinancialStatusCheckboxes.forEach(cb => {
                    if (cb.checked) {
                        selected.push(cb.value);
                    }
                });
                if (partnerFinancialStatusButton) {
                    const buttonText = selected.length > 0 ?
                        (selected.length > 3 ? selected.slice(0, 3).join(', ') + ` +${selected.length - 3} more` : selected.join(', ')) :
                        'Select Partner Financial Status';
                    partnerFinancialStatusButton.textContent = buttonText;
                }
            }

            if (partnerFinancialStatusCheckboxes.length > 0) {
                partnerFinancialStatusCheckboxes.forEach(cb => {
                    cb.addEventListener('change', updatePartnerFinancialStatusButton);
                });
                updatePartnerFinancialStatusButton();
            }

            // Partner Dress Style Multiselect
            const partnerDressStyleButton = document.getElementById('partnerPartnerDressStyleDropdownButton');
            const partnerDressStyleCheckboxes = document.querySelectorAll('input[name="partner_dress_style[]"]');

            function updatePartnerDressStyleButton() {
                let selected = [];
                partnerDressStyleCheckboxes.forEach(cb => {
                    if (cb.checked) {
                        selected.push(cb.value);
                    }
                });
                if (partnerDressStyleButton) {
                    const buttonText = selected.length > 0 ?
                        (selected.length > 3 ? selected.slice(0, 3).join(', ') + ` +${selected.length - 3} more` : selected.join(', ')) :
                        'Select Partner Dress Style';
                    partnerDressStyleButton.textContent = buttonText;
                }
            }

            if (partnerDressStyleCheckboxes.length > 0) {
                partnerDressStyleCheckboxes.forEach(cb => {
                    cb.addEventListener('change', updatePartnerDressStyleButton);
                });
                updatePartnerDressStyleButton();
            }

            // Partner Vaccination Status Multiselect
            const partnerVaccinationStatusButton = document.getElementById('partnerVaccinationStatusDropdownButton');
            const partnerVaccinationStatusCheckboxes = document.querySelectorAll('input[name="partner_vaccinated[]"]');

            function updatePartnerVaccinationStatusButton() {
                let selected = [];
                partnerVaccinationStatusCheckboxes.forEach(cb => {
                    if (cb.checked) {
                        selected.push(cb.value);
                    }
                });
                if (partnerVaccinationStatusButton) {
                    const buttonText = selected.length > 0 ?
                        (selected.length > 3 ? selected.slice(0, 3).join(', ') + ` +${selected.length - 3} more` : selected.join(', ')) :
                        'Select Partner Vaccination Status';
                    partnerVaccinationStatusButton.textContent = buttonText;
                }
            }

            if (partnerVaccinationStatusCheckboxes.length > 0) {
                partnerVaccinationStatusCheckboxes.forEach(cb => {
                    cb.addEventListener('change', updatePartnerVaccinationStatusButton);
                });
                updatePartnerVaccinationStatusButton();
            }

            // Partner Pets Multiselect
            const partnerPetsButton = document.getElementById('partnerPetsDropdownButton');
            const partnerPetsCheckboxes = document.querySelectorAll('input[name="partner_pets[]"]');

            function updatePartnerPetsButton() {
                let selected = [];
                partnerPetsCheckboxes.forEach(cb => {
                    if (cb.checked) {
                        selected.push(cb.value);
                    }
                });
                if (partnerPetsButton) {
                    const buttonText = selected.length > 0 ?
                        (selected.length > 3 ? selected.slice(0, 3).join(', ') + ` +${selected.length - 3} more` : selected.join(', ')) :
                        'Select Partner Pets';
                    partnerPetsButton.textContent = buttonText;
                }
            }

            if (partnerPetsCheckboxes.length > 0) {
                partnerPetsCheckboxes.forEach(cb => {
                    cb.addEventListener('change', updatePartnerPetsButton);
                });
                updatePartnerPetsButton();
            }

            // Partner Sports Multiselect
            const partnerSportsButton = document.getElementById('partnerSportsDropdownButton');
            const partnerSportsCheckboxes = document.querySelectorAll('input[name="partner_sports[]"]');

            function updatePartnerSportsButton() {
                let selected = [];
                partnerSportsCheckboxes.forEach(cb => {
                    if (cb.checked) {
                        selected.push(cb.value);
                    }
                });
                if (partnerSportsButton) {
                    const buttonText = selected.length > 0 ?
                        (selected.length > 3 ? selected.slice(0, 3).join(', ') + ` +${selected.length - 3} more` : selected.join(', ')) :
                        'Select Partner Sports';
                    partnerSportsButton.textContent = buttonText;
                }
            }

            if (partnerSportsCheckboxes.length > 0) {
                partnerSportsCheckboxes.forEach(cb => {
                    cb.addEventListener('change', updatePartnerSportsButton);
                });
                updatePartnerSportsButton();
            }

            // Partner Entertainment Multiselect
            const partnerEntertainmentButton = document.getElementById('partnerEntertainmentDropdownButton');
            const partnerEntertainmentCheckboxes = document.querySelectorAll('input[name="partner_entertainment[]"]');

            function updatePartnerEntertainmentButton() {
                let selected = [];
                partnerEntertainmentCheckboxes.forEach(cb => {
                    if (cb.checked) {
                        selected.push(cb.value);
                    }
                });
                if (partnerEntertainmentButton) {
                    const buttonText = selected.length > 0 ?
                        (selected.length > 3 ? selected.slice(0, 3).join(', ') + ` +${selected.length - 3} more` : selected.join(', ')) :
                        'Select Entertainment';
                    partnerEntertainmentButton.textContent = buttonText;
                }
            }

            if (partnerEntertainmentCheckboxes.length > 0) {
                partnerEntertainmentCheckboxes.forEach(cb => {
                    cb.addEventListener('change', updatePartnerEntertainmentButton);
                });
                updatePartnerEntertainmentButton();
            }

            // Goals and Dreams Multiselect
            const goalsAndDreamsButton = document.getElementById('goalsAndDreamsDropdownButton');
            const goalsAndDreamsCheckboxes = document.querySelectorAll('input[name="goals_and_dreams[]"]');

            function updateGoalsAndDreamsButton() {
                let selected = [];
                goalsAndDreamsCheckboxes.forEach(cb => {
                    if (cb.checked) {
                        selected.push(cb.value);
                    }
                });
                if (goalsAndDreamsButton) {
                    const buttonText = selected.length > 0 ?
                        (selected.length > 3 ? selected.slice(0, 3).join(', ') + ` +${selected.length - 3} more` : selected.join(', ')) :
                        'Select Goals And Dreams';
                    goalsAndDreamsButton.textContent = buttonText;
                }
            }

            if (goalsAndDreamsCheckboxes.length > 0) {
                goalsAndDreamsCheckboxes.forEach(cb => {
                    cb.addEventListener('change', updateGoalsAndDreamsButton);
                });
                updateGoalsAndDreamsButton();
            }
        });
    </script>
@endsection
