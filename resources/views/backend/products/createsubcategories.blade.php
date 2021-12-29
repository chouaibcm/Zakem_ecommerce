@foreach ($subcategories as $sub)
    <option value="{{ $sub->id }}">{{ $parent}} -> {{ $sub->name }}</option>

    @if (count($sub->childs) > 0)
        @php
            // Creating parents list separated by ->.
            $parents = $parent . '->' . $sub->name;
        @endphp
        @include('backend.products.createsubcategories', ['subcategories' => $sub->childs, 'parent' => $parents])
    @endif 
@endforeach