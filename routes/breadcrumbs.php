<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

Breadcrumbs::for('admin.dashboard', function ($trail) {
    $trail->push('Dashboard', route('admin.dashboard'));
});



Breadcrumbs::for('admin.templates.index', function ($trail) {
    $trail->push('All templates', route('admin.templates.index'));
});




Breadcrumbs::for('admin.plans.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('All playment plans', route('admin.plans.index'));
});

Breadcrumbs::for('admin.logos.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('All Logos', route('admin.logos.index'));
});
Breadcrumbs::for('admin.logos.create', function ($trail) {
    $trail->parent('admin.logos.index');
    $trail->push('Add Logo', route('admin.logos.create'));
});
Breadcrumbs::for('admin.logos.edit', function ($trail, $id) {
    $trail->parent('admin.logos.index');
    $trail->push('Edit Logo #' . $id, route('admin.logos.edit', $id));
});
Breadcrumbs::for('admin.logos.import', function ($trail) {
    $trail->parent('admin.logos.index');
    $trail->push('Logos Import', route('admin.logos.import'));
});

Breadcrumbs::for('admin.logos-categories.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('All Categories', route('admin.logos-categories.index'));
});
Breadcrumbs::for('admin.logos-categories.create', function ($trail) {
    $trail->parent('admin.logos-categories.index');
    $trail->push('Add Category', route('admin.logos-categories.create'));
});
Breadcrumbs::for('admin.logos-categories.edit', function ($trail, $id) {
    $trail->parent('admin.logos-categories.index');
    $trail->push('Edit Category #' . $id, route('admin.logos-categories.edit', $id));
});

Breadcrumbs::for('admin.shapes.index', function ($trail) {
	$trail->parent('admin.dashboard');
	$trail->push('All Shapes', route('admin.shapes.index'));
});
Breadcrumbs::for('admin.shapes.create', function ($trail) {
	$trail->parent('admin.shapes.index');
	$trail->push('Add Shape', route('admin.shapes.create'));
});
Breadcrumbs::for('admin.shapes.edit', function ($trail, $id) {
	$trail->parent('admin.shapes.index');
	$trail->push('Edit Shape #' . $id, route('admin.shapes.edit', $id));
});
Breadcrumbs::for('admin.shapes.import', function ($trail) {
    $trail->parent('admin.shapes.index');
    $trail->push('Shapes Import', route('admin.shapes.import'));
});

Breadcrumbs::for('admin.icons.index', function ($trail) {
	$trail->parent('admin.dashboard');
	$trail->push('All Icons', route('admin.icons.index'));
});
Breadcrumbs::for('admin.icons.create', function ($trail) {
	$trail->parent('admin.icons.index');
	$trail->push('Add Icon', route('admin.icons.create'));
});
Breadcrumbs::for('admin.icons.edit', function ($trail, $id) {
	$trail->parent('admin.icons.index');
	$trail->push('Edit Icon #' . $id, route('admin.icons.edit', $id));
});
Breadcrumbs::for('admin.icons.import', function ($trail) {
    $trail->parent('admin.icons.index');
    $trail->push('Icons Import', route('admin.icons.import'));
});

Breadcrumbs::for('admin.faq.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('All Questions', route('admin.faq.index'));
});
Breadcrumbs::for('admin.faq.create', function ($trail) {
    $trail->parent('admin.faq.index');
    $trail->push('Add Question', route('admin.faq.create'));
});
Breadcrumbs::for('admin.faq.edit', function ($trail, $id) {
    $trail->parent('admin.faq.index');
    $trail->push('Edit Question #' . $id, route('admin.faq.edit', $id));
});

Breadcrumbs::for('admin.faq-categories.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('All Categories', route('admin.faq-categories.index'));
});
Breadcrumbs::for('admin.faq-categories.create', function ($trail) {
    $trail->parent('admin.faq-categories.index');
    $trail->push('Add Category', route('admin.faq-categories.create'));
});
Breadcrumbs::for('admin.faq-categories.edit', function ($trail, $id) {
    $trail->parent('admin.faq-categories.index');
    $trail->push('Edit Category #' . $id, route('admin.faq-categories.edit', $id));
});

Breadcrumbs::for('admin.testimonials.index', function ($trail) {
	$trail->parent('admin.dashboard');
	$trail->push('All Testimonials', route('admin.testimonials.index'));
});
Breadcrumbs::for('admin.testimonials.create', function ($trail) {
	$trail->parent('admin.testimonials.index');
	$trail->push('Add Testimonial', route('admin.testimonials.create'));
});
Breadcrumbs::for('admin.testimonials.edit', function ($trail, $id) {
	$trail->parent('admin.testimonials.index');
	$trail->push('Edit Testimonial #' . $id, route('admin.testimonials.edit', $id));
});

Breadcrumbs::for('admin.team.index', function ($trail) {
	$trail->parent('admin.dashboard');
	$trail->push('All Team Members', route('admin.team.index'));
});
Breadcrumbs::for('admin.team.create', function ($trail) {
	$trail->parent('admin.team.index');
	$trail->push('Add Team Member', route('admin.team.create'));
});
Breadcrumbs::for('admin.team.edit', function ($trail, $id) {
	$trail->parent('admin.team.index');
	$trail->push('Edit Team Member #' . $id, route('admin.team.edit', $id));
});

