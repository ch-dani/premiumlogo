<a href="{{ route('admin.shapes.edit', $shape->id) }}"
   class="btn bg-gradient-primary btn-md">
    <i class="fas fa-edit"></i>
    Edit
</a>
<a href="#" class="btn bg-gradient-danger btn-md remove"
   data-remove-link="{{ route('admin.shapes.destroy', $shape->id) }}">
    <i class="fas fa-trash-alt"></i>
    Remove
</a>
