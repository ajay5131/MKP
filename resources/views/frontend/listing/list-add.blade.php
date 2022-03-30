@extends('frontend.layouts.layout')

@section('content')

<section id="post-project-section">
  <form method="POST" action="{{ route('store.listing') }}" id="frm-add" enctype="multipart/form-data">
    @csrf
    <div class="container-fluid bgColor-white">
      <div class="row align-v-center">
        <div class="col-md-8">
          <h5 class="title-txt">Listing Details</h5>
        </div>
        <div class="col-md-4">
          <label class="lable-txt-weight">Added From <span class="mandatory">*</span></label>
          @if(count($profile_arr) >0 )
          <select class="form-control" name="users_profiles_id" id="users_profiles_id">
            <option>Select a profile</option>
            @foreach ($profile_arr as $key => $val)
            <option value="{{ $key }}">{{ $val }} </option>
            @endforeach
          </select>
          @endif

          @error('users_profiles_id')
          <p class="help-block"><strong>{{ $message }}</strong></p>
          @enderror
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label class="lable-txt-weight">Type<span class="mandatory"> *</span></label>
            @if(count($project_types) >0 )
            <select class="form-control" name="project_type_id" id="project_type_id">
              <option>Select a type</option>
              @foreach ($project_types as $key => $val)
              <option value="{{ $key }}">{{ $val }} </option>
              @endforeach
            </select>
            @endif
            @error('project_type_id')
            <p class="help-block"><strong>{{ $message }}</strong></p>
            @enderror
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label class="lable-txt-weight">Title <span class="mandatory"> *</span></label>
            <input type="text" name="title" id="title" class="form-control">
            @error('title')
            <p class="help-block"><strong>{{ $message }}</strong></p>
            @enderror
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label class="lable-txt-weight">Language<span class="mandatory"> *</span></label>

            <select name="language_id" id="language_id" class="form-control">
              <option>Select a language</option>
              @foreach (General::getActiveLanguage() as $key => $val)
              <option value="{{ $val->id }}">{{ $val->language }} </option>
              @endforeach
            </select>
            @error('language_id')
            <p class="help-block"><strong>{{ $message }}</strong></p>
            @enderror
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="lable-txt-weight">For People Interested in<span class="mandatory"> *</span></label>

            <select name="interest_id[]" id="interest_id" class="form-control select2 int_select" multiple="multiple">
              <option>Select a profile</option>
              @foreach (General::getAllInterest() as $key => $val)
              <option value="{{ $key }}">{{ $val }} </option>
              @endforeach
            </select>
            @error('interest_id')
            <p class="help-block"><strong>{{ $message }}</strong></p>
            @enderror
          </div>
        </div>
        <div class="col-md-6">
          <label class="v-hide">dummy text</label>
          <div class="row">

            <div class="col-sm-12 col-md-12 col-lg-12 text-left">
              <div class="interest__images">
                <div class="image-grid matchingintrests">
                </div>
              </div>
            </div>

          </div>

        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <label class="lable-txt-weight">Cover Image<span class="mandatory">*</span></label>
          <p class="mandatory">Note: 1520 x 400 image dimension required</p>
          <input type="file" name="image" id="image" class="choosen-file">
          @error('image')
          <p class="help-block"><strong>{{ $message }}</strong></p>
          @enderror
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <h5 class="title-txt">More Details</h5>
        </div>
      </div>

      <div class="row">
        <div class="col-md-4">
          <label>Based In <span class="mandatory">*</span></label>
          <select name="country_id" id="country_id" class="selectpicker select2" data-live-search="true">
            <option data-tokens="" selected>Select Country</option>
            @foreach (General::getAllCountry() as $key => $val)
            <option value="{{ $key }}">{{ $val }} </option>
            @endforeach
          </select>
          @error('country_id')
          <p class="help-block"><strong>{{ $message }}</strong></p>
          @enderror
        </div>
        <div class="col-md-4">
          <label>State <span class="mandatory">*</span></label>
          <select name="state_id" id="state_id" class="selectpicker select2" data-live-search="true">
          </select>
          @error('state_id')
          <p class="help-block"><strong>{{ $message }}</strong></p>
          @enderror
        </div>
        <div class="col-md-4">

          <label>City <span class="mandatory">*</span></label>
          <select name="city_id" id="city_id" class="selectpicker select2" data-live-search="true">
          </select>
          @error('city_id')
          <p class="help-block"><strong>{{ $message }}</strong></p>
          @enderror
        </div>


      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>From <span class="mandatory">*</span></label>
            <input class="form-control datetimepicker" id="expiry_date" placeholder="Expiry Date" autocomplete="off" name="expiry_date" type="text" value="">

            @error('expiry_date')
            <p class="help-block"><strong>{{ $message }}</strong></p>
            @enderror
          </div>
        </div>


      </div>



      <div class="row">
        <div class="col-md-12 pt-5">
          <label class="lable-txt-weight">Listing Description<span class="mandatory">*</span> </label>
          <textarea name="description" id="description" rows="10" cols="80"></textarea>
          @error('description')
          <p class="help-block"><strong>{{ $message }}</strong></p>
          @enderror
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <label class="lable-txt-weight">Price <span class="mandatory">*</span> </label>
          <input type="text" class="form-control" name="price" id="price" rows="10" cols="80">
          @error('price')
          <p class="help-block"><strong>{{ $message }}</strong></p>
          @enderror
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <span class="pf-title"><label for="additional_images" class="bold">Upload Pictures</label></span>
          <div class="formrow">
            <div class="uploadbox">
              <label for="eventImageInput" class="custom-file-upload">
                <i class="la la-cloud-upload"></i> <span>Upload Pictures</span>
                <small class="text-danger">* Select all pictures at once</small>
              </label>
            </div>
            <input data-preview="#preview" name="additional_images" onclick="getOldfiles()" type="file" id="eventImageInput" style="display:none;" onchange="fileValidationmultiple()" multiple>
            <div id="multipleuploadpreview">
              <div class="old-images row">
                <span id="new_images"></span>

              </div>
            </div>
          </div>
        </div>
      </div>


      <div class="row ">
        <div class="col-md-9 pt-5">
          <label class="lable-txt-weight">Tags</label>
          <div class="row">
            <div class="col-md-3 d-flex-align-c adding">
              <input type="text" name="project_tag[]" class="form-control">
              <i class="fa fa-trash-o trash-icon" aria-hidden="true"></i>
            </div>
            @error('project_tag')
            <p class="help-block"><strong>{{ $message }}</strong></p>
            @enderror

          </div>
        </div>
        <div class="col-md-3 pt-5">
          <label class="v-hide">dummy text</label>
          <div class="row">
            <div class="col-md-12">
              <button type="button" class="btn-add-tag">Add Tags </button>
            </div>
          </div>
        </div>
      </div>



      <div class="row">
        <div class="col-md-12 pt-3">
          <button type="submit" class="create-project-btn">CREATE LISTING &nbsp;&nbsp; <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></button>
        </div>
      </div>
  </form>
