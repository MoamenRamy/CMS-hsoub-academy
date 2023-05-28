<div class="col-md-4">
    <div class="card">
        <h5 class="card-header">التصنيفات</h5>
        <div class="card-body">
            <ul class="nav flex-column p-0" style="list-style: none !important;">
                <li class="nav-item">
                    <a class="nav-link text-dark" href="{{url('/')}}">جميع التصنيفات ( {{ $posts_number }})</a>
                </li>
                @foreach($categories as $cat)
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="{{ route('category', [$cat->id, $cat->slug]) }}">{{$cat->title}} ({{ $cat->post->count() }})</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
