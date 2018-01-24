import React from 'react';
import moment from 'moment';

import TextInput from './TextInput';
import DropdownInput from './DropdownInput';
import ApiHelper from '../ApiHelper';

export default class OrderEntryForm extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            days: [],
            daysDropdownValues: [],
            timeslotsDropdownValues: [],
            songsDropdownValues: [],
        }
    }

    componentDidMount = () => {
        ApiHelper.GetOrders().then(this.onOrdersReceived);

    }

    onOrdersReceived = (orders) => {
        // console.log(orders);
        var days = orders.map((order) => moment(order.timeslot.day, "YYYY-MM-DD"));
        // days = ["Monday", "Tuesday"];
        // console.log(days);
        this.setState({days: [...this.state.days, ...days] });
        // console.log(this.state.days);
        // var daysDropdownValues = days.map((day) => { return {value: day.format('YYYY-MM-DD'), readableValue: day.format('dddd, MMMM D')} });
        var daysDropdownValues = days.map((day) => [day.format('YYYY-MM-DD'), day.format('dddd, MMMM D')] );
        this.setState({daysDropdownValues: daysDropdownValues});

        var timeslots = orders.map(order => order.timeslot);
        // console.log(timeslots);

        function formatTimeslotToReadable(timeslot) {
            var start = moment(timeslot.start_time, "HH:mm:ss");
            var end = moment(timeslot.end_time, "HH:mm:ss");
            return start.format('h:mma') + " - " + end.format('h:mma');
        }

        var timeslotsDropdownValues = timeslots.map(timeslot => [timeslot.id, formatTimeslotToReadable(timeslot)]);
        // console.log(timeslotsDropdownValues);
        this.setState({timeslotsDropdownValues: timeslotsDropdownValues});
        // console.log(this.state);

        var songs = orders.map(order => order.song);
        console.log(songs);
        var songsDropdownValues = songs.map(song => [song.id, song.title]);
        console.log(songsDropdownValues);
        this.setState({songsDropdownValues: songsDropdownValues});
    }

    render() {
        return (
            <div className="row">
                <div className="col-md-12">
                    <form method="POST" action="/sv" className="form-horizontal">

                        <TextInput 
                            formName="recipient_name" 
                            readableName="Recipients's name" 
                            placeholder="Friend's name">
                        </TextInput>

                        <TextInput 
                            formName="sender_name"
                            readableName="Senders's name" 
                            placeholder="Your name (will remain anonymous)">
                        </TextInput>

                        <TextInput 
                            formName="sender_email"
                            readableName="Sender's email address" 
                            placeholder="Your email (for order receipt)">
                        </TextInput>

                        <DropdownInput
                            formName="day"
                            readableName="Day" 
                            placeholder="-- Choose a day --"
                            dropdownValues={this.state.daysDropdownValues}>
                        </DropdownInput>

                        <DropdownInput
                            formName="timeslot"
                            readableName="Time slot" 
                            placeholder="-- Choose a time slot --"
                            dropdownValues={this.state.timeslotsDropdownValues}>
                        </DropdownInput>

                        <TextInput 
                            formName="location"
                            readableName="Location" 
                            placeholder="Building & room on campus, ex: Dooly 101">
                        </TextInput>

                        <DropdownInput
                            formName="song"
                            readableName="Song" 
                            placeholder="-- Choose a song --"
                            dropdownValues={this.state.songsDropdownValues}>
                        </DropdownInput>

                        {/*TODO: Make this TextareaInput*/}
                        <TextInput 
                            formName="comments"
                            readableName="Comments" 
                            placeholder="Optional">
                        </TextInput>

                    </form>
                </div>
            </div>
        );
    }
}