@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.icdOrder.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.icd-orders.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="order_number">{{ trans('cruds.icdOrder.fields.order_number') }}</label>
                <input class="form-control {{ $errors->has('order_number') ? 'is-invalid' : '' }}" type="text" name="order_number" id="order_number" value="{{ old('order_number', '') }}">
                @if($errors->has('order_number'))
                    <span class="text-danger">{{ $errors->first('order_number') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.icdOrder.fields.order_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="icd_cm">{{ trans('cruds.icdOrder.fields.icd_cm') }}</label>
                <input class="form-control {{ $errors->has('icd_cm') ? 'is-invalid' : '' }}" type="text" name="icd_cm" id="icd_cm" value="{{ old('icd_cm', '') }}">
                @if($errors->has('icd_cm'))
                    <span class="text-danger">{{ $errors->first('icd_cm') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.icdOrder.fields.icd_cm_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.icdOrder.fields.category') }}</label>
                @foreach(App\Models\IcdOrder::CATEGORY_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('category') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="category_{{ $key }}" name="category" value="{{ $key }}" {{ old('category', '') === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="category_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('category'))
                    <span class="text-danger">{{ $errors->first('category') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.icdOrder.fields.category_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="short_desc">{{ trans('cruds.icdOrder.fields.short_desc') }}</label>
                <input class="form-control {{ $errors->has('short_desc') ? 'is-invalid' : '' }}" type="text" name="short_desc" id="short_desc" value="{{ old('short_desc', '') }}">
                @if($errors->has('short_desc'))
                    <span class="text-danger">{{ $errors->first('short_desc') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.icdOrder.fields.short_desc_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="long_desc">{{ trans('cruds.icdOrder.fields.long_desc') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('long_desc') ? 'is-invalid' : '' }}" name="long_desc" id="long_desc">{!! old('long_desc') !!}</textarea>
                @if($errors->has('long_desc'))
                    <span class="text-danger">{{ $errors->first('long_desc') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.icdOrder.fields.long_desc_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('admin.icd-orders.storeCKEditorImages') }}', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $icdOrder->id ?? 0 }}');
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

@endsection