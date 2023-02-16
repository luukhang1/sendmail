
@if(\Illuminate\Support\Facades\Auth::user()->role == 1)
    <li class="treeview {{ (request()->is('check-price*', 'widget/*')) ? 'active menu-open' : '' }}" style="height: auto;">
        <a href="#">
            <i class="fa fa-registered"></i>
            <span>Config</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu"
            style="{{ (request()->is('check-price*', 'widget/*')) ? '' : 'display: none;' }}">
            <li class="{{ request()->is('check-price') ? 'active' : '' }}">
                <a href="{{route('site.get-config')}}" ><i class="fa fa-send-o"></i>
                    <span>All Config</span></a>
            </li>
            <li>
                <a href="{{route('site.get-setting')}}"><i class="fa fa-send-o"></i>
                    <span>Setting</span></a>
            </li>
        </ul>
    </li>
@endif

<script src="{{asset('templates/adminlte/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('js/jquery.toaster.js')}}"></script>
<script>
    $('#send-mail').click(function (e) {
        e.preventDefault()
        $.ajax({
            type: "POST",
            url: "{{route('admin.home.send-mail')}}",
            data: {
                'email' : 'hoangthianh1704@gmail.com',
                "_token": "{{ csrf_token() }}",
            },
            success: function (res) {
                $.toaster({message: 'success',title: 'Thông báo'});
            },
            error: function (err) {
                $.toaster({message: 'error',title: 'Thông báo',priority: 'error'});
            }
        })
    })
</script>
