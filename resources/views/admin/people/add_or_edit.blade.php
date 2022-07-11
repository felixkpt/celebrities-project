<?php 
use App\Models\Country;
use App\Models\Typology;
?>
    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="block p-6 rounded-lg shadow-lg bg-white">
                <form method="post" action="{{ route($route, ['person' => @$person->id]) }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method" value="{{ $method }}">
                    <input type="hidden" name="id" value="{{ (old('id') ?: @$person->id) }}">
                    <div class="form-group mb-6">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" value="{{ (old('title') ?: @$person->title) }}">
                    </div>
                    <div class="form-group mb-6">
                        <label for="first_name">First name</label>
                        <input type="text" name="first_name" id="first_name" class="basic-input"
                        value="{{ old('first_name') ?: @$person->first_name }}"
                        placeholder="First name"
                        >
                    </div>
                    <div class="form-group mb-6">
                        <label for="last_name">Last name</label>
                        <input type="text" name="last_name" id="last_name" class="basic-input"
                        value="{{ old('last_name') ?: @$person->last_name }}"
                        placeholder="Last name"
                        >
                    </div>
                    <div class="form-group mb-6">
                        <label for="nickname">Nickname</label>
                        <input type="text" name="nickname" id="nickname" class="basic-input"
                        value="{{ old('nickname') ?: @$person->nickname }}"
                        placeholder="Nickname"
                        >
                    </div>
                    <div class="form-group mb-6">
                        <label for="gender">Gender</label>
                        <select name="gender" id="gender">
                            <?php 
                                $gender = old('gender') ?: @$person->gender;
                            ?>
                            <option value="male" <?php if($gender == 'male') echo "selected" ?>>Male</option>
                            <option value="female" <?php if($gender == 'female') echo "selected" ?>>Female</option>
                        </select>
                    </div>
                    <div class="form-group mb-6">
                        <label for="dob">DOB</label>
                        <input type="text" name="dob" id="dob" class="basic-input"
                        value="{{ old('dob') ?: @$person->dob }}"
                        placeholder="Date of birth"
                        >
                    </div>
                    <div class="form-group mb-6">
                        <label for="birth_place">Birth place</label>
                        <input type="text" name="birth_place" id="birth_place" class="basic-input"
                        value="{{ old('birth_place') ?: @$person->birth_place }}"
                        placeholder="Date of birth"
                        >
                    </div>
                    <div class="form-group mb-6">
                        <label for="county">County</label>
                        <input type="text" name="county" id="county" class="basic-input"
                        value="{{ old('county') ?: @$person->county }}"
                        placeholder="County"
                        >
                    </div>
                    <div class="form-group mb-6">
                        <label for="state">State</label>
                        <input type="text" name="state" id="state" class="basic-input"
                        value="{{ old('state') ?: @$person->state }}"
                        placeholder="State"
                        >
                    </div>
                    <div class="form-group mb-6">
                        <label for="city">City</label>
                        <input type="text" name="city" id="city" class="basic-input"
                        value="{{ old('city') ?: @$person->city }}"
                        placeholder="City"
                        >
                    </div>
                    <div class="form-group mb-6">
                        <label for="coutry">Country</label>
                        <select name="country_code" id="country" class="
                        w-full
                        text-gray-700
                        bg-white bg-clip-padding
                        border border-solid border-gray-300
                        rounded
                        transition
                        ease-in-out
                        m-0
                        py-1">
                        <?php foreach (Country::all() as $country): ?>
                            <option value="{{ $country->code }}" <?php if (old('country_code') ?: @$person->country_code == $country->code): echo "selected"; endif; ?>>{{ $country->name }}</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group mb-6">
                        <label for="professional">Profession</label>
                        <input type="text" name="professional" id="professional" class="basic-input"
                        value="{{ old('professional') ?: @$person->professional }}"
                        placeholder="Professional"
                        >
                    </div>
                    <div class="form-group mb-6">
                        <label for="worth">Worth</label>
                        <input type="text" name="worth" id="worth" class="basic-input"
                        value="{{ old('worth') ?: @$person->content->worth }}"
                        placeholder="Worth"
                        >
                    </div>
                    <div class="form-group mb-6">
                        <label for="hobbies">Hobbies</label>
                        <input type="text" name="hobbies" id="hobbies" class="basic-input"
                        value="{{ old('hobbies') ?: @$person->content->hobbies }}"
                        placeholder="Hobbies"
                        >
                    </div>
                    <div class="form-group mb-6">
                        <label for="quotes">Quotes (Separate by comma ,)</label>
                        <input type="text" name="quotes" id="quotes" class="basic-input"
                        value="{{ old('quotes') ?: @$person->content->quotes }}"
                        placeholder="Favorite quote"
                        >
                    </div>
                    <div class="form-group mb-6">
                        <label for="content">Content</label>
                        <textarea name="content" id="content"
                        class="basic-textarea"
                        rows="5"
                        placeholder="Write content..."
                        >{{ old('content') ?: @$person->content->content }}</textarea>
                        <div class="form-group mb-6">
                        <label for="coutry">Typology</label>
                        <select name="typology" id="country" class="
                        w-full
                        text-gray-700
                        bg-white bg-clip-padding
                        border border-solid border-gray-300
                        rounded
                        transition
                        ease-in-out
                        m-0
                        py-1">
                        <?php foreach (Typology::all() as $typology): ?>
                            <option value="{{ $typology->name }}" <?php if (old('typology') ?: @$person->typology == $typology->name): echo "selected"; endif; ?>>{{ $typology->name }}</option>
                            <?php endforeach; ?>
                        </select>
                        </div>
                        <div class="form-group mb-6">
                            <label for="website">Website</label>
                            <input type="text" name="website" id="website" class="basic-input"
                            value="{{ old('website') ?: @$person->content->website }}"
                            placeholder="Website"
                            >
                        </div>
                        <div class="form-group mb-6">
                            <label for="timezone">Timezone</label>
                            <input type="timezone" name="timezone" id="timezone" class="basic-input"
                            value="{{ old('timezone') ?: @$person->timezone }}"
                            placeholder="Timezone"
                            >
                        </div>
                        <div class="form-group mb-6">
                            <label for="timezone_description">Tmezone description</label>
                            <input type="name" name="timezone_description" id="timezone_description" class="basic-input"
                            value="{{ old('timezone_description') ?: @$person->timezone_description }}"
                            placeholder="Timezone description"
                            >
                        </div>
                        <div class="form-group mb-6">
                            <label for="died_on">Died on</label>
                            <input type="name" name="died_on" id="died_on" class="basic-input"
                            value="{{ old('died_on') ?: @$person->died_on }}"
                            placeholder="DD-MM-YYYY"
                            >
                        </div>
                    </div>

                    @include('/admin/components/image_upload')
                   
                    <button type="submit" class="
                    w-full
                    px-6
                    py-2.5
                    bg-blue-600
                    text-white
                    font-medium
                    text-xs
                    leading-tight
                    uppercase
                    rounded
                    shadow-md
                    hover:bg-blue-700 hover:shadow-lg
                    focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0
                    active:bg-blue-800 active:shadow-lg
                    transition
                    duration-150
                    ease-in-out">Save</button>
                </form>
            </div>
        </div>
    </div>
