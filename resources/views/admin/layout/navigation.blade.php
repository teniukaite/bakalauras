<nav class="sidebar dark_sidebar">
    <div class="logo d-flex justify-content-between">
        <a class="large_logo" href="{{route('dashboard')}}"><img src="/img/logoadmin.png" alt=""></a>
        <a class="small_logo" href="{{route('dashboard')}}"><img src="/img/minlogo.png" alt=""></a>
        <div class="sidebar_close_icon d-lg-none">
            <i class="ti-close"></i>
        </div>
    </div>
    <ul id="sidebar_menu">
        <li class="">
            <a href="{{route('users.index')}}" aria-expanded="false">
                <div class="nav_icon_small">
                    <img src="/img/menu-icon/5.svg" alt="">
                </div>
                <div class="nav_title">
                    <span>Naudotojai </span>
                </div>
            </a>
{{--            <ul>--}}
{{--                <li><a href="index_2.html">Default</a></li>--}}
{{--                <li><a href="index_3.html">Dark Sidebar</a></li>--}}
{{--                <li><a href="index.html">Light Sidebar</a></li>--}}
{{--            </ul>--}}
        </li>
        <li class="">
            <a href="{{route('categories.index')}}" aria-expanded="false">
                <div class="nav_icon_small">
                    <img src="/img/menu-icon/2.svg" alt="">
                </div>
                <div class="nav_title">
                    <span>Kategorijos </span>
                </div>
            </a>
{{--            <ul>--}}
{{--                <li><a href="editor.html">editor</a></li>--}}
{{--                <li><a href="mail_box.html">Mail Box</a></li>--}}
{{--                <li><a href="chat.html">Chat</a></li>--}}
{{--                <li><a href="faq.html">FAQ</a></li>--}}
{{--            </ul>--}}
        </li>
        <li class="">
            <a href="{{route('newsletters.index')}}" aria-expanded="false">
                <div class="nav_icon_small">
                    <img src="/img/menu-icon/3.svg" alt="">
                </div>
                <div class="nav_title">
                    <span>Naujienlaiškiai</span>
                </div>
            </a>
{{--            <ul>--}}
{{--                <li><a href="login.html">Login</a></li>--}}
{{--                <li><a href="resister.html">Register</a></li>--}}
{{--                <li><a href="error_400.html">Error 404</a></li>--}}
{{--                <li><a href="error_500.html">Error 500</a></li>--}}
{{--                <li><a href="forgot_pass.html">Forgot Password</a></li>--}}
{{--                <li><a href="gallery.html">Gallery</a></li>--}}
{{--            </ul>--}}
        </li>
        <li class="">
            <a href="{{route('moderator.conflicts')}}" aria-expanded="false">
                <div class="nav_icon_small">
                    <img src="/img/menu-icon/4.svg" alt="">
                </div>
                <div class="nav_title">
                    <span>Konfliktai</span>
                </div>
            </a>
{{--            <ul>--}}
{{--                <li><a href="admin_list.html">Admin List</a></li>--}}
{{--                <li><a href="add_new_admin.html">Add New Admin</a></li>--}}
{{--            </ul>--}}
        </li>
        <li class="">
            <a href="{{route('requests.index')}}" aria-expanded="false">
                <div class="nav_icon_small">
                    <img src="/img/menu-icon/11.svg" alt="">
                </div>
                <div class="nav_title">
                    <span>Užklausos</span>
                </div>
            </a>
{{--            <ul>--}}
{{--                <li><a href="module_setting.html">Module Setting</a></li>--}}
{{--                <li><a href="role_permissions.html">Role & Permissions</a></li>--}}
{{--            </ul>--}}
        </li>
        <li class="">
            <a href="{{ route('reviews.index') }}" aria-expanded="false">
                <div class="nav_icon_small">
                    <img src="/img/menu-icon/12.svg" alt="">
                </div>
                <div class="nav_title">
                    <span>Atsiliepimai</span>
                </div>
            </a>
        </li>
        <li class="">
            <a href="{{ route('admin.offers') }}" aria-expanded="false">
                <div class="nav_icon_small">
                    <img src="/img/menu-icon/5.svg" alt="">
                </div>
                <div class="nav_title">
                    <span>Skelbimai</span>
                </div>
            </a>
{{--            <ul>--}}
{{--                <li><a href="user_list.html">Users List</a></li>--}}
{{--                <li><a href="add_new_user.html">Add New User</a></li>--}}
{{--            </ul>--}}
        </li>
        <li class="">
            <a href="{{route('dashboard')}}" aria-expanded="false">
                <div class="nav_icon_small">
                    <img src="/img/menu-icon/7.svg" alt="">
                </div>
                <div class="nav_title">
                    <span>Ataskaitos</span>
                </div>
            </a>
        </li>
    </ul>
</nav>
<div class="container-fluid">
    <div class="top_part dashboard_part large_header_bg">
        <div class="row">
            <div class="col-lg-12 p-0 ">
                <div class="header_iner d-flex justify-content-between align-items-center">
                    <div class="sidebar_icon d-lg-none">
                        <i class="ti-menu"></i>
                    </div>
                    <div class="line_icon open_miniSide d-none d-lg-block">
                        <img src="/img/line_img.png" alt="">
                    </div>
                    <div class="header_right d-flex justify-content-between align-items-center">
                        <div class="header_notification_warp d-flex align-items-center">
                            <li>
                                <a class="bell_notification_clicker" href="#"> <img src="/img/icon/msg.svg" alt="">
                                    <span>{{\App\Http\Service\UserService::getUnreadMessageCount()}}</span>
                                </a>
                                <div class="Menu_NOtification_Wrap">
                                    <div class="notification_Header">
                                        <h4>Pranešimai</h4>
                                    </div>
                                    <div class="Notification_body">
                                        @foreach(\App\Http\Service\UserService::getAllMessages() as $message)
                                        <div class="single_notify d-flex align-items-center">
                                            <div class="notify_thumb">
                                                <a href="#"><img src="{{asset($message->sender->photo)}}" alt=""></a>
                                            </div>
                                            <div class="notify_content @if(!$message->read) text-bold @endif">
                                                <a href="#"><h5>{{$message->sender->name}} {{$message->sender->lastName}} </h5></a>
                                                <p>{!! $message->message !!}</p>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="nofity_footer">
                                        <div class="submit_button text-center pt_20">
                                            <a href="{{route('messages.index')}}" class="btn_1">Peržiūrėti visus pranešimus</a>
                                        </div>
                                    </div>
                                </div>

                            </li>
                        </div>
                        <div class="profile_info">
                            @php($loggedInUser = \Illuminate\Support\Facades\Auth::user())
                            <img src="{{asset($loggedInUser->photo)}}" alt="#">
                            <div class="profile_info_iner">
                                <div class="profile_author_name">
                                    <p>{{\App\Http\Service\UserService::getRole($loggedInUser->role)}}</p>
                                    <h5>{{$loggedInUser->name}} {{$loggedInUser->lastName}}</h5>
                                </div>
                                <div class="profile_info_details">
                                    <a href="{{route('home')}}">Klientų sistema </a>
                                    <a href="#">Mano profilis</a>
                                    <a href="#">Atsijungti </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
