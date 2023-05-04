<!-- jQuery  -->
<script src="{{URL::to('/')}}/templates/dashboard/assets/js/jquery.min.js"></script>
<script src="{{URL::to('/')}}/templates/dashboard/assets/js/bootstrap.bundle.min.js"></script>
<script src="{{URL::to('/')}}/templates/dashboard/assets/js/modernizr.min.js"></script>
<script src="{{URL::to('/')}}/templates/dashboard/assets/js/detect.js"></script>
<script src="{{URL::to('/')}}/templates/dashboard/assets/js/fastclick.js"></script>
<script src="{{URL::to('/')}}/templates/dashboard/assets/js/jquery.slimscroll.js"></script>
<script src="{{URL::to('/')}}/templates/dashboard/assets/js/jquery.blockUI.js"></script>
<script src="{{URL::to('/')}}/templates/dashboard/assets/js/waves.js"></script>
<script src="{{URL::to('/')}}/templates/dashboard/assets/js/jquery.nicescroll.js"></script>
<script src="{{URL::to('/')}}/templates/dashboard/assets/js/jquery.scrollTo.min.js"></script>

<!-- skycons -->
<script src="{{URL::to('/')}}/templates/dashboard/assets/plugins/skycons/skycons.min.js"></script>

<!-- skycons -->
<script src="{{URL::to('/')}}/templates/dashboard/assets/plugins/peity/jquery.peity.min.js"></script>

<!-- dashboard -->
<script src="{{URL::to('/')}}/templates/dashboard/assets/pages/dashboard.js"></script>

<!-- App js -->
<script src="{{URL::to('/')}}/templates/dashboard/assets/js/app.js"></script>

<!-- Select2 -->
<script src="{{URL::to('/')}}/templates/dashboard/assets/plugins/bootstrap-select2/select2.min.js"></script>

<script>
    $(function() {
        if ($('.select2').length >= 1) {
            $('.select2').select2({
                width : "100%",
                allowClear: true,
            });
        }
    });
</script>
@yield("script")