{!! Form::model($role, array('route' => [$route, @$role->id], 'method' => $method)) !!}
    <div class="flex w-full justify-center">
        <div class="flex flex-col bg-gray-100 w-1/2 p-1 rounded-lg shadow-lg">
            <div class="">
                <div class="form-group">
                    <label class="flex text-gray-600 font-medium">Name:</label>
                    {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'basic-input')) !!}
                </div>
            </div>
            <div class="">
                <div class="form-group">
                    <label class="flex text-gray-600 font-medium">Permission:</label>
                    <br/>
                    @foreach($permission as $value)
                        <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                        {{ $value->name }}</label>
                    <br/>
                    @endforeach
                </div>
            </div>
            <div class="my-3">
                <button type="submit" class="button-default">Submit</button>
            </div>
        </div>
</div>
{!! Form::close() !!}
