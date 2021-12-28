<a href="{{ route('admin.logos-categories.edit', $category) }}"
   class="btn bg-gradient-primary btn-md">
    <i class="fas fa-edit"></i>
    Edit
</a>
<a href="#" class="btn bg-gradient-danger btn-md remove"
   data-remove-link="{{ route('admin.logos-categories.destroy', $category) }}">
    <i class="fas fa-trash-alt"></i>
    Remove
</a>
