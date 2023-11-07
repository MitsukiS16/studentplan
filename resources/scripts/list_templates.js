function buildSnippets(snippets) {
	htmlStr = "";
	for (let [label, value] of Object.entries(snippets)) {
		if (value !== "") {
			value = escapeHTML(value);
			label = escapeHTML(label);
			switch (label) {
				case "Status":
					htmlStr += `
                    <div class="${value}-bubble status-bubble">
                        <p>${value}</p>
                    </div>
                    `;
					break;
				case "Hashtags":
					htmlStr += `
                    <div class="hashtag-bubble status-bubble">
                        <p>${label}: ${value}</p>
                    </div>
                    `;
					break;
				default:
					htmlStr += `<p>${label}: ${value}</p>`;
					break;
			}
		}
	}
	return htmlStr;
}

function listEntry(url, id, name, snippets) {
	return `
    <a class="w-full" href="${url}?id=${id}">
        <div class="list-item-card container-box container-box-interactable">
            <h3>${escapeHTML(name)}</h3>
            <div class="simple-flex-row items-center">
                ${buildSnippets(snippets)}
            </div>
        </div>
    </a>`;
}
