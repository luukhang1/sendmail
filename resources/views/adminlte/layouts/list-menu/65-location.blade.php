
@if(\Illuminate\Support\Facades\Auth::user()->role == 1)
    <li class="treeview {{ (request()->is('check-price*', 'widget/*')) ? 'active menu-open' : '' }}" style="height: auto;">
        <a href="#">
            <i class="fa fa-registered"></i>
            <span>Users manager</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu"
            style="{{ (request()->is('check-price*', 'widget/*')) ? '' : 'display: none;' }}">
            <li class="{{ request()->is('check-price') ? 'active' : '' }}">
                <a href="{{route('admin.get-all-users')}}"><i class="fa fa-send-o"></i>
                    <span>ALL Users</span></a>
            </li>
        </ul>
    </li>
@endif

<script src="{{asset('templates/adminlte/bower_components/jquery/dist/jquery.min.js')}}"></script>

