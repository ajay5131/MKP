@push('custom-script') 
    <script>
        var index = 0;
        var max_index = 10;
        function addMore() {
            index = $('.add_more_keyword').attr('data-index');
            if(index < max_index) {
                index++;
                var html = $('.add_more_html').html();
                $('.add_more_keyword').append(html);
                
                $('.add_more_keyword').removeAttr('data-index');
                $('.add_more_keyword').attr('data-index', index);
            }
        }

        $(document).on('click', '.delete_block', function(e) {
            index--;
            $(this).parents('.add_more_class').remove();
            $('.add_more_keyword').removeAttr('data-index');
            $('.add_more_keyword').attr('data-index', index);
        })
    </script>
@endpush