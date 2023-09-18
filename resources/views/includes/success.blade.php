 @if (session()->has('success'))
        <div class="card bg-success border-0">
            <div class="card-body">
                <div class="card-text text-white">
                    {{ session('success') }}
                </div>
            </div>
        </div>
    @endif