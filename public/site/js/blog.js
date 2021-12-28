$(function () {
    // Search
    $('#blogCategorySearch').on('keyup', function () {
        $.ajax({
            url    : '/blog/ajax/category/search',
            type   : 'GET',
            data   : {
                locale : $(this).data('locale'),
                keyword: $(this).val(),
            },
            success: function (response) {
                $('#searchCategoryResult').empty().append(response.view);
            }
        });
    });
});