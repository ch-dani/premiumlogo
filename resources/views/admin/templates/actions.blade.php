<?php if(false){ ?>
<a target="_blank" href="{{ route('logo-edit', $template->id) }}"
   class="btn bg-gradient-primary btn-md">
    <i class="fas fa-edit"></i>
    Edit
</a>
<?php } ?>
<a href="#" class="btn bg-gradient-danger btn-md remove"
   data-remove-link="{{ route('admin.templates.destroy', $template->id) }}">
    <i class="fas fa-trash-alt"></i>
    Remove
</a>
