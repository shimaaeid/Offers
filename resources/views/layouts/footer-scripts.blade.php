<!-- jquery -->
<script src="{{ URL::asset('assets/js/jquery-3.3.1.min.js') }}"></script>
<!-- plugins-jquery -->
<script src="{{ URL::asset('assets/js/plugins-jquery.js') }}"></script>
<!-- plugin_path -->
<script type="text/javascript">
    var plugin_path = '{{ asset('assets/js') }}/';
</script>

<!-- chart -->
<script src="{{ URL::asset('assets/js/chart-init.js') }}"></script>
<!-- calendar -->
<script src="{{ URL::asset('assets/js/calendar.init.js') }}"></script>
<!-- charts sparkline -->
<script src="{{ URL::asset('assets/js/sparkline.init.js') }}"></script>
<!-- charts morris -->
<script src="{{ URL::asset('assets/js/morris.init.js') }}"></script>
<!-- datepicker -->
<script src="{{ URL::asset('assets/js/datepicker.js') }}"></script>
<!-- sweetalert2 -->
<script src="{{ URL::asset('assets/js/sweetalert2.js') }}"></script>
<!-- toastr -->
@yield('js')
<script src="{{ URL::asset('assets/js/toastr.js') }}"></script>
<!-- validation -->
<script src="{{ URL::asset('assets/js/validation.js') }}"></script>
<!-- lobilist -->
<script src="{{ URL::asset('assets/js/lobilist.js') }}"></script>
<!-- custom -->
<script src="{{ URL::asset('assets/js/custom.js') }}"></script>
{{-- <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="
    crossorigin="anonymous"></script> --}}

<script type="text/javascript">
    $('.modal_forms').on('keyup', 'input', function(){
            $(this).parent().find('.error').text("");
        })

</script>

<script type="text/javascript">
    $(document).on('submit', '.modal_forms', function(e){
        e.preventDefault();
        var form = $(this);
        form.find('span.error').text();
    $.ajax({
        type : form.attr('method'),
        url :  form.attr('action') ,
        data : new FormData(form[0]),
        dataType : 'JSON',
        processData : false,
        contentType : false,
        success: function (response) {
            window.location.reload();
        },
        error: function(jqXHR) {
            if (jqXHR.status == 422) { // List Validation Error
        $.each(jqXHR.responseJSON.errors, function (key, val) {
            val = Array.isArray(val) ? val[0] : val;
            form.find(`#${key.replaceAll('.', '-')}_error`).text(val).fadeIn(300);
        });
        }else if (jqXHR.status == 500) {
        $.each(jqXHR.responseJSON.errors, function (key, val) {
            val = Array.isArray(val) ? val[0] : val;
            form.find(`#${key.replaceAll('.', '-')}_error`).text(val).fadeIn(300);
        });
        }
        },
    })
})
</script>
