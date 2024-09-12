<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('/css/font-awesome.css')}}">
    <link rel="stylesheet" href="https://travel.happytobook.com/css/app.css">
    <link rel="stylesheet" href="https://travel.happytobook.com/css/app1.css">
    <link rel="stylesheet" href="https://travel.happytobook.com/css/responsive.css">
    <link rel="stylesheet" href="https://travel.happytobook.com/css/pagination.css">
    <link rel="stylesheet" href="https://travel.happytobook.com/css/new_crm.css">
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        .flex {
            display: flex;
        }

        .space-bw {
            justify-content: space-between;
        }

        .cl-50 {
            width: 50%;
        }

        .leadhive_login {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('https://travel.happytobook.com/leadbackground.png');
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
        }

        .login_content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 10px;
            border-radius: 15px;
        }

        .login_left {
            padding: 50px;
            border-radius: 10px 0px 0px 10px;
            background: url('https://travel.happytobook.com/innerbackground.png');
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
        }

        .login_left h1 {
            font-size: 23px;
            color: #fff;
            margin-bottom: 15px;
        }

        .login_left p {
            font-size: 14px;
            color: #fff;
        }

        .login_right {
            padding: 50px 50px 50px 30px;
            border-radius: 0px 10px 10px 0px;
            background: #FFF;
            box-shadow: 0px 4px 81px 0px rgba(0, 0, 0, 0.15);
        }

        .login_right img {
            width: 150px;
            display: block;
            margin-bottom: 50px;
        }

        .login_right form h3 {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .login_right form input[type="text"] {
            border-radius: 5px;
            background: #F5F5F5;
            border: none;
            outline: none;
            width: 100%;
            padding: 10px 10px 10px 40px;
            margin-bottom: 10px;
        }

        .login_right form input[type="password"] {
            border-radius: 5px;
            background: #F5F5F5;
            border: none;
            outline: none;
            width: 100%;
            padding: 10px 10px 10px 40px;
        }

        .login_right form input[type="submit"] {
            border-radius: 4px;
            background: #2C4EA5;
            padding: 12px 16px;
            color: #fff;
            border: none;
            outline: none;
        }

        .pass_key p {
            color: #F87171;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 10px;
        }

        .user_id,
        .pass_key {
            position: relative;
        }

        .user_id i,
        .pass_key i {
            color: #adadad;
            position: absolute;
            top: 10px;
            left: 10px;
            border-right: 1px solid #D9D9D9;
            font-size: 15px;
            padding-right: 8px;
        }
        @media(max-width:480px){
            .cl-50 {
               width: 100%;
            }
            .login_left {
                display: none;
            }
            .login_content {
                width: 100%;
            }
            .login_right img {
                width: 100px;
                margin-bottom: 20px;
            }
            .login_right form h3 {
                font-size: 16px;
                margin-bottom: 8px;
            }
            .login_right form input[type="submit"] {
                padding: 10px 0px;
                width: 100%;
                font-size: 14px;
            }
            .login_right {
                padding: 15px;
            }
        }

    </style>
</head>
<body>
   
    <div class="leadhive_login">
        <div class="login_content">
            <div class="flex space-bw">
                <div class="cl-50 login_left">
                    <h1>Welcome to Leadhive</h1>
                    <p>Welcome to LeadHive, your Sales CRM login portal. LeadHive is your ultimate solution for efficient sales management. With LeadHive, you can easily manage leads, contacts, and sales opportunities, all while nurturing valuable customer relationships.</p>
                </div>
                <div class="cl-50 login_right">
                    <img src="{{asset('logo.png')}}" alt="">
                    <form action="/login" method="post" id="login_form">
                        <h3>ADMIN LOG-IN</h3>
                        <div class="user_id">
                            @csrf
                            <input type="text" name="employe_id" id="employe_id" value="{{old('employe_id')}}" placeholder="Enter Username">
                            <i class="fa-solid fa-user"></i>
                            @error('employe_id')<span class="text-danger"> {{ $message }} </span>@enderror
                        </div>
                        <div class="pass_key">
                            <input type="password" id="password" value="{{old('password')}}" placeholder="Enter Password" name="password">
                            <i class="fa-solid fa-key"></i>
                            @error('password')<span class="text-danger"> {{ $message }} </span>@enderror
                            @if(session()->get('error'))
                            <p>{!! session()->get('error') !!}</p>
                            @endif
                        </div>
                        <div>
                            <input type="submit" value="Login to account" class="cm-prim-btn" name="username">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>