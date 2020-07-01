  @extends('layouts.shop')
  @section('content')
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->
     @if ($errors->any()) 
    <div class="alert alert-danger">
     <ul>
      @foreach ($errors->all() as $error)
      <li>
        {{ $error }}
      </li> 
      @endforeach
    </div>
    @endif

    @if(session('msg'))
    <div class="alert-danger">{{session('msg')}}</div>
    @endif
    
     <form action="{{url('/loginadd')}}" method="post" class="reg-login">
      <input type="hidden" name="refer" value="{{request()->refer}}">
      @csrf
      <h3>还没有三级分销账号？点此<a class="orange" href="{{url('/reg')}}">注册</a></h3>
      <div class="lrBox">
       <div class="lrList"><input type="text" placeholder="输入手机号码或者邮箱号" name="name"/></div>
       <div class="lrList"><input type="password" placeholder="输入密码" name="pwd"/></div>
       <div>七天免登录：<input type="checkbox" name="rember"/></div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="button" value="立即登录" />
      </div>
     </form><!--reg-login/-->
     <script>
         $('input[type="button"]').click(function(){
               name=$('input[name="name"]').val();
               reg=/^1[3|4|5|6|7|8|9]\d{9}$/;
               reg_email=/^\w{3,}@([a-z]{2,7}|[0-9]{3})\.(com|cn)$/;
               if(!name){
                 alert('手机号码或者邮箱号不能为空');
                 return;
               }
                pwd=$('input[name="pwd"]').val();
               if(!pwd){
                 alert('密码不能为空');
                 return;
               }


               $('form').submit();
         })
     </script>
     @endsection