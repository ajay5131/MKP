@extends('frontend.layouts.layout')

@section('content')

<section id="post-project-section">
  <form method="POST" action="{{ route('update.job', $project->id) }}" id="frm-add" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="container-fluid bgColor-white">
      <div class="row align-v-center">
        <div class="col-md-8">
          <h5 class="title-txt">Job Details</h5>
        </div>
        <div class="col-md-4">
          <label class="lable-txt-weight">Added From <span class="mandatory">*</span></label>
         
          <select class="form-control" name="users_profiles_id" id="users_profiles_id">
            <option>Select a profile</option>
         
            @foreach ($profile_arr as $key => $val)
            <option value="{{ $key }}" {{ ($key == $project->users_profiles_id)?'selected="selected"':'' }}">{{ $val }} </option>
            @endforeach
          </select>
          @error('users_profiles_id')
          <p class="help-block"><strong>{{ $message }}</strong></p>
          @enderror
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label class="lable-txt-weight">Contract<span class="mandatory"> *</span></label>
           
            <select class="form-control" name="project_type_id" id="project_type_id">
              <option>Select Contract</option>
             
              @foreach ($project_types as $key => $val)
              <option value="{{ $key }}" {{ ($key == $project->project_type_id)? 'selected="selected"':'' }}">{{ $val }} </option>
              @endforeach
              
            </select>
            
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
          <h5 class="title-txt">Company</h5>
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
        <div class="col-md-12">
          <div class="form-group">
            <label class="lable-txt-weight">Language<span class="mandatory"> *</span></label>

            <select name="job_language_id" id="job_language_id" class="form-control">
              <option>Select a language</option>
              @foreach (General::getActiveLanguage() as $key => $val)
              <option value="{{ $val->id }}" {{ ($val->id == $project->job_language_id)?'selected="selected"':'' }}">{{ $val->language }} </option>
              @endforeach
            </select>
            @error('job_language_id')
            <p class="help-block"><strong>{{ $message }}</strong></p>
            @enderror
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Job expiry date <span class="mandatory">*</span></label>
            <input class="form-control datetimepicker" id="expiry_date" placeholder="job expiry Date" autocomplete="off" name="expiry_date" type="text" value="{{$project->expiry_date}}">

            @error('expiry_date')
            <p class="help-block"><strong>{{ $message }}</strong></p>
            @enderror
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12 pt-5">
          <label class="lable-txt-weight">About Us<span class="mandatory">*</span> </label>
          <textarea name="description" id="description" rows="10" cols="80">{{$project->description}}</textarea>
          @error('description')
          <p class="help-block"><strong>{{ $message }}</strong></p>
          @enderror
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Fields <span class="mandatory">*</span></label>
            <input type="text" class="form-control" name="fields" placeholder="Fields" id="fields" value="{{$project->fields}}">
            @error('fields')
            <p class="help-block"><strong>{{ $message }}</strong></p>
            @enderror
          </div>
        </div>

        <div class="col-md-6">
          <label>Size <span class="mandatory">*</span></label>
          <input type="text" class="form-control" name="size" placeholder="Size" id="size" value="{{$project->size}}">
          @error('size')
          <p class="help-block"><strong>{{ $message }}</strong></p>
          @enderror
        </div>
      </div>


      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Number of Employees <span class="mandatory">*</span></label>
            <input type="number" class="form-control" name="no_of_people" placeholder="Number of Employees" id="no_of_people" min="1" value="{{$project->no_of_people}}">
            @error('no_of_people')
            <p class="help-block"><strong>{{ $message }}</strong></p>
            @enderror
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label>Job Atmosphere<span class="mandatory">*</span></label>
            <input type="text" class="form-control" name="job_atmosphere" placeholder="Atmosphere" id="atmosphere" value="{{$project->job_atmosphere}}">
            @error('job_atmosphere')
            <p class="help-block"><strong>{{ $message }}</strong></p>
            @enderror
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Bonus<span class="mandatory">*</span></label>
            <input type="text" class="form-control" name="bonus" placeholder="Bonus" id="bonus" value="{{$project->bonus}}">
            @error('bonus')
            <p class="help-block"><strong>{{ $message }}</strong></p>
            @enderror
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <h5 class="title-txt">Role</h5>
        </div>
      </div>


      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label class="lable-txt-weight">Role Title <span class="mandatory"> *</span></label>
            <input type="text" name="role_title" id="role_title" class="form-control" placeholder="Role Title" value="{{$project->role_title}}">
            @error('role_title')
            <p class="help-block"><strong>{{ $message }}</strong></p>
            @enderror
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12 pt-5">
          <label class="lable-txt-weight">Job Description<span class="mandatory">*</span> </label>
          <textarea name="job_description" id="job_description" rows="10" cols="80">{{$project->job_description}}</textarea>
          @error('job_description')
          <p class="help-block"><strong>{{ $message }}</strong></p>
          @enderror
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Skills<span class="mandatory">*</span></label>
            <input type="text" class="form-control" name="skills" placeholder="Skills" id="skills" value="{{$project->skills}}">
            @error('skills')
            <p class="help-block"><strong>{{ $message }}</strong></p>
            @enderror
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Education<span class="mandatory">*</span></label>
            <input type="text" class="form-control" name="education" placeholder="Education" id="education" value="{{$project->education}}">
            @error('education')
            <p class="help-block"><strong>{{ $message }}</strong></p>
            @enderror
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Experience<span class="mandatory">*</span></label>
            <input type="text" class="form-control" name="experience" placeholder="Experience" id="experience" value="{{$project->experience}}">
            @error('experience')
            <p class="help-block"><strong>{{ $message }}</strong></p>
            @enderror
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Employment Type<span class="mandatory">*</span></label>
            <input type="text" class="form-control" name="employment_type" placeholder="Employment Type" id="employment_type" value="{{$project->employment_type}}">
            @error('employment_type')
            <p class="help-block"><strong>{{ $message }}</strong></p>
            @enderror
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Days/Hours<span class="mandatory">*</span></label>
             <input type="text" class="form-control" name="day_hours" placeholder="Days/Hours" id="day_hours" value="{{$project->day_hours}}">
           @error('day_hours')
            <p class="help-block"><strong>{{ $message }}</strong></p>
            @enderror
          </div>
        </div>
      </div>

            
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Shifts<span class="mandatory">*</span></label>

            <select name="shifts[]" id="shifts" class="form-control select2 int_select" multiple="multiple">
              <option value="morning" {{ (in_array("morning",$shifts)) ? 'selected' : ''}}>Morning</option>
              <option value="afternoon" {{ (in_array("afternoon",$shifts)) ? 'selected' : ''}}>Afternoon</option>
              <option value="night" {{ (in_array("night",$shifts)) ? 'selected' : ''}}>Night</option>
              <option value="rotating" {{ (in_array("rotating",$shifts)) ? 'selected' : ''}}>Rotating</option> 
            </select>
            @error('skills')
            <p class="help-block"><strong>{{ $message }}</strong></p>
            @enderror
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Salary<span class="mandatory">*</span></label>
             <input type="text" class="form-control" name="salary" placeholder="Salary" id="salary" value="{{$project->salary}}">
           @error('salary')
            <p class="help-block"><strong>{{ $message }}</strong></p>
            @enderror
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
                <input type="text" name="project_tag[]" class="form-control" data_id="{{$value->project_tag_id}}" value="{{ $value->project_tag ?? '' }}">
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
          <button type="submit" class="create-project-btn">UPDATE JOB &nbsp;&nbsp; <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></button>
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
      var stateList = '<option value="{{$project->employment_type}}" selected disabled>Select State</value>';
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

      var cityList = '<option value="{{$project->employment_type}}" selected disabled>Select City</value>';
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
</script>
<script>
$(function () {
    $('.datetimepicker').datetimepicker({
        //minDate: $.now(),
        format: 'YYYY-MM-DD'
    });

});
</script>
<script>
  CKEDITOR.replace('description');
  CKEDITOR.replace('job_description');

</script>
@endpush