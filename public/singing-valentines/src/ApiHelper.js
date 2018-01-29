import OrderContainer from './types/OrderContainer';
import Order from './types/Order';

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

	static SubmitOrder(orderFormState) {
		// console.log(orderFormState);
		var orderJson = Order.formStateToApiJson(orderFormState);
		// can't do this, need name mapping 
		// Order.orderFormFields.forEach(fieldName => {
		// 	order[fieldName] = orderFormState[fieldName];
		// });
		console.log("Submitting order:");
		console.log(orderJson);
		console.log(JSON.stringify(orderJson));

		return fetch(this.baseUrl+"/orders", {
			method: 'POST',
			body: JSON.stringify(orderJson),
			headers: {
			    'Accept': 'application/json',
			    'Content-Type': 'application/json',
			 },
			// mode: 'no-cors',
		})
			.then(function(response) {
				if (response.ok) {
					var json = response.json();
					return json;
				}
				console.log(response);
				return Promise.reject(Error(response.status));

			})
			.catch(function(error) {
				console.error(error);
				return Promise.reject(Error(error.message));
			});
	}
}