@include('/templates/header')
<div class="flex flex-col w-full my-2">
    <h1>The 16 Typologies by Mayers Briggs</h1>
    <div class="flex flex-wrap w-full bg-fushica-100 rounded-lg">
        @include('/typologies/components/personality-card')
    </div>
</div>
@include('/templates/footer')