</section>
@endsection
@push('custom-script')
<script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
<script>
  $(".int_select").on("select2:selecting", function(e) {
    var str = e.params.args.data.text;
    var id = e.params.args.data.id;
    str = str.trim();
    textstr = str;
    removed_space = str.replace(/\s+/g, '');
    str = str.replace(/\s+/g, '+');
    var html = `<div class="text-center match_int_` + id + `">
                    <div class="setting-grid-img"> 
                        <img src="{{ asset('/') }}home/images/icons/` + str + `.png" class="interest-img-grid">
                    </div>
                    <p class="matching_int_text">` + textstr + `</p>
                </div>`;
    $(".matchingintrests").append(html);
  });
  $(".int_select").on("select2:unselecting", function(e) {
    var id = e.params.args.data.id;
    $('.match_int_' + id).remove();
  });

  $(".btn-add-tag").click(function() {
    $('.adding').after(` <div class="col-md-3 d-flex-align-c remove_btn">
               <input type="text" name="project_tag[]" class="form-control">
            <div class="btn childbtn"><i class="fa fa-trash-o trash-icon" aria-hidden="true"></i></div></div>`);
  });


  $('body').on('click', '.childbtn', function() {
    $(this).parent('.remove_btn').remove();
  });

  $(document).ready(function() {
    $('#country_id').on('change', function() {
      var idCountry = this.value;
      $("#state_id").html('');
      $.ajax({
        url: "{{ route('fetch.states')}}",
        type: "POST",
        data: {
          country_id: idCountry,
          _token: '{{csrf_token()}}'
        },
        dataType: 'json',
        success: function(result) {
          $('#state_id').html('<option value="">Select State</option>');
          $.each(result.states, function(key, value) {
            $("#state_id").append('<option value="' + value
              .id + '">' + value.title + '</option>');
          });
          $('#city_id').html('<option value="">Select City</option>');
        }
      });
    });

    $('#state_id').on('change', function() {
      var idState = this.value;
      $("#city_id").html('');
      $.ajax({
        url: "{{ route('fetch.cities')}}",
        type: "POST",
        data: {
          state_id: idState,
          _token: '{{csrf_token()}}'
        },
        dataType: 'json',
        success: function(res) {
          $('#city_id').html('<option value="">Select City</option>');
          $.each(res.cities, function(key, value) {
            $("#city_id").append('<option value="' + value
              .id + '">' + value.title + '</option>');
          });
        }
      });
    });
  });
</script>
<script>
  $(function() {
    $('.datetimepicker').datetimepicker({
      //minDate: $.now(),
      format: 'YYYY-MM-DD'
    });

  });

  function fileValidationmultiple() {


    var fileInput = document.getElementById('eventImageInput');
    var multipleuploadpreview = document.getElementById('new_images');
    if (fileInput.files) {

      var filesAmount = fileInput.files.length;

      multipleuploadpreview.innerHTML = "";
      for (i = 0; i < filesAmount; i++) {
        var reader = new FileReader();

        reader.onload = function(event) {
          var div = $('<div class="more_pic col-md-2">');
          $($.parseHTML('<img  height="120px" style="padding:2%;">')).attr('src', event.target.result).appendTo(div);
          div.appendTo(multipleuploadpreview);
        }

        reader.readAsDataURL(fileInput.files[i]);
      }
    }
  }
</script>
<script>
  CKEDITOR.replace('description');
</script>
@endpush