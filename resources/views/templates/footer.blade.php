                </main>
                @if(!isset($hide_sidebar) || !$hide_sidebar)
                <div class="w-full md:w-3/12">
                <div id="sidenav-menu">
                @include('/templates/sidebar')
                </div>
                </div>
                @endif 
        </div>
        <!-- End sidenav + content -->
        @include('/templates/footer-contents')
</body>
</html>