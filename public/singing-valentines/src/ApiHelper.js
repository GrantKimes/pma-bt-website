import OrderContainer from './types/OrderContainer';
import Order from './types/Order';

import request from 'superagent';

export default class ApiHelper {
	static baseUrl = "http://pmalocal/api";

	static GetOrderContainer() {
		return new Promise( (resolve, reject) => {
			request
				.get(this.baseUrl+"/orders")
				.set('Accept', 'application/json')
				.then( (res) => {
					resolve(OrderContainer.parseFromJson(res.body)); 
				})
				.catch( (err) => {
					reject(err);
				});
		});
	}

	static SubmitOrder(orderFormState) {
		var orderJson = Order.formStateToApiJson(orderFormState);
		console.log("Submitting order:");
		console.log(orderJson);

		return new Promise( (resolve, reject) => {
			request
				.post(this.baseUrl+"/orders")
				.send(orderJson)
				.set('Accept', 'application/json')
				.set('Content-Type', 'application/json')
				.then( (res) => {
					resolve(res.body); 
				})
				.catch( (err) => {
					reject(err);
				});
		});
	}
}