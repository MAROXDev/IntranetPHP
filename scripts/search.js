$(document).ready(function () {
    const searchInput = $('#search-input');
    const searchResults = $('#search-results');

    function fetchResults(searchTerm = '') {
        $.ajax({
            url: '',
            method: 'POST',
            data: { searchTerm },
            success: function (response) {
                searchResults.html(response);
            },
            error: function () {
                searchResults.html('<tr><td colspan="4">Error while fetching results. Please try again later.</td></tr>');
            },
        });
    }

    // Cargar el payload aunque no escriban nada
    fetchResults();

    searchInput.on('keyup', function () {
        const searchTerm = $(this).val().trim();
        fetchResults(searchTerm);
    });

    $('#search-button').on('click', function () {
        searchInput.trigger('keyup');
    });
});
