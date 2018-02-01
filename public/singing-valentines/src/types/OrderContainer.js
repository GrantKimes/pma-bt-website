import moment from 'moment';

import Order from './Order';

export default class OrderContainer {

    constructor() {
        this.orders = [];
        this.days = [];
        this.timeslots = [];
    }

    toDataTablesData(isEditing) {
        var result = [];
        this.orders.forEach((order, index) => {
            var orderRow = order.getKeyValueWithData();
            if (isEditing) {
                orderRow['edit'] = "<button class='btn btn-primary edit-button' data-order-id="+orderRow.id+" data-toggle='modal' data-target='#edit-order-modal'>Edit</button>";
            }
            result.push(orderRow);
        });
        return result;
    }

    getOrderById(orderId) {
        return this.orders.find(order => order.id === orderId);
    }

    getDaysDropdownValues() {
        return this.days.map(day => {
            return {
                value: day, 
                readable: new moment(day, 'YYYY-MM-DD').format('dddd, MMMM D'),
                disabled: false
            };
        });
    }

    getSongsDropdownValues() {
        return this.songs.map(song => {
            return {
                value: song.id, 
                readable: song.title,
                disabled: false
            };
        });
    }

    getTimesDropdownValues(selectedDay, includeNumberOfOrders) {
        return this.timeslots.filter(timeslot => timeslot.day === selectedDay).map(timeslot => {
            var dropdownValue = Order.convertToTimeString(timeslot);
            if (includeNumberOfOrders) {
                dropdownValue += " ("+timeslot.num_filled_slots+"/"+timeslot.num_available_slots+")";
            }
            var isSlotFull = timeslot.num_filled_slots >= timeslot.num_available_slots;
            return {
                value: timeslot.id, 
                readable: dropdownValue,
                disabled: isSlotFull
            };
        });
    }

    getDataTablesColumnsConfig(isEditing) {
        var columnsConfig = Order.viewTableOrdering.map(columnName => { return {title: Order.getReadableName(columnName), data: columnName, name: columnName} });
        if (isEditing) {
            columnsConfig.unshift({title: "Edit", data: "edit", name: "edit"});
        }
        return columnsConfig;
    }

    dayToDTSearchFormat(filterDay) {
        if (filterDay === "") {
            return "";
        }
        return Order.convertToAbbrevDayString(filterDay);
    }

    timeToDTSearchFormat(filterTime) {
        if (filterTime === "") {
            return "";
        }
        var timeslot = this.timeslots.find(timeslot => timeslot.id == filterTime);
        return Order.convertToTimeString(timeslot);
    }

    static parseFromJson(ordersJson) {
        console.log(ordersJson);
        var newContainer = new OrderContainer();
        ordersJson.orders.forEach(orderJson => {
            newContainer.orders.push(Order.parseFromJson(orderJson));
        });
        newContainer.days = ordersJson.days.map(value => value.day);
        newContainer.timeslots = ordersJson.timeslots;
        newContainer.songs = ordersJson.songs;
        return newContainer;
    }

}
