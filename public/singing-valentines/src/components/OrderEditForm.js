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

export default class OrderEditForm extends React.Component {
    constructor(props) {
        super(props);
        console.log(props);
        this.state = {
            id: this.props.orderBeingEdited.id,
            location: this.props.orderBeingEdited.location,
            recipient_name: this.props.orderBeingEdited.recipient_name,
            sender_name: this.props.orderBeingEdited.sender_name,
            sender_email: this.props.orderBeingEdited.sender_email,
            song: this.props.orderBeingEdited.song_id,
            day: this.props.orderBeingEdited.timeslot.day,
            time: this.props.orderBeingEdited.timeslot.id,
            comment: this.props.orderBeingEdited.comment,
            daysDropdownValues: this.props.orderContainer.getDaysDropdownValues(),
            timesDropdownValues: this.props.orderContainer.getTimesDropdownValues(this.props.orderBeingEdited.timeslot.day),
            songsDropdownValues: this.props.orderContainer.getSongsDropdownValues(),
            orderContainer: this.props.orderContainer,
            errorMessage: "",
            successMessage: "",
            submitButtonDisabled: false,
        }
    }

    componentDidMount = () => {
        // ApiHelper.GetOrderContainer().then(this.onOrderContainerLoaded);
        // this.setState({daysDropdownValues: this.props.orderContainer.getDaysDropdownValues()});
        // this.setState({songsDropdownValues: this.props.orderContainer.getSongsDropdownValues()});
        // this.setState({orderContainer: this.props.orderContainer});
    }

    // onOrderContainerLoaded = (orderContainer) => {
    //     console.log(orderContainer);
    // }

    inputChanged = (event) => {
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
            this.setState({errorMessage: "You must fill out all fields."});
            return;
        }
        else {
            this.setState({errorMessage: ""});
        }
        this.setState({submitButtonDisabled: true});
        console.log("Submitting order for editing:");
        ApiHelper.UpdateOrder(this.state).then(this.onOrderSubmitted).catch(this.onOrderFailed);
    }

    onOrderSubmitted = (response) => {
        console.log("Order updated:");
        console.log(response);
        this.setState({successMessage: "The order was updated successfully!"});
    }

    onOrderFailed = (response) => {
        console.log("Order failed:");
        console.error(response);
        this.setState({errorMessage: "Failed to update order, you may need to refresh the page."});
        this.setState({submitButtonDisabled: false});
    }

    render() {
        return (
            <div className="row">
                <div className="col-md-12">
                    <form className="form-horizontal">

                        <TextInput 
                            formName="recipient_name" 
                            value={this.state.recipient_name}
                            onChange={this.inputChanged}>
                        </TextInput>

                        <TextInput 
                            formName="sender_name"
                            value={this.state.sender_name}
                            onChange={this.inputChanged}>
                        </TextInput>

                        <TextInput 
                            formName="sender_email"
                            value={this.state.sender_email}
                            onChange={this.inputChanged}>
                        </TextInput>

                        <DropdownInput
                            formName="day"
                            value={this.state.day}
                            onChange={this.inputChanged}
                            dropdownValues={this.state.daysDropdownValues}>
                        </DropdownInput>

                        <DropdownInput
                            formName="time"
                            value={this.state.time}
                            onChange={this.inputChanged}
                            dropdownValues={this.state.timesDropdownValues}>
                        </DropdownInput>

                        <TextInput 
                            formName="location"
                            value={this.state.location}
                            onChange={this.inputChanged}>
                        </TextInput>

                        <DropdownInput
                            formName="song"
                            value={this.state.song}
                            onChange={this.inputChanged}
                            dropdownValues={this.state.songsDropdownValues}>
                        </DropdownInput>

                        <TextAreaInput 
                            formName="comment"
                            value={this.state.comment}
                            onChange={this.inputChanged}>
                        </TextAreaInput>

                        <ErrorIndicator
                            errorMessage={this.state.errorMessage}>
                        </ErrorIndicator>

                        <SubmittedIndicator
                            successMessage={this.state.successMessage}>
                        </SubmittedIndicator>

                        <div className="col-md-6 col-md-offset-3">
                            <button 
                                onClick={this.submitOrder}
                                disabled={this.state.submitButtonDisabled}
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