@extends('frontend.layouts.layout')

@section('content')

<section id="post-project-section">
  <form method="POST" action="{{ route('list.update', $project->id) }}" id="frm-add" enctype="multipart/form-data">
    @csrf
    @method('PUT')
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
            <option value="{{ $key }}" {{ ($key == $project->users_profiles_id)?'selected="selected"':'' }}">{{ $val }} </option>
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
              <option>Select Type</option>
              @foreach ($project_types as $key => $val)
              <option value="{{ $key }}" {{ ($key == $project->project_type_id)? 'selected="selected"':'' }}">{{ $val }} </option>
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
            <input type="text" name="title" id="title" class="form-control" value="{{ $project->title ?? ''}}">
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
              <option value="{{ $val->id }}" {{ ($val->id == $project->language_id)?'selected="selected"':'' }}">{{ $val->language }} </option>
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
              <option value="{{ $key }}" {{ (in_array($key,$project->interest_id)) ? 'selected' : ''}}>{{ $val }} </option>
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
          <img src="{{ isset($project->image) ? asset('uploads/'.$project->image) : '' }}" alt="profile Pic" height="400" width="1520">
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
            <option value="{{ $key }}" {{ ($key == $project->country_id)?'selected="selected"':'' }}>{{ $val }} </option>
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
        <div class="col-md-12 pt-5">
          <label class="lable-txt-weight">Listing Description<span class="mandatory">*</span> </label>
          <textarea name="description" id="description" rows="10" cols="80">{{ $project->description ?? '' }}</textarea>
          @error('description')
          <p class="help-block"><strong>{{ $message }}</strong></p>
          @enderror
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <label class="lable-txt-weight">Price <span class="mandatory">*</span> </label>
          <input type="text" class="form-control" name="price" id="price" value="{{$project->salary}}">
          @error('price')
          <p class="help-block"><strong>{{ $message }}</strong></p>
          @enderror
        </div>
      </div>

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
              <div class="more_pic col-md-2" id="additional_img_0">
              <img src="{{ asset('uploads/' . $project->additional_images) }}" class="grid-layout-item additional_im" >
                <!-- <i class="fa fa-trash text-danger delete_pic" onclick="deleteImage('s-l500.jpg',0)"></i> -->

              </div>

               <span id="new_images"></span>

            </div>
          </div>
        </div>
      </div>

      <div class="row ">
        <div class="col-md-9 pt-5">
          <label class="lable-txt-weight">Tags</label>
          <div class="row add-tag-new">
            <?php
            foreach ($project->project_tags as $key => $value) {

            ?>
              <div class="col-md-3 d-flex-align-c" id="tag-ids-{{$key}}">
                <input type="text" name="project_tag[]" class="form-control" value="{{ $value->project_tag ?? '' }}">
                <i class="fa fa-trash-o trash-icon del-tag" aria-hidden="true"></i>
              </div>
            <?php
            } ?>
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
          <button type="submit" class="create-project-btn">UPDATE LISTING &nbsp;&nbsp; <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></button>
        </div>
      </div>
  </form>
</section>
@endsection
@push('custom-script')
<script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
<script>
  $(document).ready(function() {

    var countries = <?php echo json_encode($countries); ?>;;

    var countryId = "{{ isset($project->country_id) ? $project->country_id : '' }}";
    var stateId = "{{ isset($project->state_id) ? $project->state_id : '' }}";
    var cityId = "{{ isset($project->city_id) ? $project->city_id : '' }}";

    $(function() {

      $('select[name="country_id"]').val(countryId).prop('selected', true);
      $('select[name="country_id"]').trigger('change');
      $('select[name="state_id"]').val(stateId).prop('selected', true);
      $('select[name="state_id"]').val(stateId).trigger('change');
      $('select[name="city_id"]').val(cityId).prop('selected', true);
    });

    $('#country_id').on('change', function() {
      var countID = this.value;
      var stateList = '<option value="" selected disabled>Select State</value>';
      $.each(countries, function(index, data) {

        if (data.id == countID) {
          //console.log("rashik");
          $.each(data.state_list, function(idx, state) {

            stateList += '<option value="' + state.id + '">' + state.title + '</option>'
          });

          return;
        }
      });

      $('select[name="state_id"]').html(stateList);
    });

    $('#state_id').on('change', function() {

      var countID = $('select[name="country_id"]').val();
      var stateID = this.value;

      var cityList = '<option value="" selected disabled>Select City</value>';
      $.each(countries, function(index, data) {

        if (data.id == countID) {

          $.each(data.state_list, function(idx, state) {

            if (state.id == stateID) {
              $.each(state.cities_list, function(idx, city) {
                cityList += '<option value="' + city.id + '">' + city.title + '</option>'

              });
            }
          });

          return;
        }
      });

      $('select[name="city_id"]').html(cityList);
    });
  })

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

  // $(".btn-add-tag").click(function() {
  //   $('.adding').after(`<div class="col-md-3 d-flex-align-c remove_btn">
  //              <input type="text" name="project_tag[]" class="form-control">
  //           <div class="btn childbtn"><i class="fa fa-trash-o trash-icon" aria-hidden="true"></i></div></div>`);
  // });
  // $('body').on('click', '.childbtn', function() {
  //   $(this).parent('.remove_btn').remove();
  // });

  $('.btn-add-tag').on('click', function() {
    $('.add-tag-new').append(`
              <div class="col-md-3 d-flex-align-c" id="tag-ids">
                <input type="text" name="project_tag[]" class="form-control" value="" required>
                <i class="fa fa-trash-o trash-icon del-tag" aria-hidden="true"></i>
              </div>`)
  })

  $(document).on('click', '.del-tag', function(e) {
    if (confirm("Are you sure you want to delete this?")) {
      var tagIds = $(this).closest('div').attr('id');
      // var tagIds = e.target.id.split('-')[2]
      $('#' + tagIds).remove()
    } else {
      return false;
    }

  })


  $('body').on('click', '.childbtn', function() {
    $(this).parent('.remove_btn').remove();
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
          $(".additional_im").css("display", "none");
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