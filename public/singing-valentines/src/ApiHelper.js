export default class ApiHelper {
	static baseUrl = "http://pmalocal/api";

	static GetOrders() {

		return fetch(this.baseUrl+"/orders")
			.then(function(response) {
				if (response.ok) {
					return response.json();
				}
				return Promise.reject(Error(response.status));
				// console.log("Got response");
				// console.log(response);
				// console.log(response.json());
				// return response.json();

			})
			// .then(function(data) {
			// 	console.log(data);
			// })
			.catch(function(error) {
				console.error(error);
				return Promise.reject(Error(error.message));
			});
		// return result;
	}
}