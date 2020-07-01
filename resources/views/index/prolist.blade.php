  @extends('layouts.shop')
  @section('content')
    <div class="maincont">
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <form action="#" method="get" class="prosearch"><input type="text" /></form>
      </div>
     </header>
     <ul class="pro-select">
      <li @if($type==1) class="pro-selCur" @endif><a href="{{url('prolist/'.$cate_id)}}">新品</a></li>
      <li @if($type==2) class="pro-selCur" @endif><a href="{{url('prolist/'.$cate_id.'/2')}}">销量</a></li>
      <li @if($type==3) class="pro-selCur" @endif><a href="{{url('prolist/'.$cate_id.'/3')}}">价格</a></li>
     </ul><!--pro-select/-->
     <div class="prolist">
      @foreach($goods as $v)
      <dl>
       <dt><a href="{{url('proinfo/'.$v->goods_id)}}"><img src="{{env('UPLOADS_URL')}}{{$v->goods_img}}" width="100" height="100" /></a></dt>
       <dd>
        <h3><a href="{{url('proinfo')}}">{{$v->goods_name}}</a></h3>
        <div class="{{url('proinfo')}}"><strong>{{$v->goods_price}}</strong> <span>¥599</span></div>
        <div class="prolist-yishou"><span>5.0折</span> <em>已售：35</em></div>
       
       </dd>
       
       <div class="clearfix"></div>
      </dl>
       @endforeach
     </div><!--prolist/-->
      @endsection
    