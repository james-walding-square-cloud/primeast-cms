<div class="left-nav">
    <div class="col-12 text-center">
        @if(Auth::user())
            <a class="text-decoration-none text-black" href="/admin/associate/index" class="p-3">
                <div class="bg-white py-3">
                    <h2>Associates</h2>
                </div>
            </a>
            <a class="text-decoration-none text-black" href="/admin/banner/index" class="p-3">
                <div class="bg-white py-3">
                    <h2>Banners</h2>
                </div>
            </a>
        @endif
    </div>
</div>
