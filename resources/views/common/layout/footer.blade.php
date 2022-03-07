    <footer class="footer">
        <div class="container">
        <div class="row">
            <div class="col-md-4">
            <h4 class="footer-title">@lang('messages.quicklinks')</h4>
            <ul class="list-item-footer">
                <li>
                <a href="{{ route('home') }}">@lang('messages.home')</a>
                </li>
                <li>
                <a href="{{ \Request::route()->getName() == "home" ? '#about_section' : route('home') . '#about_section' }}">@lang('messages.aboutus')</a>
                </li>
                <li>
                <a href="{{ route('contact') }}">@lang('messages.contactus')</a>
                </li>
                <li>
                <a href="{{ route('terms.and.condition') }}">@lang('messages.termsandcondition')</a>
                </li>
            </ul>
            </div>
            <div class="col-md-4">
            <h4 class="footer-title">@lang('messages.quicklinks')</h4>
            <ul class="list-item-footer">
                <li>
                    <a href="{{ route('privacy.policy') }}">@lang('messages.privacypolicy')</a>
                </li>
                <li>
                    <a href="{{ route('terms.of.service') }}">@lang('messages.termsofservice')</a>
                </li>
                <li>
                    <a href="{{ route('testimonial') }}">@lang('messages.testimonial')</a>
                </li>
                <li>
                    <a href="{{ route('faq') }}">@lang('messages.faq')</a>
                </li>
            </ul>
            </div>
            <div class="col-md-4 contact-bg-color">
            <h4 class="footer-title">@lang('messages.contactus')</h4>
            <div class="contact-details">
                <p>
                <i class="fa fa-map-marker" aria-hidden="true"></i>
                <span class="contact-txt">@lang('messages.contactaddress')</span>
                </p>
                <p>
                <i class="fa fa-envelope-o" aria-hidden="true"></i>
                <span class="contact-txt">info@meetkeypeople.com</span>
                </p>
                <p>
                <i class="fa fa-phone" aria-hidden="true"></i>
                <span class="contact-txt">+447597537747</span>
                </p>
            </div>
            <div class="social-media-links">
                <ul class="list-item-social-m">
                <li>
                    <a href="#">
                    <i class="fa fa-facebook" aria-hidden="true"></i>
                    </a>
                </li>
                <li>
                    <a href="#">
                    <i class="fa fa-instagram" aria-hidden="true"></i>
                    </a>
                </li>
                <li>
                    <a href="#">
                    <i class="fa fa-twitter" aria-hidden="true"></i>
                    </a>
                </li>
                <li>
                    <a href="#">
                    <i class="fa fa-youtube-play" aria-hidden="true"></i>
                    </a>
                </li>
                </ul>
            </div>
            </div>
        </div>
        </div>
        <div class="footer-bottom-strip">
        <div class="container">
            <div class="row">
            <div class="col-md-6">
                <p>Copyright © 2021 Meet Key People LLC. All Rights Reserved.</p>
            </div>
            <div class="col-md-6 text-right m-align">
                <img src="https://www.meetkeypeople.com/images/payment-icons.png">
            </div>
            </div>
        </div>
        </div>
    </footer>

    <div class="modal" id="uploadprofileimgModal" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-labelledby="uploadprofileimgModalTitle" aria-hidden="true">
        <div class="modal-dialog" >
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Upload & Crop Image</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <div id="image_demo" ></div>
                        </div>
                        <div class="col-md-12" >
                            <br /> 
                            <button class="btn btn-success crop_image">Crop & Upload Image</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- END Crop and update image popup --}}

      
    <div class="load_page_content">
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.7/js/swiper.min.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}home/js/swiper-slider.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js" ></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/2.2.9/flatpickr.min.js"></script>

    <script src="{{ asset('/') }}home/js/custom.validate.js" type="text/javascript"></script>
    <script src="{{ asset('/') }}home/js/custom.autocomplete.js" ></script>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.js"></script>


    {{-- Additional Css which need to add in specific page --}}
    <script>
        
        // Load modal with url
        function openModal(modalid, url) {
            $('#loader').show();
            $('#' + modalid + ' .modelDataLoad').load(url, function () {
                $('#' + modalid).modal({
                    show: true
                });
                $('#loader').hide();
            });
        }

        $(document).ready(function() {
            setTimeout(() => {
                $('.alert').slideUp();
            }, 5000);
        
        });
        flatpickr("#dobDatepicker", { 
            disableMobile: true,
            dateFormat: "Y-m-d",
        });
        $('.select2').select2();

        $(document).ready(function() {
            $(document).on('change', '#change_language', function(e) {

                var locale = $(this).val(); 
                $.ajax({
                    beforeSend: function (xhr) { // Add this line
                            xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
                    },
                    url: '{{ route("change.language") }}',
                    type: "POST",
                    data: {"locale":locale,"_token": "{{ csrf_token() }}"},
                    success: function (res) {
                        // console.log(res);
                        window.location.reload();
                    },
                });
            });

            $(document).on('click', '.add_more_btn', function(e) {
                // console.log();
                var add_more_btn = $(this);
                
                toggleLoader(add_more_btn);

                $('.load_page_content').load(add_more_btn.nextAll('#add_more_url').val(), function() {
                    var html = $('.load_page_content').html();
                    $('.load_page_content').empty();
                    // $('.add_more_lang').append(html);
                    add_more_btn.parents('form').find('.add_more_lang').append(html);
                    setTimeout(() => {
                        tinymce.remove('.tinymce_editor');
                        initEditor();
                        toggleLoader(add_more_btn);                       
                    }, 200);
                });
            });
            $(document).on('click', '.remove_btn', function(e) {
                $(this).parents('.add_more_block').remove();
            });

            function toggleLoader(ele) {
                ele.removeAttr('disabled', 'disabled');
                ele.toggleClass('loading', 100);
                if(ele.hasClass('loading')) {
                    ele.attr('disabled', 'disabled');
                } 
            }

        });
    </script>
    
    @stack('custom-script') 

    <script>
        function initEditor() {
            tinymce.init({
                selector: '.tinymce_editor',
                height: 150,
                forced_root_block: '',
                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime media table contextmenu paste code'
                ],
                toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image'
            });
        }
    </script>


</body>