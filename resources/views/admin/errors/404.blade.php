@include('/admin/templates/header')
<div class="flex flex-col px-3">
    <div id="notfound">
        <div class="notfound">
            <div class="notfound-404">
                <h1>404</h1>
            </div>
            <h2>Oops! Nothing was found</h2>
            <p>The page you are looking for might have been removed had its name changed or is temporarily unavailable. <a class="link-default" href="{{ url('admin') }}">Return to dashboard</a></p>
            <div class="notfound-social">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-pinterest"></i></a>
                <a href="#"><i class="fab fa-google-plus"></i></a>
            </div>
        </div>
    </div>
</div>
@include('/admin/templates/footer')