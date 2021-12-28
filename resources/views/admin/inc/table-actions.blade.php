<a href="{{ route('admin.'.$route.'.edit', $item->id) }}"
   class="btn bg-gradient-primary btn-md">
    <i class="fas fa-edit"></i>
    Edit
</a>

@if($route != 'menu')
    <a href="#" class="btn bg-gradient-danger btn-md remove"
       data-remove-link="{{ route('admin.'.$route.'.destroy', $item->id) }}">
        <i class="fas fa-trash-alt"></i>
        Remove
    </a>
@endif