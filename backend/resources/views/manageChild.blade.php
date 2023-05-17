<ul>
    @foreach ($childs as $child)
        <li >
            <i class="fas fa-trash category-event" onClick="deleteCategory({{ $child->id }})"></i>
            {{ $child->title }} ({{ $child->countProductLinkWithCategory()->count() }})
            <i class="fas fa-plus category-event" onClick="addOrUpdateCategory({{ $child->id }},'add')"></i>
            <i class="fas fa-edit category-event" onClick="addOrUpdateCategory({{ $child->id }},'edit')"></i>
            @if (count($child->childs))
                @include('manageChild', ['childs' => $child->childs])
            @endif
        </li>
    @endforeach
</ul>
