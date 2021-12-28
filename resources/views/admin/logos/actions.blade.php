<a href="{{ route('admin.logos.edit', $logo->id) }}"
   class="btn bg-gradient-primary btn-md">
    <i class="fas fa-edit"></i>
    Edit
</a>
<a href="#" class="btn bg-gradient-danger btn-md remove"
   data-remove-link="{{ route('admin.logos.destroy', $logo->id) }}">
    <i class="fas fa-trash-alt"></i>
    Remove
</a>
