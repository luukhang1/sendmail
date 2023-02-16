{{--@if (request()->is('file-logs/list')  || auth()->user()->hasDirectPermission('ladings.listSpecial') || auth()->user()->hasDirectPermission('ladingRefresh.index') || auth()->user()->hasDirectPermission('location.address') || auth()->user()->hasDirectPermission('simulator') || auth()->user()->hasDirectPermission('tool.check-phone') || auth()->user()->hasDirectPermission('tool.lading.force-update.index'))--}}
{{--    <li class="treeview {{ (request()->is('ladings/*') || request()->is('tools/*')) ? 'active menu-open' : '' }}">--}}
{{--        <a href="#">--}}
{{--            <i class="fa fa-cube"></i> <span>Công cụ hỗ trợ</span>--}}
{{--            <span class="pull-right-container">--}}
{{--                          <i class="fa fa-angle-left pull-right"></i>--}}
{{--                        </span>--}}
{{--        </a>--}}
{{--        <ul class="treeview-menu">--}}
{{--            <li class="{{ request()->is('file-logs/list') ? 'active' : '' }}">--}}
{{--                <a href="{{url('file-logs/list')}}"><i class="fa fa-circle-o"></i>Xử lý file log webhook</a>--}}
{{--            </li>--}}
{{--            @if (auth()->user()->hasDirectPermission('location.address'))--}}
{{--                <li class="{{ request()->is('tools/locations') || request()->is('tools/locations/*') ? 'active' : '' }}">--}}
{{--                    <a--}}
{{--                            href="{{route('location.address')}}"><i class="fa fa-circle-o"></i> List--}}
{{--                        location</a></li>--}}
{{--            @endif--}}
{{--            @if (auth()->user()->hasDirectPermission('location.v2.address'))--}}
{{--                <li class="{{ request()->is('tools/locations/v2') || request()->is('tools/locations/v2/*') ? 'active' : '' }}">--}}
{{--                    <a--}}
{{--                            href="{{route('location.v2.address')}}"><i class="fa fa-circle-o"></i> List--}}
{{--                        location v2</a></li>--}}
{{--            @endif--}}
{{--            @if (auth()->user()->hasDirectPermission('kship-location.index'))--}}
{{--                <li class="{{ request()->is('tools/kship-locations') || request()->is('tools/kship-locations/*') ? 'active' : '' }}">--}}
{{--                    <a href="{{route('kship-location.index')}}">--}}
{{--                        <i class="fa fa-circle-o"></i> KShip location</a></li>--}}
{{--            @endif--}}
{{--            @if (auth()->user()->hasDirectPermission('simulator'))--}}
{{--                <li class="{{ request()->is('tools/simulator') || request()->is('tools/simulator/*') ? 'active' : '' }}">--}}
{{--                    <a--}}
{{--                            href="{{url('tools/simulator')}}"><i class="fa fa-circle-o"></i> Simulator</a>--}}
{{--                </li>--}}
{{--            @endif--}}
{{--            @if (auth()->user()->hasDirectPermission('tool.check-phone'))--}}
{{--                <li class="{{ request()->is('tools/check-phone') || request()->is('tools/check-phone/*') ? 'active' : '' }}">--}}
{{--                    <a href="{{route('tool.check-phone')}}"><i class="fa fa-circle-o"></i> Kiểm tra SĐT</a>--}}
{{--                </li>--}}
{{--            @endif--}}
{{--            @if (auth()->user()->hasDirectPermission('tool.lading.force-update.index'))--}}
{{--                <li class="{{ request()->is('tools/lading-force-update') || request()->is('tools/lading-force-update/*') ? 'active' : '' }}">--}}
{{--                    <a href="{{route('tool.lading.force-update.index')}}"><i class="fa fa-circle-o"></i> Cập--}}
{{--                        nhật dữ liệu đối soát</a>--}}
{{--                </li>--}}
{{--            @endif--}}
{{--            @if (auth()->user()->hasDirectPermission('tool.shop.force-update.index'))--}}
{{--                <li class="{{ request()->is('tools/shop-force-update') || request()->is('tools/shop-force-update/*') ? 'active' : '' }}">--}}
{{--                    <a href="{{route('tool.shop.force-update.index', ['type' => \App\Core\Data\Common::IMPORT_TYPE_UPDATE_SHOP_ADDRESS])}}"><i class="fa fa-circle-o"></i> Cập--}}
{{--                        nhật dữ liệu gian hàng</a>--}}
{{--                </li>--}}
{{--            @endif--}}
{{--            @if (auth()->user()->hasDirectPermission('ticket.param.index'))--}}
{{--                <li class="{{ request()->is('tickets/params') ? 'active' : '' }}">--}}
{{--                    <a href="{{route('ticket.param.index')}}"><i class="fa fa-circle-o"></i> Quản lý dữ liệu--}}
{{--                        Tạo Yêu Cầu </a>--}}
{{--                </li>--}}
{{--            @endif--}}
{{--            @if (auth()->user()->hasDirectPermission('tools.update-total.index'))--}}
{{--                <li class="{{ request()->is('tools/update-total/index') ? 'active' : '' }}">--}}
{{--                    <a href="{{route('tools.update-total.index')}}"><i class="fa fa-circle-o"></i> Cập nhật phí thu shop </a>--}}
{{--                </li>--}}
{{--            @endif--}}
{{--            @if (auth()->user()->hasDirectPermission('tool.support-cross-check.index'))--}}
{{--                <li class="{{ request()->is('tool/support-cross-check') ? 'active' : '' }}">--}}
{{--                    <a href="{{route('tool.support-cross-check.index')}}"><i class="fa fa-circle-o"></i> Support ĐS </a>--}}
{{--                </li>--}}
{{--            @endif--}}
{{--            @if (auth()->user()->hasDirectPermission('tool.banks.list-bank-kship'))--}}
{{--                <li class="{{ request()->is('tool/banks/list-bank-kship') ? 'active' : '' }}">--}}
{{--                    <a href="{{route('tool.banks.list-bank-kship')}}"><i class="fa fa-circle-o"></i> List bank Kship </a>--}}
{{--                </li>--}}
{{--            @endif--}}
{{--            @if (auth()->user()->hasDirectPermission('tool.banks.list-bank-merchant'))--}}
{{--                <li class="{{ request()->is('tool/banks/list-bank-merchant') ? 'active' : '' }}">--}}
{{--                    <a href="{{route('tool.banks.list-bank-merchant')}}"><i class="fa fa-circle-o"></i> List bank merchant </a>--}}
{{--                </li>--}}
{{--            @endif--}}
{{--        </ul>--}}
{{--    </li>--}}
{{--@endif--}}

