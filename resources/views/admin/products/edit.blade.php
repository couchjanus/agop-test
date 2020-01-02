@extends('layouts.admin')
@section('styles')
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" /> --}}
    <link href="{{ asset('css/dropzone.min.css') }}" rel="stylesheet" />
@endsection

@section('content')

<div class="card">
    <div class="card-header">
        Edit product
    </div>

    <div class="card-body">
        <form action="{{ route("admin.products.update", $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">Name *</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($product) ? $product->name : '') }}">
                @if($errors->has('name'))
                    <p class="help-block">
                        {{ $errors->first('name') }}
                    </p>
                @endif
                <p class="helper-block">
                    
                </p>
            </div>
            <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
                <label for="price">Price</label>
                <input type="number" id="price" name="price" class="form-control" value="{{ old('price', isset($product) ? $product->price : '') }}" step="0.01">
                @if($errors->has('price'))
                    <p class="help-block">
                        {{ $errors->first('price') }}
                    </p>
                @endif
                <p class="helper-block">
                    
                </p>
            </div>

            <div class="form-group">
                <label class="control-label" for="brand_id">Brand</label>
                <select name="brand_id" id="brand_id" class="form-control @error('brand_id') is-invalid @enderror">
                    <option value="0">Select a brand</option>
                        @foreach($brands as $brand)
                            @if ($product->brand_id == $brand->id)
                                <option value="{{ $brand->id }}" selected>{{ $brand->name }}</option>
                            @else
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endif
                        @endforeach
                </select>
                <div class="invalid-feedback active">
                    <i class="fa fa-exclamation-circle fa-fw"></i> @error('brand_id') <span>{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-group">
                <label class="control-label" for="description">Description</label>
                <textarea name="description" id="description" rows="8" class="form-control">{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="form-group">
                <label class="control-label" for="categories">Categories</label>
                <select name="categories[]" id="categories" class="form-control" multiple>
                            @foreach($categories as $category)
                                @php $check = in_array($category->id, $product->categories->pluck('id')->toArray()) ? 'selected' : ''@endphp
                                <option value="{{ $category->id }}" {{ $check }}>{{ $category->name }}</option>
                            @endforeach
                </select>
            </div>

            <div class="form-group">
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input"
                                                   type="checkbox"
                                                   id="status"
                                                   name="status"
                                                   {{ $product->status == 1 ? 'checked' : '' }}
                                                />Status
                    </label>
                </div>
            </div>

            
            <div>
                <input class="btn btn-danger" type="submit" value="Save">
            </div>
        </form>
        
        
        
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#settiongs" data-toggle="tab">Settiongs</a></li>
                  <li class="nav-item"><a class="nav-link" href="#seo" data-toggle="tab">Seo</a></li>
                  <li class="nav-item"><a class="nav-link" href="#images" data-toggle="tab">Images</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  
                  <div class="active tab-pane" id="settiongs">
                    
                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="seo">
                    SEO
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="images">
                    <form method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        @csrf
                        <div class="form-group">
                            <div class="needsclick dropzone" id="dropzone" style="border: 2px dashed rgba(0,0,0,0.3)">
                            </div>
                        </div>
                    <div>
                        <button class="btn btn-success" type="button" id="uploadButton">
                            <i class="fa fa-fw fa-lg fa-upload"></i>Upload Images
                        </button>
                    </div>
                    </form>
                    @if ($product->images)
                                <hr>
                                <div class="row">
                                    @foreach($product->images as $image)
                                        <div class="col-md-3">
                                            <div class="card">
                                                <div class="card-body">
                                                    <img src="{{ asset('storage/'.$image->filepath) }}" id="brandLogo" class="img-fluid" alt="img">
                                                    <a class="card-link float-right text-danger" href="{{ route('admin.products.images.delete', $image->id) }}">
                                                        <i class="fa fa-fw fa-lg fa-trash"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                    @endif
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
            
    </div>
</div>
@endsection

@push('scripts')
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script> --}}
<script src="{{ asset('js/select2.min.js') }}"></script>
<script src="{{ asset('js/dropzone.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('js/plugins/bootstrap-notify.min.js') }}"></script>

<script>
    // Dropzone class:
    $('#categories').select2();  

    Dropzone.autoDiscover = false;
    
    var baseUrl = "{{ route('admin.products.images.upload') }}";
    var token = {'X-CSRF-TOKEN': "{{ csrf_token() }}"};
    
    let myDropzone = new Dropzone("#dropzone", 
    {
        paramName: "image",
        addRemoveLinks: true,
        maxFilesize: 4,
        parallelUploads: 2,
        uploadMultiple: false,
        url: baseUrl,
        headers: token,
        autoProcessQueue: false,
    });

    myDropzone.on('sending', function(file, xhr, formData){
        formData.append('product_id', $('input[name="product_id"]').val());
    });

    myDropzone.on("queuecomplete", function (file) {
        window.location.reload();
        showNotification('Completed', 'All product images uploaded', 'success', 'fa-check');
    });

    $('#uploadButton').click(function(){
        if (myDropzone.files.length === 0) {
            showNotification('Error', 'Please select files to upload.', 'danger', 'fa-close');
        } else {
            myDropzone.processQueue();
        }
    });

    function showNotification(title, message, type, icon) {
        $.notify({
            title: title + ' : ',
            message: message,
            icon: 'fa ' + icon
        },{
            type: type,
            allow_dismiss: true,
            placement: {
                    from: "top",
                    align: "right"
            },
        });
    }

    </script>
@endpush
