const statusSelector = document.querySelector("#status-select");
const agentSelector = document.querySelector("#agent-select");

const toggleAgentSelector = () => {
	if (statusSelector.value === "assigned") {
		agentSelector.disabled = false;
	} else {
		agentSelector.disabled = true;
	}
};

if (statusSelector)
	statusSelector.addEventListener("change", toggleAgentSelector);
