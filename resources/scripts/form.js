const tagsInput = document.querySelector(".tags-input");
if (tagsInput) {
	const input = tagsInput.querySelector("input");
	const hashtagsInput = document.querySelector("#hashtags-input");

	// Update hidden input that stores the hashtags that will be sent to the server using a comma-separated list
	function updateHashtagsInput() {
		const tags = Array.from(tagsInput.querySelectorAll(".tag span"));
		//transform to set to remove duplicates
		const tagsSet = new Set(tags.map((tag) => tag.textContent));
		// convert back to array
		const tagsArray = Array.from(tagsSet);
		hashtagsInput.value = tagsArray.join(",");
	}

	// Allows to remove a tag by clicking on the 'x' button
	function addRemoveTagEventListener(tag) {
		const removeTag = tag.querySelector(".remove-tag");
		removeTag.addEventListener("click", () => {
			tag.remove();
			updateHashtagsInput();
		});
	}

	// Create a new hashtag and respective div
	function createTagElement(tagValue) {
		const tag = document.createElement("div");
		tag.classList.add("tag");
		tag.innerHTML = `<span>${escapeHTML(tagValue)}</span> <i class="remove-tag">x</i>`;
		addRemoveTagEventListener(tag);
		return tag;
	}

	// Hashtag is added when spacebar is pressed by the user (prevents the form submission using enter and makes impossible for hashtags to have a space)
	function handleInputKeydown(e) {
		if (e.key === " ") {
			let tagValue = e.target.value.trim();
			if (tagValue !== "") {
				while (tagValue.startsWith("##")) {
					tagValue = tagValue.slice(1);
				}
				if (tagValue[0] !== "#") {
					tagValue = "#" + tagValue;
				}
				// remove any spaces in the middle of the hashtag
				tagValue = tagValue.replace(/\s/g, "");
				// remove any '#' in the middle of the hashtag
				tagValue = tagValue[0] + tagValue.slice(1).replace(/#/g, "");
				if (tagValue.length === 1) {
					return;
				}
				const tag = createTagElement(tagValue);
				tagsInput.insertBefore(tag, input);
				e.target.value = "";
				updateHashtagsInput();
			}
		}
	}

	// Allows existing hashtags in the database to be deleted in the edit form
	Array.from(tagsInput.querySelectorAll(".tag")).forEach(
		addRemoveTagEventListener
	);

	input.addEventListener("keydown", handleInputKeydown);

	updateHashtagsInput();
}
