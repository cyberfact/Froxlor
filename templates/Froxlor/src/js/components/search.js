$(function() {
	let search = $('#search')

	search.on('submit', function (e) {
		e.preventDefault();
	});

	search.find('input').on('keyup', function () {
		let query = $(this).val();
		let dropdown = $('#search .search-results');
		// Hide search if query is empty
		if (!query.length) {
			dropdown.html('');
			dropdown.parent().hide();
			return;
		}
		// Show notification for short search query
		if (query.length && query.length < 3) {
			dropdown.html('<li class="list-group-item text-muted">Please enter more than 2 characters</li>');
			dropdown.parent().show();
			return;
		}
		// Search
		$.ajax({
			url: "lib/ajax.php?action=searchglobal&theme=" + window.$theme,
			type: "POST",
			data: {
				searchtext: query
			},
			dataType: "json",
			success: data => {
				// Show notification if we got no results
				if (Object.keys(data).length === 0) {
					dropdown.html('<li class="list-group-item text-muted">Nothing found!</li>');
					dropdown.parent().show();
					return;
				}

				// Clear dropdown and show results
				dropdown.html('');
				dropdown.parent().show();
				Object.keys(data).forEach(key => {
					dropdown.append('<li class="list-group-item text-muted text-capitalize">' + key + '</li>');
					data[key].forEach(item => {
						dropdown.append('<li class="list-group-item"><a href="' + item.href + '" class="text-decoration-none">' + item.title + '</a></li>');
					});
				});
			},
			error: function (a, b) {
				console.log(a, b);
				dropdown.html('<li class="list-group-item text-muted">Whoops we got some errors!</li>');
				dropdown.parent().show();
			}
		});
	});
});
