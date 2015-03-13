<ul class="am-pagination">
    @if($prizes->getLastPage() <= 1)
        @else

  @for($i = 1; $i <= $prizes->getLastPage(); $i++ )
     <li class="{{$prizes->getCurrentPage() == $i ? 'am-active' : '';}}">
         <?php $query = '' ; ?>
        @foreach(Input::all() as $key => $para)
            @if($key != 'page')
                <?php $query .= '&'.$key . '=' . $para ?>
             @endif
         @endforeach
         <a href="{{ URL::current() . '?page=' . $i . $query}}">{{$i}}</a>
     </li>
  @endfor
        @endif
</ul>
