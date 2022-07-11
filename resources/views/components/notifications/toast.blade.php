@if (session()->has('status'))
<div id="toast-status" class="bg-[#cff4fc] border-[#b6effb] absolute z-50 top-2 right-2 transition-opacity duration-1000 ease-out flex items-center w-full max-w-sm p-3 rounded-lg shadow" role="alert">
    @include('/components/notifications/components/status')
    <?php $dismissTarget = '#toast-status'; ?>
    @include('/components/notifications/components/dismiss')
</div>
@endif
@if (session()->has('success'))
<div id="toast-success" class="bg-[#acd7c4] border-[#a6cea6] absolute z-50 top-2 right-2 transition-opacity duration-1000 ease-out flex items-center w-full max-w-sm p-3 rounded-lg shadow" role="alert">
    @include('/components/notifications/components/success')
    <?php $dismissTarget = '#toast-success'; ?>
    @include('/components/notifications/components/dismiss')
</div>
@endif
@if (session()->has('warning'))
<div id="toast-warning" class="bg-[#fff3cd] border-[#ffecb5] absolute z-50 top-2 right-2 flex items-center w-full max-w-sm p-3 rounded-lg shadow" role="alert">
    @include('/components/notifications/components/warning')
    <?php $dismissTarget = '#toast-warning'; ?>
    @include('/components/notifications/components/dismiss')
</div>
@endif
@if (session()->has('danger'))
<div id="toast-danger" class="bg-[#f8d7da] border-[#f5c2c7] absolute z-50 top-2 right-2 transition-opacity duration-1000 ease-out flex items-center w-full max-w-sm p-3 rounded-lg shadow" role="alert">
    @include('/components/notifications/components/danger')
    <?php $dismissTarget = '#toast-danger'; ?>
    @include('/components/notifications/components/dismiss')
</div>
@endif
@if($errors->any())
<div id="toast-errors" class="bg-[#f8d7da] border-[#f5c2c7] absolute z-50 top-2 right-2 transition-opacity duration-1000 ease-out flex items-center w-full max-w-sm p-3 rounded-lg shadow" role="alert">
    <div class="flex flex-col">
        @foreach ($errors->all() as $error)
        @include('/components/notifications/components/danger')
        @endforeach
    </div>
    <?php $dismissTarget = '#toast-errors'; ?>
    @include('/components/notifications/components/dismiss')
</div>
@endif