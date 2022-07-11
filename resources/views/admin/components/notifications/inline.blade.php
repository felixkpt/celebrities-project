@if (session()->has('status'))
<div class="m-1 bg-[#cff4fc] border-[#b6effb] border p-3 rounded relative" role="alert">
    @include('/admin/components/notifications/components/status')
</div>
@endif
@if (session()->has('success'))
<div class="m-1 bg-[#acd7c4] border-[#a6cea6] border p-3 rounded relative" role="alert">
    @include('/admin/components/notifications/components/success')
</div>
@endif
@if (session()->has('warning'))
<div class="m-1 bg-[#fff3cd] border-[#ffecb5] border p-3 rounded relative" role="alert">
    @include('/admin/components/notifications/components/warning')
</div>
@endif

@if (session()->has('danger'))
<div class="m-1 bg-[#f8d7da] border-[#f5c2c7] border p-3 rounded relative" role="alert">
    @include('/admin/components/notifications/components/danger')
</div>
@endif

@if($errors->any())
<div class="m-1 bg-[#f8d7da] border-[#f5c2c7] border p-3 rounded relative" role="alert">
    <div class="flex flex-col ">
        @foreach ($errors->all() as $error)
        @include('/admin/components/notifications/components/danger')
        @endforeach
    </div>
</div>
@endif