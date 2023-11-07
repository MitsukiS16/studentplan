const faqSelect = document.querySelector("#faq-select");
const contentTextarea = document.querySelector("#comment_content");
const submitButton = document.querySelector(".submit-button");

const updateSubmitButton = () => {
	if (
		(faqSelect && faqSelect.value) ||
		(contentTextarea && contentTextarea.value)
	) {
		submitButton.disabled = false;
	} else {
		submitButton.disabled = true;
	}
};

if (faqSelect) {
	faqSelect.addEventListener("change", updateSubmitButton);
}
if (contentTextarea) {
	contentTextarea.addEventListener("input", updateSubmitButton);
}
