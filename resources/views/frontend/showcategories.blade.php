@foreach ($subcategories as $sub)
    <li><a href="" class="nav-link p-0 ms-2"
        onclick="this.closest('form').submit();return false;">  {{$parent}} {{ $sub->name }}</a>
    </li>

    @if (count($sub->childs) > 0)
        @php
            // Creating parents list separated by ->.
            $parents = $parent . '-';
        @endphp
        @include('frontend.showcategories', ['subcategories' => $sub->childs, 'parent' => $parents])
    @endif 
@endforeach