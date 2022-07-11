@include('/admin/templates/header')    
<div class="flex flex-col px-3">
    <div class="flex w-full justify-center">
        <div class="flex flex-col bg-gray-100 w-1/2 p-1 rounded-lg shadow-lg">
            <div class="">
                <div class="form-group">
                    <label class="flex text-gray-600 font-medium">Name:</label>
                    {{ $role->name }}
                </div>
            </div>
            <div class="">
                <div class="form-group">
                    <label class="flex text-gray-600 font-medium">Permission:</label>
                    <br/>
                    @foreach($permission as $value)
                        <label>
                            <input disabled type="checkbox" {{ in_array($value->id, $rolePermissions) ? 'checked="checked"' : '' }}">
                            {{ $value->name }}
                        </label>
                    <br/>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</div>
@include('/admin/templates/footer')