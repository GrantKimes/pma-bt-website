import moment from 'moment';

export default class Order {

    getKeyValueWithData() {
        var result = {};
        Order.viewTableOrdering.forEach((value, index) => {
            result[value] = this[value];
        });
        return result;
    }

    static convertToAbbrevDayString(day) {
        return new moment(day, 'YYYY-MM-DD').format('ddd');
    }

    static convertToFullDayString(day) {
        return new moment(day, 'YYYY-MM-DD').format('dddd, MMMM D');
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
        newOrder.song_id = orderJson.song.id;
        newOrder.timeslot = orderJson.timeslot;
        newOrder.day = Order.convertToAbbrevDayString(orderJson.timeslot.day);
        newOrder.day_long = Order.convertToFullDayString(orderJson.timeslot.day);
        newOrder.time = Order.convertToTimeString(orderJson.timeslot);
        newOrder.comment = orderJson.comment;
        newOrder.id = orderJson.id;
        return newOrder;
    }

    static formStateToApiJson(formState) {
        return {
            recipient_name: formState.recipient_name,
            sender_name: formState.sender_name,
            sender_email: formState.sender_email,
            timeslot_id: formState.time,
            location: formState.location,
            song_id: formState.song,
            comment: formState.comment,
        };
    }


    static viewTableOrdering = [
        'location',
        'recipient_name',
        'sender_name',
        'sender_email',
        'song',
        'day',
        'time',
        'comment',
        'id',
    ]

    static orderFormFields = [
        'recipient_name',
        'sender_name',
        'sender_email',
        'day',
        'time',
        'location',
        'song',
        'comment',
    ]

    static getReadableName(name) {
        return Order.readableNames[name];
    }

    static readableNames =  {
        location: "Location",
        recipient_name: "Recipient's Name",
        sender_name: "Sender's Name",
        sender_email: "Sender's Email",
        song: "Song",
        day: "Day",
        time: "Timeslot",
        comment: "Comment",
        id: "id"
    }

    static getPlaceholderValue(name) {
        return Order.placeholderValues[name];
    }

    static placeholderValues =  {
        location: "Building & room on campus, ex: Dooly 101",
        recipient_name: "Friend's name",
        sender_name: "Your name (will remain anonymous)",
        sender_email: "Your email (for order receipt)",
        song: "-- Choose a song --",
        day: "-- Choose a day --",
        time: "-- Choose a time slot --",
        comment: "Optional",
        id: "id"
    }

}