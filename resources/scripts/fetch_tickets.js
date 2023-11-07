const ticketEndpointURL =
	"http://localhost:9000/src/routes/ajax_endpoints/tickets.php";
const ticketList = document.querySelector("#ticket-unordered-list");
const fetchButton = document.querySelector("#ticket-fetch-button");
let offset = 2; // server returns a document with 2 entries already

const getTicketData = async (limit, offset) => {
	const finalEndpoint =
		ticketEndpointURL +
		"?" +
		new URLSearchParams({
			limit: limit,
			offset: offset,
		});
	return fetch(finalEndpoint, {
		method: "get",
		headers: {
			"Content-Type": "application/json",
		},
	})
		.then((res) => res.json())
		.then((resData) => resData)
		.catch((err) => console.error(err));
};

const addTicket = (url, id, name, snippets) => {
	const new_ticket = listEntry(url, id, name, snippets);
	ticketList.innerHTML += new_ticket;
};

const fetchAndUpdateTickets = () => {
	getTicketData(2, offset)
		.then((data) => {
			//map each entry on the array to a new ticket entry
			if (data.length === 0) {
				fetchButton.disabled = true;
			} else {
				data.map((item) =>
					addTicket("/ticket", item.id, item.title, item.snippets)
				);
			}
		})
		.then((offset += 2));
};

if (ticketList && fetchButton) {
	fetchButton.addEventListener("click", fetchAndUpdateTickets);
}

getTicketData(2, offset);
