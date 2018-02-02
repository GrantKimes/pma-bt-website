import OrderContainer from './types/OrderContainer';
import Order from './types/Order';

import request from 'superagent';

export default class ApiHelper {
	static baseUrl = "/api";

	static GetOrderContainer() {
		console.log("ApiHelper base url: " + ApiHelper.baseUrl);
		return new Promise( (resolve, reject) => {
			request
				.get(ApiHelper.baseUrl+"/orders")
				.set('Accept', 'application/json')
				.then( (res) => {
					resolve(OrderContainer.parseFromJson(res.body)); 
				})
				.catch( (err) => {
					reject(err);
				});
		});
	}

	static SubmitOrder(orderFormState, shouldOverrideTimeslotFull=false) {
		var orderJson = Order.formStateToApiJson(orderFormState);
		orderJson.should_override_timeslot_full = shouldOverrideTimeslotFull
		console.log("Submitting order:");
		console.log(orderJson);

		return new Promise( (resolve, reject) => {
			request
				.post(ApiHelper.baseUrl+"/orders")
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

	static UpdateOrder(orderFormState) {
		var orderJson = Order.formStateToApiJson(orderFormState);
		console.log("Updating order:");
		console.log(orderJson);

		return new Promise( (resolve, reject) => {
			request
				.post(ApiHelper.baseUrl+"/orders/"+orderFormState.id+"/update")
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

if (process.env.NODE_ENV === "development") {
	ApiHelper.baseUrl = "http://pmalocal/api";
}
