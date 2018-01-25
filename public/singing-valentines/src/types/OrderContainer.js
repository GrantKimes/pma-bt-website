import Order from './Order';

export default class OrderContainer {

    constructor() {
        this.orders = [];
    }

    toDataTablesData() {
        var result = [];
        this.orders.forEach((order, index) => {
            result.push(order.getKeyValueWithData());
        });
        console.log(result);
        return result;
    }

    static parseFromJson(ordersJson) {
        var newContainer = new OrderContainer();
        ordersJson.forEach((orderJson, index) => {
            newContainer.orders.push(Order.parseFromJson(orderJson));
        });
        return newContainer;
    }

    static dataTableColumnsConfig() { 
        return Order.viewTableOrdering.map(value => { return {title: Order.getReadableName(value), data: value} });
    }



}