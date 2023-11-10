function listEntry(url, id, name) {
	return `
    <a class="w-full" href="${url}?id=${id}">
        <div class="list-item-card container-box container-box-interactable">
            <h3>${escapeHTML(name)}</h3>
        </div>
    </a>`;
}
