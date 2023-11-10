function escapeHTML(html) {
	var map = {
		"&": "&amp;",
		"<": "&lt;",
		">": "&gt;",
		'"': "&quot;",
		"'": "&#039;",
	};

	return html.replace(/[&<>"']/g, (m) => map[m]);
}

