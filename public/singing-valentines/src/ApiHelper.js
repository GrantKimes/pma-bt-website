import OrderContainer from './types/OrderContainer';

export default class ApiHelper {
	static baseUrl = "http://pmalocal/api";

	static GetOrders() {
		return fetch(this.baseUrl+"/orders")
			.then(function(response) {
				if (response.ok) {
					var json = response.json();
					return json;
				}
				return Promise.reject(Error(response.status));

			})
			.catch(function(error) {
				console.error(error);
				return Promise.reject(Error(error.message));
			});
	}

	// Returns Promise containing OrderContainer
	static GetOrderContainer() {
		return fetch(this.baseUrl+"/orders")
			.then(function(response) {
				if (response.ok) {
					return response.json().then(function(ordersJson) {
						return OrderContainer.parseFromJson(ordersJson);
					});
				}
				return Promise.reject(Error(response.status));

			})
			.catch(function(error) {
				console.error(error);
				return Promise.reject(Error(error.message));
			});

	}
}