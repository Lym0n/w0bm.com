<div class="page-header">
    <h3>{{$user->username}} {!! $user->activeIcon() !!}&nbsp;@if(auth()->check() && auth()->user()->can('edit_user'))<a href="#" data-toggle="modal" data-target="#banmenumodal"><i style="color:red;" class="fa fa-lock"></i></a>@endif @if($user->disabled && isset($user->banend) && (Carbon\Carbon::now() <= $user->banend || 0 >= $user->banend->timestamp))<span style="color: grey; font-size: 15px;">(@if(Carbon\Carbon::now() <= $user->banend)Ban expires in <time class="timeago" data-toggle="tooltip" title="{{ $user->banend }}+0000" datetime="{{ $user->banend }}+0000"></time>@else permanently banned @endif)</span>@endif<h3>
    <h6><span class="pull-right">Joined: <time class="timeago" datetime="{{ $user->created_at }}+0000" title="{{ $user->created_at }}+0000" data-toggle="tooltip"></time></span></h6>
    <h5><a style="color:#1FB2B0;" href="/user/{{$user->username}}"><i class="fa fa-cloud-upload"></i> {{ $user->videos()->count() }} Uploads</a> <span> <a style="color:white;" href="/user/{{$user->username}}/comments"><i class="fa fa-commenting"></i> {{ $user->comments()->count() }} Comments</span> <span><a style="color:#CE107C;" href="/user/{{$user->username}}/favs"><i class="fa fa-heart"></i> {{ $user->favs()->count() }} Favorites</a></span></h5>
</div>
