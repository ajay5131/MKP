@extends('frontend.layouts.layout')

@section('content')



<section id="post-project-section">
  <form method="POST" action="{{ route('store.job') }}" id="frm-add" enctype="multipart/form-data">
    @csrf
    <div class="container-fluid bgColor-white">
      <div class="row align-v-center">
        <div class="col-md-8">
          <h5 class="title-txt">JOB Details</h5>
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
            <label class="lable-txt-weight">Contract<span class="mandatory"> *</span></label>

            <select class="form-control" name="project_type_id" id="project_type_id">
               <option value="">Select Contract</option>
               @foreach ($project_types as $key => $val)
                  <option value="{{ $key }}">{{ $val }} </option>
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
            <input type="text" name="title" id="title" class="form-control">
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
          <input type="file" name="image" id="image" class="choosen-file" class="form-control">
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
          <select name="country_id" id="country_id" class="selectpicker select2" data-live-search="true" class="form-control">
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
          <select name="state_id" id="state_id" class="selectpicker select2" data-live-search="true" class="form-control">
            <option data-tokens="" selected>Select State</option>
          </select>
          @error('state_id')
          <p class="help-block"><strong>{{ $message }}</strong></p>
          @enderror
        </div>
        <div class="col-md-4">

          <label>City <span class="mandatory">*</span></label>
          <select name="city_id" id="city_id" class="selectpicker select2" data-live-search="true" class="form-control">
            <option data-tokens="" selected>Select City</option>
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
              <option value="{{ $val->id }}">{{ $val->language }} </option>
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
            <input class="form-control datetimepicker" id="expiry_date" placeholder="job expiry Date" autocomplete="off" name="expiry_date" type="text" value="">

            @error('expiry_date')
            <p class="help-block"><strong>{{ $message }}</strong></p>
            @enderror
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12 pt-5">
          <label class="lable-txt-weight">About Us<span class="mandatory">*</span> </label>
          <textarea name="description" id="description" rows="10" cols="80"></textarea>
          @error('description')
          <p class="help-block"><strong>{{ $message }}</strong></p>
          @enderror
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Fields <span class="mandatory">*</span></label>
            <input type="text" class="form-control" name="fields" placeholder="Fields" id="fields" value="">
            @error('fields')
            <p class="help-block"><strong>{{ $message }}</strong></p>
            @enderror
          </div>
        </div>

        <div class="col-md-6">
          <label>Size <span class="mandatory">*</span></label>
          <input type="text" class="form-control" name="size" placeholder="Size" id="size" value="">
          @error('size')
          <p class="help-block"><strong>{{ $message }}</strong></p>
          @enderror
        </div>
      </div>


      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Number of Employees <span class="mandatory">*</span></label>
            <input type="number" class="form-control" name="no_of_people" placeholder="Number of Employees" id="no_of_people" min="1" value="">
            @error('no_of_people')
            <p class="help-block"><strong>{{ $message }}</strong></p>
            @enderror
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label>Job Atmosphere<span class="mandatory">*</span></label>
            <input type="text" class="form-control" name="job_atmosphere" placeholder="Atmosphere" id="atmosphere" value="">
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
            <input type="text" class="form-control" name="bonus" placeholder="Bonus" id="bonus" value="">
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
            <input type="text" name="role_title" id="role_title" class="form-control" placeholder="Role Title">
            @error('role_title')
            <p class="help-block"><strong>{{ $message }}</strong></p>
            @enderror
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12 pt-5">
          <label class="lable-txt-weight">Job Description<span class="mandatory">*</span> </label>
          <textarea name="job_description" id="job_description" rows="10" cols="80"></textarea>
          @error('job_description')
          <p class="help-block"><strong>{{ $message }}</strong></p>
          @enderror
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Skills<span class="mandatory">*</span></label>
            <input type="text" class="form-control" name="skills" placeholder="Skills" id="skills" value="">
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
            <input type="text" class="form-control" name="education" placeholder="Education" id="education" value="">
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
            <input type="text" class="form-control" name="experience" placeholder="Experience" id="experience" value="">
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
            <input type="text" class="form-control" name="employment_type" placeholder="Employment Type" id="employment_type" value="">
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
             <input type="text" class="form-control" name="day_hours" placeholder="Days/Hours" id="day_hours" value="">
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
             <option value="morning">Morning</option>
             <option value="afternoon">Afternoon</option>
             <option value="night">Night</option>
             <option value="rotating">Rotating</option> 
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
             <input type="text" class="form-control" name="salary" placeholder="Salary" id="salary" value="">
           @error('salary')
            <p class="help-block"><strong>{{ $message }}</strong></p>
            @enderror
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
          <button type="submit" class="create-project-btn">CREATE JOB &nbsp;&nbsp; <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></button>
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
</script>
<script>
  CKEDITOR.replace('description');
  CKEDITOR.replace('job_description');

  
</script>
@endpush