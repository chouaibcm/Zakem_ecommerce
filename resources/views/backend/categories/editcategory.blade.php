@foreach ($subcategories as $sub)
    <option value="{{ $sub->id }}" {{ $category->id == $sub->id ? 'selected' : '' }}>{{ $parent}} -> {{ $sub->name }}</option>

    @if (count($sub->childs) > 0)
        @php
            // Creating parents list separated by ->.
            $parents = $parent . '->' . $sub->name;
        @endphp
        @include('backend.categories.editcategory', ['subcategories' => $sub->childs, 'parent' => $parents,'category'=> $category])
    @endif
@endforeach