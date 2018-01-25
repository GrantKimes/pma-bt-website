import moment from 'moment';

export default class Order {

    getKeyValueWithData() {
        var result = {};
        Order.viewTableOrdering.forEach((value, index) => {
            result[value] = this[value];
        });
        return result;
    }

    static convertToDayString(timeslot) {
        return new moment(timeslot.day, 'YYYY-MM-DD').format('ddd');
    }

    static convertToTimeString(timeslot) {
        var start = moment(timeslot.start_time, "HH:mm:ss");
        var end = moment(timeslot.end_time, "HH:mm:ss");
        return start.format('h:mma') + " - " + end.format('h:mma');
    }

    static parseFromJson(orderJson) {
        var newOrder = new Order();
        newOrder.location = orderJson.location;
        newOrder.recipient_name = orderJson.recipient_name;
        newOrder.sender_name = orderJson.sender_name;
        newOrder.sender_email = orderJson.sender_email;
        newOrder.song = orderJson.song.title;
        newOrder.timeslot = orderJson.timeslot;
        newOrder.day = Order.convertToDayString(orderJson.timeslot);
        newOrder.time = Order.convertToTimeString(orderJson.timeslot);
        newOrder.comment = orderJson.comment;
        newOrder.id = orderJson.id;
        return newOrder;
    }


    static viewTableOrdering = [
        'id',
        'location',
        'recipient_name',
        'sender_name',
        'sender_email',
        'song',
        'day',
        'time',
        'comment',
    ]

    static getReadableName(name) {
        return Order.readableNames[name];
    }

    static readableNames =  {
        location: "Location",
        recipient_name: "Recipient's Name",
        sender_name: "Sender's Name",
        sender_email: "Sender's email",
        song: "Song",
        day: "Day",
        time: "Timeslot",
        comment: "Comment",
        id: "id"
    }

}