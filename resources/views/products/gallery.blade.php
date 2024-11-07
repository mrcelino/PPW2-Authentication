@extends('products.layout')
@section('content')
<div class="row justify-content-center mt-5">
  <div class="col-md-8">
      <div class="card">
          <div class="card-header">Dashboard atau Gallery</div>
          <div class="card-body">
              <div class="row">
                  @if(count($galleries) > 0)
                      @foreach ($galleries as $gallery)
                          <div class="col-sm-2">
                              <div>
                                <a class="example-image-link" href="{{ asset('storage/images/' . $gallery->image) }}" data-lightbox="roadtrip" data-title="{{ $gallery->description }}" rel="lightbox">
                                  <img class="example-image img-fluid mb-2" src="{{ asset('storage/images/' . $gallery->image) }}" alt="image-1">
                                </a>
                              </div>
                          </div>
                      @endforeach
                  @else
                      <h3>Tidak ada data.</h3>
                  @endif
              </div>
              <div class="d-flex">
                  {{ $galleries->links() }}
              </div>
          </div>
      </div>
  </div>
</div>
@endsection