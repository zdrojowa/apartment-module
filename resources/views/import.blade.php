@extends('DashboardModule::dashboard.index')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @include('DashboardModule::partials.alerts')

                        <h4 class="card-title">Import apartamentów</h4>
                        <form method="POST" action="{{route('ApartmentModule::apartments.import.store')}}"
                              enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="csv">Plik <code>*.csv</code></label>
                                <input
                                    id="csv"
                                    type="file"
                                    name="csv"
                                    class="dropify"
                                    data-height="100"
                                    data-allowed-file-extensions="csv"
                                    data-max-file-size="1M">

                                @error('csv')
                                <small class="error mt-1 text-danger d-block">{{ $message }}</small>
                                @enderror
                            </div>

                            <button type="submit" class="float-right mt-2 btn btn-primary mr-2">Importuj</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('javascripts')
    @parent
    <script>
        $('.dropify').dropify({})
    </script>
@endsection
