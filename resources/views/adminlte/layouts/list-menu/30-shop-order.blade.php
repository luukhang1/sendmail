<li class="treeview {{ (request()->is('check-price*', 'widget/*')) ? 'active menu-open' : '' }}" style="height: auto;">
    <a href="#">
        <i class="fa fa-registered"></i>
        <span>Payment</span>
        <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
    </a>
    <ul class="treeview-menu"
        style="{{ (request()->is('check-price*', 'widget/*')) ? '' : 'display: none;' }}">
        <li class="{{ request()->is('check-price') ? 'active' : '' }}">
            <a href="{{route('site.get-payment')}}" ><i class="fa fa-send-o"></i>
                <span>Add Payment</span></a>
        </li>
        <li class="{{ request()->is('check-price') ? 'active' : '' }}">
            <a href="{{route('site.withdrawal-view')}}" ><i class="fa fa-send-o"></i>
                <span>Withdrawal</span></a>
        </li>
    </ul>
</li>
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