Breadcrumbs::for('admin.pages.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('All Pages', route('admin.pages.index'));
});
Breadcrumbs::for('admin.pages.create', function ($trail) {
    $trail->parent('admin.pages.index');
    $trail->push('Add Page', route('admin.pages.create'));
});
Breadcrumbs::for('admin.pages.edit', function ($trail, $id) {
    $trail->parent('admin.pages.index');
    $trail->push('Edit Page #' . $id, route('admin.pages.edit', $id));
});

Breadcrumbs::for('admin.blocks.home-header', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Home: Header', route('admin.blocks.home-header'));
});

Breadcrumbs::for('admin.blocks.create-logo-in-seconds', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Create a Logo in Seconds', route('admin.blocks.create-logo-in-seconds'));
});

Breadcrumbs::for('admin.blocks.how-create-logo', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('How to create a logo?', route('admin.blocks.how-create-logo'));
});

Breadcrumbs::for('admin.blocks.why-choose-freeLogoDesign', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Why choose FreeLogoDesign', route('admin.blocks.why-choose-freeLogoDesign'));
});

Breadcrumbs::for('admin.blocks.professional-logos-for-your-company', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Professional logos for your company', route('admin.blocks.professional-logos-for-your-company'));
});

Breadcrumbs::for('admin.blocks.about-freeLogoDesign', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('About FreeLogoDesign', route('admin.blocks.about-freeLogoDesign'));
});

Breadcrumbs::for('admin.menu.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Menu', route('admin.menu.index'));
});
Breadcrumbs::for('admin.menu.edit', function ($trail, $id) {
	$trail->parent('admin.menu.index');
	$trail->push('Edit Menu #' . $id, route('admin.menu.edit', $id));
});

Breadcrumbs::for('admin.settings.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Settings', route('admin.settings.index'));
});

Breadcrumbs::for('admin.blog.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('All Blog Articles', route('admin.blog.index'));
});
Breadcrumbs::for('admin.blog.create', function ($trail) {
    $trail->parent('admin.blog.index');
    $trail->push('Add Article', route('admin.blog.create'));
});
Breadcrumbs::for('admin.blog.edit', function ($trail, $id) {
    $trail->parent('admin.blog.index');
    $trail->push('Edit Article #' . $id, route('admin.blog.edit', $id));
});

Breadcrumbs::for('admin.blog-categories.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('All Categories', route('admin.blog-categories.index'));
});
Breadcrumbs::for('admin.blog-categories.create', function ($trail) {
    $trail->parent('admin.blog-categories.index');
    $trail->push('Add Category', route('admin.blog-categories.create'));
});
Breadcrumbs::for('admin.blog-categories.edit', function ($trail, $id) {
    $trail->parent('admin.blog-categories.index');
    $trail->push('Edit Category #' . $id, route('admin.blog-categories.edit', $id));
});

Breadcrumbs::for('admin.designer-plans.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('All Categories', route('admin.designer-plans.index'));
});
Breadcrumbs::for('admin.designer-plans.create', function ($trail) {
    $trail->parent('admin.designer-plans.index');
    $trail->push('Add Designer Plan', route('admin.designer-plans.create'));
});
Breadcrumbs::for('admin.designer-plans.edit', function ($trail, $id) {
    $trail->parent('admin.designer-plans.index');
    $trail->push('Edit Designer Plan #' . $id, route('admin.designer-plans.edit', $id));
});

Breadcrumbs::for('admin.logo-prices.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('All Logo Prices', route('admin.logo-prices.index'));
});
Breadcrumbs::for('admin.logo-prices.create', function ($trail) {
    $trail->parent('admin.logo-prices.index');
    $trail->push('Add Logo Price', route('admin.designer-plans.create'));
});
Breadcrumbs::for('admin.logo-prices.edit', function ($trail, $id) {
    $trail->parent('admin.logo-prices.index');
    $trail->push('Edit Logo Price #' . $id, route('admin.logo-prices.edit', $id));
});

Breadcrumbs::for('admin.hire-designer-messages.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('All Hire Designer Messages', route('admin.hire-designer-messages.index'));
});
Breadcrumbs::for('admin.hire-designer-messages.edit', function ($trail, $id) {
    $trail->parent('admin.hire-designer-messages.index');
    $trail->push('Edit Hire Designer Message #' . $id, route('admin.hire-designer-messages.edit', $id));
});

Breadcrumbs::for('admin.users.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('All Users', route('admin.users.index'));
});
Breadcrumbs::for('admin.users.create', function ($trail) {
    $trail->parent('admin.users.index');
    $trail->push('Add User', route('admin.users.create'));
});
Breadcrumbs::for('admin.users.edit', function ($trail, $id) {
    $trail->parent('admin.users.index');
    $trail->push('Edit User #' . $id, route('admin.users.edit', $id));
});

Breadcrumbs::for('admin.profile.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Edit Profile', route('admin.profile.index'));
});

Breadcrumbs::for('admin.payments.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('All Payments', route('admin.payments.index'));
});
