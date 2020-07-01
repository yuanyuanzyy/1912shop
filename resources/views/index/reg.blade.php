
    @extends('layouts.shop')
  @section('content')
     
     
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->
     <b style="color:red">{{session('msg')}}</b>
     <form action="{{url('regadd')}}" method="post" class="reg-login">
      @csrf
      <h3>已经有账号了？点此<a class="orange" href="{{url('/login')}}">登陆</a></h3>
      <div class="lrBox">
       <div class="lrList"><input type="text" placeholder="输入手机号码或者邮箱号"  name="name"/></div>
       <div class="lrList2"><input type="text" placeholder="输入短信验证码" name="code"/> <button type="button">获取验证码</button></div>
       <div class="lrList"><input type="password" placeholder="设置新密码（6-18位数字或字母）" name="pwd" /></div>
       <div class="lrList"><input type="password" placeholder="再次输入密码" name="repwd"/></div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="button" value="立即注册" />
      </div>
     </form><!--reg-login/-->
     <script>
          $('button').click(function(){
             var name=$('input[name="name"]').val();
             $.get('/send',{name:name},function(res){

                 if(res.code=='00000'){
                    alert(res.msg);
                 }
             },'json')
          });

          $('input[type="button"]').click(function(){
             var name=$('input[name="name"]').val();

             if(!name){
                alert('手机号或邮箱不能为空');
                return;
             }
             var code=$('input[name="code"]').val();
             if(!code){
                alert('验证码不能为空');
                return;
             }
              var pwd=$('input[name="pwd"]').val();
              var reg=/^[a-zA-Z\d]{6,18}$/
             if(!reg.test(pwd)){
                alert('设置新密码（6-18位数字或字母）');
                return;
             }
                var repwd=$('input[name="repwd"]').val();
               if(repwd!=pwd){
                  alert('确认密码不一致');
                  return;
              }
             $('form').submit();
          });
     </script>
     
      @endsection