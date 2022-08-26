    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="block p-6 rounded-lg shadow-lg bg-white">
                @if($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Alert!</strong>
                            <span class="block sm:inline">{{ $error }}</span>
                        </div>
                    @endforeach
                @endif
                <form method="post" action="{{ url($route) }}" enctype="multipart/form-data">
                    @csrf
                    @method($method)
                    <input type="hidden" name="id" value="{{ @$personality->id }}">
                    <div class="form-group mb-6">
                    <input type="text" name="name" class="form-control block
                        w-full
                        px-3
                        py-1.5
                        text-base
                        font-normal
                        text-gray-700
                        bg-white bg-clip-padding
                        border border-solid border-gray-300
                        rounded
                        transition
                        ease-in-out
                        m-0
                        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                        value="{{ old('name') ?? @$personality->name }}"
                        placeholder="Name"
                        >
                    </div>
                    <div class="form-group mb-6">
                    <input type="text" name="strength" class="form-control block
                        w-full
                        px-3
                        py-1.5
                        text-base
                        font-normal
                        text-gray-700
                        bg-white bg-clip-padding
                        border border-solid border-gray-300
                        rounded
                        transition
                        ease-in-out
                        m-0
                        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                        value="{{ old('strength') ?? @$personality->strength }}"
                        placeholder="Personality strength"
                        >
                    </div>
                    <div class="form-group mb-6">
                    <textarea name="description"
                    class="
                        form-control
                        block
                        w-full
                        px-3
                        py-1.5
                        text-base
                        font-normal
                        text-gray-700
                        bg-white bg-clip-padding
                        border border-solid border-gray-300
                        rounded
                        transition
                        ease-in-out
                        m-0
                        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none
                    "
                    id="exampleFormControlTextarea13"
                    rows="3"
                    placeholder="Description"
                    >{{ old('description') ?? @$personality->description }}</textarea>
                    <div class="form-group mb-6">
                    <select name="prevalence" class="
                        w-full
                        text-gray-700
                        bg-white bg-clip-padding
                        border border-solid border-gray-300
                        rounded
                        transition
                        ease-in-out
                        m-0
                        py-1">
                        <?php for ($i=1; $i<=20; $i++): ?>
                            <option value="{{ $i }}" <?php if ((old('name') ?? @$personality->prevalence) == $i): echo "selected"; endif; ?>>{{ $i }}%</option>
                        <?php endfor; ?>
                    </select>
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
