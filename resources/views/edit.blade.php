@extends('DashboardModule::dashboard.index')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @include('DashboardModule::partials.alerts')

                        <h4 class="card-title">Dodawanie nowego apartamentu</h4>
                        <form method="POST"
                              action="{{route('ApartmentModule::apartments.update', ['apartment' => $apartment])}}"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="d-flex justify-content-center">
                                <div class="form-group @error('rooms_count') has-danger @enderror col-6">
                                    <label for="">Liczba pokoi</label>
                                    <input type="number" class="form-control" name="rooms_count"
                                           value="{{$apartment->rooms_count}}">
                                    @error('rooms_count')
                                    <small class="error mt-1 text-danger d-block">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group @error('number') has-danger @enderror col-6">
                                    <label for="">Numer apartamentu</label>
                                    <input type="text" class="form-control" name="number"
                                           value="{{$apartment->number}}">
                                    @error('number')
                                    <small class="error mt-1 text-danger d-block">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-flex justify-content-center">
                                <div class="form-group @error('floor') has-danger @enderror col-6">
                                    <label for="">Piętro</label>
                                    <input type="number" class="form-control" name="floor"
                                           value="{{$apartment->floor}}">
                                    @error('floor')
                                    <small class="error mt-1 text-danger d-block">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group @error('area') has-danger @enderror col-6">
                                    <label for="">Powierzchnia w m<sup>2</sup></label>
                                    <input type="number" class="form-control" name="area"
                                           value="{{$apartment->area}}" step="0.01">
                                    @error('area')
                                    <small class="error mt-1 text-danger d-block">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-flex">
                                <div class="form-group @error('status') has-danger @enderror col-6">
                                    <label for="">Status</label>
                                    <select class="form-control" name="status" id="">
                                        @foreach($statuses as $status)
                                            <option value="{{$status}}"
                                                    @if($apartment->status == $status) selected @endif>{{$status}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group @error('terrace_area') has-danger @enderror col-6">
                                    <label for="">Powierzchnia tarasu w m<sup>2</sup></label>
                                    <input type="number" class="form-control" name="terrace_area"
                                           value="{{$apartment->terrace_area}}" step="0.01">
                                    @error('terrace_area')
                                    <small class="error mt-1 text-danger d-block">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="photo">Plan apartamentu</label>
                                <input
                                    id="photo"
                                    type="file"
                                    name="photo_file"
                                    class="dropify"
                                    data-height="100"
                                    data-allowed-file-extensions="svg png jpg jpeg"
                                    data-default-file="{{asset($apartment->image_uri)}}"
                                    data-max-file-size="1M">

                                @error('photo_file')
                                <small class="error mt-1 text-danger d-block">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="pdf">Prospekt apartamentu (pdf)</label>
                                <input
                                    id="pdf"
                                    type="file"
                                    name="pdf_file"
                                    class="dropify"
                                    data-height="100"
                                    data-allowed-file-extensions="pdf"
                                    data-default-file="{{asset($apartment->pdf_uri)}}"
                                    data-max-file-size="2M">

                                @error('pdf_file')
                                <small class="error mt-1 text-danger d-block">{{ $message }}</small>
                                @enderror
                            </div>

                            <button type="submit" class="float-right mt-2 btn btn-primary mr-2">Zapisz</button>
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
