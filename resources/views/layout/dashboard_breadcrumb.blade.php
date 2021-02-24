<div class="row">
    <div class="col-md-4">
        <div class="mt-3" >
            <h5 class="mb-1 font-weight-bold">{{ mb_strtoupper($title['name']) }}</h5>
            <div style="font-size: 13px;">
                <a href="{{ url('/home') }}">Home</a> > {!! implode(' > ', $title['path']) !!}
            </div>
        </div>
    </div>
    <div class="col-md-8">
        {{-- messages dialog --}}
        <div class="container-fluid px-0 pt-1 mb-3">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                    <i class="fa fa-check-circle" aria-hidden="true"></i> {!! session('success') !!}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="margin-top: -2px;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> {!! session('error') !!}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="margin-top: -2px;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
        </div>
    </div>
</div>



