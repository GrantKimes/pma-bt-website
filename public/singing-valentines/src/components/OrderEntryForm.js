import React from 'react';
import moment from 'moment';

import TextInput from './TextInput';
import TextAreaInput from './TextAreaInput';
import DropdownInput from './DropdownInput';
import ApiHelper from '../ApiHelper';
import ErrorIndicator from './ErrorIndicator';
import SubmittedIndicator from './SubmittedIndicator';

import OrderContainer from '../types/OrderContainer';
import Order from '../types/Order';

export default class OrderEntryForm extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            location: "",
            recipient_name: "",
            sender_name: "",
            sender_email: "",
            song: "",
            day: "",
            time: "",
            comment: "",
            daysDropdownValues: [],
            timesDropdownValues: [],
            songsDropdownValues: [],
            orderContainer: {},
            error: "",
            successMessage: "",
        }
    }

    componentDidMount = () => {
        ApiHelper.GetOrderContainer().then(this.onOrderContainerLoaded);
    }

    onOrderContainerLoaded = (orderContainer) => {
        console.log(orderContainer);
        this.setState({daysDropdownValues: orderContainer.getDaysDropdownValues()});
        this.setState({songsDropdownValues: orderContainer.getSongsDropdownValues()});
        this.setState({orderContainer: orderContainer});
    }

    textInputChanged = (event) => {
        var inputName = event.target.name;
        var inputValue = event.target.value;
        this.setState({[inputName]: inputValue});
    }

    dropdownInputChanged = (event) => {
        var inputName = event.target.name;
        var inputValue = event.target.value;
        this.setState({[inputName]: inputValue});
        if (inputName === 'day') {
            this.setState({timesDropdownValues: this.state.orderContainer.getTimesDropdownValues(inputValue)});
        }
    }

    submitOrder = () => {
        var allFieldsFilledOut = Order.orderFormFields.every(formName => {
            // return this.state[formName] !== "" || formName === 'comment';
            // TODO: Make comment field optional
            return this.state[formName] !== "";
        });
        console.log("fields filled out: " + allFieldsFilledOut);
        if (!allFieldsFilledOut) {
            this.setState({error: "You must fill out all fields."});
            return;
        }
        else {
            this.setState({error: ""});
        }
        ApiHelper.SubmitOrder(this.state).then(this.onOrderSubmitted).catch(this.onOrderFailed);
    }

    onOrderSubmitted = (response) => {
        console.log("Order submitted:");
        console.log(response);
        this.setState({successMessage: "Order submitted!"});
    }

    onOrderFailed = (response) => {
        console.log("Order failed:");
        console.error(response);
    }

    render() {
        return (
            <div className="row">
                <div className="col-md-12">
                    <form className="form-horizontal">

                        <TextInput 
                            formName="recipient_name" 
                            value={this.state.recipient_name}
                            onChange={this.textInputChanged}>
                        </TextInput>

                        <TextInput 
                            formName="sender_name"
                            value={this.state.sender_name}
                            onChange={this.textInputChanged}>
                        </TextInput>

                        <TextInput 
                            formName="sender_email"
                            value={this.state.sender_email}
                            onChange={this.textInputChanged}>
                        </TextInput>

                        <DropdownInput
                            formName="day"
                            value={this.state.day}
                            onChange={this.dropdownInputChanged}
                            dropdownValues={this.state.daysDropdownValues}>
                        </DropdownInput>

                        <DropdownInput
                            formName="time"
                            value={this.state.time}
                            onChange={this.dropdownInputChanged}
                            dropdownValues={this.state.timesDropdownValues}>
                        </DropdownInput>

                        <TextInput 
                            formName="location"
                            value={this.state.location}
                            onChange={this.textInputChanged}>
                        </TextInput>

                        <DropdownInput
                            formName="song"
                            value={this.state.song}
                            onChange={this.dropdownInputChanged}
                            dropdownValues={this.state.songsDropdownValues}>
                        </DropdownInput>

                        <TextAreaInput 
                            formName="comment"
                            value={this.state.comment}
                            onChange={this.textInputChanged}>
                        </TextAreaInput>

                        <ErrorIndicator
                            errorMessage={this.state.error}>
                        </ErrorIndicator>

                        <SubmittedIndicator
                            successMessage={this.state.successMessage}>
                        </SubmittedIndicator>


                        <div className="col-md-6 col-md-offset-3">
                            <button 
                                onClick={this.submitOrder}
                                type="button" 
                                className="btn btn-block btn-primary">
                                <span>Submit</span>
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        );
    }
}