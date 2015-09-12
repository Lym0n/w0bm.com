<!doctype html>
<html lang="de">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"">
    <meta name="viewport"
          content="width=device-width,initial-scale=1">
    <meta charset="UTF-8">
    <title>w0b me</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.5/cyborg/bootstrap.min.css">
    <style>
        body {
            padding-bottom: 70px;
        }
        .flashcontainer {
            position:fixed;
            margin:0 auto;
            left:0;
            right:0;
            bottom:100px;
            opacity: 0.8;
            z-index: 5;
        }
        .flashcontainer:empty {
            display:none;
        }
        .navbar{
            min-height:20px;
        }
        #bg {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            width: 100%;
            height: 100%;
            -webkit-filter: blur(100px);
            filter:blur(100px);
            transform: translate3d(0, 0, 0);
            z-index: -1;
        }
        .navbar-inverse {
            background-color: rgba(32, 32, 32, 0.6);
            border-color: transparent;
            z-index: 3;
        }
        .vertical-align {
            min-height: calc(100% - 70px);
            min-height: calc(100vh - 70px);
            display: flex;
            align-items: center;

        }
        .wrapper {
            width: 100%;
        }
        .row {
            width: 100%;
        }
    </style>
</head>
<body>
<canvas id="bg"></canvas>
<div class="container">
    @yield('content')
</div>

<nav class="navbar navbar-inverse navbar-fixed-bottom">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">w0bm</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-left">
                <li><a href="categories">Categories</a></li>
                <li><a href="about">About</a></li>
                <li><a href="songindex">Songindex</a></li>
            </ul>
            @if(Auth::check())
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="upload">Upload</a></li>
                    <li><a href="user/{{Auth::user()->username}}">{{Auth::user()->username}}</a></li>
                    <li><a href="logout">Logout</a></li>
                </ul>
            @else
                <form action="login" method="post" class="navbar-form navbar-right">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <input type="text" name="identifier" placeholder="Username/Email" class="form-control">
                        <input type="password" name="password" placeholder="Password" class="form-control">
                        <input type="checkbox" name="remember">
                        <button type="submit" class="btn btn-primary">Login</button>
                        <a href="register" class="btn btn-success">Register</a>
                    </div>
                </form>
            @endif
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
@include('partials.flash')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script>
    var video = document.getElementById('video');
    if(video !== null) {
        video.volume = 0.3;
        video.play();


        var canvas = document.getElementById('bg'),
                context = canvas.getContext('2d'),
                cw = canvas.clientWidth | 0,
                ch = canvas.clientHeight | 0;

        canvas.width = cw;
        canvas.height = ch;

        video.addEventListener('play', function() {
            draw(this,context,cw,ch);
        }, false);


        function draw(v,c,w,h) {
            if(v.paused || v.ended) return false;
            c.drawImage(v,0,0,w,h);

            setTimeout(draw,20,v,c,w,h);
        }

    } else {
        var canvas = document.getElementById('bg');
        canvas.parentNode.removeChild(canvas);
    }

    (function(){
        document.onkeydown = checkKey;
        var prev = document.getElementById('prev');
        var next = document.getElementById('next');
        function checkKey(event) {
            if (event.defaultPrevented) {
                return;
            }
            if(prev == undefined || next == undefined) return;
            if(event.keyIdentifier == 'Left') {
                if(prev.style.visibility == 'hidden') {
                    return;
                }
                prev.click();
            } else if(event.keyIdentifier == 'Right') {
                if(next.style.visibility == 'hidden') {
                    return;
                }
                next.click();
            }
        }
    })();


</script>
</body>
</html>
