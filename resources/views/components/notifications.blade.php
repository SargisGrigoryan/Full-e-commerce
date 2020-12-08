<div class="container">
    <div class="row">
        <div class="col-12">
            {{-- Check if isset success status --}}
            @if (Session::get('notify_success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('notify_success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            {{-- Check if isset success status --}}
            @if (Session::get('notify_danger'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ Session::get('notify_danger') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
        </div>
    </div>
</div>