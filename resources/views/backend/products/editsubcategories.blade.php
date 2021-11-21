@foreach ($subcategories as $sub)
    <option value="{{ $sub->id }}" {{ $product->category_id == $sub->id ? 'selected' : '' }}>{{ $parent}} -> {{ $sub->name }}</option>

    @if (count($sub->childs) > 0)
        @php
            // Creating parents list separated by ->.
            $parents = $parent . '->' . $sub->name;
        @endphp
        @include('backend.products.editsubcategories', ['subcategories' => $sub->childs, 'parent' => $parents,'product'=> $product])
    @endif
@endforeach