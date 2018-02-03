import moment from 'moment';

import Order from './Order';

export default class OrderContainer {

    constructor() {
        this.orders = [];
        this.ordersById = {};
        this.days = [];
        this.timeslots = [];
        this.songs = [];
    }

    toDataTablesData(isEditingTable) {
        var result = [];
        this.orders.forEach((order, index) => {
            var orderRow = order.getKeyValueWithData();
            if (isEditingTable) {
                orderRow['edit'] = "<button class='btn btn-primary edit-button' data-order-id="+orderRow.id+">Edit</button>";
            }
            result.push(orderRow);
        });
        return result;
    }

    getOrderById(orderId) {
        return this.ordersById[orderId];
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

    getTimesDropdownValues(selectedDay, includeNumberOfOrders, shouldOverrideTimeslotFull) {
        return this.timeslots.filter(timeslot => timeslot.day === selectedDay).map(timeslot => {
            var dropdownValue = Order.convertToTimeString(timeslot);
            if (includeNumberOfOrders) {
                dropdownValue += " ("+timeslot.num_filled_slots+"/"+timeslot.num_available_slots+")";
            }
            var result = {
                value: timeslot.id, 
                readable: dropdownValue,
            };
            if (shouldOverrideTimeslotFull) {
                return result;
            }

            var isSlotFull = timeslot.num_filled_slots >= timeslot.num_available_slots;
            if (isSlotFull) {
                result.disabled = true;
                result.readable = result.readable + " (full)";
            }
            return result;
        });
    }

    getDataTablesColumnsConfig(isEditing) {
        var columnsConfig = Order.viewTableOrdering.map(columnName => { 
            return {
                title: Order.getReadableName(columnName), 
                data: columnName, 
                name: columnName,
                visible: (columnName !== 'id'),
            };
        });
        if (isEditing) {
            columnsConfig.unshift({
                title: "Edit", 
                data: "edit", 
                name: "edit"
            });
        }
        return columnsConfig;
    }

    getDataTablesOrdering(isEditing) {
        var idColumnIndex = null;
        this.getDataTablesColumnsConfig(isEditing).forEach((column, index) => {
            if (column.data === 'id') {
                idColumnIndex = index;
            }
        });
        return [[idColumnIndex, 'desc']];
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
        var timeslot = this.timeslots.find(timeslot => timeslot.id === Number(filterTime));
        return Order.convertToTimeString(timeslot);
    }

    static parseFromJson(ordersJson) {
        var newContainer = new OrderContainer();
        ordersJson.orders.forEach(orderJson => {
            var order = Order.parseFromJson(orderJson);
            newContainer.orders.push(order);
            newContainer.ordersById[order.id] = order;
        });
        newContainer.days = ordersJson.days.map(value => value.day);
        newContainer.timeslots = ordersJson.timeslots;
        newContainer.songs = ordersJson.songs;
        return newContainer;
    }

}
