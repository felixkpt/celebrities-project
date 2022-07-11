{!! Form::model($user, ['method' => $method,'route' => [$route, @$user->id], 'enctype' => 'multipart/form-data']) !!}
<div class="grid gap-8 sm:grid-cols-2">
    <div class="">
        <div class="form-group">
            <label class="text-gray-600 font-medium">Name:</label>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'basic-input')) !!}
        </div>
    </div>
    <div class="">
        <div class="form-group">
        <label class="text-gray-600 font-medium">Email:</label>
            {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'basic-input')) !!}
        </div>
    </div>
    <div class="">
        <div class="form-group">
            <label class="text-gray-600 font-medium">Password:</label>
            {!! Form::password('password', array('placeholder' => 'Password','class' => 'basic-input')) !!}
        </div>
    </div>
    <div class="">
        <div class="form-group">
            <label class="text-gray-600 font-medium">Confirm Password:</label>
            {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'basic-input')) !!}
        </div>
    </div>
    <div class="mx-auto sm:mx-0">
        <div class="flex flex flex-col w-3/4 sm:w-2/3 justify-center md:justify-end">
            <label class="flex text-gray-600 font-medium">User Avatar:</label>
            <?php $image = isset($user->avatar) ? $user->avatar : ''; $name = 'avatar'; ?>
            @include('/admin/components/image_upload')
        </div>
    </div>
    <div class="">
        <div class="flex flex-col h-full justify-between">
            <div class="flex flex-col w-100">
                <label class="text-gray-600 font-medium">Role:</label>
                {!! Form::select('roles[]', $roles,$userRole, array('class' => 'basic-input','multiple')) !!}
            </div>
            <div class="flex w-100 justify-end p-2">
                <button type="submit" class="button-default">Submit</button>
            </div>
        </div>
    </div>
    
</div>
{!! Form::close() !!}
