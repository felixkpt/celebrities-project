@include('/templates/header')
<div class="flex flex-wrap w-full md:w-6/12 bg-teal-50 p-2 shadow-lg">
    <div class="flex w-full px-2">
        <h1 class="text-2xl w-full text-center">Send enquiry</h1>
    </div>
    <div class="flex flex-wrap w-full bg-gray-200 px-2">
        @include('contact.form')
    </div>
</div>
@include('/templates/footer')